<?php
declare(strict_types=1);

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::post('/submit', [SubmissionController::class, 'submit']);

