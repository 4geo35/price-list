<?php

use Illuminate\Support\Facades\Route;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {});
