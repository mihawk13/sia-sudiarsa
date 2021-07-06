<?

use App\Models\Akun;
use App\Models\PerpindahanDana;
use App\Models\TransaksiBiaya;
use App\Models\TransaksiKas;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianDetail;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Support\Facades\DB;

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

    if ($akun->kode == '1-1001') { //akun kas
        $masukJual = TransaksiPenjualan::where('status', 'Simpan')->sum('grand_total');
        $keluarBeli = TransaksiPembelian::where('status', 'Simpan')->sum('grand_total');
        $masukKas = TransaksiKas::sum('jumlah');
        $keluarBiaya = TransaksiBiaya::sum('jumlah') + PerpindahanDana::where('dari', '1')->sum('jumlah');
        $masuk = $masukJual + $masukKas;
        $keluar = $keluarBeli + $keluarBiaya;
    } elseif ($akun->kode == '4-1001') { // akun penjualan
        $masukJual = TransaksiPenjualan::where('status', 'Simpan')->sum('grand_total');
        $masuk = $masukJual;
        $keluar = 0;
    } elseif ($akun->kode == '5-1001') { // akun pembelian
        $keluarBeli = TransaksiPembelian::where('status', 'Simpan')->sum('grand_total');
        $masuk = 0;
        $keluar = $keluarBeli;
    } else {
        $masukJual = TransaksiPenjualan::where('status', 'Simpan')->where('akun_id', $akun_id)->sum('grand_total');
        $keluarBeli = TransaksiPembelian::where('status', 'Simpan')->where('akun_id', $akun_id)->sum('grand_total');
        $masukKas = TransaksiKas::where('akun_id', $akun_id)->sum('jumlah') + PerpindahanDana::where('dari', $akun_id)->sum('jumlah') - PerpindahanDana::where('ke', $akun_id)->sum('jumlah');
        $keluarBiaya = TransaksiBiaya::where('akun_id', $akun_id)->sum('jumlah');
        $masuk = $masukJual + $masukKas;
        $keluar = $keluarBeli + $keluarBiaya;
    }

    $hasil = $masuk - $keluar;
    if ($hasil < 0) {
        $hasil = str_replace('-', '', $hasil);
    }
    return $hasil;
}

function getStock($brg_id)
{
    $keluar = TransaksiPenjualanDetail::where('barang_id', $brg_id)->sum('jumlah');
    $masuk = TransaksiPembelianDetail::where('barang_id', $brg_id)->sum('jumlah');
    return $masuk - $keluar;
}

function getMasuk($dari, $hingga, $brg_id)
{
    $masuk = DB::select("SELECT SUM(b.jumlah) jml FROM transaksi_pembelian a
    INNER JOIN transaksi_pembelian_detail b ON a.id=b.pembelian_id
    INNER JOIN barang c ON b.barang_id=c.id
    WHERE a.tanggal BETWEEN ? AND ? AND c.id = ?
    GROUP BY c.id", [$dari, $hingga, $brg_id]);
    return $masuk[0]->jml ?? 0;
}

function getKeluar($dari, $hingga, $brg_id)
{
    $keluar = DB::select("SELECT SUM(b.jumlah) jml FROM transaksi_penjualan a
    INNER JOIN transaksi_penjualan_detail b ON a.id=b.penjualan_id
    INNER JOIN barang c ON b.barang_id=c.id
    WHERE a.tanggal BETWEEN ? AND ? AND c.id = ?
    GROUP BY c.id", [$dari, $hingga, $brg_id]);
    return $keluar[0]->jml ?? 0;
}


