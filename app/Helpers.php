<?

use App\Models\TransaksiBiaya;
use App\Models\TransaksiKas;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPenjualan;

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

function getSaldoAkun($id_akun)
{
    return 0;
}
