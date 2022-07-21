<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/obtain-articles', [ArticleController::class, 'obtainArticles']);
