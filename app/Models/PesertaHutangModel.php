<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaHutangModel extends Model
{
    protected $DBGroup          ='default';
    protected $table            ='trx_peserta_hutang';
    protected $primaryKey       ='peserta_hutang_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       ='array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'peserta_hutang_id',
        'peserta_hutang_unique_code',
        'peserta_id',
        'peserta_unique_code',
        'nama_peserta',
        'jenis_hutang_id',
        'nama_jenis_hutang',
        'jenis_hutang_unique_code',
        'mitra_bayar_id',
        'nama_mitra_bayar',
        'mitra_bayar_unique_code',
        'jumlah_hutang',
        'bunga_tahunan',
        'cicilan',
        'is_selesai',
        'tanggal_bayar_terakhir',
        'tanggal_bayar_selanjutnya',
        'created_by',
        'created_date',
        'last_update_date',
        'last_update_by',
        'deleted_date',
        'deleted_by',
        'deleted_status',
        'sisa_hutang',

    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    ='datetime';
    protected $createdField  ='created_at';
    protected $updatedField  ='updated_at';
    protected $deletedField  ='deleted_at';

    // Validation
    protected $validationRules      = [
        'peserta_hutang_unique_code'=>'required',
        'peserta_id'=>'required',
        'peserta_unique_code'=>'required',
        'nama_peserta'=>'required',
        'jenis_hutang_id'=>'required',
        'nama_jenis_hutang'=>'required',
        'jenis_hutang_unique_code'=>'required',
        'mitra_bayar_id'=>'required',
        'nama_mitra_bayar'=>'required',
        'mitra_bayar_unique_code'=>'required',
        'jumlah_hutang'=>'required',
        'bunga_tahunan'=>'required',
        'cicilan'=>'required',
        'is_selesai'=>'required',
        'tanggal_bayar_terakhir'=>'required',
        'tanggal_bayar_selanjutnya'=>'required',
        'sisa_hutang'=>'required',

    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public static function getAll(){
        $model = new PesertaHutangModel();
        return $model->where(['deleted_status'=> 0])->findAll();
    }

    public static function findById($id){
        $model = new PesertaHutangModel();
        return $model->where([$model->primaryKey => $id])->where(['deleted_status'=> 0])->first();
    }

    public static function createNew($model, $request, $user){
        return $model->insert([
            'peserta_hutang_unique_code'=> $request->getVar('peserta_hutang_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'jenis_hutang_id'=> $request->getVar('jenis_hutang_id'),
            'nama_jenis_hutang'=> $request->getVar('nama_jenis_hutang'),
            'jenis_hutang_unique_code'=> $request->getVar('jenis_hutang_unique_code'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'jumlah_hutang'=> $request->getVar('jumlah_hutang'),
            'bunga_tahunan'=> $request->getVar('bunga_tahunan'),
            'cicilan'=> $request->getVar('cicilan'),
            'is_selesai'=> $request->getVar('is_selesai'),
            'tanggal_bayar_terakhir'=> $request->getVar('tanggal_bayar_terakhir'),
            'tanggal_bayar_selanjutnya'=> $request->getVar('tanggal_bayar_selanjutnya'),
            'sisa_hutang'=> $request->getVar('sisa_hutang'),

            'created_date'=> date('Y-m-d H:i:s'),
            'created_by'=> $user->data->email,
            'deleted_status'=>  0, 
        ]) ;
    }

    public static function updateData($id, $model, $request, $user){
        return $model->update($id, [
            'peserta_hutang_unique_code'=> $request->getVar('peserta_hutang_unique_code'),
            'peserta_id'=> $request->getVar('peserta_id'),
            'peserta_unique_code'=> $request->getVar('peserta_unique_code'),
            'nama_peserta'=> $request->getVar('nama_peserta'),
            'jenis_hutang_id'=> $request->getVar('jenis_hutang_id'),
            'nama_jenis_hutang'=> $request->getVar('nama_jenis_hutang'),
            'jenis_hutang_unique_code'=> $request->getVar('jenis_hutang_unique_code'),
            'mitra_bayar_id'=> $request->getVar('mitra_bayar_id'),
            'nama_mitra_bayar'=> $request->getVar('nama_mitra_bayar'),
            'mitra_bayar_unique_code'=> $request->getVar('mitra_bayar_unique_code'),
            'jumlah_hutang'=> $request->getVar('jumlah_hutang'),
            'bunga_tahunan'=> $request->getVar('bunga_tahunan'),
            'cicilan'=> $request->getVar('cicilan'),
            'is_selesai'=> $request->getVar('is_selesai'),
            'tanggal_bayar_terakhir'=> $request->getVar('tanggal_bayar_terakhir'),
            'tanggal_bayar_selanjutnya'=> $request->getVar('tanggal_bayar_selanjutnya'),
            'sisa_hutang'=> $request->getVar('sisa_hutang'),

            'last_update_by'=> $user->data->email, 
            'last_update_date'=> date('Y-m-d H:i:s'),
        ]);
    }

    public static function softDelete($id, $model, $user){
        return $model->update($id,[
            'deleted_status'=> 1,
            'deleted_by'=> $user->data->email,
            'deleted_date'=> date('Y-m-d H:i:s')
        ]);
    }

    public function getAvailableId($model){
        $result = $model->findAll();
        if (count($result) > 0) {
            return $result[count($result) - 1][$model->primaryKey] + 1;
        } else {
            return 1;
        }

    }
}
