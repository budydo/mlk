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
                'title' => 'Restorasi Hutan Pesisir — Kabupaten Bangkalan',
                'slug' => 'restorasi-hutan-pesisir-bangkalan',
                'excerpt' => 'Revegetasi dan pemberdayaan komunitas nelayan dalam restorasi ekosistem mangrove.',
                'description' => 'Program restorasi hutan pesisir seluas 50 hektar dengan fokus pada rehabilitasi ekosistem mangrove dan pemberdayaan ekonomi komunitas nelayan lokal. Melibatkan pelatihan keterampilan, market linkage, dan pemantauan jangka panjang.',
                'cover_image' => '/images/projects/project-01-hutan-pesisir.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'AMDAL Pembangkit Listrik Tenaga Angin — Sulawesi Selatan',
                'slug' => 'amdal-plta-sulawesi-selatan',
                'excerpt' => 'Studi dampak lingkungan komprehensif untuk proyek infrastruktur energi terbarukan.',
                'description' => 'Kajian dampak lingkungan menyeluruh untuk pembangunan Pembangkit Listrik Tenaga Angin (PLTA) dengan kapasitas 100 MW. Mencakup baseline lingkungan, analisis dampak sosial ekonomi, dan rekomendasi mitigasi yang dapat dipertanggungjawabkan.',
                'cover_image' => '/images/projects/project-02-amdal-plta.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'UKL-UPL Pabrik Pengolahan Kopi — Jawa Timur',
                'slug' => 'ukl-upl-pabrik-kopi-jawa-timur',
                'excerpt' => 'Rencana pengelolaan lingkungan dan sistem pemantauan untuk operasional pabrik berkelanjutan.',
                'description' => 'Penyusunan dokumen Upaya Pengelolaan dan Pemantauan Lingkungan (UKL-UPL) untuk pabrik pengolahan kopi dengan kapasitas 500 ton/tahun. Mencakup SOP operasional, sistem pemantauan parameter kualitas, dan pelatihan tim lapangan.',
                'cover_image' => '/images/projects/project-03-ukl-upl-kopi.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'ANDALALIN Jalan Tol Lingkar — Jakarta',
                'slug' => 'andalalin-jalan-tol-jakarta',
                'excerpt' => 'Analisis dampak lalu lintas dan rekomendasi mitigasi untuk proyek transportasi strategis.',
                'description' => 'Studi ANDALALIN untuk pembangunan jalan tol lingkar sepanjang 45 km di wilayah Jakarta dan sekitarnya. Mencakup analisis geometri jalan, proyeksi volume lalu lintas, dan rekomendasi manajemen transportasi untuk meminimalkan kemacetan.',
                'cover_image' => '/images/projects/project-04-andalalin-tol.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Program Penghijauan Urban — Kota Surabaya',
                'slug' => 'program-penghijauan-urban-surabaya',
                'excerpt' => 'Inisiatif penghijauan perkotaan dengan melibatkan komunitas lokal untuk meningkatkan kualitas udara.',
                'description' => 'Program penghijauan seluas 20 hektar di area perkotaan dengan penanaman 10,000 pohon produktif dan estetika. Melibatkan pelatihan pengelolaan tanaman, edukasi lingkungan, dan pemantauan pertumbuhan pohon selama 3 tahun.',
                'cover_image' => '/images/projects/project-05-penghijauan-urban.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Audit Lingkungan Industri Tekstil — Bandung',
                'slug' => 'audit-lingkungan-tekstil-bandung',
                'excerpt' => 'Evaluasi kepatuhan lingkungan dan rekomendasi peningkatan sistem pengelolaan lingkungan.',
                'description' => 'Audit lingkungan komprehensif pada industri tekstil dengan 5 unit pabrik untuk mengevaluasi kepatuhan terhadap regulasi lingkungan. Mengidentifikasi risiko, memberikan rekomendasi perbaikan, dan mendukung sertifikasi ISO 14001.',
                'cover_image' => '/images/projects/project-06-audit-tekstil.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Kajian Potensi Geothermal — Sumatera Utara',
                'slug' => 'kajian-geothermal-sumatera-utara',
                'excerpt' => 'Studi kelayakan dan baseline lingkungan untuk eksplorasi energi panas bumi.',
                'description' => 'Kajian potensi geothermal dan studi baseline lingkungan untuk area eksplorasi seluas 5,000 hektar di Sumatera Utara. Mencakup analisis geologi, potensi dampak lingkungan, dan strategi mitigasi untuk operasional yang berkelanjutan.',
                'cover_image' => '/images/projects/project-07-geothermal.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Pemulihan Ekosistem Gambut — Kalimantan Tengah',
                'slug' => 'pemulihan-gambut-kalimantan',
                'excerpt' => 'Program restorasi lahan gambut dengan fokus penyimpanan karbon dan biodiversity.',
                'description' => 'Program pemulihan ekosistem gambut seluas 100 hektar dengan strategi rewetting, reforestasi, dan pengendalian kebakaran. Melibatkan komunitas lokal dan pemantauan jangka panjang terhadap stok karbon dan keanekaragaman hayati.',
                'cover_image' => '/images/projects/project-08-gambut.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Desain Sistem Pengelolaan Air Limbah — Bandara',
                'slug' => 'sistem-air-limbah-bandara',
                'excerpt' => 'Perancangan IPAL modern dengan teknologi advanced treatment untuk standar internasional.',
                'description' => 'Perancangan dan implementasi sistem Instalasi Pengolahan Air Limbah (IPAL) dengan kapasitas 500 m³/hari menggunakan teknologi advanced treatment. Mencakup pre-treatment, biological treatment, dan polishing untuk memenuhi standar baku mutu kelas A.',
                'cover_image' => '/images/projects/project-09-ipal-bandara.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Program CSR Pemberdayaan Perempuan — Sumba',
                'slug' => 'csr-pemberdayaan-perempuan-sumba',
                'excerpt' => 'Inisiatif pemberdayaan ekonomi perempuan melalui pelatihan keterampilan dan akses pasar.',
                'description' => 'Program Corporate Social Responsibility (CSR) pemberdayaan 500 perempuan di Pulau Sumba melalui pelatihan keterampilan kerajinan, akses permodalan, dan linkage pasar. Hasil produksi dipasarkan melalui platform e-commerce dengan dukungan teknis dan manajemen.',
                'cover_image' => '/images/projects/project-10-csr-perempuan.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Riset Biodiversity Hutan Hujan Tropis — Papua',
                'slug' => 'riset-biodiversity-papua',
                'excerpt' => 'Survei biodiversity dan assessment ekosistem untuk mendukung konservasi hutan tropis.',
                'description' => 'Riset biodiversity komprehensif mencakup survei flora (2,000+ spesies) dan fauna (bird watching, herpetologi) di area hutan hujan tropis seluas 50,000 hektar. Hasil digunakan untuk perencanaan konservasi dan perlindungan spesies langka.',
                'cover_image' => '/images/projects/project-11-biodiversity-papua.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Sertifikasi Manajemen Lingkungan ISO 14001 — Perkebunan',
                'slug' => 'sertifikasi-iso-14001-perkebunan',
                'excerpt' => 'Implementasi sistem manajemen lingkungan untuk sertifikasi internasional di sektor perkebunan.',
                'description' => 'Program implementasi ISO 14001:2015 pada perusahaan perkebunan kelapa sawit berkelanjutan (ISPO). Mencakup policy development, dokumentasi sistem, internal audit, dan management review untuk meraih sertifikasi internasional.',
                'cover_image' => '/images/projects/project-12-iso-14001.jpg',
                'is_published' => true,
                'is_featured' => true,
            ],
        ];

        /**
         * Gunakan updateOrCreate untuk menghindari duplikat jika seeder dijalankan berkali-kali.
         * Jika proyek dengan slug yang sama ada, update data-nya; jika tidak, buat baru.
         */
        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['slug' => $project['slug']],
                $project
            );
        }

        $this->command->info('FeaturedProject seeder berhasil dijalankan: ' . count($projects) . ' proyek unggulan telah ditambahkan.');
    }
}
