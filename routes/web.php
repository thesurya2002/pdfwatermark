<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageFileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ------ composer require setasign/fpdi-fpdf:2.3 ----Install Package--------//

Route::post('/pdf',[ImageFileController::class, "imageFileUpload"]);

