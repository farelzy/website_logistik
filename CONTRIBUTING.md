# Panduan Kontribusi SwiftLogix

Terima kasih telah ingin berkontribusi pada proyek SwiftLogix!

## Alur Kerja

1. **Fork** repository ini
2. Buat branch fitur: `git checkout -b feature/nama-fitur`
3. Commit perubahan: `git commit -m 'feat: tambah fitur baru'`
4. Push ke branch: `git push origin feature/nama-fitur`
5. Buat **Pull Request**

## Standar Kode

- Ikuti PSR-12 untuk PHP
- Tulis docblock untuk method baru
- Tambahkan unit test untuk fitur baru
- Jalankan `php artisan test` sebelum PR

## Konvensi Commit

```
feat: tambah fitur baru
fix: perbaiki bug X
docs: update dokumentasi
refactor: refaktor kode Y
test: tambah test untuk Z
```

## Melaporkan Bug

Gunakan GitHub Issues dengan template:
- **Deskripsi**: Apa yang terjadi?
- **Langkah reproduksi**: Bagaimana mereproduksi?
- **Expected behavior**: Apa yang seharusnya terjadi?
- **Environment**: OS, PHP version, Laravel version
