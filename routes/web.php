<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tickets');
});

Route::get('/tickets', function () {
    return view('tickets.index');
});
