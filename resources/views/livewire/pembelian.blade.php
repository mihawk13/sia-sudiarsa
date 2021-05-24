<tr>
    <form action="" method="post">
        @csrf
        <input type="hidden" name="id_pembelian" value="{{ $idp }}">
        <td width="25%" wire:ignore>
            <select id="barang" name="barang" class="form-control" required>
                <option selected value="">--Pilih Barang--</option>
                @foreach ($barangs as $brg)
                <option value="{{ $brg->id }}">{{ $brg->nama }}</option>
                @endforeach
            </select>
        </td>
        <td width="10%">
            <input type="number" class="form-control" name="jumlah" wire:model="jumlah">
        </td>
        <td width="15%">
            <input type="number" class="form-control" name="harga" readonly wire:model="harga">
        </td>
        <td width="25%">
            <input type="number" class="form-control" name="total" readonly wire:model="total">
        </td>
        <td width="10%">
            <center>
                <button type="submit" class="btn btn-success btn-icon-anim btn-square"><i
                        class="fa fa-plus"></i></button>
            </center>
        </td>
    </form>
</tr>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#barang').on('change', function (e) {
            var barang = $('#barang').val();
            @this.set('barang', barang);
        });
    });

</script>

@endpush
