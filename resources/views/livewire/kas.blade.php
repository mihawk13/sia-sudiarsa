<div>
    <div class="form-group" wire:ignore>
        <label for="kode" class="control-label">Kode Akun:</label>
        <select id="kode" name="kode" class="form-control">
            <option value="">--Pilih Kode Akun--</option>
            @foreach ($akun as $akn)
                <option value="{{ $akn->kode }}">{{ $akn->kode }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nama" class="control-label">Nama Akun:</label>
        <input type="text" class="form-control" name="nama" readonly required
            placeholder="Masukkan Nama Akun" value="{{ $nama }}">
    </div>
</div>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#kode').on('change', function (e) {
            var kode = $('#kode').val();
            @this.set('kode', kode);
        });
    });

</script>

@endpush
