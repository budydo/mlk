<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * FeaturedProjectSeeder — Mengisi data 12 proyek unggulan untuk halaman beranda.
 */
class FeaturedProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Data 12 proyek unggulan yang akan ditampilkan di halaman beranda.
         * Gambar diambil dari folder public/images/projects.
         * Pastikan gambar tersedia dengan nama yang sesuai.
         */
        $projects = [
            [
                'title' => 'Penyusunan Dokumen UKL-UPL Resto Panbaker’s, Jl. Gunung Latimojong, Makassar, (Agustus, 2017)  ',
                'slug' => 'penyusunan-dokumen-ukl-upl-resto-panbakers',
                'excerpt' => 'Penyusunan dokumen Upaya Pengelolaan Lingkungan dan Upaya Pemantauan Lingkungan (UKL-UPL) untuk restoran Panbaker’s di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk restoran Panbaker’s yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional restoran. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1620571514293-f2178438e96d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDB8fGtvdGElMjBwZXNpc2lyfGVufDB8fDB8fHwy',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen Analisis Dampak Lalu Lintas (Andalalin) Pembangunan Kantor Cabang Bank BNI Mattoangin (Maret, 2020)  ',
                'slug' => 'penyusanan-dokumen-andalalin-kantor-bni-mattoangin',
                'excerpt' => 'Analisis dampak lalu lintas untuk pembangunan kantor cabang Bank BNI di Mattoangin, Makassar.',
                'description' => 'Penyusunan dokumen Andalalin untuk proyek pembangunan kantor cabang Bank BNI Mattoangin yang meliputi analisis kondisi lalu lintas eksisting, proyeksi dampak lalu lintas akibat pembangunan kantor, serta rekomendasi mitigasi untuk mengurangi potensi kemacetan dan gangguan lalu lintas di sekitar lokasi proyek.',
                'cover_image' => 'https://images.unsplash.com/photo-1565062778477-b95c18ae67d6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cGVtYmFuZ2tpdCUyMGxpc3RyaWslMjBhbmdpbnxlbnwwfHwwfHx8Mg%3D%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen Upaya Pengelolaan Lingkungan Hidup dan Upaya Pemantauan Lingkungan Hidup (UKL-UPL) Pembangunan Stasiun Pengisian Bahan Bakar Umum (SPBU) Codo di Jalan Perintis Kemerdekaan Km.11 (Juli, 2020)  ',
                'slug' => 'penyusanan-dokumen-ukl-upl-spbu-codo',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan SPBU Codo di Jalan Perintis Kemerdekaan Km.11, Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk proyek pembangunan Stasiun Pengisian Bahan Bakar Umum (SPBU) Codo yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional SPBU. Dokumen ini disusun',
                'cover_image' => 'https://images.unsplash.com/photo-1585252155261-cff31944d781?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDB8fHBhYnJpa3xlbnwwfHwwfHx8Mg%3D%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen Analisis Dampak Lalu Lintas (Andalalin) Pembangunan dan Operasional Costel Cendekia Makassar (Agustus, 2020).',
                'slug' => 'penyusanan-dokumen-andalalin-costel-cendekia-makassar',
                'excerpt' => 'Analisis dampak lalu lintas untuk pembangunan dan operasional Costel Cendekia di Makassar.',
                'description' => 'Penyusunan dokumen Andalalin untuk proyek pembangunan dan operasional Costel Cendekia Makassar yang meliputi analisis kondisi lalu lintas eksisting, proyeksi dampak lalu lintas akibat pembangunan dan operasional costel, serta rekomendasi mitigasi untuk mengurangi potensi kemacetan dan gangguan lalu lintas di sekitar lokasi proyek.',
                'cover_image' => 'https://images.unsplash.com/photo-1748336698565-0bd8fe3e4064?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGphbGFuJTIwdG9sJTIwaW5kb25lc2lhfGVufDB8fDB8fHwy',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen upaya pengelolaan lingkungan hidup dan upaya pemantaun lingkungan hidup (UKL-UPL) dari usaha usaha dan/atau kegiatan Sekolah Dasar Islam Athirah Yayasan An-Nur Kalla (September 2020).',
                'slug' => 'penyusanan-dokumen-ukl-upl-sekolah-dasar-islam-athirah',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk Sekolah Dasar Islam Athirah Yayasan An-Nur Kalla di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Sekolah Dasar Islam Athirah yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional sekolah. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1531270165448-73e7ee678f2a?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8a290YSUyMGhpamF1fGVufDB8fDB8fHwy',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen Analisis Dampak Lalu Lintas (Andalalin) pembangunan Sekolah Dasar Islam Athirah Yayasan An-Nur Kalla (Oktober, 2020)',
                'slug' => 'penyusanan-dokumen-andalalin-sekolah-dasar-islam-athirah',
                'excerpt' => 'Analisis dampak lalu lintas untuk pembangunan Sekolah Dasar Islam Athirah Yayasan An-Nur Kalla di Makassar.',
                'description' => 'Penyusunan dokumen Andalalin untuk proyek pembangunan Sekolah Dasar Islam Athirah yang meliputi analisis kondisi lalu lintas eksisting, proyeksi dampak lalu lintas akibat pembangunan sekolah, serta rekomendasi mitigasi untuk mengurangi potensi kemacetan dan gangguan lalu lintas di sekitar lokasi proyek.',
                'cover_image' => 'https://images.unsplash.com/photo-1669003749709-45394329596b?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjF8fGthd2FzYW4lMjBpbmR1c3RyaXxlbnwwfHwwfHx8Mg%3D%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen Analisis Dampak Lalu Lintas (Andalalin) Pembangunan Gedung Kampus Universitas Islam Makassar (UIM) Yayasan Perguruan Tinggi Al-gazali Makassar (Desember, 2020)  ',
                'slug' => 'penyusanan-dokumen-andalalin-kampus-uim',
                'excerpt' => 'Analisis dampak lalu lintas untuk pembangunan gedung kampus Universitas Islam Makassar (UIM).',
                'description' => 'Penyusunan dokumen Andalalin untuk proyek pembangunan gedung kampus Universitas Islam Makassar (UIM) yang meliputi analisis kondisi lalu lintas eksisting, proyeksi dampak lalu lintas akibat pembangunan kampus, serta rekomendasi mitigasi untuk mengurangi potensi kemacetan dan gangguan lalu lintas di sekitar lokasi proyek.',
                'cover_image' => 'https://images.unsplash.com/photo-1594317487324-49e8fecce458?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTZ8fGdlb3RoZXJtYWx8ZW58MHx8MHx8fDI%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL BNI Mattoangin (Januari, 2021) ',
                'slug' => 'penyusanan-dokumen-ukl-upl-bni-mattoangin',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan kantor cabang Bank BNI di Mattoangin, Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk proyek pembangunan kantor cabang Bank BNI Mattoangin yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional kantor. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGdhbWJ1dHxlbnwwfHwwfHx8Mg%3D%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Klinik Inggit Medical (Januari, 2021)  ',
                'slug' => 'penyusanan-dokumen-ukl-upl-klinik-inggit-medical',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Klinik Inggit Medical di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Klinik Inggit Medical yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional klinik. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia. ',
                'cover_image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGFpcmwlMjBsaW1iYWh8ZW58MHx8MHx8fDI%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan DPLH Tower PT. Hutchison 3 Indonesia (Februari. 2021) ',
                'slug' => 'penyusanan-dplh-tower-hutchison-3-indonesia',
                'excerpt' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk menara telekomunikasi PT. Hutchison 3 Indonesia.',
                'description' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk menara telekomunikasi PT. Hutchison 3 Indonesia yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional menara. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHBlcmVtdWFuJTIwcGVtYmVyZGF5YW58ZW58MHx8MHx8fDI%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan DPLH Readimix dan Beton Perkasa (Maret, 2021) ',
                'slug' => 'penyusanan-dplh-readimix-dan-beton-perkasa',
                'excerpt' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk operasional Readimix dan Beton Perkasa di Makassar.',
                'description' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk Readimix dan Beton Perkasa yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fGZvcmVzdCUyMGp1YW4lMjB0cm9waXN8ZW58MHx8MHx8fDI%3D',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan DPLH Gudang Iskandar (Maret, 2021)  ',
                'slug' => 'penyusanan-dplh-gudang-iskandar',
                'excerpt' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk operasional Gudang Iskandar di Makassar.',
                'description' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk Gudang Iskandar yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional gudang. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mzh8fHBlcmthYmV1bmFuJTIwbGluaW5nfGVufDB8fDB8fHwy',
                'is_published' => true,
                'is_featured' => true,
            ],

            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Kantor Sahbandar (April, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-kantor-sahbandar',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Kantor Sahbandar di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Kantor Sahbandar yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional kantor. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Industri Tandon Air PT. Samudra (April, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-industri-tandon-air-samudra',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk Industri Tandon Air PT. Samudra di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Industri Tandon Air PT. Samudra yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional industri. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Citra Kosmetik (Juni, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-citra-kosmetik',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Citra Kosmetik di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Citra Kosmetik yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Hotel Surya Inn (Juli, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-hotel-surya-inn',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Hotel Surya Inn di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Hotel Surya Inn yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional hotel. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564501049351-8e9ece3df5a9?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Meratus Line (Juli, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-meratus-line',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Meratus Line di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Meratus Line yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL PT. Kamadjaja Logistik (Agustus, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-pt-kamadjaja-logistik',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional PT. Kamadjaja Logistik di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk PT. Kamadjaja Logistik yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional logistik. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1567637642117-f43146ca3be0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan DPLH Kampus STIFA (September, 2021)',
                'slug' => 'penyusanan-dplh-kampus-stifa',
                'excerpt' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk Kampus STIFA di Makassar.',
                'description' => 'Penyusunan Dokumen Pengelolaan Lingkungan Hidup (DPLH) untuk Kampus STIFA yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional kampus. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1427504494785-cdaf8fda9b84?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL PT. Indo ICE (September, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-pt-indo-ice',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional PT. Indo ICE di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk PT. Indo ICE yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Klinik Etrita (Oktober, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-klinik-etrita',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Klinik Etrita di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Klinik Etrita yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional klinik. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Klinik Alisa (Oktober, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-klinik-alisa',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Klinik Alisa di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Klinik Alisa yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional klinik. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL RS. JEC Orbita (Oktober, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-rs-jec-orbita',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional RS. JEC Orbita di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk RS. JEC Orbita yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional rumah sakit. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Perumahan Al Fatih (November, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-perumahan-al-fatih',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Al Fatih di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Al Fatih yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perumahan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Perumahan Bosowa (Desember, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-perumahan-bosowa',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Bosowa di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Bosowa yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perumahan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Kebun Induk Sidrap (Desember, 2021)',
                'slug' => 'penyusanan-dokumen-ukl-upl-kebun-induk-sidrap',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Kebun Induk Sidrap.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Kebun Induk Sidrap yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional kebun. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1574943320219-553eb2f72539?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL PT. Mustika DBL Properti (Januari, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-pt-mustika-dbl-properti',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional PT. Mustika DBL Properti di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk PT. Mustika DBL Properti yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional properti. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Perumahan Panakkukang Green Villa (Januari, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-perumahan-panakkukang-green-villa',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Panakkukang Green Villa di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Panakkukang Green Villa yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perumahan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Toko Satu Sama (Februari, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-toko-satu-sama',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Toko Satu Sama di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Toko Satu Sama yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional toko. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1487700492490-a480967fbc67?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Sekolah Pusat Terapi Anak (Februari, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-sekolah-pusat-terapi-anak',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Sekolah Pusat Terapi Anak di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Sekolah Pusat Terapi Anak yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional sekolah. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1427504494785-cdaf8fda9b84?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Perumahan Mahkota Panakkukang Residence (Mei, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-perumahan-mahkota-panakkukang-residence',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Mahkota Panakkukang Residence di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Mahkota Panakkukang Residence yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perumahan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan RM. Madaeng (Mei, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-rm-madaeng',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan RM. Madaeng di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan RM. Madaeng yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional restoran. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1504674900967-1b0b9dd997d1?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pertasolar Barru (Juni, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-pertasolar-barru',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Pertasolar Barru.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Pertasolar Barru yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1509391366360-2e938aa555ff?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Perumahan Anging Mammiri (Juni, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-perumahan-anging-mammiri',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Anging Mammiri di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Perumahan Anging Mammiri yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perumahan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Pembangunan Gedung Satu Atap Bulukumba (Juni, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-gedung-satu-atap-bulukumba',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Gedung Satu Atap Bulukumba.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk pembangunan Gedung Satu Atap Bulukumba yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional gedung. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Gelael Indotim (Juli, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-gelael-indotim',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Gelael Indotim di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Gelael Indotim yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional toko. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1487700492490-a480967fbc67?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL RS. Akademis Jauri (Juli, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-rs-akademis-jauri',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional RS. Akademis Jauri di Makassar.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk RS. Akademis Jauri yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional rumah sakit. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde0f?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Rumah Pemotongan Ayam UD. Harco (Agustus, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-rpa-ud-harco',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Rumah Pemotongan Ayam UD. Harco.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Rumah Pemotongan Ayam UD. Harco yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional perusahaan. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1488409283903-8c1b73b99eaa?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Penyusanan Dokumen UKL-UPL Tambak Udang (Agustus, 2022)',
                'slug' => 'penyusanan-dokumen-ukl-upl-tambak-udang',
                'excerpt' => 'Penyusunan dokumen UKL-UPL untuk operasional Tambak Udang.',
                'description' => 'Penyusunan dokumen UKL-UPL untuk Tambak Udang yang mencakup identifikasi potensi dampak lingkungan, rencana pengelolaan lingkungan, dan sistem pemantauan lingkungan selama operasional tambak. Dokumen ini disusun sesuai dengan peraturan lingkungan hidup yang berlaku di Indonesia.',
                'cover_image' => 'https://images.unsplash.com/photo-1574943320219-553eb2f72539?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0',
                'is_published' => true,
                'is_featured' => true,
            ],
        ];


        $projects = array_merge($projects);
        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }

        $this->command->info('FeaturedProject seeder berhasil dijalankan: ' . count($projects) . ' proyek unggulan telah ditambahkan.');
    }
}
