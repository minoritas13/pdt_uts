<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $kategori_id
 * @property int $penerbit_id
 * @property string $isbn
 * @property string $judul
 * @property string $penulis
 * @property numeric $harga_nasional
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Kategori $kategori
 * @property-read \App\Models\Penerbit|null $penerbit
 * @method static \Database\Factories\BukuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereHargaNasional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku wherePenerbitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku wherePenulis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Buku withoutTrashed()
 */
	class Buku extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $kode_cabang
 * @property string $nama_cabang
 * @property string $lokasi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CabangFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereKodeCabang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereNamaCabang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cabang whereUpdatedAt($value)
 */
	class Cabang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $transaksi_id
 * @property int $buku_id
 * @property int $qty
 * @property numeric $harga_satuan
 * @property numeric $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereBukuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereHargaSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereTransaksiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailTransaksi whereUpdatedAt($value)
 */
	class DetailTransaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_kategori
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Buku> $buku
 * @property-read int|null $buku_count
 * @method static \Database\Factories\KategoriFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereNamaKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $buku_id
 * @property string $jenis
 * @property int $qty
 * @property string $keterangan
 * @property string $waktu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereBukuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiGudangPusat whereWaktu($value)
 */
	class MutasiGudangPusat extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $buku_id
 * @property string $jenis
 * @property int $qty
 * @property string $keterangan
 * @property string $waktu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereBukuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MutasiStokLokal whereWaktu($value)
 */
	class MutasiStokLokal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string $no_telp
 * @property int $poin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PelangganLokalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal wherePoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganLokal whereUpdatedAt($value)
 */
	class PelangganLokal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string $asal_cabang
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional whereAsalCabang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PelangganNasional whereUpdatedAt($value)
 */
	class PelangganNasional extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama_penerbit
 * @property string|null $kota
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Buku> $buku
 * @property-read int|null $buku_count
 * @method static \Database\Factories\PenerbitFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereKota($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereNamaPenerbit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Penerbit withoutTrashed()
 */
	class Penerbit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $cabang_id
 * @property string $tanggal
 * @property int $total_transaksi
 * @property numeric $total_pendapatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereCabangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereTotalPendapatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereTotalTransaksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RekapHarianNasional whereUpdatedAt($value)
 */
	class RekapHarianNasional extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $buku_id
 * @property int $qty_tersedia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat whereBukuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat whereQtyTersedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokGudangPusat whereUpdatedAt($value)
 */
	class StokGudangPusat extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $buku_id
 * @property int $qty_tersedia
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal whereBukuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal whereQtyTersedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StokLokal whereUpdatedAt($value)
 */
	class StokLokal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $no_struk
 * @property int|null $pelanggan_id
 * @property numeric $total
 * @property string $status_pembayaran
 * @property string $tipe_pesanan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $bukti_bayar
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetailTransaksi> $details
 * @property-read int|null $details_count
 * @method static \Database\Factories\TransaksiFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereBuktiBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereNoStruk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi wherePelangganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereStatusPembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereTipePesanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereUpdatedAt($value)
 */
	class Transaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

