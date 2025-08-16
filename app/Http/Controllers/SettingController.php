<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skill;
use App\Models\ReportType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {

        $title = 'Add Value | Dashboard';
        return view('Dashboard.settings.index', [
            'title' => $title,
            'roles' => Role::all(),
            'skills' => Skill::all(),
            'reportTypes' => ReportType::all()
        ]);
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);
        Role::create(['name' => $request->name]);
        return back()->with('success', 'Role added successfully');
    }

    public function deleteRole($id)
    {
        Role::destroy($id);
        return back()->with('success', 'Role deleted successfully');
    }

    public function storeSkill(Request $request)
    {
        $request->validate(['name' => 'required|unique:skills']);
        Skill::create(['name' => $request->name]);
        return back()->with('success', 'Skill added successfully');
    }

    public function deleteSkill($id)
    {
        Skill::destroy($id);
        return back()->with('success', 'Skill deleted successfully');
    }

    public function storeReportType(Request $request)
    {
        $request->validate(['name' => 'required|unique:report_types']);
        ReportType::create(['name' => $request->name]);
        return back()->with('success', 'Report type added successfully');
    }

    public function deleteReportType($id)
    {
        ReportType::destroy($id);
        return back()->with('success', 'Report type deleted successfully');
    }
}
