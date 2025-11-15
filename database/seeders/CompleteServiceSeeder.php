<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class CompleteServiceSeeder extends Seeder
{
    /**
     * Seed lengkap semua layanan dengan data yang sesuai.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Upaya Pengelolaan & Pemantauan Lingkungan (UKL-UPL)',
                'slug' => 'ukl-upl',
                'excerpt' => 'Rencana teknis pengelolaan lingkungan dan sistem pemantauan untuk mematuhi operasi usaha.',
                'description' => 'Rencana teknis pengelolaan lingkungan dan sistem pemantauan untuk mematuhi operasi usaha sesuai keperluan lingkungan.',
                'image_path' => 'images/services/ukl-upl.jpg',
                'icon' => 'images/services/ukl-upl.jpg',
                'features' => json_encode([
                    'Penyusunan UKL-UPL & rencana pemantauan',
                    'Pelatihan tim lapangan & SOP pemantauan',
                    'Dashboard pemantauan & laporan berkala',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Analisis Mengenai Dampak Lingkungan (AMDAL)',
                'slug' => 'amdal-kajian-dampak',
                'excerpt' => 'Kajian dampak komprehensif, identifikasi mitigasi, dan rekomendasi kebijakan untuk memenuhi persyaratan regulator.',
                'description' => 'Kajian dampak komprehensif, identifikasi mitigasi, dan rekomendasi kebijakan untuk memenuhi persyaratan regulator.',
                'image_path' => 'images/services/amdal-kajian-dampak.jpg',
                'icon' => 'images/services/amdal-kajian-dampak.jpg',
                'features' => json_encode([
                    'Studi baseline lingkungan & sosio-ekonomi',
                    'Analisis dampak & matrik mitigasi',
                    'Konsultasi publik & fasilitasi AMDAL',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Pemberdayaan Komunitas & Program Sosial',
                'slug' => 'pemberdayaan-komunitas',
                'excerpt' => 'Desain intervensi sosial yang meningkatkan kapasitas ekonomi dan sosial komunitas terdampak.',
                'description' => 'Desain intervensi sosial yang meningkatkan kapasitas ekonomi dan sosial komunitas terdampak.',
                'image_path' => 'images/services/pemberdayaan-komunitas.jpg',
                'icon' => 'images/services/pemberdayaan-komunitas.jpg',
                'features' => json_encode([
                    'Pelatihan keterampilan & inkubasi usaha',
                    'Studi implementasi program sosial',
                    'Evaluasi & pelaporan program hasil',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Restorasi Lahan & Ekosistem',
                'slug' => 'restorasi-lahan',
                'excerpt' => 'Program revegetasi dan restorasi ekosistem untuk pemulihan fungsi lahan.',
                'description' => 'Program revegetasi, rehabilitasi, dan pemantauan untuk memulihkan fungsi ekologis serta memberdayakan komunitas lokal dengan hasil yang berkelanjutan.',
                'image_path' => 'images/services/restorasi-lahan.jpg',
                'icon' => 'images/services/restorasi-lahan.jpg',
                'features' => json_encode([
                    'Desain teknis revegetasi dan penanaman',
                    'Pemantauan pertumbuhan & kesehatan vegetasi',
                    'Manajemen risiko degradasi lahan berkelanjutan',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Analisis & Pengendalian Transportasi',
                'slug' => 'transportasi-manajemen-lalu-lintas',
                'excerpt' => 'ANDALALIN dan sistem manajemen lalu lintas untuk infrastruktur transportasi.',
                'description' => 'Analisis Dampak Lalu Lintas (ANDALALIN) dan pengembangan sistem manajemen lalu lintas untuk meminimalkan dampak transportasi dari proyek infrastruktur.',
                'image_path' => 'images/services/transportasi-manajemen-lalu-lintas.jpg',
                'icon' => 'images/services/transportasi-manajemen-lalu-lintas.jpg',
                'features' => json_encode([
                    'Pemodelan arus lalu lintas dan impact assessment',
                    'Sistem manajemen mobilitas berkelanjutan',
                    'Rekomendasi mitigasi untuk optimasi transportasi',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Pengelolaan Lingkungan Hidup',
                'slug' => 'lingkungan-hidup-berkelanjutan',
                'excerpt' => 'Strategi komprehensif untuk mitigasi dampak dan pembangunan berkelanjutan.',
                'description' => 'Strategi komprehensif untuk mitigasi dampak lingkungan, kepatuhan regulasi, dan pencapaian pembangunan berkelanjutan sesuai standar internasional.',
                'image_path' => 'images/services/lingkungan-hidup-berkelanjutan.jpg',
                'icon' => 'images/services/lingkungan-hidup-berkelanjutan.jpg',
                'features' => json_encode([
                    'Audit lingkungan komprehensif',
                    'Strategi mitigasi dampak terintegrasi',
                    'Manajemen lingkungan berkelanjutan',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Konsultasi Lingkungan',
                'slug' => 'konsultasi-lingkungan',
                'excerpt' => 'Konsultasi profesional untuk isu-isu lingkungan dan kepatuhan regulasi.',
                'description' => 'Layanan konsultasi profesional untuk mengatasi isu-isu lingkungan kompleks, memastikan kepatuhan terhadap regulasi, dan mengoptimalkan strategi keberlanjutan perusahaan.',
                'image_path' => 'images/services/konsultasi-lingkungan.jpg',
                'icon' => 'images/services/konsultasi-lingkungan.jpg',
                'features' => json_encode([
                    'Analisis kebijakan dan regulasi lingkungan',
                    'Strategi kepatuhan dan manajemen risiko',
                    'Implementasi sistem manajemen lingkungan ISO 14001',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Pemantauan & Evaluasi Dampak',
                'slug' => 'pemantauan-dampak',
                'excerpt' => 'Program pemantauan berkelanjutan untuk evaluasi dampak real-time.',
                'description' => 'Program pemantauan berkelanjutan dengan metodologi ilmiah untuk mengevaluasi efektivitas mitigasi dan memastikan kepatuhan terhadap standar lingkungan.',
                'image_path' => 'images/services/pemantauan-dampak.jpg',
                'icon' => 'images/services/pemantauan-dampak.jpg',
                'features' => json_encode([
                    'Program monitoring lingkungan multikomponen',
                    'Analisis data dan interpretasi hasil',
                    'Pelaporan dan evaluasi keefektifan mitigasi',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Riset & Pengembangan',
                'slug' => 'riset-dan-pengembangan',
                'excerpt' => 'Program riset untuk pengembangan solusi lingkungan inovatif.',
                'description' => 'Program riset dan pengembangan untuk menciptakan solusi lingkungan yang inovatif, berkelanjutan, dan dapat diterapkan di berbagai konteks geografis dan sosial.',
                'image_path' => 'images/services/riset-dan-pengembangan.jpg',
                'icon' => 'images/services/riset-dan-pengembangan.jpg',
                'features' => json_encode([
                    'Kajian ilmiah dan metodologi penelitian',
                    'Pengembangan teknologi ramah lingkungan',
                    'Transfer teknologi dan publikasi hasil',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Pelatihan & Kapasitas',
                'slug' => 'pelatihan-kapasitas',
                'excerpt' => 'Program pelatihan untuk meningkatkan kapasitas pengelolaan lingkungan.',
                'description' => 'Program pelatihan dan pengembangan kapasitas untuk meningkatkan kemampuan organisasi dan individu dalam mengelola isu-isu lingkungan dan pembangunan berkelanjutan.',
                'image_path' => 'images/services/pelatihan-kapasitas.jpg',
                'icon' => 'images/services/pelatihan-kapasitas.jpg',
                'features' => json_encode([
                    'Kurikulum pelatihan komprehensif',
                    'Fasilitator dan materi pembelajaran berkualitas',
                    'Sertifikasi dan penugasan implementasi lapangan',
                ]),
                'is_published' => true,
            ],
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );
        }

        $this->command->info('Semua 9 layanan telah dilengkapi dengan data lengkap dan fitur.');
    }
}
