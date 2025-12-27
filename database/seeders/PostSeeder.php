<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => '5 Destinasi Wisata Alam Terbaik di Medan yang Wajib Dikunjungi',
                'slug' => Str::slug('5 Destinasi Wisata Alam Terbaik di Medan yang Wajib Dikunjungi'),
                'excerpt' => 'Jelajahi keindahan alam Medan melalui 5 destinasi wisata menakjubkan yang menawarkan pengalaman tak terlupakan bagi para traveler.',
                'content' => '<p>Medan, ibu kota Provinsi Sumatera Utara, menyimpan segudang pesona alam yang memukau. Dari danau vulkanik terbesar di dunia hingga hutan hujan tropis yang masih asri, berikut adalah 5 destinasi wisata alam terbaik di Medan yang wajib Anda kunjungi:</p>

<h3>1. Danau Toba - Keajaiban Alam Dunia</h3>
<p>Danau Toba merupakan danau vulkanik terbesar di dunia dengan luas 1.145 km². Terbentuk dari letusan gunung berapi super sekitar 74.000 tahun yang lalu, danau ini menawarkan pemandangan yang spektakuler. Pulau Samosir di tengah danau menjadi daya tarik utama dengan budaya Batak yang masih kental.</p>

<h3>2. Bukit Lawang - Rumah Orangutan Sumatera</h3>
<p>Terletak di Taman Nasional Gunung Leuser, Bukit Lawang merupakan pusat rehabilitasi orangutan terbesar di Sumatera. Pengunjung dapat melakukan trekking menyusuri hutan sambil menyaksikan orangutan dalam habitat aslinya.</p>

<h3>3. Air Terjun Sipiso-piso</h3>
<p>Air terjun setinggi 120 meter ini terletak di Kabupaten Karo. Airnya yang jernih jatuh dari tebing curam menciptakan pemandangan yang dramatis. Lokasinya yang strategis membuatnya mudah dijangkau dari Kota Medan.</p>

<h3>4. Tangkahan - Hidden Paradise Sumatera</h3>
<p>Dijuluki sebagai "hidden paradise", Tangkahan menawarkan pengalaman wisata ekologi yang unik. Pengunjung dapat bermain dengan gajah sumatera yang sudah dijinakkan sambil menikmati keindahan sungai yang jernih.</p>

<h3>5. Pulau Rubiah - Surga Para Diver</h3>
<p>Terletak di Sabang, Pulau Rubiah menawarkan keindahan bawah laut yang memesona. Dengan terumbu karang yang masih terjaga dan biota laut yang beragam, pulau ini menjadi destinasi favorit para penyelam.</p>

<p>Setiap destinasi menawarkan pengalaman yang berbeda, mulai dari petualangan alam hingga wisata budaya. Pastikan untuk merencanakan perjalanan Anda dengan baik dan selalu menjaga kelestarian alam selama berkunjung.</p>',
                'image' => 'assets/posts/wisata-alam-medan.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kuliner Medan: 7 Makanan Khas yang Harus Dicoba Saat Berkunjung',
                'slug' => Str::slug('Kuliner Medan: 7 Makanan Khas yang Harus Dicoba Saat Berkunjung'),
                'excerpt' => 'Temukan kelezatan kuliner khas Medan yang menggugah selera, dari soto medan yang hangat hingga bika ambon yang legit.',
                'content' => '<p>Medan tidak hanya terkenal dengan destinasi wisatanya yang menakjubkan, tetapi juga dengan kekayaan kuliner yang menggugah selera. Berikut adalah 7 makanan khas Medan yang wajib Anda coba:</p>

<h3>1. Soto Medan</h3>
<p>Soto Medan memiliki cita rasa yang khas dengan kuah santan yang gurih. Berbeda dengan soto lainnya, soto Medan menggunakan santan kental dan rempah-rempah pilihan. Biasanya disajikan dengan suwiran ayam, tauge, dan perkedal.</p>

<h3>2. Bika Ambon</h3>
<p>Meski namanya "ambon", kue ini justru berasal dari Medan. Bika ambon memiliki tekstur yang unik dengan pori-pori besar dan rasa yang legit. Kue ini terbuat dari tepung tapioka, telur, dan gula dengan aroma yang harum.</p>

<h3>3. Mie Gomak</h3>
<p>Mie gomak adalah mie lidi khas Batak yang disajikan dengan bumbu andaliman. Mie ini memiliki rasa yang pedas dan gurih, biasanya disajikan dengan kuah atau digoreng.</p>

<h3>4. Durian Medan</h3>
<p>Medan terkenal dengan duriannya yang lezat. Durian Medan memiliki daging yang tebal, tekstur yang lembut, dan rasa yang manis. Durian Ucok adalah tempat legendaris untuk menikmati durian di Medan.</p>

<h3>5. Saksang</h3>
<p>Masakan khas Batak ini terbuat dari daging babi atau anjing yang dimasak dengan darah dan bumbu rempah. Rasanya kaya akan rempah dengan aroma yang kuat.</p>

<h3>6. Arsik Ikan Mas</h3>
<p>Ikan mas yang dimasak dengan bumbu kuning khas Batak. Proses memasaknya yang lama membuat bumbu meresap sempurna ke dalam daging ikan.</p>

<h3>7. Tipa-tipa</h3>
<p>Kue kering tradisional Medan yang renyah dan manis. Terbuat dari tepung beras, gula, dan santan, kue ini biasanya disajikan saat hari raya.</p>

<p>Setiap hidangan mencerminkan kekayaan budaya dan tradisi masyarakat Medan yang multietnis. Jangan lewatkan pengalaman kuliner yang tak terlupakan ini saat berkunjung ke Medan.</p>',
                'image' => 'assets/posts/kuliner-medan.png',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Festival Danau Toba 2024: Agenda dan Aktivitas yang Tidak Boleh Dilewatkan',
                'slug' => Str::slug('Festival Danau Toba 2024: Agenda dan Aktivitas yang Tidak Boleh Dilewatkan'),
                'excerpt' => 'Siap-siap untuk merayakan keindahan Danau Toba dalam festival tahunan yang penuh dengan budaya, musik, dan kuliner khas Batak.',
                'content' => '<p>Festival Danau Toba 2024 kembali digelar dengan semangat yang lebih besar. Acara tahunan ini bertujuan untuk mempromosikan keindahan Danau Toba sekaligus melestarikan budaya Batak. Berikut adalah agenda lengkap dan aktivitas yang tidak boleh Anda lewatkan:</p>

<h3>Agenda Utama Festival</h3>
<p><strong>Tanggal:</strong> 15-20 Juli 2024<br>
<strong>Lokasi:</strong> Kawasan Parapat dan Pulau Samosir</p>

<h3>1. Opening Ceremony & Karnaval Budaya (15 Juli)</h3>
<p>Pembukaan festival akan dimeriahkan dengan karnaval budaya yang menampilkan berbagai tarian tradisional Batak. Peserta dari berbagai kabupaten akan mengenakan pakaian adat yang colorful.</p>

<h3>2. Pagelaran Musik Batak (16-17 Juli)</h3>
<p>Nikmati alunan musik Batak tradisional dan modern dari musisi ternama. Gondang dan tortor akan mengiringi malam yang penuh keceriaan.</p>

<h3>3. Lomba Perahu Naga (18 Juli)</h3>
<p>Pertandingan perahu naga tradisional yang menampilkan tim-tim dari berbagai desa di sekitar Danau Toba. Lomba ini menjadi salah satu daya tarik utama festival.</p>

<h3>4. Pameran Kerajinan Tangan (15-20 Juli)</h3>
<p>Jelajahi berbagai kerajinan tangan khas Batak seperti ulos, patung, dan anyaman. Pengunjung dapat membeli souvenir autentik langsung dari pengrajin.</p>

<h3>5. Festival Kuliner Batak (15-20 Juli)</h3>
<p>Nikmati kelezatan masakan Batak seperti arsik, saksang, dan mie gomak. Ada juga demo memasak dari chef ternama.</p>

<h3>6. Tour Danau Toba (Setiap Hari)</h3>
<p>Paket tur khusus selama festival yang mengunjungi spot-spot terbaik di sekitar Danau Toba dengan harga spesial.</p>

<h3>Tips untuk Pengunjung:</h3>
<ul>
<li>Book akomodasi sejak dini karena biasanya penuh selama festival</li>
<li>Siapkan pakaian hangat karena suhu di malam hari bisa dingin</li>
<li>Bawa kamera untuk mengabadikan momen spesial</li>
<li>Pelajari beberapa frasa bahasa Batak dasar</li>
</ul>

<p>Festival Danau Toba 2024 menjanjikan pengalaman budaya yang tak terlupakan. Jangan lewatkan kesempatan untuk merasakan keramahan masyarakat Batak dan keindahan alam Danau Toba.</p>',
                'image' => 'assets/posts/festival-danau-toba.png',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Mengenal Rumah Adat Batak: Arsitektur Tradisional yang Penuh Makna',
                'slug' => Str::slug('Mengenal Rumah Adat Batak: Arsitektur Tradisional yang Penuh Makna'),
                'excerpt' => 'Jelajahi keunikan arsitektur rumah adat Batak yang tidak hanya indah tetapi juga sarat dengan filosofi dan makna kehidupan.',
                'content' => '<p>Rumah adat Batak, atau yang dikenal sebagai "Rumah Bolon", merupakan warisan budaya yang mencerminkan kearifan lokal masyarakat Batak. Setiap detail arsitekturnya memiliki makna filosofis yang dalam.</p>

<h3>Jenis-Jenis Rumah Adat Batak</h3>

<h4>1. Rumah Bolon Toba</h4>
<p>Rumah Bolon Toba memiliki bentuk seperti kapal dengan atap yang melengkung. Rumah ini biasanya berbentuk panggung dengan tiang-tiang penyangga yang tinggi. Atapnya terbuat dari ijuk dan dinding dari kayu yang diukir.</p>

<h4>2. Rumah Karo</h4>
<p>Rumah adat Karo disebut "Siwaluh Jabu" yang berarti rumah untuk delapan keluarga. Arsitekturnya lebih megah dengan ornamen yang lebih detail. Atapnya bertingkat-tingkat melambangkan status sosial.</p>

<h4>3. Rumah Simalungun</h4>
<p>Rumah Simalungun memiliki karakteristik yang lebih sederhana namun tetap mempertahankan elemen tradisional. Ornamennya didominasi oleh warna merah dan hitam.</p>

<h3>Makna Filosofis dalam Arsitektur</h3>

<h4>Bentuk Atap yang Melengkung</h4>
<p>Bentuk atap yang melengkung seperti perahu melambangkan kehidupan yang dinamis dan siap menghadapi tantangan.</p>

<h4>Tingkat Lantai</h4>
<p>Rumah berbentuk panggung dengan tiga tingkat:
<ul>
<li><strong>Bagian Bawah:</strong> Untuk hewan ternak, melambangkan hubungan dengan alam</li>
<li><strong>Bagian Tengah:</strong> Untuk manusia, sebagai pusat aktivitas</li>
<li><strong>Bagian Atas:</strong> Untuk penyimpanan, melambangkan hubungan dengan sang pencipta</li>
</ul>
</p>

<h4>Ornamen dan Warna</h4>
<p>Setiap ukiran dan warna memiliki makna khusus:
<ul>
<li><strong>Gorga (ukiran):</strong> Melambangkan perlindungan dari roh jahat</li>
<li><strong>Warna Merah:</strong> Keberanian dan kekuatan</li>
<li><strong>Warna Putih:</strong> Kesucian dan kebenaran</li>
<li><strong>Warna Hitam:</strong> Kematian dan misteri</li>
</ul>
</p>

<h3>Fungsi Sosial Rumah Adat</h3>
<p>Rumah adat Batak tidak hanya berfungsi sebagai tempat tinggal, tetapi juga sebagai:
<ul>
<li>Pusat kegiatan adat dan ritual</li>
<li>Tempat pertemuan keluarga besar</li>
<li>Sarana pendidikan nilai-nilai budaya</li>
<li>Simbol status sosial dalam masyarakat</li>
</ul>
</p>

<h3>Tempat untuk Melihat Rumah Adat Batak</h3>
<p>Beberapa tempat di Medan dan sekitarnya dimana Anda dapat melihat rumah adat Batak:
<ul>
<li>Desa Wisata Tomok, Pulau Samosir</li>
<li>Museum Batak TB Silalahi Center, Balige</li>
<li>Desa Huta Bolon, Simanindo</li>
<li>Taman Mini Indonesia Indah (replika)</li>
</ul>
</p>

<p>Rumah adat Batak merupakan bukti nyata kecerdasan arsitektur tradisional yang ramah lingkungan dan sarat makna. Melestarikannya berarti menjaga warisan budaya yang tak ternilai harganya.</p>',
                'image' => 'assets/posts/rumah-adat-batak.png',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'title' => 'Tips Berwisata ke Bukit Lawang: Panduan Lengkap untuk Pengunjung Pertama Kali',
                'slug' => Str::slug('Tips Berwisata ke Bukit Lawang: Panduan Lengkap untuk Pengunjung Pertama Kali'),
                'excerpt' => 'Persiapan yang matang membuat perjalanan ke Bukit Lawang lebih menyenangkan. Simak panduan lengkap untuk pengalaman terbaik.',
                'content' => '<p>Bukit Lawang merupakan destinasi wisata alam yang terkenal dengan pusat rehabilitasi orangutan. Bagi Anda yang pertama kali berkunjung, berikut panduan lengkap untuk memaksimalkan pengalaman wisata:</p>

<h3>Persiapan Sebelum Berangkat</h3>

<h4>1. Waktu Terbaik Berkunjung</h4>
<p>Musim kemarau (April-September) adalah waktu ideal karena cuaca cerah dan trekking lebih mudah. Hindari musim hujan karena jalur trekking bisa licin dan berbahaya.</p>

<h4>2. Perlengkapan yang Harus Dibawa</h4>
<ul>
<li>Sepatu trekking yang nyaman dan anti slip</li>
<li>Pakaian yang menyerap keringat (hindari warna mencolok)</li>
<li>Jaket tipis untuk malam hari</li>
<li>Topi dan sunblock</li>
<li>Kamera dengan lensa tele (untuk foto orangutan)</li>
<li>Power bank dan charger</li>
<li>Obat-obatan pribadi dan P3K</li>
</ul>

<h4>3. Booking Akomodasi</h4>
<p>Book homestay atau hotel minimal 2 minggu sebelumnya, terutama di weekend dan hari libur. Pilih yang dekat dengan pintu masuk Taman Nasional untuk memudahkan akses.</p>

<h3>Aktivitas yang Bisa Dilakukan</h3>

<h4>1. Trekking Melihat Orangutan</h4>
<p>Ini adalah aktivitas utama di Bukit Lawang:
<ul>
<li>Durasi: 2-4 jam (tergantung paket)</li>
<li>Waktu terbaik: Pagi hari (07.00-10.00)</li>
<li>Harus didampingi guide resmi</li>
<li>Biaya: Rp 150.000 - Rp 400.000 per orang</li>
</ul>
</p>

<h4>2. Tubing di Sungai Bohorok</h4>
<p>Berenang atau tubing di sungai yang jernih sangat menyegarkan. Sewa ban dalam atau perahu karet dari pengelola setempat.</p>

<h4>3. Jungle Night Walk</h4>
<p>Pengalaman trekking malam hari untuk melihat satwa nokturnal. Dilakukan dengan pemandu yang berpengalaman.</p>

<h4>4. Mengunjungi Batu Kapal</h4>
<p>Spot foto yang indah dengan bentuk batu yang unik seperti kapal. Lokasinya tidak jauh dari desa.</p>

<h3>Etika Berinteraksi dengan Orangutan</h3>
<ul>
<li>Jaga jarak minimal 10 meter</li>
<li>Jangan menyentuh atau memberi makan</li>
<li>Hindari flash photography</li>
<li>Jangan berisik atau membuat gerakan tiba-tiba</li>
<li>Ikuti instruksi dari pemandu</li>
</ul>

<h3>Tips Menghemat Budget</h3>
<ul>
<li>Pilih paket trekking group untuk bagi biaya guide</li>
<li>Makan di warung lokal daripada restaurant hotel</li>
<li>Sewa perlengkapan dari pengelola resmi</li>
<li>Bawa snack dan air minum sendiri</li>
<li>Gunakan transportasi umum dari Medan</li>
</ul>

<h3>Transportasi dari Medan</h3>
<p><strong>Option 1:</strong> Travel langsung dari Bandara Kualanamu (Rp 80.000/orang)<br>
<strong>Option 2:</strong> Bus dari Terminal Amplas (Rp 30.000/orang)<br>
<strong>Option 3:</strong> Sewa mobil dengan driver (Rp 500.000/hari)</p>

<h3>Akomodasi Rekomendasi</h3>
<p><strong>Budget:</strong> Jungle Inn, Green Hill<br>
<strong>Mid-range:</strong> Bukit Lawang Cottage, Eco Travel<br>
<strong>Luxury:</strong> Sam’s Bungalows, Garden Inn</p>

<p>Dengan persiapan yang matang, perjalanan ke Bukit Lawang akan menjadi pengalaman yang tak terlupakan. Selalu patuhi peraturan dan jaga kelestarian alam selama berkunjung.</p>',
                'image' => 'assets/posts/tips-bukit-lawang.png',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'title' => 'Sejarah Masjid Raya Medan: Ikon Budaya Islam yang Megah',
                'slug' => Str::slug('Sejarah Masjid Raya Medan: Ikon Budaya Islam yang Megah'),
                'excerpt' => 'Mengulik sejarah panjang Masjid Raya Medan, bangunan bersejarah yang menjadi saksi bisu perkembangan Islam di Sumatera Utara.',
                'content' => '<p>Masjid Raya Medan atau Masjid Raya Al-Mashun merupakan salah satu ikon bersejarah Kota Medan. Dibangun pada era Kesultanan Deli, masjid ini menyimpan cerita panjang tentang perkembangan Islam di Sumatera Utara.</p>

<h3>Sejarah Pembangunan</h3>

<h4>Latar Belakang</h4>
<p>Masjid Raya Medan dibangun pada tahun 1906 atas prakarsa Sultan Ma\'mun Al Rasyid Perkasa Alam, sultan ketujuh Kesultanan Deli. Pembangunannya memakan waktu 3 tahun dan selesai pada tahun 1909.</p>

<h4>Arsitek dan Gaya Arsitektur</h4>
<p>Masjid ini dirancang oleh arsitek Belanda, Van Erp, yang juga terlibat dalam pemugaran Candi Borobudur. Gaya arsitekturnya merupakan perpaduan unik antara:
<ul>
<li><strong>Gaya Mughal India:</strong> Terlihat dari kubah besar dan menara</li>
<li><strong>Gaya Timur Tengah:</strong> Pada ornamen kaligrafi dan geometris</li>
<li><strong>Gaya Eropa:</strong> Terlihat dari jendela kaca patri dan struktur bangunan</li>
<li><strong>Gaya Melayu:</strong> Pada detail ukiran dan warna</li>
</ul>
</p>

<h3>Fitur Arsitektur yang Menakjubkan</h3>

<h4>1. Kubah Utama</h4>
<p>Kubah utama berbentuk segi delapan dengan diameter 21 meter. Bagian dalam kubah dihiasi dengan kaligrafi ayat-ayat Al-Quran yang indah.</p>

<h4>2. Menara</h4>
<p>Menara setinggi 53 meter menjadi penanda lokasi masjid dari kejauhan. Dari puncak menara, pengunjung dapat melihat pemandangan Kota Medan.</p>

<h4>3. Mihrab dan Mimbar</h4>
<p>Mihrab terbuat dari marmer Italia dengan ukiran yang rumit. Mimbar kayu berukir dibuat oleh pengrajin lokal dengan teknik tradisional.</p>

<h4>4. Jendela Kaca Patri</h4>
<p>Jendela kaca patri import dari Eropa menampilkan pola geometris yang rumit. Saat sinar matahari masuk, menciptakan efek cahaya yang memukau.</p>

<h4>5. Lampu Kristal</h4>
<p>Lampu kristal besar menggantung di ruang utama shalat, menambah kesan megah dan elegan.</p>

<h3>Fungsi Sosial dan Budaya</h3>
<p>Selain sebagai tempat ibadah, Masjid Raya Medan juga berfungsi sebagai:
<ul>
<li>Pusat kegiatan keagamaan masyarakat</li>
<li>Tempat wisata religi</li>
<li>Situs warisan budaya</li>
<li>Tempat edukasi sejarah Islam</li>
<li>Venue festival budaya Islam</li>
</ul>
</p>

<h3>Restorasi dan Pemeliharaan</h3>
<p>Masjid Raya Medan telah mengalami beberapa kali restorasi:
<ul>
<li><strong>1950:</strong> Perbaikan atap dan kubah</li>
<li><strong>1979:</strong> Renovasi besar-besaran</li>
<li><strong>2000:</strong> Pemugaran menara</li>
<li><strong>2019:</strong> Restorasi kaca patri dan ornamen</li>
</ul>
</p>

<h3>Tips Berkunjung</h3>
<ul>
<li><strong>Waktu terbaik:</strong> Pagi atau sore hari untuk menghindari keramaian</li>
<li><strong>Pakaian:</strong> Gunakan pakaian yang sopan dan menutup aurat</li>
<li><strong>Fotografi:</strong> Boleh mengambil foto untuk keperluan pribadi</li>
<li><strong>Waktu shalat:</strong> Hindari berkunjung saat waktu shalat berjamaah</li>
<li><strong>Tour guide:</strong> Tersedia pemandu untuk tour sejarah</li>
</ul>

<h3>Lokasi dan Akses</h3>
<p><strong>Alamat:</strong> Jalan Sisingamangaraja, Medan<br>
<strong>Akses:</strong> Mudah dijangkau dengan taksi, ride-hailing, atau angkot<br>
<strong>Jam operasional:</strong> 24 jam (area luar), untuk turis 08.00-17.00</p>

<p>Masjid Raya Medan tidak hanya menjadi tempat ibadah, tetapi juga simbol toleransi dan kerukunan umat beragama di Medan. Keindahan arsitekturnya terus memukau pengunjung dari berbagai belahan dunia.</p>',
                'image' => 'assets/posts/masjid-raya-medan.png',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ]
        ];

        DB::table('posts')->insert($posts);
    }
}
