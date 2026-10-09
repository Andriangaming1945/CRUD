<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tipe Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    @include('sidebar')
    <div style="margin-left: 250px; padding: 20px;">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Manajemen Tipe Akun</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Tipe Akun
            </button>
        </div>

        {{-- TABEL --}}
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Jumlah Akun</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($types as $type)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->description ?: '-' }}</td>
                                <td>{{ $type->accounts_count }}</td>
                                <td class="text-end">
                                    {{-- Detail --}}
                                    <button type="button" class="btn btn-sm btn-info text-white"
                                            data-bs-toggle="modal" data-bs-target="#modalDetail"
                                            data-name="{{ $type->name }}"
                                            data-description="{{ $type->description ?: '-' }}"
                                            data-count="{{ $type->accounts_count }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    {{-- Edit --}}
                                    <button type="button" class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-id="{{ $type->id }}"
                                            data-name="{{ $type->name }}"
                                            data-description="{{ $type->description }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    {{-- Hapus --}}
                                    <form action="{{ route('tipe-akun.destroy', $type) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus tipe akun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted py-4">Belum ada tipe akun.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL (dipisah per file) --}}
    @include('tipeakun.modal.tambah')
    @include('tipeakun.modal.edit')
    @include('tipeakun.modal.detail')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @include('tipeakun.modal.script')
</body>
</html>