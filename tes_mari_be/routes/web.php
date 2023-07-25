<?php

use App\Http\Controllers\SatkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/satker', [SatkerController::class, 'index']);
Route::get('/satker/{id}', [SatkerController::class, 'show']);   


Route::get('/json/data_rekrutmen', [SatkerController::class, 'rekrutmen']); 
Route::get('/json/data_rekrutmen/{nip}', [SatkerController::class, 'rekrutmenshow']); 
Route::get('/json/data_attribut', [SatkerController::class, 'attribut']);  
Route::get('/json/data_attribut/{nip}', [SatkerController::class, 'attributshow']); 
 
// Route::get('/cek', function () {
//     return response('Hello World', 200)
//                   ->header('Content-Type', 'text/plain');
// });
