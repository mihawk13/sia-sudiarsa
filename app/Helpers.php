<?

use App\Models\Akun;
use App\Models\TransaksiBiaya;
use App\Models\TransaksiKas;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianDetail;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;

function getMerkHelm()
{
    return ['Bogo', 'GM', 'INK', 'KYT', 'NHK'];
}

function getJmlKas()
{
    $kas = TransaksiKas::sum('jumlah');
    return $kas;
}

function getJmlBiaya()
{
    $byy = TransaksiBiaya::sum('jumlah');
    return $byy;
}

function getTotalPenjualan()
{
    $grd = TransaksiPenjualan::where('status', 'Simpan')->sum('grand_total');
    return $grd;
}

function getTotalPembelian()
{
    $grd = TransaksiPembelian::where('status', 'Simpan')->sum('grand_total');
    return $grd;
}

function getSaldoAkun($akun_id)
{
    $akun = Akun::find($akun_id);
    if ($akun->kode == '4-1001') {
        $masukJual = TransaksiPenjualan::sum('grand_total');
        $masuk = $masukJual;
        $keluar = 0;
    } elseif ($akun->kode == '5-1001') {
        $keluarBeli = TransaksiPembelian::sum('grand_total');
        // dibalik supaya nilai tidak minus
        $masuk = $keluarBeli;
        $keluar = 0;
    } else {
        $masukJual = TransaksiPenjualan::where('akun_id', $akun_id)->sum('grand_total');
        $keluarBeli = TransaksiPembelian::where('akun_id', $akun_id)->sum('grand_total');
        $masukKas = TransaksiKas::where('akun_id', $akun_id)->sum('jumlah');
        $keluarBiaya = TransaksiBiaya::where('akun_id', $akun_id)->sum('jumlah');
        $masuk = $masukJual + $masukKas;
        $keluar = $keluarBeli + $keluarBiaya;
    }

    return $masuk - $keluar;
}

function getStock($brg_id)
{
    $keluar = TransaksiPenjualanDetail::where('barang_id', $brg_id)->sum('jumlah');
    $masuk = TransaksiPembelianDetail::where('barang_id', $brg_id)->sum('jumlah');
    return $masuk - $keluar;
}
