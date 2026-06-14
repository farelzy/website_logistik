<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Shipment;
use App\Models\ShipmentHistory;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@swiftlogix.id'],
            [
                'name'     => 'Admin SwiftLogix',
                'password' => Hash::make('admin123'),
            ]
        );

        // Settings
        $settings = [
            ['key' => 'company_name',    'value' => 'SwiftLogix',            'label' => 'Nama Perusahaan', 'group' => 'general'],
            ['key' => 'company_tagline', 'value' => 'Delivering Trust, Every Mile', 'label' => 'Tagline', 'group' => 'general'],
            ['key' => 'company_email',   'value' => 'info@swiftlogix.id',    'label' => 'Email',          'group' => 'contact'],
            ['key' => 'company_phone',   'value' => '+62 21 1234 5678',      'label' => 'Telepon',        'group' => 'contact'],
            ['key' => 'company_whatsapp','value' => '+6281234567890',        'label' => 'WhatsApp',       'group' => 'contact'],
            ['key' => 'company_address', 'value' => 'Jl. Sudirman No. 123, Jakarta Pusat 10220', 'label' => 'Alamat', 'group' => 'contact'],
            ['key' => 'company_about',   'value' => 'SwiftLogix adalah perusahaan logistik terkemuka di Indonesia yang berdiri sejak 2010. Kami berkomitmen memberikan layanan pengiriman yang cepat, aman, dan terpercaya ke seluruh penjuru nusantara.', 'label' => 'Tentang Perusahaan', 'group' => 'general'],
            ['key' => 'facebook',        'value' => 'https://facebook.com/swiftlogix', 'label' => 'Facebook', 'group' => 'social'],
            ['key' => 'instagram',       'value' => 'https://instagram.com/swiftlogix', 'label' => 'Instagram', 'group' => 'social'],
            ['key' => 'twitter',         'value' => 'https://twitter.com/swiftlogix', 'label' => 'Twitter', 'group' => 'social'],
            ['key' => 'linkedin',        'value' => 'https://linkedin.com/company/swiftlogix', 'label' => 'LinkedIn', 'group' => 'social'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // Services
        $services = [
            ['title' => 'Pengiriman Ekspres', 'icon' => 'fas fa-bolt', 'short_description' => 'Kirim dalam 24 jam ke seluruh Indonesia', 'description' => 'Layanan pengiriman ekspres kami menjamin paket tiba dalam 24-48 jam ke seluruh kota besar di Indonesia. Dilengkapi dengan sistem tracking real-time dan asuransi pengiriman.', 'order' => 1],
            ['title' => 'Kargo Darat',        'icon' => 'fas fa-truck', 'short_description' => 'Angkutan besar kapasitas tinggi via darat', 'description' => 'Solusi pengiriman kargo skala besar menggunakan armada truk modern kami. Cocok untuk pengiriman industri, pindahan kantor, dan distribusi produk massal.', 'order' => 2],
            ['title' => 'Kargo Laut',         'icon' => 'fas fa-ship', 'short_description' => 'Pengiriman antarpulau via jalur laut', 'description' => 'Layanan kargo laut kami menghubungkan seluruh kepulauan Indonesia. Tarif kompetitif untuk pengiriman barang berat dan kontainer.', 'order' => 3],
            ['title' => 'Kargo Udara',        'icon' => 'fas fa-plane', 'short_description' => 'Pengiriman kilat via jalur udara', 'description' => 'Layanan kargo udara untuk pengiriman prioritas yang membutuhkan kecepatan maksimal. Jangkauan ke seluruh bandara di Indonesia.', 'order' => 4],
            ['title' => 'Gudang & Fulfillment','icon' => 'fas fa-warehouse', 'short_description' => 'Solusi pergudangan modern dan fulfillment', 'description' => 'Layanan pergudangan terintegrasi dengan sistem inventory management. Cocok untuk e-commerce, FMCG, dan bisnis retail yang membutuhkan fulfillment center.', 'order' => 5],
            ['title' => 'Logistik Dingin',    'icon' => 'fas fa-snowflake', 'short_description' => 'Pengiriman produk berpendingin', 'description' => 'Layanan cold chain logistics untuk pengiriman produk farmasi, makanan beku, dan produk sensitif suhu. Armada berpendingin modern dengan monitoring suhu 24/7.', 'order' => 6],
        ];
        foreach ($services as $s) {
            $s['slug'] = Str::slug($s['title']);
            $s['is_active'] = true;
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // Shipments
        $statuses = ['pending', 'picked_up', 'in_transit', 'out_for_delivery', 'delivered'];
        $cities = ['Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Makassar', 'Bali', 'Semarang', 'Yogyakarta'];
        $shipmentsData = [
            ['sender_name' => 'Budi Santoso', 'sender_address' => 'Jl. Thamrin No. 5, Jakarta', 'receiver_name' => 'Ani Wijaya', 'receiver_address' => 'Jl. Pemuda No. 12, Surabaya', 'description' => 'Elektronik - Laptop', 'weight' => 2.5, 'origin_city' => 'Jakarta', 'destination_city' => 'Surabaya', 'status' => 'delivered', 'shipping_cost' => 85000],
            ['sender_name' => 'PT Maju Jaya', 'sender_address' => 'Jl. Gatot Subroto No. 88, Jakarta', 'receiver_name' => 'CV Berkah', 'receiver_address' => 'Jl. Diponegoro No. 45, Bandung', 'description' => 'Dokumen Kontrak', 'weight' => 0.5, 'origin_city' => 'Jakarta', 'destination_city' => 'Bandung', 'status' => 'in_transit', 'shipping_cost' => 35000],
            ['sender_name' => 'Siti Rahayu', 'sender_address' => 'Jl. Veteran No. 7, Medan', 'receiver_name' => 'Ahmad Fauzi', 'receiver_address' => 'Jl. Cendrawasih No. 3, Makassar', 'description' => 'Pakaian & Tekstil', 'weight' => 5.0, 'origin_city' => 'Medan', 'destination_city' => 'Makassar', 'status' => 'picked_up', 'shipping_cost' => 120000],
            ['sender_name' => 'Toko Online ABC', 'sender_address' => 'Jl. Malioboro No. 1, Yogyakarta', 'receiver_name' => 'Dewi Susanti', 'receiver_address' => 'Jl. Kuta No. 22, Bali', 'description' => 'Kerajinan Tangan', 'weight' => 3.0, 'origin_city' => 'Yogyakarta', 'destination_city' => 'Bali', 'status' => 'out_for_delivery', 'shipping_cost' => 65000],
            ['sender_name' => 'Rizky Pratama', 'sender_address' => 'Jl. Raya Darmo No. 14, Surabaya', 'receiver_name' => 'Linda Halim', 'receiver_address' => 'Jl. Pemuda No. 99, Semarang', 'description' => 'Peralatan Rumah Tangga', 'weight' => 8.0, 'origin_city' => 'Surabaya', 'destination_city' => 'Semarang', 'status' => 'pending', 'shipping_cost' => 95000],
        ];
        foreach ($shipmentsData as $index => $s) {
            $s['tracking_number'] = 'SWL' . strtoupper(substr(md5($index . 'seed'), 0, 7));
            $s['sender_phone'] = '0812' . rand(10000000, 99999999);
            $s['receiver_phone'] = '0813' . rand(10000000, 99999999);
            $s['estimated_delivery'] = now()->addDays(rand(1, 5))->toDateString();
            $shipment = Shipment::updateOrCreate(['tracking_number' => $s['tracking_number']], $s);

            // Add history
            ShipmentHistory::updateOrCreate(
                ['shipment_id' => $shipment->id, 'status' => 'pending'],
                ['location' => $s['origin_city'], 'description' => 'Paket diterima di gudang origin']
            );
            if (in_array($s['status'], ['picked_up', 'in_transit', 'out_for_delivery', 'delivered'])) {
                ShipmentHistory::updateOrCreate(
                    ['shipment_id' => $shipment->id, 'status' => 'picked_up'],
                    ['location' => $s['origin_city'], 'description' => 'Paket telah diambil oleh kurir']
                );
            }
            if (in_array($s['status'], ['in_transit', 'out_for_delivery', 'delivered'])) {
                ShipmentHistory::updateOrCreate(
                    ['shipment_id' => $shipment->id, 'status' => 'in_transit'],
                    ['location' => 'Hub Nasional Jakarta', 'description' => 'Paket sedang dalam perjalanan ke kota tujuan']
                );
            }
            if (in_array($s['status'], ['out_for_delivery', 'delivered'])) {
                ShipmentHistory::updateOrCreate(
                    ['shipment_id' => $shipment->id, 'status' => 'out_for_delivery'],
                    ['location' => $s['destination_city'], 'description' => 'Paket tiba di kota tujuan, siap diantarkan']
                );
            }
            if ($s['status'] === 'delivered') {
                ShipmentHistory::updateOrCreate(
                    ['shipment_id' => $shipment->id, 'status' => 'delivered'],
                    ['location' => $s['destination_city'], 'description' => 'Paket berhasil diterima oleh penerima']
                );
            }
        }

        // Blog Posts
        $posts = [
            ['title' => 'Tips Mengemas Barang Agar Aman Saat Pengiriman', 'category' => 'Tips & Trik', 'excerpt' => 'Cara mengemas paket dengan benar agar tidak rusak selama pengiriman jarak jauh.', 'content' => '<p>Mengemas barang dengan benar adalah kunci keberhasilan pengiriman. Berikut tips dari tim ahli SwiftLogix:</p><h3>1. Pilih Kardus yang Tepat</h3><p>Gunakan kardus tebal dengan kekuatan minimal 32 ECT. Pastikan ukuran kardus sesuai dengan barang yang dikemas.</p><h3>2. Gunakan Pelindung Ekstra</h3><p>Bungkus barang dengan bubble wrap setidaknya 3 lapis. Isi ruang kosong dengan styrofoam atau kertas koran.</p><h3>3. Labeling yang Jelas</h3><p>Tulis alamat pengirim dan penerima dengan jelas menggunakan spidol permanen. Tambahkan label "FRAGILE" jika barang mudah pecah.</p><p>Dengan mengikuti tips ini, barang Anda akan sampai dalam kondisi sempurna!</p>'],
            ['title' => 'SwiftLogix Ekspansi Layanan ke 50 Kota Baru', 'category' => 'Berita', 'excerpt' => 'SwiftLogix resmi memperluas jangkauan layanan ke 50 kota baru di seluruh Indonesia.', 'content' => '<p>Jakarta, 1 Juni 2025 — SwiftLogix dengan bangga mengumumkan ekspansi besar-besaran layanan pengiriman ke 50 kota baru di seluruh Indonesia. Ekspansi ini merupakan bagian dari komitmen kami untuk menghubungkan seluruh nusantara.</p><p>Dengan penambahan ini, SwiftLogix kini melayani lebih dari 200 kota dan kabupaten di 34 provinsi. "Ini adalah tonggak sejarah bagi kami," ujar CEO SwiftLogix, Bapak Hendra Kusuma. "Kami percaya bahwa akses logistik yang merata akan mendorong pertumbuhan ekonomi di seluruh Indonesia."</p><p>Kota-kota baru yang masuk dalam jaringan SwiftLogix antara lain: Sorong, Ternate, Manokwari, Bau-Bau, dan Kolaka di wilayah timur Indonesia.</p>'],
            ['title' => 'Mengenal Cold Chain Logistics: Solusi Pengiriman Barang Sensitif', 'category' => 'Edukasi', 'excerpt' => 'Apa itu cold chain logistics dan mengapa penting bagi industri farmasi dan makanan.', 'content' => '<p>Cold chain logistics adalah sistem pengiriman yang mempertahankan suhu tertentu selama seluruh proses distribusi. Ini sangat penting untuk produk-produk yang sensitif terhadap perubahan suhu.</p><h3>Produk yang Membutuhkan Cold Chain</h3><ul><li>Obat-obatan dan vaksin</li><li>Makanan beku dan segar</li><li>Produk kosmetik tertentu</li><li>Sampel laboratorium</li></ul><h3>Sistem Cold Chain SwiftLogix</h3><p>Armada cold chain SwiftLogix dilengkapi dengan teknologi monitoring suhu real-time, memastikan produk Anda tetap dalam kondisi optimal dari gudang hingga tujuan akhir.</p>'],
        ];
        foreach ($posts as $index => $p) {
            $p['slug'] = Str::slug($p['title']);
            $p['is_published'] = true;
            $p['published_at'] = now()->subDays($index * 5);
            $p['user_id'] = 1;
            $p['views'] = rand(50, 500);
            BlogPost::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Rudi Hartono', 'company' => 'PT Elektronik Nusantara', 'position' => 'Direktur Operasional', 'content' => 'SwiftLogix adalah mitra logistik terbaik yang pernah kami gunakan. Pengiriman selalu tepat waktu dan kondisi barang selalu terjaga. Sangat direkomendasikan untuk perusahaan yang membutuhkan layanan logistik profesional.', 'rating' => 5],
            ['name' => 'Maria Tandiono', 'company' => 'Toko Online Fashion.id', 'position' => 'Owner', 'content' => 'Sejak menggunakan SwiftLogix, customer complain soal keterlambatan pengiriman turun drastis. Sistem tracking real-time mereka sangat membantu kami memberikan update kepada pelanggan.', 'rating' => 5],
            ['name' => 'Drs. Bambang Wicaksono', 'company' => 'Rumah Sakit Medika Utama', 'position' => 'Manajer Pengadaan', 'content' => 'Layanan cold chain logistics SwiftLogix sangat andal. Pengiriman obat-obatan dan vaksin kami selalu tiba dalam suhu yang sesuai standar. Tim mereka juga responsif dan profesional.', 'rating' => 5],
            ['name' => 'Siska Amelia', 'company' => 'UMKM Kue Tradisional', 'position' => 'Pemilik Usaha', 'content' => 'Harganya bersaing dan pelayanannya memuaskan. Paket saya selalu aman dan tidak ada yang rusak. Terima kasih SwiftLogix sudah membantu bisnis kecil saya berkembang!', 'rating' => 4],
            ['name' => 'Ir. Hendra Wijaya', 'company' => 'Konstruksi Mega Jaya', 'position' => 'Project Manager', 'content' => 'Untuk pengiriman material konstruksi skala besar, SwiftLogix sangat bisa diandalkan. Armada mereka lengkap dan tim operasionalnya sangat terkoordinasi dengan baik.', 'rating' => 5],
        ];
        foreach ($testimonials as $t) {
            $t['is_active'] = true;
            Testimonial::create($t);
        }

        // Team Members
        $team = [
            ['name' => 'Hendra Kusuma', 'position' => 'Chief Executive Officer', 'bio' => 'Berpengalaman 20 tahun di industri logistik. Lulusan MBA Harvard Business School. Memimpin SwiftLogix sejak 2010 dan berhasil membawa perusahaan tumbuh 300% dalam 5 tahun terakhir.', 'order' => 1],
            ['name' => 'Dra. Susanti Halim', 'position' => 'Chief Operations Officer', 'bio' => 'Ahli manajemen operasional dengan track record pengelolaan armada 500+ kendaraan. Lulusan Teknik Industri ITB dengan pengalaman 15 tahun di supply chain management.', 'order' => 2],
            ['name' => 'Rizky Ananda', 'position' => 'Chief Technology Officer', 'bio' => 'Software engineer dan tech innovator yang membangun platform tracking real-time SwiftLogix. Sebelumnya bekerja di Gojek dan Tokopedia sebagai senior engineer.', 'order' => 3],
            ['name' => 'Ir. Putri Maharani', 'position' => 'Head of Fleet Management', 'bio' => 'Manajer armada berpengalaman yang mengelola 200+ kendaraan pengiriman di seluruh Indonesia. Spesialis dalam optimisasi rute dan efisiensi bahan bakar.', 'order' => 4],
        ];
        foreach ($team as $t) {
            $t['is_active'] = true;
            TeamMember::create($t);
        }
    }
}
