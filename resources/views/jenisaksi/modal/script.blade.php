<script>

    document.getElementById('modalEdit').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        const f = document.getElementById('formEdit');
        f.action = "{{ url('jenis-aksi') }}/" + d.id;
        f.querySelector('[name="name"]').value = d.name;
        f.querySelector('[name="description"]').value = d.description;
    });

    
    document.getElementById('modalDetail').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        document.getElementById('dName').textContent = d.name;
        document.getElementById('dDescription').textContent = d.description;
    });

    @if ($errors->any() && old('form_mode') === 'tambah')
        
        new bootstrap.Modal(document.getElementById('modalTambah')).show();
    @endif
</script>