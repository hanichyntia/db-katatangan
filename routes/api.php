<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaketController;

//Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group([
    'middleware' => ['auth:api']
], function () {
    //Auth
    Route::post('profile', [AuthController::class, 'profile']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('logout', [AuthController::class, 'logout']);

    //Lesson
    Route::post('/createLesson', [LessonController::class, 'createLesson']);
    Route::get('/getAllLesson', [LessonController::class, 'getAllLesson']);
    Route::get('/getByIdLesson/{id}', [LessonController::class, 'getByIdLesson']);
    Route::put('/updateLesson/{id}', [LessonController::class, 'updateLesson']);
    Route::delete('/deleteLesson/{id}', [LessonController::class, 'deleteLesson']);

    //Level
    Route::post('/createLevel', [LevelController::class, 'createLevel ']);
    Route::get('/getAllLevel', [LevelController::class, 'getAllLevel']);
    Route::get('/getByIdLevel/{id}', [LevelController::class, 'getByIdLevel']);
    Route::put('/updateLevel/{id}', [LevelController::class, 'updateLevel']);
    Route::delete('/deleteLevel/{id}', [LevelController::class, 'deleteLevel']);

    //Testimoni
    Route::post('/createTest', [TestimoniController::class, 'createTest']);
    Route::get('/getAllTest', [TestimoniController::class, 'getAllTest']);
    Route::get('/getByIdTest/{id}', [TestimoniController::class, 'getByIdTest']);
    Route::put('/updateTest/{id}', [TestimoniController::class, 'updateTest']);
    Route::delete('/deleteTest/{id}', [TestimoniController::class, 'deleteTest']);

    //Event
    Route::post('/createEvent', [EventController::class, 'createEvent']);
    Route::get('/getAllEvent', [EventController::class, 'getAllEvent']);
    Route::get('/getByIdEvent/{id}', [EventController::class, 'getByIdEvent']);
    Route::put('/updateEvent/{id}', [EventController::class, 'updateEvent']);
    Route::delete('/deleteEvent/{id}', [EventController::class, 'deleteEvent']);

    //Paket
    Route::post('/createPaket', [PaketController::class, 'createPaket']);
    Route::get('/getAllPaket', [PaketController::class, 'getAllPaket']);
    Route::get('/getIdPaket/{id}', [PaketController::class, 'getIdPaket']);
    Route::put('/updatePaket/{id}', [PaketController::class, 'updatePaket']);
    Route::delete('/deletePaket/{id}', [PaketController::class, 'deletePaket']);

});


