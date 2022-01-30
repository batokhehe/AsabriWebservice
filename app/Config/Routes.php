<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('api', function ($routes) {
    $routes->post('register', 'User::register');
    $routes->post('login', 'User::login');
    $routes->get('profile', 'User::details');
    $routes->resource('user');
    $routes->resource('provinsi');
    $routes->resource('kota');
    $routes->resource('kecamatan');
    $routes->resource('kelurahan');
    $routes->resource('unitOrganisasi');
    $routes->resource('kesatuan');
    $routes->resource('kelompokPangkat');
    $routes->resource('pangkat');
    $routes->resource('pangkatKesatuan');
    $routes->resource('bintangJasa');
    $routes->resource('cacatGolongan');
    $routes->resource('cacatTingkat');
    $routes->resource('peserta');
    $routes->resource('batchPeserta');
    $routes->resource('keluarga');
    $routes->resource('penerimaPensiun');
    $routes->resource('pesertaPangkat');
    $routes->resource('pembayaranKlaim');
    $routes->resource('pembayaranKlaimManfaat');
    $routes->resource('mitraBayar');
    $routes->resource('pesertaCacat');
    $routes->resource('klaim');
    $routes->resource('pembayaranPensiun');
    $routes->resource('pembayaranPensiunManfaat');
    $routes->resource('batchPembayaran');
    $routes->resource('pesertaHutang');
    $routes->resource('pesertaRekening');
    $routes->resource('pesertaGaji');
    $routes->resource('pensiunMitraBayar');
    $routes->resource('mitraBayarCabang');
    $routes->resource('faskes');
    $routes->resource('manfaat');
    $routes->resource('klaimManfaat');
    $routes->resource('produk');
    $routes->resource('produkManfaat');
    $routes->resource('golonganPangkat');
    $routes->resource('dokumenKlaimProduk');
    $routes->resource('manfaatKomponen');
    $routes->resource('pesertaManfaat');
    $routes->resource('statusPembayaran');
    $routes->resource('laporSptb');
    $routes->resource('pesertaMutasi');
    $routes->resource('pesertaIuran');
    $routes->resource('pesertaBintangJasa');
    $routes->resource('pembayaranHutangPeserta');
    $routes->resource('otentikasiPensiun');
    $routes->resource('laporanSptbPeserta');
    $routes->resource('klaimBatch');
    $routes->resource('sumberKlaim');
    $routes->resource('pendelegasianWewenang');
    $routes->resource('produkPremi');
    $routes->resource('penghasilan');
    $routes->resource('ktpaGenerator');
    $routes->resource('appMenu');
    $routes->resource('userMenu');

    //Peserta
    $routes->resource('kantorCabang');

    // untested
    $routes->resource('jenisHutang');
    $routes->resource('jenisKlaim');
    $routes->resource('jenisMutasi');
    $routes->resource('jenisProduk');
    $routes->resource('jenisRelasi');
    $routes->resource('mataAnggaran');
    $routes->resource('pekerjaan');
    $routes->resource('statusKlaim');
    $routes->resource('statusPeserta');
    $routes->resource('tipeDokumen');
    $routes->resource('tipePembayaran');
    $routes->resource('pesertaProduk');
    // untested
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
