<?php

use App\Http\Controllers\MidtransController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Livewire\Chat;
use App\Livewire\PsychologistList;
use App\Http\Controllers\PsychologistApplicationController;
use Illuminate\Support\Facades\Route;

//GENERAL FEATURES
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('login', function () {
    return redirect()->route('home', ['showLogin' => 'true']);
})->name('loginRedirect');

//ADMIN FEATURES
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('admin', function() {
        return view('admin.admin');
    })->name('admin');

    Route::get('user-admin', function () {
        return view('admin.admin');
    })->name('user-admin');

    Route::get('transaksi', [TransactionController::class, 'index'])->name('transaksi');

    Route::redirect('/user-admin', '/admin');
    Route::resource('/admin', UserController::class);
});

//PSIKOLOG FEATURES
Route::middleware(['auth', 'verified', 'role:admin|psikolog'])->group(function () {
    Route::get('psikolog', function() {
        return view('psikolog.psikolog');
    })->name('psikolog');
});

//USER FEATURES
Route::middleware(['auth', 'verified'])->group(function () {
    //TRANSAKSi
    Route::get('riwayat', [TransactionController::class, 'Riwayat'])->name('riwayat');
    Route::post('/transaksi/create/{psikologId}', [TransactionController::class, 'createTransaction'])->name('transaksi.create');
    Route::post('/transaksi/update-status', [TransactionController::class, 'updateStatus'])->name('transaksi.update-status');
    Route::get('/transaksi/finish', [TransactionController::class, 'finishTransaction'])->name('transaksi.finish');
    Route::post('midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
    
    //FITUR CHAT
    Route::get('/preview-chat', Chat::class)->name('preview-chat');
    Route::get('chat/{from_user_id?}-{user}', Chat::class)->name('chat');
});

//GUEST FEATURES
Route::get('tes-kuis', function () {
    return view('home.tes-kuis');
})->name('tes-kuis');
Route::post('/hasil-kuis', [QuizController::class, 'submit'])->name('kuis.submit');

Route::get('/list-psikolog', PsychologistList::class)->name('list-psikolog');

Route::get('jadi-psikolog', function () {
    return view('home.jadi-psikolog');
})->name('jadi-psikolog');

Route::post('/jadi-psikolog', [PsychologistApplicationController::class, 'submit'])->name('jadi-psikolog.submit');

//PROFILE EDIT
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';