<?php
include_once("KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelSirkuit.php");
include_once(__DIR__ . "/../models/Sirkuit.php");
include_once(__DIR__ . "/../views/ViewSirkuit.php");

class PresenterSirkuit implements KontrakPresenter {
    private $tabelSirkuit;
    private $viewSirkuit;
    private $listSirkuit = [];

    public function __construct($tabel, $view) {
        $this->tabelSirkuit = $tabel;
        $this->viewSirkuit = $view;
    }

    // Wajib dari interface (tapi kita pakai nama beda untuk sirkuit, jadi return kosong)
    public function tampilkanPembalap(): string { return ""; }
    public function tampilkanFormPembalap($id = null): string { return ""; }
    public function tambahPembalap($n, $t, $ne, $p, $j): void {}
    public function ubahPembalap($id, $n, $t, $ne, $p, $j): void {}
    public function hapusPembalap($id): void {}

    // --- Method Sirkuit ---
    public function prosesTampilSirkuit(): string {
        $data = $this->tabelSirkuit->getAllSirkuit();
        $this->listSirkuit = [];
        foreach ($data as $row) {
            $this->listSirkuit[] = new Sirkuit($row['id'], $row['nama'], $row['negara'], $row['panjang_km'], $row['jumlah_tikungan']);
        }
        return $this->viewSirkuit->tampilSirkuit($this->listSirkuit);
    }

    public function prosesFormSirkuit($id = null): string {
        $data = null;
        if ($id) {
            $data = $this->tabelSirkuit->getSirkuitById($id);
        }
        return $this->viewSirkuit->tampilFormSirkuit($data);
    }

    public function add($nama, $negara, $panjang, $tikungan) {
        $this->tabelSirkuit->addSirkuit($nama, $negara, $panjang, $tikungan);
    }

    public function update($id, $nama, $negara, $panjang, $tikungan) {
        $this->tabelSirkuit->updateSirkuit($id, $nama, $negara, $panjang, $tikungan);
    }

    public function delete($id) {
        $this->tabelSirkuit->deleteSirkuit($id);
    }
}
?>
