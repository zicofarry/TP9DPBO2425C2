<?php

include_once("models/DB.php");
include("models/TabelPembalap.php");
include("views/ViewPembalap.php");
include("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);



if(isset($_GET['screen'])){
    if($_GET['screen'] == 'add'){
        $formHtml = $presenter->tampilkanFormPembalap();
        echo $formHtml;
    }
    else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
        $formHtml = $presenter->tampilkanFormPembalap($_GET['id']);
        echo $formHtml;
    }
} 
else if(isset($_POST['action'])){
    $action = $_POST['action'];

    try {
        if($action == 'add'){
            // Ambil data dari form
            $nama = $_POST['nama'];
            $tim = $_POST['tim'];
            $negara = $_POST['negara'];
            $poinMusim = $_POST['poinMusim'];
            $jumlahMenang = $_POST['jumlahMenang'];
            
            // Panggil presenter untuk menambah data
            $presenter->tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
        }
        else if($action == 'edit' && isset($_POST['id'])){
            // Ambil data dari form
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $tim = $_POST['tim'];
            $negara = $_POST['negara'];
            $poinMusim = $_POST['poinMusim'];
            $jumlahMenang = $_POST['jumlahMenang'];

            // Panggil presenter untuk mengubah data
            $presenter->ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        }
        else if($action == 'delete' && isset($_POST['id'])){
            // Ambil id
            $id = $_POST['id'];
            
            // Panggil presenter untuk menghapus data
            $presenter->hapusPembalap($id);
        }
    } catch (Exception $e) {
        // (Opsional) Tangani error jika terjadi
        echo "Error: " . $e->getMessage();
        // Sebaiknya redirect juga agar tidak error
    }
    // Redirect back to list without performing any action
    header("Location: index.php");
    exit();

} else{
    // Presenter now returns the full HTML (view injects the template and total)
    $html = $presenter->tampilkanPembalap();
    echo $html;
}

?>