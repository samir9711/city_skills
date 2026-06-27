<?php



use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Skill\SkillController;
use App\Http\Controllers\SkillUser\SkillUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserAnswer\UserAnswerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::prefix('user')->name('user.')->group(function () {

    Route::post('register', [UserAuthController::class, 'register'])->name('register');
    Route::post('register/resend', [UserAuthController::class, 'resendRegisterOtp'])->name('register.resend');
    Route::post('register/verify', [UserAuthController::class, 'verifyOtp'])->name('register.verify');
    // Login (email+pass | phone+pass | social_id)
    Route::post('login', [UserAuthController::class, 'login'])->name('login');
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    // Social register/login (upsert)
    //Route::post('social/register', [UserAuthController::class, 'socialRegister'])->name('social.register');

    // Reset password (email OR phone)
    Route::post('password/send-otp', [UserAuthController::class, 'sendResetOtp'])->name('password.send_otp');
    Route::post('password/verify-otp', [UserAuthController::class, 'verifyOtp'])->name('password.verify_otp'); //set the same method
    Route::post('password/reset', [UserAuthController::class, 'resetPassword'])->name('password.reset');

    // Authenticated actions (Sanctum)
    Route::middleware('auth:user')->group(function () {
        //Route::post('resend-final-otp',       [UserAuthController::class, 'resendFinalOtp'])->name('resend_final_otp');
       // Route::post('request-phone-change', [UserAuthController::class, 'requestPhoneChange'])->name('phone.request_change');
       // Route::post('verify-phone-change-otp', [UserAuthController::class, 'verifyOtp'])->name('phone.verify_change'); //set the same method
       // Route::post('update-language', [UserAuthController::class, 'updateLanguage'])->name('language.update');
        Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');
        Route::post('update-profile', [UserController::class, 'updateMyProfile']);
    });


    Route::prefix('user-answer')->middleware('auth:user')->group(function () {
        Route::post('/submit', [UserAnswerController::class, 'submitAnswers']);
    });


    Route::prefix('skill')->group(function () {
        Route::get('/all/paginated', [SkillController::class, 'allPaginated']);
        Route::get('/all',           [SkillController::class, 'all']);
        Route::post('/show',         [SkillController::class, 'show']);

    });

    Route::prefix('skill-user')->middleware('auth:user')->group(function () {
        Route::post('/store-skills',  [SkillUserController::class, 'storeSkills']);
        Route::post('/delete-skills', [SkillUserController::class, 'deleteSkills']);

    });

    Route::prefix('question')->middleware('auth:user')->group(function () {
        Route::get('/all/paginated', [QuestionController::class, 'allPaginated']);
        Route::get('/all',           [QuestionController::class, 'all']);
        Route::post('/show',         [QuestionController::class, 'show']);
      
    });




});






