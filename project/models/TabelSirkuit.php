<?php
include_once("DB.php");
include_once("KontrakModel.php");
include_once("Sirkuit.php");

class TabelSirkuit extends DB implements KontrakModel {
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getAllPembalap(): array { return []; } // Tidak dipakai di sini
    public function getPembalapById($id): ?array { return null; } // Tidak dipakai
    public function addPembalap($n, $t, $ne, $p, $j): void {} // Tidak dipakai
    public function updatePembalap($id, $n, $t, $ne, $p, $j): void {} // Tidak dipakai
    public function deletePembalap($id): void {} // Tidak dipakai

    // --- Method Khusus Sirkuit ---

    public function getAllSirkuit(): array {
        $query = "SELECT * FROM sirkuit";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getSirkuitById($id): ?array {
        $this->executeQuery("SELECT * FROM sirkuit WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addSirkuit($nama, $negara, $panjang, $tikungan): void {
        $query = "INSERT INTO sirkuit (nama, negara, panjang_km, jumlah_tikungan) VALUES (:nama, :negara, :panjang, :tikungan)";
        $this->executeQuery($query, ['nama' => $nama, 'negara' => $negara, 'panjang' => $panjang, 'tikungan' => $tikungan]);
    }

    public function updateSirkuit($id, $nama, $negara, $panjang, $tikungan): void {
        $query = "UPDATE sirkuit SET nama=:nama, negara=:negara, panjang_km=:panjang, jumlah_tikungan=:tikungan WHERE id=:id";
        $this->executeQuery($query, ['id' => $id, 'nama' => $nama, 'negara' => $negara, 'panjang' => $panjang, 'tikungan' => $tikungan]);
    }

    public function deleteSirkuit($id): void {
        $query = "DELETE FROM sirkuit WHERE id = :id";
        $this->executeQuery($query, ['id' => $id]);
    }
}
?>
