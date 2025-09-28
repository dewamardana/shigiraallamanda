<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AddValueController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CheckerTaskController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskGroupController;
use App\Http\Controllers\CleaningTaskController;
use App\Http\Controllers\FormulaCheckController;
use App\Http\Controllers\CleaningGroupController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'store'])->name('loginStore');
});
Route::middleware('auth')->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/homepage/cleaning', [HomepageController::class, 'cleaning'])->name('cleaning');
    Route::get('/homepage/cleaning/getTask/{id}', [HomepageController::class, 'getTasks'])->name('getTask');
    Route::post('/homepage/cleaning', [HomepageController::class, 'cleaningStore'])->name('cleaningStore');
    Route::get('/homepage/checker', [HomepageController::class, 'checker'])->name('checker');
    Route::post('/homepage/checker', [HomepageController::class, 'checkerStore'])->name('checkerStore');
    Route::get('/homepage/office', [HomepageController::class, 'office'])->name('office');
    Route::post('/homepage/office', [HomepageController::class, 'officeStore'])->name('officeStore');
    Route::get('/homepage/history', [HomepageController::class, 'history'])->name('history');
    Route::get('/homepage/report', [HomepageController::class, 'report'])->name('report');
    Route::post('/homepage/report', [HomepageController::class, 'reportStore'])->name('reportStore');
    Route::get('/homepage/reportHistory', [HomepageController::class, 'reportHistory'])->name('reportHistory');
    Route::get('/homepage/userprofile', [HomepageController::class, 'profile'])->name('userprofile');
    Route::post('/homepage/userprofile/{slug}', [HomepageController::class, 'userprofileUpdate'])->name('userprofileUpdate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/cleaningdata', [DataController::class, 'cleaningData'])->name('cleaningdata');
    Route::delete('/dashboard/cleaningdata/{cleaningRecord}', [DataController::class, 'destroycleaningData'])->name('cleaning.destroy');
    Route::get('/dashboard/cleaningexport', [DataController::class, 'exportCleaningData'])->name('cleaningexport');
    Route::get('/dashboard/checker', [DataController::class, 'checkerData'])->name('checkerdata');
    Route::delete('/dashboard/checker/{checkerRecord}', [DataController::class, 'checkerDestroy'])->name('checkerDestroy');
    Route::get('/dashboard/checkerexport', [DataController::class, 'exportCheckerData'])->name('checkerexport');
    Route::get('/dashboard/office', [DataController::class, 'officeData'])->name('officedata');
    Route::delete('/dashboard/office/{office}', [DataController::class, 'officeDestroy'])->name('officeDestroy');
    Route::get('/dashboard/officeexport', [DataController::class, 'officeexport'])->name('officeexport');
    Route::get('/dashboard/userpoint', [DataController::class, 'userPoint'])->name('userpoint');
    Route::get('/dashboard/userpointexport', [DataController::class, 'userPointExport'])->name('userPointExport');
    Route::get('/dashboard/cleaninghistorydata', [DataController::class, 'CleaningHistoryData'])->name('Cleaninghistorydata');
    Route::get('/dashboard/checkofficehistorydata', [DataController::class, 'CheckOfficeHistoryData'])->name('CheckOfficeHistoryData');
    Route::get('/userpoint/{user}/{year}/{month}/rekap', [DataController::class, 'userPointRekap'])->name('userpoint.rekap');


    Route::resource('/dashboard/user', UserController::class);
    Route::resource('/dashboard/cleaningGroups', CleaningGroupController::class);
    Route::resource('/dashboard/cleaningTasks', CleaningTaskController::class);
    Route::resource('/dashboard/checker-tasks', CheckerTaskController::class);
    Route::resource('/dashboard/formula', FormulaController::class);
    Route::resource('/dashboard/formulaCheck', FormulaCheckController::class);
    Route::resource('/dashboard/task-groups', TaskGroupController::class);
    Route::resource('dashboard/task-groups/tasks', TaskController::class);
    Route::get('/dashboard/reportData', [ReportController::class, 'reportData'])->name('reportData');
    Route::post('/dashboard/reportData', [ReportController::class, 'reply'])->name('reply');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/role', [SettingController::class, 'storeRole'])->name('settings.role.store');
    Route::delete('/settings/role/{id}', [SettingController::class, 'deleteRole'])->name('settings.role.delete');
    Route::post('/settings/skill', [SettingController::class, 'storeSkill'])->name('settings.skill.store');
    Route::delete('/settings/skill/{id}', [SettingController::class, 'deleteSkill'])->name('settings.skill.delete');
    Route::post('/settings/report-type', [SettingController::class, 'storeReportType'])->name('settings.reporttype.store');
    Route::delete('/settings/report-type/{id}', [SettingController::class, 'deleteReportType'])->name('settings.reporttype.delete');
});


Route::get('/lang/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'id', 'ja', 'km', 'my', 'vi'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return back();
})->name('change.lang');
