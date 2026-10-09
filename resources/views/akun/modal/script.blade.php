<script>
    document.getElementById('modalEdit').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        const f = document.getElementById('formEdit');
        f.action = "{{ url('akun') }}/" + d.id;
        f.querySelector('[name="name"]').value = d.name;
        f.querySelector('[name="email"]').value = d.email;
        f.querySelector('[name="password"]').value = '';
        f.querySelector('[name="account_type_id"]').value = d.type;
        f.querySelector('[name="status"]').value = d.status;
        f.querySelector('[name="identification_type"]').value = d.idtype;
        f.querySelector('[name="identification_number"]').value = d.idnumber;
    });

    document.getElementById('modalDetail').addEventListener('show.bs.modal', function (e) {
        const d = e.relatedTarget.dataset;
        document.getElementById('dName').textContent = d.name;
        document.getElementById('dEmail').textContent = d.email;
        document.getElementById('dType').textContent = d.type;
        document.getElementById('dStatus').textContent = d.status;
        document.getElementById('dIdType').textContent = d.idtype;
        document.getElementById('dIdNumber').textContent = d.idnumber;
    });

    @if ($errors->any() && old('form_mode') === 'tambah')
        new bootstrap.Modal(document.getElementById('modalTambah')).show();
    @endif
</script>