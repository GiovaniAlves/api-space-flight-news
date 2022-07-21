<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GetArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route of script that stores article data
Route::get('/obtain-articles', [GetArticlesController::class, 'obtainArticles']);

Route::get('/', [ArticleController::class, 'message']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

