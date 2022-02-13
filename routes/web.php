<?php

use Dealskoo\Contact\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'throttle:6,1'])->post('/contact', [ContactController::class, 'handle'])->name('contact.inbox');
