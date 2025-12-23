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

        return redirect()->route('settings.index', [
            'tab' => request('tab', 'roles')
        ])->with('success', __('dashboardSettingValue.controller.create.success_add_role'));
    }

    public function deleteRole($id)
    {
        Role::destroy($id);
        return redirect()->route('settings.index', [
            'tab' => request('tab', 'roles')
        ])->with('success', __('dashboardSettingValue.controller.delete.success_delete_role'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate(['name' => 'required|unique:skills']);
        Skill::create(['name' => $request->name]);
        return redirect()->route('settings.index', [
            'tab' => request('tab', 'skills')
        ])->with('success', __('dashboardSettingValue.controller.create.success_add_skill'));
    }

    public function deleteSkill($id)
    {
        Skill::destroy($id);
        return redirect()->route('settings.index', [
            'tab' => request('tab', 'skills')
        ])->with('success', __('dashboardSettingValue.controller.delete.success_delete_skills'));
    }

    public function storeReportType(Request $request)
    {
        $request->validate(['name' => 'required|unique:report_types']);
        ReportType::create(['name' => $request->name]);
        return redirect()->route('settings.index', [
            'tab' => request('tab', 'reportTypes')
        ])->with('success', __('dashboardSettingValue.controller.create.success_add_report'));
    }

    public function deleteReportType($id)
    {
        ReportType::destroy($id);
        return redirect()->route('settings.index', [
            'tab' => request('tab', 'reportTypes')
        ])->with('success', __('dashboardSettingValue.controller.delete.success_delete_report'));
    }

    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:100|unique:rooms,room_name',
        ]);

        Room::create(['room_name' => $request->room_name]);

        return redirect()->route('settings.index', [
            'tab' => request('tab', 'rooms')
        ])->with('success', 'Berhasil Menambahkan Room');
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);

        // ===============================
        // 1. Masih terikat Cleaning Group?
        // ===============================
        if (!is_null($room->cleaning_group_id)) {
            return back()->with('error', 'Room masih terdaftar di Cleaning Group, lepaskan terlebih dahulu.');
        }

        // =====================================
        // 2. Dipakai di Cleaning Record Detail?
        // =====================================
        $usedInCleaning = DB::table('cleaning_record_details')
            ->whereJsonContains('rooms', $room->id)
            ->exists();

        if ($usedInCleaning) {
            return back()->with('error', 'Room sudah digunakan pada data Cleaning.');
        }

        // =====================================
        // 3. Dipakai di Checker Record Location?
        // =====================================
        $usedInChecker = DB::table('checker_record_locations')
            ->whereJsonContains('rooms', $room->id)
            ->exists();

        if ($usedInChecker) {
            return back()->with('error', 'Room sudah digunakan pada data Checker.');
        }

        // ===============================
        // 4. AMAN → BOLEH DIHAPUS
        // ===============================
        $room->delete();

        return redirect()
            ->route('settings.index', ['tab' => 'rooms'])
            ->with('success', 'Room berhasil dihapus.');
    }
}
