<?php

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

$controller_path = 'App\Http\Controllers';

// Main Page Route

// pages


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
$controller_path = 'App\Http\Controllers';

    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
    
    // users
    Route::get('/users', $controller_path . '\pages\Users@index')->name('pages-users');
    Route::get('/users/create', $controller_path . '\pages\Users@create')->name('pages-users-create');
    Route::post('/users/store', $controller_path . '\pages\Users@store')->name('pages-users-store');
    Route::get('/users/show/{user_id}', $controller_path . '\pages\Users@show')->name('pages-users-show');
    Route::get('/users/edit/{user_id}', $controller_path . '\pages\Users@edit')->name('pages-users-edit');
    Route::post('/users/update', $controller_path . '\pages\Users@update')->name('pages-users-update');
    Route::get('/users/delete/{user_id}', $controller_path . '\pages\Users@delete')->name('pages-users-delete');
    Route::post('/users/destroy', $controller_path . '\pages\Users@destroy')->name('pages-users-destroy');

    // specialties
    Route::get('/specialties', $controller_path . '\pages\Specialties@index')->name('pages-specialties');
    Route::get('/specialties/create', $controller_path . '\pages\Specialties@create')->name('pages-specialties-create');
    Route::post('/specialties/store', $controller_path . '\pages\Specialties@store')->name('pages-specialties-store');
    Route::get('/specialties/show/{specialty_id}', $controller_path . '\pages\Specialties@show')->name('pages-specialties-show');
    Route::get('/specialties/edit/{specialty_id}', $controller_path . '\pages\Specialties@edit')->name('pages-specialties-edit');
    Route::post('/specialties/update', $controller_path . '\pages\Specialties@update')->name('pages-specialties-update');
    Route::get('/specialties/delete/{specialty_id}', $controller_path . '\pages\Specialties@delete')->name('pages-specialties-delete');
    Route::post('/specialties/destroy', $controller_path . '\pages\Specialties@destroy')->name('pages-specialties-destroy');

    // doctors
    Route::get('/doctors', $controller_path . '\pages\Doctors@index')->name('pages-doctors');
    Route::get('/doctors/create', $controller_path . '\pages\Doctors@create')->name('pages-doctors-create');
    Route::post('/doctors/store', $controller_path . '\pages\Doctors@store')->name('pages-doctors-store');
    Route::get('/doctors/show/{doctor_id}', $controller_path . '\pages\Doctors@show')->name('pages-doctors-show');
    Route::get('/doctors/edit/{doctor_id}', $controller_path . '\pages\Doctors@edit')->name('pages-doctors-edit');
    Route::post('/doctors/update', $controller_path . '\pages\Doctors@update')->name('pages-doctors-update');
    Route::get('/doctors/delete/{doctor_id}', $controller_path . '\pages\Doctors@delete')->name('pages-doctors-delete'); 
    Route::post('/doctors/destroy', $controller_path . '\pages\Doctors@destroy')->name('pages-doctors-destroy');

    // patients
    Route::get('/patients', $controller_path . '\pages\Patients@index')->name('pages-patients');
    Route::get('/patients/create', $controller_path . '\pages\Patients@create')->name('pages-patients-create');
    Route::post('/patients/store', $controller_path . '\pages\Patients@store')->name('pages-patients-store');
    Route::get('/patients/show/{patient_id}', $controller_path . '\pages\Patients@show')->name('pages-patients-show');
    Route::get('/patients/edit/{patient_id}', $controller_path . '\pages\Patients@edit')->name('pages-patients-edit');
    Route::post('/patients/update', $controller_path . '\pages\Patients@update')->name('pages-patients-update');
    Route::get('/patients/delete/{patient_id}', $controller_path . '\pages\Patients@delete')->name('pages-patients-delete');
    Route::post('/patients/destroy', $controller_path . '\pages\Patients@destroy')->name('pages-patients-destroy');

    // appointments
    Route::get('/appointments', $controller_path . '\pages\Appointments@index')->name('pages-appointments');
    Route::get('/appointments/create', $controller_path . '\pages\Appointments@create')->name('pages-appointments-create');
    Route::post('/appointments/store', $controller_path . '\pages\Appointments@store')->name('pages-appointments-store');
    Route::get('/appointments/show/{appointment_id}', $controller_path . '\pages\Appointments@show')->name('pages-appointments-show');
    Route::get('/appointments/edit/{appointment_id}', $controller_path . '\pages\Appointments@edit')->name('pages-appointments-edit');
    Route::post('/appointments/update', $controller_path . '\pages\Appointments@update')->name('pages-appointments-update');
    Route::get('/appointments/delete/{appointment_id}', $controller_path . '\pages\Appointments@delete')->name('pages-appointments-delete');
    Route::post('/appointments/destroy', $controller_path . '\pages\Appointments@destroy')->name('pages-appointments-destroy');
    Route::get('/appointments/search', $controller_path . '\pages\Appointments@search')->name('pages-appointments-search');
});
