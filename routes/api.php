<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

//Route::prefix();
Route::get('search/houses/all', 'SearchController@index');
Route::get('search/houses', 'SearchController@search');

/*Route::get('bedrooms/{bedroomsNum}', function($bedroomsNum) {
    $bedrooms = DB::table('houses')->where('bedrooms', '=', $bedroomsNum)->get();

    return response()->json($bedrooms, 200);
});

Route::get('bathrooms/{bathroomsNum}', function($bathroomsNum) {
    $bathrooms = DB::table('houses')->where('bedrooms', '=', $bathroomsNum)->get();

    return response()->json($bathrooms, 200);
});

Route::get('storeys/{storeysNum}', function($storeysNum) {
    $storeys = DB::table('houses')->where('bedrooms', '=', $storeysNum)->get();

    return response()->json($storeys, 200);
});

Route::get('garages/{garagesNum}', function($garagesNum) {
    $garages = DB::table('houses')->where('bedrooms', '=', $garagesNum)->get();

    return response()->json($garages, 200);
});


Route::get('price/{range}', function($rangeArr) {

    $garages = DB::table('houses')->where('price', '=', $rangeArr)->get();

    return response()->json($garages, 200);
});*/

