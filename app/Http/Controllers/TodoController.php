<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->todos()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $request->user()->todos()->create([
            'tugas' => $request->tugas,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan! ^^',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);
        return response()->json([
            'data' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);

        $todo->update($request->validated());

        return response()->json([
            'message' => 'Data berhasil diupdate! ^^'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->todos()->findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus! ^^'
        ], 201);
    }
}
