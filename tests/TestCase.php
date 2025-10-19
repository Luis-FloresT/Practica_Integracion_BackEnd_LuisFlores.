<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Route;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Forzar la carga de rutas API
        if (!Route::has('api.guardar-producto')) {
            require base_path('routes/api.php');
        }
    }
}