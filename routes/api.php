<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ProjectAttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\ProjectUserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('projects', ProjectController::class);    
    Route::apiResource('timesheets', TimesheetController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attribute-values', AttributeValueController::class);

    
    Route::get('/attributes', [AttributeController::class, 'index']);
    Route::post('/attributes', [AttributeController::class, 'store']);
    Route::put('/attributes/{attribute}', [AttributeController::class, 'updateAtr']);

    Route::post('/projects/{project}/attributes', [ProjectAttributeController::class, 'setAttributes']);
    Route::get('/projects/{project}/attributes', [ProjectAttributeController::class, 'getProjectWithAttributes']);
    Route::get('/project/filter', [ProjectAttributeController::class, 'filterProjectsByAttribute']);

    Route::post('/projects/{project}/users', [ProjectUserController::class, 'assignUserToProject']);
    Route::delete('/projects/{project}/users/{user}', [ProjectUserController::class, 'removeUserFromProject']);
    Route::get('/projects/{project}/users', [ProjectUserController::class, 'getUsersByProject']);
});



