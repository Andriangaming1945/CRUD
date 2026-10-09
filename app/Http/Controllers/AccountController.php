<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = User::with('accountType')->latest('created_at')->get();
        $types = AccountType::orderBy('name')->get();

        return view('dashboard', compact('accounts', 'types'));
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
            'name'                  => ['required', 'string', 'max:128'],
            'email'                 => ['required', 'email', 'max:128', 'unique:accounts,email'],
            'password'              => ['required', 'string', 'min:8'],
            'account_type_id'       => ['required', 'exists:account_type,id'],
            'status'                => ['required', Rule::in(['Aktif', 'Nonaktif'])],
            'identification_type'   => ['required', Rule::in(['NIM', 'NIP'])],
            'identification_number' => ['required', 'string', 'max:128'],
        ]);

        User::create($data);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil ditambahkan.');
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
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:128'],
            'email'                 => ['required', 'email', 'max:128', Rule::unique('accounts', 'email')->ignore($user->id, 'id')],
            'password'              => ['nullable', 'string', 'min:8'],
            'account_type_id'       => ['required', 'exists:account_type,id'],
            'status'                => ['required', Rule::in(['Aktif', 'Nonaktif'])],
            'identification_type'   => ['required', Rule::in(['NIM', 'NIP'])],
            'identification_number' => ['required', 'string', 'max:128'],
        ]);

        // Password kosong = tidak diubah
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()->route('dashboard')->with('error', 'Kamu tidak bisa menghapus akun yang sedang login.');
        }

        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dihapus.');
    }
}