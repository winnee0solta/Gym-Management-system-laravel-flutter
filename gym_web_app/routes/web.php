<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\NotificaitonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\TrainersController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Members section routes
    Route::get('/members', [MembersController::class, 'index']);
    Route::get('/members/view/{member_id}', [MembersController::class, 'singleMember']);
    Route::get('/members/change-status/{member_id}', [MembersController::class, 'memberChangeStatus']);
    Route::post('/members/add', [MembersController::class, 'add']);
    Route::post('/members/update', [MembersController::class, 'update']);
    Route::post('/members/remove', [MembersController::class, 'removeMember']);
    Route::post('/members/{member_id}/nutrition-plan', [MembersController::class, 'memberNutritionPlan']);
    Route::post('/members/{member_id}/workout-plan', [MembersController::class, 'memberWorkoutPlan']);
    Route::post('/members/{member_id}/update-body-status', [MembersController::class, 'memberBodyStatus']);

    //trainer section routes
    Route::get('/trainers', [TrainersController::class, 'index']);
    Route::get('/trainers/view/{trainers_id}', [TrainersController::class, 'singleTrainers']);
    Route::post('/trainers/add', [TrainersController::class, 'add']);
    Route::post('/trainers/update', [TrainersController::class, 'update']);
    Route::post('/trainers/remove', [TrainersController::class, 'remove']);

    //schedule section routes
    Route::get('/schedule', [SchedulesController::class, 'index']);
    Route::get('/schedule/trainer/{trainer_id}', [SchedulesController::class, 'singleTrainerSchedule']);
    Route::get('/schedule/trainer/{trainer_id}/assign-member/{member_id}', [SchedulesController::class, 'singleTrainerAssignMember']);
    Route::get('/schedule/trainer/{trainer_id}/remove-member/{member_id}', [SchedulesController::class, 'singleTrainerRemoveAssignedMember']);
    Route::get('/schedule/member/{member_id}', [SchedulesController::class, 'singleMemberSchedule']);
    Route::post('/schedule/member/{member_id}/{shift}', [SchedulesController::class, 'memberScheduleUpdate']);

    //attendance section routes
    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::get('/attendance/trainer/{trainer_id}/{status}', [AttendanceController::class, 'setTrainerAttendaceStatus']);
    Route::get('/attendance/member/{member_id}/{status}', [AttendanceController::class, 'setMemberAttendaceStatus']);

    //payment section routes
    Route::get('/payment', [PaymentController::class, 'index']);
    Route::get('/payment/view/{member_id}', [PaymentController::class, 'singleMemberPayments']);
    Route::post('/payment/update-expiration-date/{member_id}', [PaymentController::class, 'updateMemberExpirationDate']);
    Route::post('/payment/add-transaction/{member_id}', [PaymentController::class, 'addMemberPaymentTransaction']);

    //notifications
    Route::get('/notifications', [NotificaitonController::class, 'index']);
    Route::post('/notifications/send/add', [NotificaitonController::class, 'sendNotice']);



    //logout user
    Route::get('/logout', [AuthController::class, 'destroy']);
});

//Auth routes
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);