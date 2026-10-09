<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formEdit" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_mode" value="edit">
            <div class="modal-header">
                <h5 class="modal-title">Edit Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tipe Akun</label>
                        <select name="account_type_id" class="form-select" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Jenis Identitas</label>
                        <select name="identification_type" class="form-select" required>
                            <option value="NIM">NIM</option>
                            <option value="NIP">NIP</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Nomor Identitas (NIM / NIP)</label>
                        <input type="text" name="identification_number" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>