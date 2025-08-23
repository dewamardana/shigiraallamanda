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
        return view('Dashboard.user.index', [
            'users' => $users,
            'title' => __('userControllerMessage.title_index')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Dashboard.user.create', [
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
            'nama.required'        => __('dashboardUser.controller.store.name_required'),
            'username.required'    => __('dashboardUser.controller.store.username_required'),
            'username.unique'      => __('dashboardUser.controller.store.username_unique'),
            'email.required'       => __('dashboardUser.controller.store.email_required'),
            'email.unique'         => __('dashboardUser.controller.store.email_unique'),
            'password.required'    => __('dashboardUser.controller.store.password_required'),
            'password.min'         => __('dashboardUser.controller.store.password_min'),
            'nomor_telp.required'  => __('dashboardUser.controller.store.phone_required'),
            'gender.in'            => __('dashboardUser.controller.store.gender_in'),
            'foto.image'           => __('dashboardUser.controller.store.photo_error'),
            'foto.mimes'           => __('dashboardUser.controller.store.photo_mimes'),
            'foto.max'             => __('dashboardUser.controller.store.photo_max'),

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

        return redirect()->route('user.index')->with('success', __('dashboardUser.controller.store.success_add'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('Dashboard.user.show', [
            'user' => $user,
            'title' => __('dashboardUser.controller.show.title')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $skill = Skill::all();

        return view('Dashboard.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'skills' => $skill,
            'title' => __('dashboardUser.controller.edit.title')
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
        ], [
            'nama.required'        => __('dashboardUser.controller.upload.name_required'),
            'username.required'    => __('dashboardUser.controller.upload.username_required'),
            'username.unique'      => __('dashboardUser.controller.upload.username_unique'),
            'email.required'       => __('dashboardUser.controller.upload.email_required'),
            'email.unique'         => __('dashboardUser.controller.upload.email_unique'),
            'password.required'    => __('dashboardUser.controller.upload.password_required'),
            'password.min'         => __('dashboardUser.controller.upload.password_min'),
            'nomor_telp.required'  => __('dashboardUser.controller.upload.phone_required'),
            'gender.in'            => __('dashboardUser.controller.upload.gender_in'),
            'foto.image'           => __('dashboardUser.controller.upload.photo_error'),
            'foto.mimes'           => __('dashboardUser.controller.upload.photo_mimes'),
            'foto.max'             => __('dashboardUser.controller.upload.photo_max'),
            'role.required'        => __('dashboardUser.controller.upload.role_required'),
            'role.in'              => __('dashboardUser.controller.upload.role_in'),
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
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            $fotoPath = $request->file('foto')->store('foto', 'public');
            $user->foto = $fotoPath;
        }

        $user->save();

        // Sync roles
        $user->roles()->sync($request->roles ?? []);

        // Sync skills
        $user->skills()->sync($request->skills ?? []);


        return redirect()->route('user.index')->with('success', __('dashboardUser.controller.upload.success_edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Hapus foto jika ada
        if ($user->foto && Storage::exists('public/' . $user->foto)) {
            Storage::delete('public/' . $user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', __('dashboardUser.controller.delete.success_deleted'));
    }
}
