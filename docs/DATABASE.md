# 📊 Dokumentasi Database SwiftLogix

## Gambaran Umum

SwiftLogix menggunakan **MySQL 8** dengan 9 tabel utama + tabel default Laravel.

## Diagram Relasi

```
users
  └── blog_posts (user_id)

shipments
  └── shipment_histories (shipment_id)

services          (standalone)
testimonials      (standalone)
contacts          (standalone)
team_members      (standalone)
settings          (key-value store)
```

---

## Tabel: `services`

Menyimpan data layanan perusahaan yang ditampilkan di halaman publik.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| title | VARCHAR(200) | Nama layanan |
| slug | VARCHAR(200) UNIQUE | URL-friendly identifier |
| description | TEXT | Deskripsi lengkap |
| short_description | VARCHAR(255) | Deskripsi singkat untuk card |
| icon | VARCHAR(100) | Font Awesome class (e.g. `fas fa-truck`) |
| image | VARCHAR(255) | Path gambar di storage |
| is_active | BOOLEAN | Tampil di website atau tidak |
| order | INT | Urutan tampil (ascending) |
| created_at | TIMESTAMP | Auto-managed |
| updated_at | TIMESTAMP | Auto-managed |

---

## Tabel: `shipments`

Data pengiriman/paket utama.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| tracking_number | VARCHAR UNIQUE | Nomor resi (format: SWL + 9 char) |
| sender_name | VARCHAR(150) | Nama pengirim |
| sender_address | TEXT | Alamat pengirim |
| sender_phone | VARCHAR(20) | Nomor telepon pengirim |
| receiver_name | VARCHAR(150) | Nama penerima |
| receiver_address | TEXT | Alamat penerima |
| receiver_phone | VARCHAR(20) | Nomor telepon penerima |
| description | VARCHAR(255) | Deskripsi isi paket |
| weight | DECIMAL(8,2) | Berat dalam kg |
| origin_city | VARCHAR(100) | Kota asal |
| destination_city | VARCHAR(100) | Kota tujuan |
| status | ENUM | Lihat status values di bawah |
| estimated_delivery | DATE | Estimasi tanggal tiba |
| actual_delivery | TIMESTAMP | Tanggal aktual tiba |
| notes | TEXT | Catatan tambahan |
| shipping_cost | DECIMAL(12,2) | Ongkos kirim dalam Rupiah |

### Status Values

| Value | Label | Deskripsi |
|-------|-------|-----------|
| `pending` | Menunggu Pickup | Paket diterima, menunggu diambil |
| `picked_up` | Sudah Diambil | Paket diambil oleh kurir |
| `in_transit` | Dalam Pengiriman | Paket dalam perjalanan |
| `out_for_delivery` | Dalam Kota Tujuan | Paket tiba di kota tujuan |
| `delivered` | Terkirim | Paket berhasil diterima |
| `failed` | Gagal Kirim | Pengiriman gagal |
| `returned` | Dikembalikan | Paket dikembalikan ke pengirim |

---

## Tabel: `shipment_histories`

Riwayat perjalanan/status setiap paket.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| shipment_id | BIGINT UNSIGNED FK | Referensi ke shipments |
| status | VARCHAR(50) | Status pada saat update |
| location | VARCHAR(150) | Lokasi saat ini |
| description | TEXT | Keterangan update |

---

## Tabel: `blog_posts`

Artikel dan berita perusahaan.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| title | VARCHAR(255) | Judul artikel |
| slug | VARCHAR(255) UNIQUE | URL-friendly identifier |
| excerpt | TEXT | Ringkasan artikel |
| content | LONGTEXT | Isi artikel (mendukung HTML) |
| image | VARCHAR(255) | Thumbnail gambar |
| category | VARCHAR(100) | Kategori artikel |
| user_id | BIGINT FK nullable | Penulis (relasi ke users) |
| is_published | BOOLEAN | Status terbit |
| published_at | TIMESTAMP | Tanggal terbit |
| views | INT | Jumlah tampilan |

---

## Tabel: `testimonials`

Ulasan dari pelanggan.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| name | VARCHAR(100) | Nama pelanggan |
| company | VARCHAR(150) | Nama perusahaan |
| position | VARCHAR(100) | Jabatan |
| content | TEXT | Isi testimoni |
| rating | TINYINT | Rating 1-5 |
| photo | VARCHAR(255) | Foto pelanggan |
| is_active | BOOLEAN | Tampil di website |

---

## Tabel: `contacts`

Pesan dari form kontak website.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| name | VARCHAR(100) | Nama pengirim |
| email | VARCHAR(100) | Email pengirim |
| phone | VARCHAR(20) | Telepon (opsional) |
| subject | VARCHAR(200) | Subjek pesan |
| message | TEXT | Isi pesan |
| is_read | BOOLEAN | Status baca admin |
| reply | TEXT | Balasan admin |
| replied_at | TIMESTAMP | Waktu dibalas |

---

## Tabel: `team_members`

Profil anggota tim perusahaan.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| name | VARCHAR(100) | Nama lengkap |
| position | VARCHAR(100) | Jabatan |
| bio | TEXT | Biografi singkat |
| photo | VARCHAR(255) | Foto profil |
| linkedin | VARCHAR(255) | URL LinkedIn |
| twitter | VARCHAR(255) | URL Twitter |
| order | INT | Urutan tampil |
| is_active | BOOLEAN | Tampil di website |

---

## Tabel: `settings`

Key-value store untuk pengaturan situs dinamis.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT UNSIGNED | Primary key |
| key | VARCHAR UNIQUE | Identifier setting |
| value | TEXT | Nilai setting |
| type | VARCHAR(50) | Tipe: text, textarea, image |
| label | VARCHAR(255) | Label untuk admin UI |
| group | VARCHAR(50) | Grup: general, contact, social |

### Setting Keys yang Tersedia

| Key | Keterangan | Grup |
|-----|------------|------|
| `company_name` | Nama perusahaan | general |
| `company_tagline` | Tagline perusahaan | general |
| `company_about` | Deskripsi perusahaan | general |
| `company_email` | Email perusahaan | contact |
| `company_phone` | Telepon perusahaan | contact |
| `company_whatsapp` | Nomor WhatsApp | contact |
| `company_address` | Alamat kantor | contact |
| `facebook` | URL Facebook | social |
| `instagram` | URL Instagram | social |
| `twitter` | URL Twitter | social |
| `linkedin` | URL LinkedIn | social |
