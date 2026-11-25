<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\NavMenu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for Prodi S1 Keperawatan & Profesi Ners.
     */
    public function run(): void
    {
        // 1. Akun Pengguna / Administrator
        // Super Admin khusus Orang IT (memiliki akses penuh & manajemen sistem)
        $itAdmin = User::updateOrCreate(
            ['email' => 'it@pantiwaluya.ac.id'],
            [
                'name' => 'Super Admin (Unit IT)',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@pantiwaluya.ac.id'],
            [
                'name' => 'Super Admin IT Utama',
                'role' => 'super_admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Akun Kaprodi sebagai Admin Prodi (mengelola konten & layanan akademik)
        $kaprodi = User::updateOrCreate(
            ['email' => 'keperawatan@pantiwaluya.ac.id'],
            [
                'name' => 'Kaprodi S1 Keperawatan & Ners',
                'role' => 'admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Akun Admin Berita / Humas Prodi
        $newsAdmin = User::updateOrCreate(
            ['email' => 'berita@pantiwaluya.ac.id'],
            [
                'name' => 'Admin Humas & Berita Prodi',
                'role' => 'admin',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Pengaturan Profil & Identitas Prodi S1 Keperawatan & Profesi Ners
        $defaultSettings = [
            // Identitas Program Studi
            'division_name' => 'Program Studi S1 Keperawatan & Pendidikan Profesi Ners',
            'division_short_name' => 'Prodi S1 Keperawatan & Ners',
            'division_acronym' => 'S1 KEP & NERS',
            'division_type' => 'prodi',
            'prodi_degree' => 'Sarjana Keperawatan (S.Kep) & Profesi Ners (Ns.)',
            'prodi_accreditation' => 'Terakreditasi Baik Sekali (LAM-PTKes)',
            'division_tagline' => 'Mewujudkan Ners Profesional, Unggul, Inovatif, dan Berkarakter Kasih',
            'parent_institution' => 'STIKES Panti Waluya Malang',
            
            // Visual & Branding
            'theme_primary_color' => '#c2410c', // Orange Tua (Warna Identitas Keperawatan & Ners)
            'theme_secondary_color' => '#9a3412', // Dark Orange / Rust
            'theme_accent_color' => '#ea580c', // Orange-600
            'logo_url' => '',
            'hero_banner_title' => 'Program Studi S1 Keperawatan & Pendidikan Profesi Ners',
            'hero_banner_subtitle' => 'Mencetak Ners profesional, unggul dalam asuhan keperawatan holistik, serta berdaya saing global berlandaskan kasih.',

            // Tentang & Visi Misi
            'about_title' => 'Tentang Prodi S1 Keperawatan & Profesi Ners',
            'about_description' => "Program Studi S1 Keperawatan dan Pendidikan Profesi Ners STIKES Panti Waluya Malang menyelenggarakan pendidikan tinggi keperawatan terpadu yang memadukan tahap akademik Sarjana Keperawatan dan tahap Profesi Ners.\n\nKurikulum kami dirancang berbasis Outcome-Based Education (OBE) dan standar nasional KKNI, berorientasi pada keunggulan keperawatan holistik, paliatif, medikal bedah, serta kegawatdaruratan dan bencana.\n\nDidukung tenaga pengajar berkualifikasi S2/S3 Keperawatan dan Ners Spesialis, laboratorium berstandar rumah sakit, OSCE Center, serta jaringan Rumah Sakit Pendidikan Tipe A dan B, kami berkomitmen mencetak lulusan yang profesional, adaptif, dan berjiwa cinta kasih.",
            'vision' => 'Menjadi Program Studi S1 Ilmu Keperawatan dan Pendidikan Profesi Ners yang Unggul, Inovatif, dan Berdaya Saing Global Berlandaskan Nilai-Nilai Kasih dan Kearifan Lokal pada Tahun 2035.',
            'mission' => "1. Menyelenggarakan pendidikan sarjana keperawatan dan profesi ners bermutu tinggi berbasis kurikulum OBE (Outcome-Based Education).\n2. Mengembangkan penelitian inovatif berbasis bukti (Evidence-Based Nursing) guna memperkaya ilmu pengetahuan dan mutu pelayanan kesehatan.\n3. Melaksanakan pengabdian kepada masyarakat berbasis hasil riset keperawatan untuk meningkatkan derajat kesehatan komunitas dan kemandirian keluarga.\n4. Membina pembentukan karakter lulusan yang berintegritas tinggi, berdisiplin, beretika luhur, dan berjiwa cinta kasih dalam melayani sesama.\n5. Menjalin kerjasama strategis dengan rumah sakit pendidikan, industri pelayanan kesehatan, institusi internasional, dan organisasi profesi (PPNI).",
            'prodi_graduate_profile' => "Lulusan dipersiapkan sebagai Care Provider (Pemberi Asuhan Keperawatan Komprehensif), Communicator, Educator & Health Promoter, Manager & Leader di fasilitas pelayanan kesehatan, serta Researcher pemula yang berdaya saing global.",
            
            // Kontak & Lokasi
            'contact_email' => 'keperawatan@pantiwaluya.ac.id',
            'contact_phone' => '(0341) 569275',
            'contact_whatsapp' => '6281234567890',
            'enable_whatsapp_floating' => '1',
            'whatsapp_floating_message' => 'Halo Admin Prodi S1 Keperawatan & Ners, saya ingin bertanya seputar informasi akademik.',
            'contact_room' => 'Gedung Rektorat Lt. 2, Ruang Prodi S1 Keperawatan & Profesi Ners',
            'contact_address' => 'Jl. Yulius Usman No. 62, Kasin, Kec. Klojen, Kota Malang, Jawa Timur 65117',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.213601444588!2d112.62473467499647!3d-7.976868692048386!2m3!1f0!2f0!3f0!3m2!1i1024!2f768!4f13.1!3m3!1m2!1s0x2dd62828b49e1a17%3A0xc3cb73f1d3c01fa9!2sSTIKes%20Panti%20Waluya%20Malang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',

            // Media Sosial
            'social_instagram' => 'https://instagram.com/stikespantiwaluya',
            'social_facebook' => 'https://facebook.com/stikespantiwaluyamalang',
            'social_youtube' => 'https://youtube.com/@stikespantiwaluya',
            'social_website' => 'https://pantiwaluya.ac.id',

            // Statistik Capaian di Beranda
            'stat_1_number' => '98%',
            'stat_1_label' => 'Kelulusan UKOM Ners',
            'stat_2_number' => '100%',
            'stat_2_label' => 'Dosen S2/S3 & Ners Spesialis',
            'stat_3_number' => '25+',
            'stat_3_label' => 'RS & Wahana Praktik Mitra',
            'stat_4_number' => '1.500+',
            'stat_4_label' => 'Alumni Ners Terserap Kerja',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
        }

        // 3. Kategori Berita & Dokumen
        $cat1 = Category::updateOrCreate(['slug' => 'akademik-perkuliahan'], ['name' => 'Akademik & Perkuliahan', 'type' => 'post', 'description' => 'Informasi perkuliahan dan kurikulum keperawatan']);
        $cat2 = Category::updateOrCreate(['slug' => 'praktik-klinik-profesi'], ['name' => 'Praktik Klinik & Profesi', 'type' => 'post', 'description' => 'Informasi stase klinik dan rotasi RS']);
        $cat3 = Category::updateOrCreate(['slug' => 'pengumuman-prodi'], ['name' => 'Pengumuman Resmi', 'type' => 'post', 'description' => 'Edaran dan pengumuman resmi prodi']);
        $catDoc1 = Category::updateOrCreate(['slug' => 'pedoman-panduan'], ['name' => 'Buku Panduan & Pedoman', 'type' => 'document', 'description' => 'Buku pedoman akademik dan praktik klinik']);
        $catDoc2 = Category::updateOrCreate(['slug' => 'format-skripsi-kian'], ['name' => 'Format Skripsi & KIAN', 'type' => 'document', 'description' => 'Format penulisan tugas akhir sarjana dan profesi']);
        $catDoc3 = Category::updateOrCreate(['slug' => 'formulir-praktik'], ['name' => 'Formulir Praktik Klinik', 'type' => 'document', 'description' => 'Logbook dan formulir administrasi stase']);

        // 4. Berita & Pengumuman Prodi
        Post::updateOrCreate(
            ['slug' => 'pelepasan-mahasiswa-praktik-klinik-keperawatan-terpadu'],
            [
                'title' => 'Pelepasan Mahasiswa Praktik Klinik Keperawatan (PKK) di RS Jejaring Pendidikan',
                'category_id' => $cat2->id,
                'user_id' => $superAdmin->id,
                'type' => 'berita',
                'summary' => 'Prodi S1 Keperawatan dan Profesi Ners secara resmi memberangkatkan mahasiswa untuk menjalani rotasi praktik klinik.',
                'content' => '<p>Program Studi S1 Keperawatan dan Pendidikan Profesi Ners STIKES Panti Waluya Malang menyelenggarakan acara pembekalan dan pelepasan mahasiswa Praktik Klinik Keperawatan (PKK) di Rumah Sakit jejaring pendidikan wilayah Jawa Timur.</p><p>Kegiatan praktik klinik ini bertujuan untuk mengasah kompetensi asuhan keperawatan langsung kepada pasien secara holistik, mengutamakan keselamatan pasien (patient safety), dan menjunjung tinggi kode etik keperawatan.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 195,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'workshop-persiapan-uji-kompetensi-nasional-ners-2025'],
            [
                'title' => 'Workshop Intensif Persiapan Uji Kompetensi Nasional (Exit Exam) Ners Periode 2025',
                'category_id' => $cat1->id,
                'user_id' => $superAdmin->id,
                'type' => 'berita',
                'summary' => 'Mempersiapkan lulusan Ners dengan pemantapan materi soal klinis dan simulasi CBT berskala nasional.',
                'content' => '<p>Dalam upaya mempertahankan rekor tingkat kelulusan tinggi (First Taker Pass Rate), Prodi menyelenggarakan Workshop Pemantapan Soal Uji Kompetensi Nasional Ners (UKOM). Narasumber pakar keperawatan membedah soal-soal vignete 7 area keperawatan klinis dan strategi manajemen waktu saat ujian CBT.</p>',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 280,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'sosialisasi-alur-penyusunan-skripsi-dan-kian-tahun-akademik-2025'],
            [
                'title' => 'Sosialisasi Alur Penyusunan Skripsi & Sidang Karya Ilmiah Akhir Ners (KIAN)',
                'category_id' => $cat3->id,
                'user_id' => $superAdmin->id,
                'type' => 'pengumuman',
                'summary' => 'Pedoman pengajuan judul, alur bimbingan dosen pembimbing, hingga syarat kelayakan ujian sidang hasil.',
                'content' => '<p>Diberitahukan kepada seluruh mahasiswa tingkat akhir Program Sarjana dan Program Profesi Ners mengenai jadwal pengusulan proposal skripsi dan KIAN. Buku pedoman penulisan dan format lembar pengesahan terbaru telah dapat diunduh pada Pusat Unduhan website resmi prodi.</p>',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'views_count' => 164,
            ]
        );

        // 5. Layanan Mahasiswa & Akademik Prodi
        Service::updateOrCreate(
            ['slug' => 'layanan-praktik-klinik-dan-stase-ners'],
            [
                'title' => 'Layanan Praktik Klinik & Stase Profesi Ners',
                'icon' => 'fa-solid fa-user-nurse',
                'summary' => 'Koordinasi penempatan, pembekalan, dan supervisi stase klinik di Rumah Sakit jejaring dan komunitas.',
                'description' => 'Program Studi memfasilitasi rotasi praktik klinik mahasiswa tahap sarjana dan profesi ners di berbagai stase keperawatan (KMB, Maternitas, Anak, Jiwa, Gadar-Kritis, Komunitas, Gerontik, dan Manajemen Keperawatan).',
                'requirements' => "1. Telah menyelesaikan beban SKS prasyarat akademik\n2. Surat Keterangan Lulus Pembekalan & OSCE Internal\n3. Bukti Vaksinasi & Medical Check-Up\n4. Surat Izin Orang Tua/Wali",
                'procedure' => "1. Mahasiswa melakukan pendaftaran stase di sistem akademik prodi.\n2. Mengikuti pembekalan teknis dan uji keterampilan klinik (OSCE).\n3. Penyerahan ke Rumah Sakit Pendidikan mitra.\n4. Pelaksanaan stase klinik dan bimbingan preseptor.",
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'bimbingan-skripsi-dan-karya-ilmiah-ners'],
            [
                'title' => 'Bimbingan Skripsi & Sidang KIAN',
                'icon' => 'fa-solid fa-graduation-cap',
                'summary' => 'Pelayanan pengajuan judul, penetapan dosen pembimbing, seminar proposal, hingga sidang hasil karya ilmiah.',
                'description' => 'Layanan akademik bagi mahasiswa S1 Keperawatan untuk penyusunan Skripsi dan mahasiswa Profesi Ners untuk penyusunan Karya Ilmiah Akhir Ners (KIAN) berbasis studi kasus klinis.',
                'requirements' => "1. KRS Skripsi/KIAN telah disetujui Dosen PA\n2. Naskah Proposal Penelitian / Analisis Kasus\n3. Lembar Persetujuan Pembimbing\n4. Bebas Administrasi Keuangan",
                'procedure' => "1. Pengajuan judul dan usulan pembimbing ke Koordinator Skripsi/KIAN.\n2. Penetapan SK Pembimbing oleh Prodi.\n3. Proses bimbingan minimal 8 kali pertemuan.\n4. Pendaftaran seminar proposal dan sidang hasil.",
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'bimbingan-uji-kompetensi-nasional-ners'],
            [
                'title' => 'Pendampingan & Try Out Uji Kompetensi (UKOM) Ners',
                'icon' => 'fa-solid fa-award',
                'summary' => 'Program pembinaan intensif, try out Computer Based Test (CBT), dan pendaftaran exit exam nasional Ners.',
                'description' => 'Fasilitasi persiapan menghadapi Uji Kompetensi Nasional Ners (UKOM) melalui review soal, bimbingan materi komprehensif, dan simulasi CBT berkala untuk mencapai tingkat kelulusan optimal.',
                'requirements' => "1. Mahasiswa terdaftar pada semester akhir tahap Profesi Ners\n2. Telah menyelesaikan seluruh stase klinik\n3. Mengikuti rangkaian Try Out Internal Prodi\n4. Berkas administrasi pendaftaran UKOM Nasional",
                'procedure' => "1. Pendaftaran peserta UKOM via sekretariat prodi.\n2. Mengikuti bimbingan intensif dan try out berkala.\n3. Verifikasi data peserta di portal nasional.\n4. Pelaksanaan ujian CBT dan pengurusan berkas STR pasca kelulusan.",
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        Service::updateOrCreate(
            ['slug' => 'pelayanan-administrasi-akademik-mahasiswa'],
            [
                'title' => 'Layanan Administrasi Akademik & Surat Izin Penelitian',
                'icon' => 'fa-solid fa-file-signature',
                'summary' => 'Penerbitan surat izin studi pendahuluan, izin penelitian, rekomendasi beasiswa, dan legalisir berkas.',
                'description' => 'Pusat pelayanan surat-menyurat akademik bagi mahasiswa yang memerlukan perizinan pengambilan data di rumah sakit, puskesmas, klinik, maupun instansi pemerintah terkait.',
                'requirements' => "1. Mengisi formulir permohonan surat secara online\n2. Melampirkan persetujuan Dosen Pembimbing / PA\n3. Menyertakan instrumen dan judul penelitian (bila untuk riset)",
                'procedure' => "1. Mengajukan surat permohonan melalui sistem / loket prodi.\n2. Verifikasi berkas oleh staf tata usaha.\n3. Penandatanganan oleh Ketua Program Studi.\n4. Surat resmi terbit dalam waktu 1-2 hari kerja.",
                'order_index' => 4,
                'is_active' => true,
            ]
        );

        // 6. Dosen & Susunan Pengelola Prodi S1 Keperawatan & Ners
        TeamMember::updateOrCreate(
            ['name' => 'Ns. Maria Magdalena, M.Kep., Sp.Kep.MB'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.MB',
                'identifier' => 'NIDN. 0712058501',
                'position' => 'Ketua Program Studi S1 Keperawatan & Ners',
                'type' => 'dosen',
                'expertise' => 'Keperawatan Medikal Bedah & Luka Modern',
                'academic_rank' => 'Lektor',
                'bio' => 'Dosen Keperawatan Medikal Bedah dengan spesialisasi keperawatan kardiovaskuler dan manajemen perawatan luka modern.',
                'email' => 'maria.magdalena@pantiwaluya.ac.id',
                'phone' => '081234567891',
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Yohanes Berchmans, M.Kep., Sp.Kep.Kom'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.Kom',
                'identifier' => 'NIDN. 0725088902',
                'position' => 'Sekretaris Prodi & Koordinator Profesi Ners',
                'type' => 'dosen',
                'expertise' => 'Keperawatan Komunitas & Promosi Kesehatan',
                'academic_rank' => 'Lektor',
                'bio' => 'Dosen Keperawatan Komunitas dengan fokus penelitian promosi kesehatan masyarakat dan manajemen fasilitas kesehatan primer.',
                'email' => 'yohanes.berchmans@pantiwaluya.ac.id',
                'phone' => '081234567892',
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Theresia Avila, M.Kep., Sp.Kep.An'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.An',
                'identifier' => 'NIDN. 0718109003',
                'position' => 'Koordinator Akademik Tahap Sarjana',
                'type' => 'dosen',
                'expertise' => 'Keperawatan Anak & Pediatrik Neonatus',
                'academic_rank' => 'Asisten Ahli',
                'bio' => 'Dosen Keperawatan Anak dengan keahlian asuhan keperawatan neonatus, pediatrik, dan stimulasi tumbuh kembang balita.',
                'email' => 'theresia.avila@pantiwaluya.ac.id',
                'phone' => '081234567893',
                'order_index' => 3,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Fransiskus Xaverius, M.Kes.'],
            [
                'title_degree' => 'M.Kes.',
                'identifier' => 'NIDN. 0709048704',
                'position' => 'Koordinator Laboratorium Keperawatan & OSCE',
                'type' => 'dosen',
                'expertise' => 'Gawat Darurat, Kritis & BTCLS',
                'academic_rank' => 'Asisten Ahli',
                'bio' => 'Dosen Keperawatan Gawat Darurat dan Kritis dengan sertifikasi instruktur BTCLS dan simulasi kebencanaan.',
                'email' => 'fransiskus.xaverius@pantiwaluya.ac.id',
                'phone' => '081234567894',
                'order_index' => 4,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Elisabeth Dwi, M.Kep., Sp.Kep.Mat'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.Mat',
                'identifier' => 'NIDN. 0714028805',
                'position' => 'Dosen Keperawatan Maternitas',
                'type' => 'dosen',
                'expertise' => 'Keperawatan Maternitas & Safe Motherhood',
                'academic_rank' => 'Asisten Ahli',
                'bio' => 'Fokus pengajaran dan riset pada kesehatan reproduksi wanita, antenatal care komprehensif, dan pendampingan persalinan.',
                'email' => 'elisabeth.dwi@pantiwaluya.ac.id',
                'phone' => '081234567896',
                'order_index' => 5,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Ns. Petrus Kanisius, M.Kep., Sp.Kep.J'],
            [
                'title_degree' => 'M.Kep., Sp.Kep.J',
                'identifier' => 'NIDN. 0722079106',
                'position' => 'Dosen Keperawatan Jiwa & Psikososial',
                'type' => 'dosen',
                'expertise' => 'Keperawatan Jiwa & Konseling Klinis',
                'academic_rank' => 'Tenaga Pengajar',
                'bio' => 'Penggiat kesehatan jiwa komunitas, terapi modalitas, dan penanganan stres pada mahasiswa dan keluarga.',
                'email' => 'petrus.kanisius@pantiwaluya.ac.id',
                'phone' => '081234567897',
                'order_index' => 6,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Antonius Joko Santoso, S.Kom.'],
            [
                'title_degree' => 'S.Kom.',
                'identifier' => 'NIP. 202109004',
                'position' => 'Staf Administrasi & Tata Usaha Prodi',
                'type' => 'tendik',
                'expertise' => 'Administrasi Akademik & Pengelolaan Sistem Informasi',
                'academic_rank' => 'Pengadministrasi Akademik',
                'bio' => 'Pengelola sistem informasi akademik prodi, administrasi persuratan, dan pelayanan berkas mahasiswa.',
                'email' => 'antonius.joko@pantiwaluya.ac.id',
                'phone' => '081234567895',
                'order_index' => 7,
                'is_active' => true,
            ]
        );

        TeamMember::updateOrCreate(
            ['name' => 'Siti Rahayu, A.Md.Kes.'],
            [
                'title_degree' => 'A.Md.Kes.',
                'identifier' => 'NIP. 202201012',
                'position' => 'Pranata Laboratorium Pendidikan (Laboran Keperawatan)',
                'type' => 'tendik',
                'expertise' => 'Manajemen Alat Medis Lab, OSCE Center & Praktikum',
                'academic_rank' => 'Laboran Keperawatan',
                'bio' => 'Pengelola sarana dan prasarana laboratorium skill keperawatan, manekin phantom, dan logistik praktikum klinik.',
                'email' => 'siti.rahayu@pantiwaluya.ac.id',
                'phone' => '081234567898',
                'order_index' => 8,
                'is_active' => true,
            ]
        );

        // 7. Agenda Kegiatan Prodi
        Event::updateOrCreate(
            ['slug' => 'ucap-janji-dan-capping-day-mahasiswa-keperawatan'],
            [
                'title' => 'Ucap Janji & Capping Day Mahasiswa S1 Keperawatan',
                'location' => 'Auditorium STIKES Panti Waluya Malang',
                'start_date' => now()->addDays(14)->setTime(8, 30),
                'end_date' => now()->addDays(14)->setTime(13, 0),
                'description' => 'Prosesi sakral pengucapan janji perawat dan pemasangan kap sebagai penanda kesiapan mahasiswa melangkah ke tahapan praktik klinik di rumah sakit.',
                'registration_link' => '',
                'is_active' => true,
            ]
        );

        Event::updateOrCreate(
            ['slug' => 'simulasi-try-out-cbt-uji-kompetensi-ners-batch-1'],
            [
                'title' => 'Simulasi Try Out CBT Uji Kompetensi Ners (UKOM) Batch 1',
                'location' => 'Laboratorium Komputer CBT Center STIKES Panti Waluya',
                'start_date' => now()->addDays(28)->setTime(9, 0),
                'end_date' => now()->addDays(28)->setTime(12, 30),
                'description' => 'Simulasi ujian CBT berbasis komputer standar nasional untuk mengukur kesiapan materi, analisis kasus klinik, dan akurasi waktu mahasiswa.',
                'registration_link' => '',
                'is_active' => true,
            ]
        );

        // 8. Dokumen & Buku Panduan Prodi
        Document::updateOrCreate(
            ['title' => 'Buku Pedoman Praktik Profesi Ners Edisi 2025'],
            [
                'category_id' => $catDoc1->id,
                'file_path' => 'documents/buku_pedoman_profesi_ners_2025.pdf',
                'file_type' => 'PDF',
                'file_size' => '3.1 MB',
                'description' => 'Panduan lengkap capaian kompetensi, tata tertib, dan format evaluasi stase klinik profesi ners.',
                'downloads_count' => 412,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Buku Panduan Penulisan Skripsi & Karya Ilmiah Akhir Ners (KIAN)'],
            [
                'category_id' => $catDoc2->id,
                'file_path' => 'documents/panduan_skripsi_kian.pdf',
                'file_type' => 'PDF',
                'file_size' => '2.5 MB',
                'description' => 'Petunjuk teknis penulisan karya ilmiah, format laporan studi kasus asuhan keperawatan, dan tata cara sidang.',
                'downloads_count' => 380,
                'is_published' => true,
            ]
        );

        Document::updateOrCreate(
            ['title' => 'Format Logbook Harian Praktik Klinik Keperawatan'],
            [
                'category_id' => $catDoc3->id,
                'file_path' => 'documents/format_logbook_klinik.docx',
                'file_type' => 'DOCX',
                'file_size' => '520 KB',
                'description' => 'Format resmi pencatatan tindakan keperawatan mandiri, bimbingan preseptor, dan rekapitulasi presensi dinas.',
                'downloads_count' => 295,
                'is_published' => true,
            ]
        );

        // 9. Banner Carousel Beranda
        Carousel::updateOrCreate(
            ['title' => 'Program Studi S1 Keperawatan & Pendidikan Profesi Ners'],
            [
                'subtitle' => 'Mencetak Ners profesional, kompeten, inovatif, dan berkarakter kasih yang siap mengabdi di tingkat nasional maupun internasional.',
                'image_path' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Profil Program Studi',
                'button_link' => '/profil',
                'order_index' => 1,
                'is_active' => true,
            ]
        );

        Carousel::updateOrCreate(
            ['title' => 'Laboratorium Keperawatan Komprehensif & OSCE Center'],
            [
                'subtitle' => 'Fasilitas simulasi rumah sakit terpadu untuk mengasah keterampilan klinis, komunikasi terapeutik, dan patient safety.',
                'image_path' => 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1920&q=80',
                'button_text' => 'Jelajahi Layanan & Fasilitas',
                'button_link' => '/layanan',
                'order_index' => 2,
                'is_active' => true,
            ]
        );

        // 10. Navigasi Menu Default
        $defaultMenus = [
            ['label' => 'Beranda', 'url' => '/', 'target' => '_self', 'order_index' => 1, 'is_active' => true],
            ['label' => 'Profil Prodi', 'url' => '/profil', 'target' => '_self', 'order_index' => 2, 'is_active' => true],
            ['label' => 'Dosen & Tendik', 'url' => '/dosen-tendik', 'target' => '_self', 'order_index' => 3, 'is_active' => true],
            ['label' => 'Layanan Akademik', 'url' => '/layanan', 'target' => '_self', 'order_index' => 4, 'is_active' => true],
            ['label' => 'Berita & Informasi', 'url' => '/berita', 'target' => '_self', 'order_index' => 5, 'is_active' => true],
            ['label' => 'Agenda Kegiatan', 'url' => '/agenda', 'target' => '_self', 'order_index' => 6, 'is_active' => true],
            ['label' => 'Pusat Unduhan', 'url' => '/unduhan', 'target' => '_self', 'order_index' => 7, 'is_active' => true],
            ['label' => 'Galeri Foto', 'url' => '/galeri', 'target' => '_self', 'order_index' => 8, 'is_active' => true],
            ['label' => 'Kontak Kami', 'url' => '/kontak', 'target' => '_self', 'order_index' => 9, 'is_active' => true],
        ];

        foreach ($defaultMenus as $menu) {
            NavMenu::updateOrCreate(['url' => $menu['url']], $menu);
        }
    }
}
