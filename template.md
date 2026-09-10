# Product Requirements Document (PRD)
## Admin Dashboard Template — Custom (Terinspirasi Tabler)

| | |
|---|---|
| **Author** | Gana Purba Kusuma |
| **Status** | Completed & Expanded |
| **Lokasi Project** | `public/template/be/` |

---

## 1. Overview

### 1.1 Tujuan
Membangun template admin dashboard **static HTML + Bootstrap 5 murni** (tanpa framework JS lain, tanpa build tools/npm), disimpan di `public/template/be/`, untuk dipakai sebagai basis tampilan admin dashboard LMS (dan project Laravel lain ke depannya). Dibuat sendiri karena template pihak ketiga (Tabler) membutuhkan proses build yang tidak sesuai preferensi kerja (ingin static file yang bisa langsung copy-paste element).

### 1.2 Prinsip Desain
- Terinspirasi gaya visual **Tabler** (clean, modern, minimalis, glassmorphism navbar, card accents)
- **Tipografi Modern**: Menggunakan Google Font `Plus Jakarta Sans`
- **Mobile first**: dirancang dari layar kecil dulu, baru diperluas ke desktop (responsive drawer sidebar)
- **User friendly**: navigasi jelas, kontras warna cukup, ukuran elemen nyaman disentuh
- Mendukung **Light Mode** dan **Dark Mode** dengan toggle + `localStorage` persistence

---

## 2. Tech Stack

| Layer | Teknologi |
|---|---|
| Struktur | HTML5 murni |
| Styling | Bootstrap 5.3.3 + Custom CSS (`public/template/be/assets/css/custom.css`) |
| Tipografi | Google Fonts (`Plus Jakarta Sans`) |
| Tabel Interaktif | DataTables 1.13.8 (Bootstrap 5 theme + Bahasa Indonesia) |
| Interaktivitas | Vanilla JavaScript & jQuery 3.7 (tanpa framework frontend berat) |
| Icon | Tabler Icons Webfont (`ti ti-*`) |
| Dark Mode | CSS Variables + `localStorage` + `data-theme` attribute |

---

## 3. Struktur Folder

```
public/template/be/
├── index.html                 ← Halaman referensi utama, berisi SEMUA komponen/UI
│                                  (Buttons, Cards, DataTables, Forms, Badges, Alerts, Modals, Tabs, Accordions, Empty State)
├── assets/
│   ├── css/
│   │   └── custom.css         ← Styling tambahan, CSS variable dark/light mode, DataTables theme, glassmorphism, accent cards
│   └── js/
│       ├── theme-toggle.js    ← Logic toggle dark/light mode + localStorage persistence
│       └── sidebar.js         ← Logic buka/tutup sidebar mobile drawer & backdrop
├── pages/
│   ├── dashboard.html         ← Contoh halaman dashboard lengkap dengan stat cards & log aktivitas
│   ├── table-example.html     ← Contoh halaman dengan tabel DataTables & modal konfirmasi hapus
│   ├── form-example.html      ← Contoh halaman dengan form pembuatan modul/kursus
│   ├── profile.html           ← Contoh halaman profil user & pengaturan akun (tabbed interface)
│   └── blank.html             ← Starter page kosong untuk membuat halaman baru dengan cepat
└── components/                ← Potongan HTML per komponen, untuk referensi cepat
    ├── sidebar.html           ← Partial sidebar navigasi
    ├── navbar.html            ← Partial navbar header + glassmorphism
    └── modal.html             ← Partial modal konfirmasi hapus & modal form
```

---

## 4. Functional Requirements

### 4.1 Halaman `index.html` — Component Library Catalog
| ID | Requirement |
|---|---|
| FR-1.1 | Menampilkan seluruh komponen UI dalam satu halaman terorganisir: Buttons (Solid, Outline, Soft, Icon, Pill, Groups), Stat Cards, DataTables, Forms, Alerts, Badges, Modals, Accordions, Nav Tabs, Progress Bars, Breadcrumb, Pagination, dan Empty State |
| FR-1.2 | Setiap komponen ditampilkan dengan contoh visual rapi + siap di-copy-paste ke Blade view Laravel |
| FR-1.3 | Halaman ini menjadi "katalog" utama referensi pengembangan UI |

### 4.2 Layout Dasar (Sidebar + Glassmorphic Navbar)
| ID | Requirement |
|---|---|
| FR-2.1 | Sidebar navigasi vertikal untuk desktop, otomatis berubah jadi **hamburger drawer** di mobile dengan blur backdrop |
| FR-2.2 | Navbar atas dengan efek **glassmorphism** (`backdrop-filter: blur(12px)`): toggle sidebar (mobile), toggle dark/light mode, notifikasi, profil user dropdown |
| FR-2.3 | Layout menggunakan Flexbox/CSS Grid yang sepenuhnya responsif di semua resolusi layar |

### 4.3 DataTables & Modal Konfirmasi Hapus
| ID | Requirement |
|---|---|
| FR-3.1 | Integrasi DataTables Bootstrap 5 pada tabel data dengan fitur pencarian, pilihan jumlah data, info halaman, dan pagination berbahasa Indonesia |
| FR-3.2 | Tombol Hapus memicu **Modal Konfirmasi Hapus** khusus dengan ikon peringatan merah dan nama item dinamis (`data-item-name`) |
| FR-3.3 | Modal konfirmasi berisi tombol "Batal" dan "Ya, Hapus" |

### 4.4 Komponen UI yang Tersedia
| Komponen | Keterangan |
|---|---|
| Buttons | Solid, Outline, Soft Glow, Icon-Only, Pill Buttons, Button Groups, Status Loading |
| Cards | Stat Cards dengan aksen warna bagian atas (`stat-card-accent-*`), Icon Box pastel, `card-hover` terangkat |
| DataTables | Tabel rapi dengan `table-vcenter`, sorting, pencarian, dan pagination |
| Forms | Input, Select, Textarea, Checkbox, Radio, Switches, Input Group |
| Badges | Solid Badges & Soft Glowing Badges dengan border transparan |
| Alerts | Alert Notifikasi dengan Icon dan tombol Tutup |
| Modals | Dialog Konfirmasi Hapus Dinamis & Form Popup |
| Nav Tabs & Accordion | Tab navigasi konten dan Accordion collapsing |
| Progress & Steps | Progress Bar berwarna & indikator langkah |
| Empty State | Tampilan saat data kosong dengan ilustrasi icon dan tombol aksi |

### 4.5 Dark Mode & Responsivitas
| ID | Requirement |
|---|---|
| FR-5.1 | Tombol toggle ikon matahari/bulan di navbar untuk beralih mode |
| FR-5.2 | Preferensi tersimpan di `localStorage`, tetap aktif saat halaman di-refresh |
| FR-5.3 | Teruji rapi di layar kecil (mobile 320px ke atas), tablet, dan desktop |

---

## 5. Cara Penggunaan Dalam Laravel

1. Buka `public/template/be/index.html` atau halaman di `public/template/be/pages/` di browser.
2. Pilih komponen UI yang dibutuhkan, copy kode HTML-nya.
3. Paste ke file Blade view Laravel (misal `resources/views/admin/courses/index.blade.php`).
4. Ubah data statis menjadi dinamis menggunakan sintaks Blade (`@foreach`, `{{ $item->name }}`).
5. Untuk fungsi hapus dinamis, tambahkan atribut `data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" data-item-name="{{ $item->name }}"` pada tombol hapus.

---

## 6. Milestone Pengerjaan

| Fase | Deliverable | Status |
|---|---|---|
| 1 | Setup struktur folder, CSS variable (light/dark), layout sidebar+navbar | Selesai |
| 2 | Bangun `index.html` dengan katalog komponen UI lengkap | Selesai |
| 3 | Implementasi DataTables & Modal Konfirmasi Hapus Dinamis | Selesai |
| 4 | Upgrade visual: Plus Jakarta Sans font, Glassmorphism navbar, Card hover accents, Button variants | Selesai |
| 5 | Buat contoh halaman jadi (`dashboard.html`, `table-example.html`, `form-example.html`, `profile.html`, `blank.html`) | Selesai |
| 6 | Dokumentasi PRD & Walkthrough | Selesai |

---

## 7. Success Criteria

- [x] Seluruh komponen di `index.html` bisa di-copy langsung tanpa dependency npm/build tools yang rumit
- [x] DataTables terintegrasi rapi dengan style Tabler dan penyesuaian Bahasa Indonesia
- [x] Modal Konfirmasi Hapus menampilkan nama item secara dinamis
- [x] Variasi tombol, icon button, tab, dan accordion tersedia lengkap
- [x] Dark/light mode berfungsi dan tersimpan preferensinya di `localStorage`
- [x] Tampilan modern, bersih, dan responsif di layar mobile (320px ke atas)