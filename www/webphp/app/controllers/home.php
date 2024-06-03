<?php

class Home extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            echo json_encode(array("message" => "hello world"));
        }
    }
    // public function delete($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    //         $data = $this->model('Film_model')->deleteData($id);

    //         if ($data) {
    //             echo json_encode(array("status" => "success", "message" => "Data berhasil dihapus."));
    //         } else {
    //             echo json_encode(array("status" => "error", "message" => "Gagal menghapus data."));
    //         }
    //     } else {
    //         echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
    //     }
    // }

    // public function create()
    // {

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $input = file_get_contents("php://input");

    //         $data = json_decode($input, true);


    //         if (isset($data['title']) && isset($data['genre'])  && isset($data['img']) && isset($data['video'])) {
    //             // Panggil fungsi createData di model dan kirim data
    //             $result = $this->model('Film_model')->createData($data);

    //             // Periksa apakah data berhasil disimpan
    //             if ($result) {
    //                 // Jika berhasil, kirim respon JSON sukses
    //                 echo json_encode(array("status" => "success", "message" => "Data berhasil disimpan."));
    //             } else {
    //                 // Jika gagal, kirim respon JSON gagal
    //                 echo json_encode(array("status" => "error", "message" => "Gagal menyimpan data."));
    //             }
    //         } else {
    //             // Jika data tidak lengkap, kirim respon JSON error
    //             echo json_encode(array("status" => "error", "message" => "Data tidak lengkap."));
    //         }
    //     } else {
    //         // Jika bukan metode POST, kirim respon JSON error
    //         echo json_encode(array("status" => "error", "message" => "Metode request tidak valid."));
    //     }
    // }
}
