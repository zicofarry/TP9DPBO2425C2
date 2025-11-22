<?php

include_once("KontrakView.php");
include_once("models/Sirkuit.php");

class ViewSirkuit implements KontrakView {
    // Method yang tidak terpakai (wajib ada karena interface)
    public function tampilPembalap($data): string { return ""; }
    public function tampilFormPembalap($data = null): string { return ""; }

    // Method Utama Menampilkan Tabel Sirkuit
    public function tampilSirkuit($listSirkuit): string {
        // 1. Buat baris tabel (rows) HTML
        $tbody = '';
        $no = 1;
        foreach ($listSirkuit as $sirkuit) {
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">' . $no++ . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getNama()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getNegara()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getPanjangKm()) . ' km</td>';
            $tbody .= '<td>' . htmlspecialchars($sirkuit->getJumlahTikungan()) . '</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?page=sirkuit&screen=edit&id=' . $sirkuit->getId() . '" class="btn btn-edit">Edit</a>
                    <button data-id="' . $sirkuit->getId() . '" class="btn btn-delete">Hapus</button>
                </td>';
            $tbody .= '</tr>';
        }

        // 2. Ambil template skin.html
        $templatePath = __DIR__ . '/../template/skin.html';
        if (!file_exists($templatePath)) {
            return "Error: Template skin.html tidak ditemukan!";
        }
        $template = file_get_contents($templatePath);

        // 3. --- BAGIAN FIX --- 
        // Ganti Header Tabel (Judul Kolom)
        $customHeader = '<tr>
              <th class="col-id">No</th>
              <th>Nama Sirkuit</th>
              <th>Negara</th>
              <th>Panjang (KM)</th>
              <th>Jumlah Tikungan</th>
              <th class="col-actions">Aksi</th>
            </tr>';
        $template = preg_replace('/<thead>(.*?)<\/thead>/s', '<thead>'.$customHeader.'</thead>', $template);

        // Ganti Isi Body Tabel (Data) -> MENGGUNAKAN REGEX AGAR LEBIH AMAN
        // Ini akan menghapus apapun di dalam <tbody>...</tbody> dan mengisinya dengan data baru
        $template = preg_replace('/<tbody>(.*?)<\/tbody>/s', '<tbody>' . $tbody . '</tbody>', $template);

        // 4. Ganti Label dan Link Lainnya
        $template = str_replace('Daftar Pembalap', 'Daftar Sirkuit', $template); // Judul Halaman
        $template = str_replace('Total:', 'Total: ' . count($listSirkuit), $template); // Total Data
        $template = str_replace('index.php?screen=add', 'index.php?page=sirkuit&screen=add', $template); // Link tombol tambah
        
        // (Opsional) Ganti teks tombol "+ Tambah Pembalap" jadi "+ Tambah Sirkuit"
        $template = str_replace('+ Tambah Pembalap', '+ Tambah Sirkuit', $template);

        return $template;
    }

    // Method Form Sirkuit (Tetap sama seperti sebelumnya)
    public function tampilFormSirkuit($data = null): string {
        $action = $data ? 'edit' : 'add';
        $idVal = $data['id'] ?? '';
        $namaVal = $data['nama'] ?? '';
        $negaraVal = $data['negara'] ?? '';
        $panjangVal = $data['panjang_km'] ?? '';
        $tikunganVal = $data['jumlah_tikungan'] ?? '';

        return '
        <!doctype html>
        <html lang="id">
        <head><title>Form Sirkuit</title>
        <style>
            :root{ --bg: #f7f8fb; --card: #ffffff; --accent: #2563eb; --border: #e6e9ef; font-family: sans-serif;}
            body{background:var(--bg); display:flex; justify-content:center; padding-top:40px;}
            .card{background:var(--card); border:1px solid var(--border); padding:20px; border-radius:8px; width:600px;}
            input{width:100%; padding:10px; margin-bottom:10px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;}
            label{display:block; margin-bottom:5px; color:#555; font-size:14px;}
            .btn{padding:10px 15px; background:var(--accent); color:white; border:none; border-radius:4px; cursor:pointer;}
            .btn-cancel{background:transparent; border:1px solid #ccc; color:#555; text-decoration:none; margin-right:10px;}
        </style>
        </head>
        <body>
            <div class="card">
                <h1>Form Sirkuit</h1>
                <form method="post" action="index.php?page=sirkuit">
                    <input type="hidden" name="action" value="'.$action.'">
                    <input type="hidden" name="id" value="'.$idVal.'">
                    
                    <label>Nama Sirkuit</label>
                    <input type="text" name="nama" value="'.$namaVal.'" required>
                    
                    <label>Negara</label>
                    <input type="text" name="negara" value="'.$negaraVal.'" required>
                    
                    <label>Panjang (KM)</label>
                    <input type="number" step="0.001" name="panjang" value="'.$panjangVal.'">
                    
                    <label>Jumlah Tikungan</label>
                    <input type="number" name="tikungan" value="'.$tikunganVal.'">
                    
                    <div style="text-align:right; margin-top:10px;">
                        <a href="index.php?page=sirkuit" class="btn btn-cancel">Batal</a>
                        <button type="submit" class="btn">Simpan</button>
                    </div>
                </form>
            </div>
        </body>
        </html>';
    }
}
?>