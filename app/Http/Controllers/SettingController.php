<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Room;
use App\Models\Skill;
use App\Models\ReportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {

        $title = __('dashboardSettingValue.controller.index.title');
        return view('Dashboard.settings.index', [
            'title' => $title,
            'roles' => Role::all(),
            'skills' => Skill::all(),
            'reportTypes' => ReportType::all(),
            'rooms' => Room::all(),
        ]);
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);
        Role::create(['name' => $request->name]);
        return back()->with('success', __('dashboardSettingValue.controller.create.success_add_role'));
    }

    public function deleteRole($id)
    {
        Role::destroy($id);
        return back()->with('success', __('dashboardSettingValue.controller.delete.success_delete_role'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate(['name' => 'required|unique:skills']);
        Skill::create(['name' => $request->name]);
        return back()->with('success', __('dashboardSettingValue.controller.create.success_add_skill'));
    }

    public function deleteSkill($id)
    {
        Skill::destroy($id);
        return back()->with('success', __('dashboardSettingValue.controller.delete.success_delete_skills'));
    }

    public function storeReportType(Request $request)
    {
        $request->validate(['name' => 'required|unique:report_types']);
        ReportType::create(['name' => $request->name]);
        return back()->with('success', __('dashboardSettingValue.controller.create.success_add_report'));
    }

    public function deleteReportType($id)
    {
        ReportType::destroy($id);
        return back()->with('success', __('dashboardSettingValue.controller.delete.success_delete_report'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:100|unique:rooms,room_name',
        ]);

        Room::create(['room_name' => $request->room_name]);

        return back()->with('success', 'Berhasil Menambahkan Room');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);

        // Cek apakah room sedang digunakan di tabel lain
        $isUsedInGroup = DB::table('cleaning_group_room')->where('room_id', $id)->exists();
        $isUsedInRecord = DB::table('cleaning_record_details')
            ->whereJsonContains('rooms', (string)$id) // jika rooms disimpan dalam bentuk JSON/string
            ->exists();

        if ($isUsedInGroup || $isUsedInRecord) {
            return back()->with('error', 'Room ini sudah digunakan, Tidak bisa Menghapus Room');
        }

        $room->delete();

        return back()->with('success', 'Berhasil Menghapus Room');
    }
}
