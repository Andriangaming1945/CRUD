<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actions = Actions::orderBy('name')->get();

        return view('jenisaksi', compact('actions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:128'],
            'description' => ['nullable', 'string'],
        ]);

        Actions::create($data);

        return redirect()->route('jenis-aksi.index')->with('success', 'Jenis aksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $action = Actions::findOrFail($id);

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:128'],
            'description' => ['nullable', 'string'],
        ]);

        $action->update($data);

        return redirect()->route('jenis-aksi.index')->with('success', 'Jenis aksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Actions::findOrFail($id)->delete();

        return redirect()->route('jenis-aksi.index')->with('success', 'Jenis aksi berhasil dihapus.');
    }
}