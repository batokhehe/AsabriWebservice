<?php
namespace App\Validation;

use App\Models\BatchPembayaranModel;
use App\Models\BatchPesertaModel;
use App\Models\BintangJasaModel;
use App\Models\CacatGolonganModel;
use App\Models\CacatTingkatModel;
use App\Models\FaskesModel;
use App\Models\GolonganPangkatModel;
use App\Models\JenisHutangModel;
use App\Models\JenisKlaimModel;
use App\Models\JenisMutasiModel;
use App\Models\JenisProdukModel;
use App\Models\JenisRelasiModel;
use App\Models\KantorCabangModel;
use App\Models\KecamatanModel;
use App\Models\KelompokPangkatModel;
use App\Models\KeluargaModel;
use App\Models\KesatuanModel;
use App\Models\KlaimModel;
use App\Models\KotaModel;
use App\Models\ManfaatKomponenModel;
use App\Models\ManfaatModel;
use App\Models\MataAnggaranModel;
use App\Models\MitraBayarCabangModel;
use App\Models\MitraBayarModel;
use App\Models\PangkatModel;
use App\Models\PekerjaanModel;
use App\Models\PembayaranPensiunModel;
use App\Models\PendelegasianWewenangModel;
use App\Models\PenerimaPensiunModel;
use App\Models\PesertaCacatModel;
use App\Models\PesertaHutangModel;
use App\Models\PesertaModel;
use App\Models\PesertaMutasiModel;
use App\Models\PesertaProdukModel;
use App\Models\ProdukModel;
use App\Models\ProvinsiModel;
use App\Models\StatusKlaimModel;
use App\Models\StatusPesertaModel;
use App\Models\TipeDokumenModel;
use App\Models\TipePembayaranModel;
use App\Models\UnitOrganisasiModel;

class CustomRules
{
    public function is_provinsi_exists($id)
    {
        $model = new ProvinsiModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kota_exists($id)
    {
        $model = new KotaModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kecamatan_exists($id)
    {
        $model = new KecamatanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kelurahan_exists($id)
    {
        $model = new KecamatanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_unit_organisasi_exists($id)
    {
        $model = new UnitOrganisasiModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_pangkat_exists($id)
    {
        $model = new PangkatModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kesatuan_exists($id)
    {
        $model = new KesatuanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kantor_cabang_exists($id)
    {
        $model = new KantorCabangModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_tipe_dokumen_exists($id)
    {
        $model = new TipeDokumenModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_jenis_klaim_exists($id)
    {
        $model = new JenisKlaimModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_produk_exists($id)
    {
        $model = new ProdukModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_peserta_exists($id)
    {
        $model = new PesertaModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_status_peserta_exists($id)
    {
        $model = new StatusPesertaModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_jenis_relasi_exists($id)
    {
        $model = new JenisRelasiModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_pekerjaan_exists($id)
    {
        $model = new PekerjaanModel();
        $data  = $model->where([$model->primaryKey => $id])->where(['deleted_status' => 0])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_batch_peserta_exists($id)
    {
        $model = new BatchPesertaModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_pendelegasian_wewenang_exists($id)
    {
        $model = new PendelegasianWewenangModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_golongan_pangkat_exists($id)
    {
        $model = new GolonganPangkatModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_golongan_cacat_exists($id)
    {
        $model = new CacatGolonganModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_faskes_exists($id)
    {
        $model = new FaskesModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_status_klaim_exists($id)
    {
        $model = new StatusKlaimModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_keluarga_exists($id)
    {
        $model = new KeluargaModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_peserta_cacat_exists($id)
    {
        $model = new PesertaCacatModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_mitra_bayar_exists($id)
    {
        $model = new MitraBayarModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_mitra_bayar_cabang_exists($id)
    {
        $model = new MitraBayarCabangModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_peserta_produk_exists($id)
    {
        $model = new PesertaProdukModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_cacat_tingkat_exists($id)
    {
        $model = new CacatTingkatModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_peserta_mutasi_exists($id)
    {
        $model = new PesertaMutasiModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_jenis_mutasi_exists($id)
    {
        $model = new JenisMutasiModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_manfaat_exists($id)
    {
        $model = new ManfaatModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_klaim_exists($id)
    {
        $model = new KlaimModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_penerima_pensiun_exists($id)
    {
        $model = new PenerimaPensiunModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_kelompok_pangkat_exists($id)
    {
        $model = new KelompokPangkatModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_peserta_hutang_exists($id)
    {
        $model = new PesertaHutangModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_jenis_hutang_exists($id)
    {
        $model = new JenisHutangModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_tipe_pembayaran_exists($id)
    {
        $model = new TipePembayaranModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_batch_pembayaran_exists($id)
    {
        $model = new BatchPembayaranModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_mata_anggaran_exists($id)
    {
        $model = new MataAnggaranModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_pembayaran_pensiun_exists($id)
    {
        $model = new PembayaranPensiunModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_manfaat_komponen_exists($id)
    {
        $model = new ManfaatKomponenModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_bintang_jasa_exists($id)
    {
        $model = new BintangJasaModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_jenis_produk_exists($id)
    {
        $model = new JenisProdukModel();
        $data  = $model->where([$model->primaryKey => $id])->findAll();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
