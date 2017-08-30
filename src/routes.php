<?php
// Routes
use App\Controllers\TaskController;

$app->get('/', TaskController::class.':index');
$app->get('/tasks', TaskController::class.':index');
$app->post('/tasks', TaskController::class.':store');