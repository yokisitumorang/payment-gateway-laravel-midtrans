<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PaymentController;

Route::get(
    '/',
    function () {
        // return 'test'
        return Inertia::render(
            'Dashboard/Index',
            [
                'title' => 'Homepage',
            ]
        );
    }
)->name( 'homepage' );

Route::post('/payment', [PaymentController::class, 'getSnapToken']);