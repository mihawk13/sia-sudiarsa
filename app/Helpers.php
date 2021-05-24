<?

use App\Models\TransaksiKas;

function getJmlKas()
{
    $kas = TransaksiKas::sum('jumlah');
    return $kas;
}
