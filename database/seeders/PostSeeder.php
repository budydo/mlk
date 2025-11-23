<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sample = [
            [
                'title' => 'Restorasi Lahan: Pendekatan Partisipatif',
                'excerpt' => 'Pendekatan partisipatif meningkatkan keberlanjutan program restorasi lahan.',
                'content' => '<p>Restorasi lahan memerlukan pendekatan partisipatif yang melibatkan seluruh komunitas lokal. Strategi ini terbukti meningkatkan keberlanjutan program karena masyarakat menjadi pemilik dan pelindung proyek. Partisipasi aktif dari awal perencanaan hingga evaluasi memastikan keputusan sesuai kebutuhan lokal. Pendekatan ini juga memperkuat kapasitas komunitas dalam mengelola sumber daya alam secara berkelanjutan. Dengan melibatkan berbagai stakeholder, risiko kegagalan proyek berkurang signifikan. Pengalaman menunjukkan bahwa proyek partisipatif memiliki dampak jangka panjang lebih baik dibanding pendekatan top-down tradisional.</p>',
                'cover_image' => 'images/posts/1.png'
            ],
            [
                'title' => 'Membangun Kapasitas Komunitas Lokal',
                'excerpt' => 'Pentingnya pelatihan dan pelibatan komunitas dalam setiap proyek lingkungan.',
                'content' => '<p>Pelatihan dan pelibatan komunitas lokal adalah kunci keberhasilan proyek lingkungan. Dengan membangun kapasitas mereka, komunitas dapat mengelola sumber daya alam secara berkelanjutan. Pelatihan teknis, manajemen proyek, dan kesadaran lingkungan harus disesuaikan dengan kebutuhan lokal. Pendekatan inklusif ini memperkuat rasa memiliki terhadap proyek, meningkatkan partisipasi aktif, dan memastikan keberlanjutan jangka panjang. Studi kasus menunjukkan bahwa komunitas yang terlatih mampu mengatasi tantangan lingkungan dengan lebih efektif.</p>',
                'cover_image' => 'images/posts/2.png'
            ],
            [
                'title' => 'Metode Monitoring & Evaluasi Proyek',
                'excerpt' => 'Metode sederhana untuk memantau hasil ekologis dan sosial proyek.',
                'content' => '<p>Monitoring dan evaluasi (M&E) proyek lingkungan sangat penting untuk menilai keberhasilan dan dampak jangka panjang. Metode sederhana seperti survei lapangan, wawancara dengan komunitas, dan penggunaan indikator ekologis dapat memberikan gambaran jelas tentang kemajuan proyek. Data yang dikumpulkan harus dianalisis secara berkala untuk mengidentifikasi tantangan dan peluang perbaikan. Pelibatan komunitas dalam proses M&E juga meningkatkan transparansi dan akuntabilitas. Dengan pendekatan yang sistematis, proyek dapat disesuaikan untuk mencapai hasil yang diinginkan secara efektif.</p>',
                'cover_image' => 'images/posts/3.png'
            ],
            [
                'title' => 'Pemilihan Spesies untuk Revegetasi',
                'excerpt' => 'Panduan memilih spesies yang cocok untuk revegetasi lahan terdegradasi.',
                'content' => '<p>Panduan ini menjelaskan prinsip pemilihan spesies untuk revegetasi lahan terdegradasi. Pilih spesies lokal yang adaptif terhadap kondisi iklim dan tanah setempat, serta memiliki peran ekologis seperti penahan erosi atau memperbaiki kesuburan tanah. Perhatikan kebutuhan air, intoleransi terhadap salinitas, dan interaksi dengan fauna lokal. Kombinasikan pionir cepat tumbuh dengan spesies payung untuk menciptakan struktur vegetasi yang berkelanjutan. Hindari spesies invasif yang dapat mengganggu keseimbangan ekosistem. Libatkan komunitas lokal dalam proses pemilihan untuk memastikan pemeliharaan jangka panjang. Monitoring pasca-penanaman diperlukan untuk mengevaluasi keberhasilan dan melakukan intervensi adaptif. Pendekatan ilmiah dan tradisional harus digabungkan agar restorasi berhasil dan tahan lama secara berkelanjutan selalu.</p>',
                'cover_image' => 'images/posts/4.png'
            ],
            [
                'title' => 'Studi Kasus: Keberhasilan Proyek Desa Seruni',
                'excerpt' => 'Ringkasan hasil dan pelajaran dari proyek di Desa Seruni.',
                'content' => '<p>Proyek restorasi lahan di Desa Seruni berhasil meningkatkan produktivitas tanah dan kesejahteraan masyarakat lokal. Melalui pendekatan partisipatif, komunitas dilibatkan dalam setiap tahap proyek, dari perencanaan hingga evaluasi. Pelatihan kapasitas memperkuat kemampuan mereka dalam mengelola sumber daya alam secara berkelanjutan. Monitoring dan evaluasi rutin menunjukkan peningkatan keanekaragaman hayati dan penurunan erosi tanah. Studi kasus ini menyoroti pentingnya kolaborasi antara pemerintah, LSM, dan komunitas lokal untuk mencapai hasil yang berkelanjutan. Pelajaran utama adalah bahwa keberhasilan proyek bergantung pada keterlibatan aktif semua pihak terkait dan adaptasi terhadap kondisi lokal.</p>',
                'cover_image' => 'images/posts/5.png'
            ],
            [
                'title' => 'Perizinan Lingkungan: Panduan Praktis',
                'excerpt' => 'Langkah-langkah perizinan untuk proyek restorasi dan pembangunan berkelanjutan.',
                'content' => '<p>Perizinan lingkungan adalah proses penting untuk memastikan bahwa proyek restorasi dan pembangunan berkelanjutan mematuhi regulasi yang berlaku. Panduan ini menjelaskan langkah-langkah praktis dalam memperoleh izin lingkungan, termasuk identifikasi jenis izin yang diperlukan, persiapan dokumen, dan konsultasi dengan pihak berwenang. Penting untuk melakukan analisis dampak lingkungan (AMDAL) atau dokumen lingkungan lainnya sesuai dengan skala proyek. Keterlibatan masyarakat dan transparansi selama proses perizinan juga sangat dianjurkan untuk menghindari konflik di kemudian hari. Setelah izin diperoleh, pemantauan kepatuhan terhadap persyaratan izin harus dilakukan secara rutin untuk memastikan keberlanjutan proyek.</p>',
                'cover_image' => 'images/posts/6.png'
            ],
        ];

        foreach ($sample as $item) {
            // dd($item['cover_image']);
            $slug = Str::slug($item['title']);
            Post::create([
                'title' => $item['title'],
                'slug' => $slug . '-' . substr(Str::random(5),0,5),
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'cover_image' => $item['cover_image'],
                'is_published' => true,
                'published_at' => now()->subDays(rand(0,30)),
            ]);
        }
    }
}
