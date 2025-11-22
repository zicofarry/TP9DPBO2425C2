<?php
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelSirkuit.php");
include_once("views/ViewPembalap.php");
include_once("views/ViewSirkuit.php");
include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterSirkuit.php");

// Halaman aktif (default: pembalap)
$page = $_GET['page'] ?? 'pembalap';

if ($page == 'sirkuit') {
    // LOGIKA SIRKUIT
    $tabel = new TabelSirkuit('localhost', 'mvp_db', 'root', '');
    $view = new ViewSirkuit();
    $presenter = new PresenterSirkuit($tabel, $view);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->prosesFormSirkuit();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->prosesFormSirkuit($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->add($_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->update($_POST['id'], $_POST['nama'], $_POST['negara'], $_POST['panjang'], $_POST['tikungan']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->delete($_POST['id']);
        }
        header("Location: index.php?page=sirkuit");
        exit();
    } else {
        echo $presenter->prosesTampilSirkuit();
    }

} else {
    // LOGIKA PEMBALAP (DEFAULT)
    $tabel = new TabelPembalap('localhost', 'mvp_db', 'root', '');
    $view = new ViewPembalap();
    $presenter = new PresenterPembalap($tabel, $view);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormPembalap();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusPembalap($_POST['id']);
        }
        header("Location: index.php?page=pembalap");
        exit();
    } else {
        echo $presenter->tampilkanPembalap();
    }
}
?>