<?php

use App\Http\Controllers\Backend_Api\CompanyController;
use App\Http\Controllers\Backend_Api\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Contacts Api Route (Single Resource)*/
Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);
Route::post('companies', [CompanyController::class, 'store']);
Route::put('companies/{id}', [CompanyController::class, 'update']);
Route::patch('companies/{id}', [CompanyController::class, 'update']);

/* Contacts Api Route (Single Resource)*/
Route::get('contacts', [ContactsController::class, 'index']);
Route::get('contacts/{id}', [ContactsController::class, 'show']);
Route::post('contacts', [ContactsController::class, 'store']);
Route::put('contacts/{id}', [ContactsController::class, 'update']);
Route::patch('contacts/{id}', [ContactsController::class, 'update']);
Route::post('contacts/{id}', [ContactsController::class, 'store_multiple']);
Route::get('contacts/company/{id}', [ContactsController::class, 'get_contacts']);
Route::post('search/all', [ContactsController::class, 'search']);

/* Contacts Api Route (SEARCH Resource)*/
//Route::get('search1/{name}', [ContactsController::class, 'search']);

/* Contacts Api Route (SEARCH Resource)*/
////Route::get('search/{name}', [CompanyController::class,'search']);

/* Contacts Api Route (UPDATE Resource)*/
//Route::post('save', [CompanyController::class, 'store']);
