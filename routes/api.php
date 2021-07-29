<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Posts;
use App\Http\Controllers\AuthCheck;

Route::post('dangnhap', [AuthCheck::class, 'dangnhap']);
Route::post('dangky', [AuthCheck::class, 'dangky']);
//Route::middleware('auth:api')->group(function () {
    //Route::resource('blog', Posts::class);
//});
Route::resource('blog', Posts::class);