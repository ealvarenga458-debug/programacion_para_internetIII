<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

// 1. Ruta para LEER todas las tareas (Retorna JSON)
Route::get('/tareas', function () {
    return response()->json(Task::all());
});

// 2. Ruta para GUARDAR una nueva tarea (Recibe y retorna JSON)
Route::post('/tareas', function (Request $request) {
    // Validamos que envíen el título solicitado
    $request->validate([
        'titulo' => 'required|string|max:255'
    ]);

    // Creamos el registro en la tabla 'tareas'
    $task = Task::create([
        'titulo' => $request->titulo
    ]);

    return response()->json($task, 201);
});
