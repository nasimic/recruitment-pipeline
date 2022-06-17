<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Skills
Route::get('/skills', 'SkillController@index');


// Status
Route::get('/statuses', 'StatusController@index');


// Candidates
Route::get('/candidates', 'CandidateController@index');
Route::post('/candidates', 'CandidateController@store');
Route::get('/candidates/status/{status}', 'CandidateController@listByStatus');
Route::get('/candidates/{candidate}', 'CandidateController@show');