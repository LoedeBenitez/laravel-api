<?php
use App\Http\Controllers\Auth\CredentialController;
use App\Http\Controllers\UserProfile\PersonalInformationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [CredentialController::class, 'onLogin']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    // User Management
    Route::post('user/register', [PersonalInformationController::class, 'onRegister']);
    Route::get('user/list', [PersonalInformationController::class, 'onGetUserAll']);
    Route::get('user/list/{employee_id}', [PersonalInformationController::class, 'onGetUserById']);
    Route::post('user/list/paginate', [PersonalInformationController::class, 'onGetUserPaginate']);
    Route::post('user/list/{employee_id}/update', [PersonalInformationController::class, 'onUserUpdate']);
    Route::post('user/list/{employee_id}/delete', [PersonalInformationController::class, 'onUserDelete']);
    Route::post('user/list/{employee_id}/status', [PersonalInformationController::class, 'onUserChangeStatus']);

    // Logout
    Route::post('logout', [CredentialController::class, 'onLogout']);
});
