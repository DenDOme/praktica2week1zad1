<?php
use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/employee', [Controller\Site::class, 'employee'])->middleware('role');
Route::add(['GET', 'POST'], '/department', [Controller\Site::class, 'department'])->middleware('role');
Route::add(['GET', 'POST'], '/position', [Controller\Site::class, 'position'])->middleware('role');
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/employee-list', [Controller\Site::class, 'employee_list']);

?>