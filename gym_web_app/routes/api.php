<?php

use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TrainerController;
use App\Http\Controllers\api\MemberController;
use App\Http\Controllers\api\NotificationsController;
use App\Http\Controllers\api\PaymentController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| MOBILE APP API Routes
|--------------------------------------------------------------------------
|
*/

Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::get('/schedule/trainer/{user_id}', [TrainerController::class, 'trainersSchedule']);
Route::get('/trainer-data/{user_id}', [TrainerController::class, 'trainerdata']);

Route::get('/member-data/{member_id}', [MemberController::class, 'memberdata']);
Route::post('/member-data/update-body-status', [MemberController::class, 'updateBodyStatus']);
Route::post('/member-data/update-nutrition-plan', [MemberController::class, 'updateNutritionPlans']);
Route::post('/member-data/update-workout-plan', [MemberController::class, 'updateWorkoutPlans']);
Route::post('/member-data/update-attendance', [MemberController::class, 'updateAttendance']);

Route::get('/attendance/trainer/{user_id}', [AttendanceController::class, 'trainerAttendance']);
Route::get('/attendance/today/trainer/{user_id}', [AttendanceController::class, 'trainerAttendanceToday']);
Route::get('/attendance/member/{user_id}', [AttendanceController::class, 'memberAttendance']);

Route::get('/notifications/{user_id}', [NotificationsController::class, 'notificaitons']);
Route::get('/notifications/{user_id}/count', [NotificationsController::class, 'notificaitonsCount']);

Route::get('/member-data/member/{user_id}', [MemberController::class, 'singleMemberdata']);


Route::get('/schedule/member/{user_id}', [MemberController::class, 'membersSchedule']);
Route::get('/payment/member/{user_id}', [PaymentController::class, 'memberPayments']);
/*
|--------------------------------------------------------------------------
| WEB APP API Routes
|--------------------------------------------------------------------------
|
*/
//Create new admin account
Route::get('/register-admin/{username}/{password}', function ($username, $password) {

    if (User::where('username', $username)->count() == 0) {

        $user =  User::create([
            'username' => $username,
            'password' => bcrypt($password),
            'type' => 'admin'
        ]);
        return $user;
    } else {
        return response('Username already exisits');
    }
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });