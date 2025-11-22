<?php
class Sirkuit {
    private $id;
    private $nama;
    private $negara;
    private $panjang_km;
    private $jumlah_tikungan;

    public function __construct($id, $nama, $negara, $panjang_km, $jumlah_tikungan) {
        $this->id = $id;
        $this->nama = $nama;
        $this->negara = $negara;
        $this->panjang_km = $panjang_km;
        $this->jumlah_tikungan = $jumlah_tikungan;
    }

    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getNegara() { return $this->negara; }
    public function getPanjangKm() { return $this->panjang_km; }
    public function getJumlahTikungan() { return $this->jumlah_tikungan; }
}
?>
