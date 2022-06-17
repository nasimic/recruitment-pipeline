<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Skills
Route::get('/skills', 'SkillController@index');


// Status
Route::get('/statuses', 'StatusController@index');