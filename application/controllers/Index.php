<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pmb', 'm_pmb');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->render('index/index', $data);
    }

    public function pendaftarprodi1()
    {
        $data['title'] = 'Grafik Berdasarkan Prodi 1';
        $prodi = $this->m_pmb->listProdi();

        $result = null;

        foreach ($prodi as $key => $p) {
            $prodi[$key]['jumlah'] = $this->m_pmb->jumlahPendaftarProdi1($p['id_prodi']);
            $prodi[$key]['jumlah2'] = $this->m_pmb->jumlahPendaftarProdi2($p['id_prodi']);
            $prodi[$key]['size'] = rand(10, 30);
        }

        //grafik pertama

        foreach ($prodi as $p => $prod) {
            // if ($prod['jumlah'] > $sum) {
            //     $sum = $prod['jumlah'];
            //     $sliced = true;
            //     $selected = true;
            // }
            $result[$p] = [
                "name"  => $prod['nama_prodi'],
                "jumlah" => $prod['jumlah'],
                "y"     => $prod['size'],
                // "sliced" => $sliced,
                // 'selected' => $selected
            ];
        }

        $data['pendaftar'] = $prodi;
        $data['grafik1'] = json_encode($result);
        $this->render('index/grafik_prodi1', $data);
    }

    public function pendaftarprodi2()
    {
        $data['title'] = 'Grafik Berdasarkan Prodi 2';
        $prodi = $this->m_pmb->listProdi();
        foreach ($prodi as $key => $p) {
            $prodi[$key]['jumlah'] = $this->m_pmb->jumlahPendaftarProdi1($p['id_prodi']);
            $prodi[$key]['jumlah2'] = $this->m_pmb->jumlahPendaftarProdi2($p['id_prodi']);
            $prodi[$key]['size'] = rand(10, 30);
        }

        //grafik kedua
        $hasil = null;
        foreach ($prodi as $p => $prod) {
            $hasil[$p] = [
                "name"  => $prod['nama_prodi'],
                "jumlah" => $prod['jumlah2'],
                "y"     => $prod['size'],
                // "sliced" => $sliced,
                // 'selected' => $selected
            ];
        }

        $data['pendaftar'] = $prodi;
        $data['grafik2'] = json_encode($hasil);
        $this->render('index/grafik_prodi2', $data);
    }

    public function pendaftarprestasi()
    {
        $data['title'] = 'Grafik Pendaftar Jalur Mandiri Prestasi';
        $pendaftar = $this->m_pmb->pendaftarPrestasi();
        // echo $this->db->last_query();
        // die;
        $grafik = null;
        $sumtotal = 0;
        foreach ($pendaftar as $key => $value){
            $sumtotal += $value['jumlah'];
            $grafik[$key] = [
                'name' => $value['tingkat_prestasi'],
                'jumlah' => intval($value['jumlah']),
                'y' => intval($value['jumlah']),
            ];
        }

        $data['subtitle'] = 'Jumlah Pendaftar:' .$sumtotal;
        $data['grafik'] = json_encode($grafik);
        $this->render('index/grafik_prestasi', $data);
    }

    
    public function pendaftarJalur()
    {
        $data['title'] = 'Grafik Pendaftar Berdasarkan Jalur Masuk';
        $pendaftar = $this->m_pmb->pendaftarJalurMasuk();
        // echo $this->db->last_query();
        // die;
        $grafik = null;
        $sumtotal = 0;
        foreach ($pendaftar as $key => $value){
            $sumtotal += $value['jumlah'];
            $grafik[$key] = [
                'name' => $value['nama_jalur'],
                'jumlah' => intval($value['jumlah']),
                'y' => intval($value['jumlah']),
            ];
        }

        $data['subtitle'] = 'Jumlah Pendaftar:' .$sumtotal;
        $data['grafik'] = json_encode($grafik);
        $this->render('index/grafik_jalur', $data);
    }


    public function grafikPendapatan()
    {
        $data['title'] = 'Grafik Pendapatan Berdasarkan Bank';
        $bank = $this->m_pmb->listBank();
        $pendaftar = $this->m_pmb->pendaftarBank();

        $categories = null;
        $lunas = null;
        $belum_lunas = null;
        $sumtotal = 0;
        foreach ($bank as $i => $b){
            $categories[] = $b['bank'];
            foreach ($pendaftar as $key => $value){
                if ($b['id_bank'] == $value['id_bank']){
                    if ($value['is_bayar'] == '1'){
                        $sumtotal += intval($value['total']);
                        $lunas[] = intval($value['total']);
                    } else {
                        $belum_lunas[] = intval($value['total']);
                    }
                }
            }
        }
        $result[] = [
            'name'=> 'Pendapatan',
            'data'=> $lunas,
        ];
        $data['subtitle'] = 'Total Pendapatan Rp. ' .$sumtotal;
        $data['data'] = json_encode($result);
        $grafik['categories'] = json_encode($categories);
        $data['grafik'] = $grafik;
        $this->render('index/grafik_pendapatan', $data);
    }

    public function pendaftarBank()
    {
        $data['title'] = 'Grafik Pendaftar Berdasarkan Bank';
        $bank = $this->m_pmb->listBank();
        $pendaftar = $this->m_pmb->pendaftarBank();

        $categories = null;
        $lunas = null;
        $belum_lunas = null;
        $sumtotal = 0;
        foreach ($bank as $i => $b){
            $categories[] = $b['bank'];
            foreach ($pendaftar as $key => $value){
                if ($b['id_bank'] == $value['id_bank']){
                    if ($value['is_bayar'] == '1'){
                        $sumtotal += intval($value['total']);
                        $lunas[] = intval($value['total']);
                    } else {
                        $sumtotal += intval($value['total']);
                        $belum_lunas[] = intval($value['total']);
                    }
                }
            }
        }
        $result[] = [
            'name'=> 'Lunas',
            'data'=> $lunas,
        ];
        $result[] = [
            'name'=> 'Belum Lunas',
            'data'=> $belum_lunas,
        ];

        $data['subtitle'] = 'Total Pendaftar: ' .$sumtotal;
        $data['data'] = json_encode($result, 1);
        $grafik['categories'] = json_encode($categories);
        $data['grafik'] = $grafik;
        $this->render('index/grafik_bank', $data);
    }

}
