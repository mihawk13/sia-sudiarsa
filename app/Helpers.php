<?

use App\Models\TransaksiKas;
use App\Models\TransaksiPenjualan;

function getJmlKas()
{
    $kas = TransaksiKas::sum('jumlah');
    return $kas;
}

function getTotalPenjualan()
{
    $grd = TransaksiPenjualan::sum('grand_total');
    return $grd;
}
