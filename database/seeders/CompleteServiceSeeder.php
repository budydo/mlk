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
                'excerpt' => 'UKL-UPL memastikan pengelolaan dampak lingkungan operasional yang terpadu, pemantauan berkala, mitigasi efektif, dan kepatuhan regulasi untuk keberlanjutan sosial dan ekonomi.',
                'description' => 'UKL–UPL disusun sebagai bentuk tanggung jawab pelaku usaha terhadap potensi dampak yang berskala lebih ringan namun tetap membutuhkan pengelolaan yang terarah. Dokumen ini menjadi pedoman operasional bagi perusahaan untuk memastikan bahwa seluruh aktivitasnya berada dalam koridor pengendalian lingkungan yang baik. Melalui identifikasi kegiatan, sumber dampak, serta langkah perlindungan yang tepat, UKL–UPL membantu pelaku usaha mematuhi regulasi sekaligus menjaga kualitas lingkungan sekitar. Penyusunan UKL–UPL yang profesional menghadirkan kejelasan bagi pengambil keputusan, meningkatkan kepercayaan pemangku kepentingan, dan memastikan kegiatan berjalan efisien tanpa mengabaikan aspek keberlanjutan.',
                'image_path' => 'images/services/7.png',
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
                'description' => 'AMDAL adalah kajian komprehensif yang mengevaluasi potensi dampak lingkungan, sosial, dan ekonomi dari rencana kegiatan atau proyek. Dokumen ini mengidentifikasi sumber dampak, mengukur besaran risiko, serta merumuskan langkah mitigasi yang efektif untuk meminimalkan efek negatif terhadap ekosistem dan masyarakat setempat. Prosesnya melibatkan studi baseline, analisis alternatif, serta partisipasi publik untuk menjamin transparansi dan akseptabilitas keputusan. Hasil AMDAL menjadi dasar perizinan dan panduan pengelolaan lingkungan selama siklus hidup proyek, memastikan kepatuhan terhadap regulasi, perlindungan sumber daya alam, dan penerapan praktik pembangunan berkelanjutan yang bertanggungjawab serta mendorong inovasi teknologi hijau, pemantauan berkelanjutan, dan kolaborasi lintas sektor demi kesejahteraan jangka panjang yang berkelanjutan.',
                'image_path' => 'images/services/9.png',
                'icon' => 'images/services/amdal-kajian-dampak.jpg',
                'features' => json_encode([
                    'Studi baseline lingkungan & sosio-ekonomi',
                    'Analisis dampak & matrik mitigasi',
                    'Konsultasi publik & fasilitasi AMDAL',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Sertifikat Laik Fungsi (SLF) & Analisis Resiko',
                'slug' => 'sertifikat-laik-fungsi-dan-analisis-resiko',
                'excerpt' => ' Penilaian resiko menyeluruh dan penyusunan dokumen SLF untuk memastikan keamanan bangunan.',
                'description' => 'SLF adalah bukti bahwa suatu bangunan telah memenuhi persyaratan teknis keselamatan, kesehatan, kenyamanan, dan kemudahan sesuai standar nasional. Sertifikat ini memastikan bahwa setiap bagian bangunan—mulai dari struktur, utilitas, hingga sistem proteksi kebakaran—berfungsi dengan baik dan aman digunakan. Proses verifikasi SLF dilakukan melalui pemeriksaan menyeluruh oleh tenaga ahli yang berwenang untuk memastikan tidak ada potensi bahaya yang dapat mengancam pengguna. Dengan memiliki SLF, pemilik bangunan memperoleh legitimasi operasional yang kuat serta meningkatkan kepercayaan publik terhadap kualitas fasilitas yang disediakan. SLF bukan sekadar dokumen, tetapi jaminan mutu bagi setiap bangunan.',
                'image_path' => 'images/services/8.png',
                'icon' => 'images/services/pemberdayaan-komunitas.jpg',
                'features' => json_encode([
                    'Penilaian resiko komprehensif bangunan',
                    'Studi implementasi program sosial',
                    'Evaluasi & pelaporan program hasil',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Persetujuan Bangunan Gedung (PBG)',
                'slug' => 'persetujuan-bangunan-gedung',
                'excerpt' => 'Program persetujuan bangunan gedung sesuai standar teknis dan regulasi.',
                'description' => 'PBG berfungsi sebagai persetujuan resmi pemerintah terhadap rencana pembangunan maupun renovasi bangunan, memastikan seluruh desain yang diajukan telah memenuhi ketentuan tata ruang, struktur, keselamatan, hingga aspek estetika yang berlaku. Melalui PBG, pemilik bangunan mendapatkan kepastian bahwa proses konstruksi berada di jalur yang benar dan sesuai aturan. Kajian teknis dalam PBG melibatkan evaluasi gambar kerja, spesifikasi material, hingga simulasi risiko, sehingga pembangunan dapat dilakukan dengan aman dan efisien. PBG memberikan dasar hukum yang kokoh bagi pelaku usaha sekaligus menjadi komitmen terhadap kualitas bangunan yang bertanggung jawab dan berkelanjutan.',
                'image_path' => 'images/services/6.png',
                'icon' => 'images/services/restorasi-lahan.jpg',
                'features' => json_encode([
                    'Desain teknis revegetasi dan penanaman',
                    'Pemantauan pertumbuhan & kesehatan vegetasi',
                    'Manajemen risiko degradasi lahan berkelanjutan',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Surat Izin Pengambilan dan Pemanfaatan Air',
                'slug' => 'izin-pengambilan-dan-pemanfaatan-air',
                'excerpt' => 'Izin resmi untuk pengambilan dan pemanfaatan sumber daya air sesuai regulasi.',
                'description' => 'Surat Izin Pengambilan dan Pemanfaatan Air adalah dokumen resmi yang dikeluarkan oleh otoritas terkait sebagai persetujuan bagi individu atau entitas untuk mengambil dan menggunakan sumber daya air dari lingkungan. Izin ini memastikan bahwa pengambilan air dilakukan secara bertanggung jawab, sesuai dengan kuota yang ditetapkan, serta tidak merusak ekosistem sekitar. Proses perizinan melibatkan evaluasi dampak lingkungan, analisis kebutuhan air, dan rencana pengelolaan yang komprehensif. Dengan memiliki izin ini, pemegangnya dapat menjalankan aktivitas yang memerlukan air—seperti industri, pertanian, atau domestik—dengan kepastian hukum dan komitmen terhadap keberlanjutan sumber daya air.',
                'image_path' => 'images/services/5.png',
                'icon' => 'images/services/transportasi-manajemen-lalu-lintas.jpg',
                'features' => json_encode([
                    'Pemodelan arus lalu lintas dan impact assessment',
                    'Sistem manajemen mobilitas berkelanjutan',
                    'Rekomendasi mitigasi untuk optimasi transportasi',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Perizinan Pengelolaan Lingkungan (PIEL)',
                'slug' => 'perizinan-pengelolaan-lingkungan',
                'excerpt' => 'Izin pengelolaan lingkungan untuk operasional usaha sesuai standar keberlanjutan.',
                'description' => 'PIEL adalah izin resmi yang diberikan kepada pelaku usaha sebagai persyaratan untuk mengelola dampak lingkungan dari kegiatan operasionalnya. Izin ini menegaskan komitmen perusahaan terhadap praktik pengelolaan lingkungan yang bertanggung jawab, termasuk pengendalian polusi, konservasi sumber daya, dan pemulihan ekosistem. Proses perizinan melibatkan evaluasi menyeluruh terhadap rencana pengelolaan lingkungan, sistem pemantauan, serta mekanisme pelaporan yang transparan. Dengan memiliki PIEL, pelaku usaha tidak hanya memenuhi kewajiban hukum, tetapi juga memperkuat reputasi sebagai entitas yang peduli terhadap keberlanjutan lingkungan dan kesejahteraan masyarakat sekitar.',
                'image_path' => 'images/services/3.png',
                'icon' => 'images/services/lingkungan-hidup-berkelanjutan.jpg',
                'features' => json_encode([
                    'Audit lingkungan komprehensif',
                    'Strategi mitigasi dampak terintegrasi',
                    'Manajemen lingkungan berkelanjutan',
                ]),
                'is_published' => true,
            ],
            [
                'title' => 'Analisis Dampak Lalulintas (ANDALALIN)',
                'slug' => 'analisis-dampak-lalulintas',
                'excerpt' => 'Kajian teknis dampak lalu lintas untuk pembangunan infrastruktur yang aman dan efisien',
                'description' => 'ANDALALIN merupakan kajian teknis untuk memastikan bahwa pembangunan suatu fasilitas tidak menimbulkan kemacetan atau gangguan terhadap sistem transportasi yang ada. Melalui pendekatan rekayasa lalu lintas, kajian ini mengukur volume kendaraan, pola pergerakan, akses masuk–keluar, serta kebutuhan infrastruktur pendukung. Hasil analisis kemudian diterjemahkan menjadi rekomendasi teknis agar aktivitas usaha tetap aman, tertib, dan selaras dengan perencanaan kota. Dokumen ANDALALIN yang baik memberikan kepastian bagi pemerintah, masyarakat, dan pengembang bahwa seluruh pergerakan di sekitar lokasi pembangunan dapat berlangsung lancar. Kajian ini bukan hanya syarat administratif, tetapi juga bentuk komitmen terhadap keselamatan dan efisiensi transportasi.',
                'image_path' => 'images/services/4.png',
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
                'description' => 'Program pemantauan dan evaluasi dampak dirancang untuk mengukur efektivitas langkah-langkah mitigasi yang telah diterapkan dalam suatu proyek atau kegiatan. Melalui pengumpulan data secara berkala, analisis tren, dan pelaporan hasil, program ini memberikan gambaran menyeluruh tentang perubahan lingkungan dan sosial yang terjadi. Dengan pendekatan ilmiah dan teknologi terkini, pemantauan ini memungkinkan identifikasi dini terhadap potensi masalah serta penyesuaian strategi yang diperlukan. Hasil evaluasi tidak hanya menjadi alat ukur keberhasilan, tetapi juga dasar pengambilan keputusan yang informatif bagi pemangku kepentingan. Program ini menegaskan komitmen terhadap transparansi, akuntabilitas, dan perbaikan berkelanjutan dalam pengelolaan dampak lingkungan.',
                'image_path' => 'images/services/2.png',
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
                'image_path' => 'images/services/1.png',
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
                'image_path' => 'images/services/1.png',
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
