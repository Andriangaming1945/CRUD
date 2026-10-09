<script>
    // Isi modal Edit dari data tombol yang diklik
    document.getElementById('modalEdit').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        const f = document.getElementById('formEdit');
        f.action = "{{ url('tipe-akun') }}/" + d.id;
        f.querySelector('[name="name"]').value = d.name;
        f.querySelector('[name="description"]').value = d.description;
    });

    // Isi modal Detail
    document.getElementById('modalDetail').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        document.getElementById('dName').textContent = d.name;
        document.getElementById('dDescription').textContent = d.description;
        document.getElementById('dCount').textContent = d.count;
    });

    @if ($errors->any() && old('form_mode') === 'tambah')
        // Buka lagi modal Tambah kalau validasi gagal
        new bootstrap.Modal(document.getElementById('modalTambah')).show();
    @endif
</script>