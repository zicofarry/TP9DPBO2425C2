# Proyek MVP - Manajemen Data F1

Proyek ini adalah implementasi aplikasi web berbasis PHP Native yang menggunakan arsitektur **Model-View-Presenter (MVP)**. Proyek ini mengelola data balapan F1 yang mencakup data **Pembalap** dan data **Sirkuit**.

## Arsitektur Program (MVP)

Program ini memisahkan logika aplikasi menjadi tiga komponen utama untuk menjaga kode tetap rapi, terstruktur, dan mudah dikembangkan (Separation of Concerns).

1.  **Model (`models/`)**:
    * Bertanggung jawab mengelola data dan berinteraksi langsung dengan database (MySQL).
    * Mengimplementasikan interface `KontrakModel`.
    * Contoh: `TabelPembalap.php` dan `TabelSirkuit.php`.

2.  **View (`views/`)**:
    * Bertanggung jawab menampilkan antarmuka pengguna (HTML) kepada user.
    * View **tidak boleh** mengakses Model atau Database secara langsung.
    * Mengimplementasikan interface `KontrakView`.
    * Contoh: `ViewPembalap.php` dan `ViewSirkuit.php`.

3.  **Presenter (`presenters/`)**:
    * Bertindak sebagai perantara (jembatan) antara View dan Model.
    * Menerima input dari View (melalui Controller/index), memproses logika bisnis, meminta data ke Model, dan menyerahkannya kembali ke View.
    * Mengimplementasikan interface `KontrakPresenter`.

### Alur Program

1.  **Request**: User membuka `index.php`.
2.  **Routing**: `index.php` mengecek parameter `page` (pembalap atau sirkuit).
3.  **Inisialisasi**: `index.php` membuat objek Model, View, dan Presenter yang sesuai.
4.  **Proses**:
    * Presenter meminta data ke Model (`getAll...`).
    * Model query ke Database.
    * Model mengembalikan data array ke Presenter.
    * Presenter mengubah data array menjadi list objek Entity.
    * Presenter memberikan list objek ke View.
5.  **Response**: View merender HTML (menggunakan template `skin.html`) dan menampilkannya ke user.

## Struktur Folder

```text
TP9DPBO2425C2/
├── project/
│   ├── models/              # Logika database dan Entity
│   │   ├── DB.php
│   │   ├── Pembalap.php
│   │   ├── Sirkuit.php      (Baru)
│   │   ├── TabelPembalap.php
│   │   └── TabelSirkuit.php (Baru)
│   ├── views/               # Tampilan HTML
│   │   ├── ViewPembalap.php
│   │   └── ViewSirkuit.php  (Baru)
│   ├── presenters/          # Penghubung Model & View
│   │   ├── PresenterPembalap.php
│   │   └── PresenterSirkuit.php (Baru)
│   ├── template/            # Template HTML dasar
│   │   ├── skin.html
│   │   └── form.html
│   └── index.php            # Main controller / Router
├── dokumentasi/             # Screenshoot / Screenrecord
├── mvp_db.sql               # File database
└── README.md                # Dokumentasi ini
````

## Fitur CRUD

Aplikasi ini memiliki fitur CRUD lengkap untuk dua entitas:

1.  **Pembalap**:
      * Create: Form tambah pembalap.
      * Read: Tabel daftar pembalap.
      * Update: Form edit data pembalap.
      * Delete: Tombol hapus pembalap.
2.  **Sirkuit**:
      * Create: Form tambah sirkuit (Nama, Negara, Panjang KM, Tikungan).
      * Read: Tabel daftar sirkuit.
      * Update: Form edit sirkuit.
      * Delete: Tombol hapus sirkuit.

## Dokumentasi

*(Tempelkan link Screenrecord atau screenshot program di sini)*

1.  **Tampilan Daftar Pembalap**

2.  **Tampilan Daftar Sirkuit**

-----

*Dibuat untuk Tugas TP9 DPBO 2024/2025.*

```
```