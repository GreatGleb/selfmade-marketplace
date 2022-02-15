<?php

/**
 * App\Models\User => ./App/Models/User.php
 */
spl_autoload_register(function ($class)
{
    require __DIR__ . '/' .str_replace('\\', '/', $class) . '.php';
});