<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Panggil Libraries Server
require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {

    // serivice get
    function service_get()
    {
        // PANGGIL model mahasiswa
        
        $this->load->model("Mmahasiswa","mdl",TRUE);

        // panggil method ambil data
        $hasil = $this->mdl->ambil_data();

        // memberikan respond JSON
        $this->response(array("mahasiswa" => $hasil),200);
    }
	
    // service delete
    function service_delete()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        // ambil parameter "npm" sebagai dasar penghapus data
        $token = $this->delete("npm");
        // panggil metode "hapus_data"
        $hasil = $this->mdl->hapus_data(base64_encode($token));
        // jika data mahasiswa berhasil dihapus
        if  ($hasil == 1){
            $this->response(array("status"=>"Data Berhasil Dihapus"));
        }
        // jika data mahasiswa gagal dihapus
        else
        {
            $this->response(array("status"=>"Data Gagal Dihapus!",200));
        }
    }
    // service post
    function service_post()
    {
        // panggil model "Mmahasiswa"
        $this->load->model("Mmahasiswa","mdl",TRUE);
        $data = array(
            "npm" => $this->post("npm"),
            "nama" => $this->post("nama"),
            "telepon" => $this->post("telepon"),
            "jurusan" => $this->post("jurusan"),
        );

        // $data["npm"] = $this->post("npm");

        // panggil method "simpan data"
        $hasil = $this->mdl->simpan_data($data["npm"],$data["nama"],$data["telepon"],
        $data["jurusan"],base64_encode($data["npm"]));
        // jika data mahasiswa tidak ditemukan
        if  ($hasil == 0){
            $this->response(array("status"=>"Data Berhasil Disimpan"));
        }
        // jika data mahasiswa gagal dihapus
        else
        {
            $this->response(array("status"=>"Data Gagal Disimpan!",200));
        }
    }
    // service put
    function service_put()
    {

    }    
}
