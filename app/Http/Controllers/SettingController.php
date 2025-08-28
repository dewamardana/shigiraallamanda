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

        $title = __('dashboardSettingValue.controller.index.title');
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
}
