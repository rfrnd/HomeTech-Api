<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TechController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tech', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/tech/{i}', function () {
    return view('pages.pdp');
})->name('pdp');