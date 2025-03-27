<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DetailTypeInformationController;
use App\Http\Controllers\FieldTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonTypeInformationController;
use App\Http\Controllers\TypeComboInformationController;
use App\Http\Controllers\TypeInformationController;
use App\Models\FieldType;
use App\Models\TypeComboInformation;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/example/{id}/{casa?}', function ($id, $casa = null) {
//     return "hola {$id} {$casa}";
// });


// Route::get('/home', [HomeController::class, 'index'] )->name('home.index');
// Route::get('/vv', [HomeController::class, 'ex'] );
// //store para guardar create par formulario 
// Route::get('/prueba', function () {
//     // $fieldType= new FieldType();
//     // $fieldType->fieldType('Varchar(255)');
//     // $fieldType->save();
//     // return $fieldType;

//     $fieldType = FieldType::find(1);
//     $fieldType->created_at->format('d-m-Y');
//     $fieldType->created_at->diffForHumans();
//     $fieldType = FieldType::where('fielType', 'pepe')->first();
//     $fieldType = FieldType::all();
//     $fieldType = FieldType::where('id','>', '2')->get();
//     $fieldType = FieldType::orderBy('id','desc')->get();
//     $fieldType = FieldType::orderBy('id','desc')->select('name')->take(2)->get();

//     $fieldType = FieldType::find(1);
//     $fieldType->delete();
// });

// Route::resource('posts', HomeController::class );
// Route::resource('posts', HomeController::class )->except(['destroy','update']);

Route::get('/home', [HomeController::class, 'index'] )->name('home.index');
// Route::get('/fieldType', [FieldTypeController::class, 'index'] )->name('fieldtype.index');
Route::resource('/fieldType', FieldTypeController::class );
Route::resource('/company', CompanyController::class );
Route::resource('/typeInformation', TypeInformationController::class );
Route::resource('/detailTypeInformation', DetailTypeInformationController::class );
Route::resource('/typeComboInformation', TypeComboInformationController::class );
Route::resource('/person', PersonController::class );
Route::get('/personTypeInformationFilter/{personTypeInformation}', [PersonTypeInformationController::class,'createFilter' ])->name('personTypeInformation.createFilter');
Route::get('/personTypeInformationEditFilter/{personTypeInformation}', [PersonTypeInformationController::class,'editFilter' ])->name('personTypeInformation.editFilter');
Route::post('/personTypeInformationStoreFilter', [PersonTypeInformationController::class,'storeFilter' ])->name('personTypeInformation.storeFilter');
Route::put('/personTypeInformationUpdateFilter', [PersonTypeInformationController::class,'bulkUpdate' ])->name('personTypeInformation.bulkUpdate');
Route::resource('/personTypeInformation', PersonTypeInformationController::class );