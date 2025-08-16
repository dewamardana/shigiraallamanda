<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index',[
            'users' => $users,
            'title' => __('userControllerMessage.title_index')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.create',[
            'title' => __('userControllerMessage.title_create')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama'        => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'nomor_telp'  => 'required|numeric|digits_between:10,15',
            'department'  => 'required|string|max:255',
            'gender'      => 'required|in:L,P',
            'status'      => 'required|in:Active,Inactive',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ], [
            'nama.required'        => __('userControllerMessage.store.name_required'),
            'username.required'    => __('userControllerMessage.store.username_required'),
            'username.unique'      => __('userControllerMessage.store.username_unique'),
            'email.required'       => __('userControllerMessage.store.email_required'),
            'email.unique'         => __('userControllerMessage.store.email_unique'),
            'password.required'    => __('userControllerMessage.store.password_required'),
            'password.min'         => __('userControllerMessage.store.password_min'),
            'nomor_telp.required'  => __('userControllerMessage.store.phone_required'),
            'gender.in'            => __('userControllerMessage.store.gender_in'),
            'foto.image'           => __('userControllerMessage.store.photo_error'),
            'foto.mimes'           => __('userControllerMessage.store.photo_mimes'),
            'foto.max'             => __('userControllerMessage.store.photo_max'),
            
        ]);

        // handle upload foto (jika ada)
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto', 'public');
            $validatedData['foto'] = $fotoPath;
        }

        // generate slug dari nama
        $validatedData['slug'] = Str::slug($request->nama, '-');

        // set default role
        $validatedData['role'] = 'user';

        // hash password sebelum simpan
        $validatedData['password'] = bcrypt($validatedData['password']);

        // simpan ke database
        User::create($validatedData);

        return redirect()->route('user.index')->with('success', __('userControllerMessage.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('Dashboard.user.show',[
            'user' => $user,
            'title' => __('userControllerMessage.title_show')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $skill = Skill::all();

        return view('dashboard.user.edit',[
            'user' => $user,
            'roles' => $roles,
            'skills' => $skill,
            'title' => __('userControllerMessage.title_edit')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'password'    => 'nullable|string|min:6',
            'nomor_telp'  => 'required|string|max:20',
            'department'  => 'required|string|max:255',
            'gender'      => 'required|in:L,P',
            'status'      => 'required|in:Active,Inactive',
            'roles'      => 'nullable|array',
            'roles.*'    => 'exists:roles,id',
            'skills'     => 'nullable|array',
            'skills.*'   => 'exists:skills,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nama.required'        => __('userControllerMessage.upload.name_required'),
            'username.required'    => __('userControllerMessage.upload.username_required'),
            'username.unique'      => __('userControllerMessage.upload.username_unique'),
            'email.required'       => __('userControllerMessage.upload.email_required'),
            'email.unique'         => __('userControllerMessage.upload.email_unique'),
            'password.required'    => __('userControllerMessage.upload.password_required'),
            'password.min'         => __('userControllerMessage.upload.password_min'),
            'nomor_telp.required'  => __('userControllerMessage.upload.phone_required'),
            'gender.in'            => __('userControllerMessage.upload.gender_in'),
            'foto.image'           => __('userControllerMessage.upload.photo_error'),
            'foto.mimes'           => __('userControllerMessage.upload.photo_mimes'),
            'foto.max'             => __('userControllerMessage.upload.photo_max'),
            'role.required'        => __('userControllerMessage.upload.role_required'),
            'role.in'              => __('userControllerMessage.upload.role_in'),
        ]);

        // Update basic fields
        $user->fill([
            'nama'       => $validated['nama'],
            'username'   => $validated['username'],
            'email'      => $validated['email'],
            'nomor_telp' => $validated['nomor_telp'],
            'department' => $validated['department'],
            'gender'     => $validated['gender'],
            'status'     => $validated['status'],
        ]);

        // jika ada password baru, hash dan simpan
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // jika ada foto baru
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/'.$user->foto)) {
                Storage::delete('public/'.$user->foto);
            }
            $fotoPath = $request->file('foto')->store('foto', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        // Sync roles
        $user->roles()->sync($request->roles ?? []);

        // Sync skills
        $user->skills()->sync($request->skills ?? []);


        return redirect()->route('user.index')->with('success', __('userControllerMessage.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Hapus foto jika ada
        if ($user->foto && Storage::exists('public/'.$user->foto)) {
            Storage::delete('public/'.$user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', __('userControllerMessage.success_deleted'));
    }
}
