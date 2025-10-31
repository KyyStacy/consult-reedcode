<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ChatController;
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

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth.simple')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    Route::post('/profile/change-password', [AuthController::class, 'changePassword']);
    Route::post('/profile/delete', [AuthController::class, 'deleteAccount']);
    Route::post('/profile/update-photo', [AuthController::class, 'updatePhoto']);
    Route::get('/psychologists', [AuthController::class, 'getPsychologists']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'status' => true,
            'message' => 'User data retrieved successfully',
            'data' => auth()->user()
        ]);
    });

    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transaction/create', [TransactionController::class, 'store']);
    Route::post('/transaction/update-status', [TransactionController::class, 'updateStatus']);
    Route::post('/transaction/check-status', [TransactionController::class, 'checkStatus']);
    Route::get('/transaction/midtrans-config', [TransactionController::class, 'getMidtransConfig']);

    Route::get('/messages/conversations/{userId}', [ChatController::class, 'getConversations']);
    Route::get('/messages/{fromUserId}/{toUserId}', [ChatController::class, 'getMessages']);
    Route::post('/messages', [ChatController::class, 'sendMessage']);
    Route::get('/transactions/check-status/{toUserId}', [ChatController::class, 'checkTransactionStatus']);
});
