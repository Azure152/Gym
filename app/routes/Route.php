<?php

require_once "Main.php";

/* <=== =====================================================
    Declaracion de rutas
===================================================== ===> */

Route::get( '/' , [Welcome::class, 'index'] ); // General
Route::get( 'login', [User::class, 'login'] ); // General
Route::get( 'register', [User::class, 'register'] ); // General
Route::get( 'logout', [User::class, 'logout'] ); // General

Route::get( 'products', [Product::class, 'index'] ); // Usuario comun
Route::get( 'admin/products', [Product::class, 'admin_index'] ); // Administrador
Route::get( 'products/edit/', [Product::class, 'edit'] );

Route::get( 'profile', [User::class, 'profile'] ); // Usuario Comun
Route::get( 'user/delete/', [User::class, 'delete'] ); // Usuario Comun

Route::get( 'coachs', [Coach::class, 'index'] ); // Usuario Comun
Route::get( 'coach-applicants', [Coach::class, 'show_applicants'] ); // Administrador


// Route::get( 'welcome' , [Welcome::class, 'show'] );
// Route::get( 'welcome/edit/' , [Welcome::class, 'show'] , [1] );