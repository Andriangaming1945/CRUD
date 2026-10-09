<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = AccountType::withCount('accounts')->orderBy('name')->get();

        return view('tipeakun', compact('types'));
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

        AccountType::create($data);

        return redirect()->route('tipe-akun.index')->with('success', 'Tipe akun berhasil ditambahkan.');
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
        $accountType = AccountType::findOrFail($id);

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:128'],
            'description' => ['nullable', 'string'],
        ]);

        $accountType->update($data);

        return redirect()->route('tipe-akun.index')->with('success', 'Tipe akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $accountType = AccountType::findOrFail($id);

        if ($accountType->accounts()->exists()) {
            return redirect()->route('tipe-akun.index')
                ->with('error', 'Tipe akun masih dipakai oleh akun lain, tidak bisa dihapus.');
        }

        $accountType->delete();

        return redirect()->route('tipe-akun.index')->with('success', 'Tipe akun berhasil dihapus.');
    }
}