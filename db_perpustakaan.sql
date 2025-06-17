-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2025 pada 16.04
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(150) NOT NULL,
  `penerbit` varchar(150) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `cover` varchar(255) DEFAULT NULL COMMENT 'Nama file gambar cover',
  `sinopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `stok`, `cover`, `sinopsis`) VALUES
(99, 'Sapiens: Riwayat Singkat Umat Manusia', 'Yuval Noah Harari', 'KPG', '2018', 7, NULL, 'Sebuah penelusuran mendalam tentang sejarah umat manusia, dari zaman batu hingga revolusi kognitif dan teknologi.'),
(100, 'Atomic Habits', 'James Clear', 'Gramedia Pustaka Utama', '2019', 10, NULL, 'Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk melalui perubahan kecil yang konsisten.'),
(101, 'The Psychology of Money', 'Morgan Housel', 'Baca', '2021', 6, NULL, 'Kumpulan cerita pendek yang menjelaskan bagaimana cara orang berpikir tentang uang dan mengajarkan Anda cara membuat keputusan finansial yang lebih baik.'),
(102, 'Gadis Kretek', 'Ratih Kumala', 'Gramedia Pustaka Utama', '2012', 5, NULL, 'Kisah pencarian seorang anak yang menelusuri jejak bisnis kretek ayahnya di masa lalu, penuh dengan intrik keluarga dan sejarah industri tembakau Indonesia.'),
(103, 'Sebuah Seni untuk Bersikap Bodo Amat', 'Mark Manson', 'Grasindo', '2018', 9, NULL, 'Pendekatan yang berlawanan dengan buku motivasi biasa, mengajarkan untuk fokus pada hal-hal yang benar-benar penting dalam hidup.'),
(104, 'Home Deus: Masa Depan Umat Manusia', 'Yuval Noah Harari', 'KPG', '2018', 4, NULL, 'Sekuel dari Sapiens yang mengeksplorasi proyek-proyek, mimpi, dan mimpi buruk yang akan membentuk abad ke-21.'),
(105, 'Seperti Dendam, Rindu Harus Dibayar Tuntas', 'Eka Kurniawan', 'Gramedia Pustaka Utama', '2014', 3, NULL, 'Kisah Ajo Kawir, seorang petarung yang tidak takut mati, dengan sentuhan humor gelap dan kritik sosial.'),
(106, 'Laut Bercerita', 'Leila S. Chudori', 'KPG', '2017', 6, NULL, 'Novel yang menyuarakan kisah para aktivis yang diculik pada masa Orde Baru, dilihat dari dua sudut pandang yang berbeda.'),
(107, 'The Midnight Library', 'Matt Haig', 'Gramedia Pustaka Utama', '2021', 5, NULL, 'Kisah seorang wanita yang diberi kesempatan untuk mencoba kehidupan lain yang mungkin bisa ia jalani, menjelajahi konsep penyesalan dan pilihan.'),
(108, 'Kecamuk Darah (The Troubled Blood)', 'Robert Galbraith', 'Gramedia Pustaka Utama', '2022', 2, NULL, 'Novel kelima dalam seri Cormoran Strike, di mana detektif swasta ini menangani kasus dingin hilangnya seseorang 40 tahun yang lalu.'),
(109, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Gramedia Pustaka Utama', '2000', 8, NULL, 'Buku klasik tentang keuangan pribadi yang menantang cara pandang konvensional tentang uang dan investasi.'),
(110, 'Dunia Sophie', 'Jostein Gaarder', 'Mizan', '1996', 3, NULL, 'Sebuah novel yang juga merupakan pengantar ke dalam dunia filsafat, diceritakan melalui surat-surat misterius kepada seorang gadis remaja.'),
(111, 'How to Win Friends and Influence People', 'Dale Carnegie', 'Gramedia Pustaka Utama', '1990', 7, NULL, 'Buku klasik tentang seni berkomunikasi dan membangun hubungan interpersonal yang kuat.'),
(112, 'Thinking, Fast and Slow', 'Daniel Kahneman', 'Gramedia Pustaka Utama', '2011', 4, NULL, 'Penjelasan tentang dua sistem yang menggerakkan cara kita berpikir: sistem cepat (intuitif) dan sistem lambat (logis).'),
(113, 'Negeri Para Bedebah', 'Tere Liye', 'Gramedia Pustaka Utama', '2012', 5, NULL, 'Thriller ekonomi yang mengisahkan seorang konsultan keuangan yang harus menyelamatkan bank tempat ia bekerja dari kebangkrutan sistematis.'),
(114, 'Pulang', 'Tere Liye', 'Republika Penerbit', '2015', 6, NULL, 'Kisah seorang pemuda dari pedalaman Sumatera yang berkelana ke dunia gelap ekonomi dan kekuasaan.'),
(115, 'Aroma Karsa', 'Dee Lestari', 'Bentang Pustaka', '2018', 4, NULL, 'Petualangan Jati Wesi dalam menelusuri aroma misterius Puspa Karsa yang legendaris, membawanya ke tempat-tempat tak terduga.'),
(116, 'The 7 Habits of Highly Effective People', 'Stephen R. Covey', 'Binarupa Aksara', '1989', 9, NULL, 'Sebuah pendekatan holistik dan berprinsip untuk memecahkan masalah pribadi dan profesional.'),
(117, 'Grit: The Power of Passion and Perseverance', 'Angela Duckworth', 'Gramedia Pustaka Utama', '2016', 5, NULL, 'Buku yang menjelaskan bahwa kunci kesuksesan luar biasa bukanlah bakat, tetapi perpaduan khusus antara gairah dan ketekunan.'),
(118, 'Bicara Itu Ada Seninya', 'Oh Su Hyang', 'Bhuana Ilmu Populer', '2018', 11, NULL, 'Tips dan trik praktis untuk meningkatkan kemampuan berbicara di depan umum maupun dalam percakapan sehari-hari.'),
(119, 'Madilog', 'Tan Malaka', 'Narasi', '1943', 2, NULL, 'Sebuah karya monumental yang memperkenalkan cara berpikir Materialisme, Dialektika, dan Logika kepada bangsa Indonesia.'),
(120, 'Mindset: The New Psychology of Success', 'Carol S. Dweck', 'Read', '2006', 6, NULL, 'Penelitian tentang kekuatan mindset kita, membedakan antara fixed mindset dan growth mindset.'),
(121, 'Ayahku (Bukan) Pembohong', 'Tere Liye', 'Gramedia Pustaka Utama', '2011', 7, NULL, 'Kisah menyentuh tentang hubungan seorang anak dengan ayahnya yang selalu menceritakan dongeng-dongeng luar biasa.'),
(122, 'Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', '2009', 5, NULL, 'Kisah cinta yang unik antara Keenan, seorang pelukis, dan Kugy, seorang penulis dongeng eksentrik.'),
(123, 'Hujan', 'Tere Liye', 'Gramedia Pustaka Utama', '2016', 8, NULL, 'Novel fiksi ilmiah tentang persahabatan, cinta, dan perpisahan di dunia masa depan yang serba canggih.'),
(124, 'Why? People', 'YeaRimDang', 'Elex Media Komputindo', '2015', 12, NULL, 'Seri buku pengetahuan populer untuk anak-anak yang menjelaskan tentang tokoh-tokoh hebat dunia.'),
(125, 'Man\'s Search for Meaning', 'Viktor E. Frankl', 'Noura Books', '1946', 3, NULL, 'Refleksi seorang psikiater yang selamat dari kamp konsentrasi Nazi tentang pencarian makna hidup.'),
(126, 'Start with Why', 'Simon Sinek', 'Gramedia Pustaka Utama', '2009', 6, NULL, 'Sebuah konsep tentang bagaimana para pemimpin besar menginspirasi semua orang untuk mengambil tindakan.'),
(127, 'O', 'Eka Kurniawan', 'Gramedia Pustaka Utama', '2016', 2, NULL, 'Seekor monyet ingin menjadi manusia, sebuah kisah satir tentang cinta, ambisi, dan kekuasaan.'),
(128, '21 Lessons for the 21st Century', 'Yuval Noah Harari', 'KPG', '2018', 5, NULL, 'Membahas tantangan-tantangan terbesar yang dihadapi dunia saat ini, dari teknologi hingga politik.'),
(129, 'The Alchemist', 'Paulo Coelho', 'Gramedia Pustaka Utama', '1988', 9, NULL, 'Kisah magis seorang gembala Andalusia bernama Santiago yang melakukan perjalanan untuk mencari harta karun.'),
(130, 'Norwegian Wood', 'Haruki Murakami', 'KPG', '1987', 4, NULL, 'Kisah nostalgia tentang cinta pertama, kehilangan, dan seksualitas di Tokyo pada akhir tahun 1960-an.'),
(131, 'To Kill a Mockingbird', 'Harper Lee', 'Qanita', '1960', 3, NULL, 'Novel klasik yang membahas isu-isu serius seperti ketidaksetaraan ras dan perkosaan melalui mata seorang anak kecil.'),
(132, '1984', 'George Orwell', 'Bentang Pustaka', '1949', 4, NULL, 'Sebuah visi distopia tentang pemerintahan totaliter yang mengawasi setiap gerak-gerik warganya.'),
(133, 'The Hobbit', 'J.R.R. Tolkien', 'Gramedia Pustaka Utama', '1937', 6, NULL, 'Petualangan Bilbo Baggins, seorang hobbit yang nyaman, yang terseret ke dalam pencarian epik untuk merebut kembali harta karun.'),
(134, 'Pride and Prejudice', 'Jane Austen', 'Gramedia Pustaka Utama', '0000', 5, NULL, 'Kisah klasik tentang cinta, reputasi, dan kelas sosial di Inggris pada awal abad ke-19.'),
(135, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Odyssey', '1925', 3, NULL, 'Kisah tentang seorang jutawan misterius, Jay Gatsby, dan obsesinya terhadap seorang wanita muda yang sudah menikah.'),
(136, 'One Hundred Years of Solitude', 'Gabriel Garcia Marquez', 'Gramedia Pustaka Utama', '1967', 2, NULL, 'Kisah multi-generasi dari keluarga Buendía, di mana keajaiban dan kenyataan saling terkait.'),
(137, 'Blink: The Power of Thinking Without Thinking', 'Malcolm Gladwell', 'Gramedia Pustaka Utama', '2005', 6, NULL, 'Buku yang merevolusi cara kita memahami dunia di balik pintu yang terkunci.'),
(138, 'The Power of Now', 'Eckhart Tolle', 'BACA', '1997', 8, NULL, 'Panduan spiritual untuk menemukan kedamaian dan kebahagiaan dengan hidup sepenuhnya di saat ini.'),
(139, 'Educated: A Memoir', 'Tara Westover', 'Gramedia Pustaka Utama', '2018', 4, NULL, 'Memoar yang menginspirasi tentang seorang wanita muda yang, setelah tumbuh dalam keluarga survivalis, memutuskan untuk mengejar pendidikan.'),
(140, 'Becoming', 'Michelle Obama', 'Noura Books', '2018', 5, NULL, 'Memoar mantan Ibu Negara Amerika Serikat, Michelle Obama, yang menceritakan perjalanannya dari South Side Chicago ke Gedung Putih.'),
(141, 'Zero to One', 'Peter Thiel', 'Gramedia Pustaka Utama', '2014', 6, NULL, 'Catatan tentang startup, atau cara membangun masa depan, dari seorang pengusaha dan investor legendaris.'),
(142, 'The Lean Startup', 'Eric Ries', 'Mizan', '2011', 7, NULL, 'Metodologi untuk mengembangkan bisnis dan produk baru dengan lebih efisien.'),
(143, 'Si Anak Cahaya', 'Tere Liye', 'Sabak Grip', '2018', 5, NULL, 'Bagian dari serial Anak Nusantara, menceritakan petualangan masa kecil yang penuh imajinasi dan kearifan lokal.'),
(144, 'Dilan: Dia adalah Dilanku Tahun 1990', 'Pidi Baiq', 'Pastel Books', '2014', 15, NULL, 'Kisah cinta remaja antara Dilan dan Milea di Bandung pada tahun 1990 dengan gaya bahasa yang unik.'),
(145, 'Lelaki Harimau', 'Eka Kurniawan', 'Gramedia Pustaka Utama', '2004', 5, NULL, 'Kisah Margio, seorang pemuda yang percaya ada harimau putih di dalam tubuhnya, dalam sebuah narasi yang kelam dan magis.'),
(146, 'Critical Eleven', 'Ika Natassa', 'Gramedia Pustaka Utama', '2015', 8, NULL, 'Kisah tentang Ale dan Anya, pasangan yang diuji oleh tragedi, berpusat pada 11 menit kritis dalam penerbangan.'),
(147, 'Komet', 'Tere Liye', 'Gramedia Pustaka Utama', '2018', 7, NULL, 'Bagian dari serial Bumi yang melanjutkan petualangan Raib, Seli, dan Ali di dunia paralel.'),
(148, 'Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'Dee Lestari', 'Truedee Books', '2001', 6, NULL, 'Novel pertama dari seri Supernova yang menggabungkan sains, spiritualitas, dan kisah cinta modern.'),
(149, 'The Lord of the Rings', 'J.R.R. Tolkien', 'Gramedia Pustaka Utama', '1954', 5, NULL, 'Karya fantasi epik tentang perjuangan melawan kekuatan gelap Sauron untuk menghancurkan Cincin Utama.'),
(150, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Gramedia Pustaka Utama', '1997', 18, NULL, 'Awal mula kisah Harry Potter, seorang anak laki-laki yang menemukan bahwa dia adalah seorang penyihir dan masuk ke sekolah sihir Hogwarts.'),
(151, 'The Da Vinci Code', 'Dan Brown', 'Serambi Ilmu Semesta', '2003', 7, NULL, 'Thriller konspirasi yang mengikuti simbolog Robert Langdon saat ia mengungkap rahasia tersembunyi dalam karya Leonardo da Vinci.'),
(152, 'A Brief History of Time', 'Stephen Hawking', 'Pustaka Alvabet', '1988', 4, NULL, 'Buku yang menjelaskan konsep-konsep kompleks dalam kosmologi, dari Big Bang hingga lubang hitam, dengan cara yang dapat diakses.'),
(153, 'Cosmos', 'Carl Sagan', 'KPG', '1980', 3, NULL, 'Sebuah eksplorasi luas tentang alam semesta dan tempat kita di dalamnya, dari seorang astronom dan komunikator sains legendaris.'),
(154, 'Outliers: The Story of Success', 'Malcolm Gladwell', 'Gramedia Pustaka Utama', '2008', 6, NULL, 'Buku yang meneliti faktor-faktor yang berkontribusi pada kesuksesan tingkat tinggi, dari budaya hingga keberuntungan.'),
(155, 'Ikigai: The Japanese Secret to a Long and Happy Life', 'Héctor García & Francesc Miralles', 'Renebook', '2016', 9, NULL, 'Menjelajahi konsep Jepang tentang menemukan tujuan hidup atau alasan untuk bangun di pagi hari.'),
(156, 'Siddhartha', 'Hermann Hesse', 'Bentang Pustaka', '1922', 4, NULL, 'Perjalanan spiritual seorang pria India selama masa Sang Buddha.'),
(157, 'Crime and Punishment', 'Fyodor Dostoevsky', 'Penerbit Independen', '0000', 3, NULL, 'Novel psikologis tentang dilema moral seorang mahasiswa miskin yang melakukan pembunuhan.'),
(158, 'The Catcher in the Rye', 'J.D. Salinger', 'Bananafish', '1951', 5, NULL, 'Kisah tentang beberapa hari dalam kehidupan Holden Caulfield yang berusia 16 tahun setelah ia dikeluarkan dari sekolah.'),
(159, 'Fahrenheit 451', 'Ray Bradbury', 'Gramedia Pustaka Utama', '1953', 4, NULL, 'Novel distopia tentang masa depan di mana buku dilarang dan \"petugas pemadam kebakaran\" membakar buku apa pun yang ditemukan.'),
(160, 'Brave New World', 'Aldous Huxley', 'Gramedia Pustaka Utama', '1932', 4, NULL, 'Visi tentang masyarakat masa depan yang direkayasa secara genetik dan dikondisikan secara psikologis.'),
(161, 'Animal Farm', 'George Orwell', 'KPG', '1945', 6, NULL, 'Sebuah alegori tentang Revolusi Rusia dan kebangkitan Stalinisme, diceritakan melalui sekelompok hewan ternak.'),
(162, 'The Little Prince', 'Antoine de Saint-Exupéry', 'Gramedia Pustaka Utama', '1943', 10, NULL, 'Kisah puitis tentang seorang pangeran kecil yang mengunjungi berbagai planet, penuh dengan observasi tentang kehidupan dan sifat manusia.'),
(163, 'Deep Work', 'Cal Newport', 'Baca', '2016', 7, NULL, 'Aturan untuk kesuksesan yang terfokus di dunia yang terdistraksi, menekankan pentingnya kemampuan untuk berkonsentrasi tanpa gangguan.'),
(164, 'Essentialism: The Disciplined Pursuit of Less', 'Greg McKeown', 'Gramedia Pustaka Utama', '2014', 6, NULL, 'Sebuah gerakan untuk melakukan lebih sedikit, tetapi lebih baik, sehingga kita dapat membuat kontribusi tertinggi kita.'),
(165, 'Freakonomics', 'Steven D. Levitt & Stephen J. Dubner', 'Gramedia Pustaka Utama', '2005', 5, NULL, 'Seorang ekonom nakal menjelajahi sisi tersembunyi dari segala sesuatu, menerapkan teori ekonomi pada subjek yang beragam.'),
(166, 'Kitchen Confidential', 'Anthony Bourdain', 'Juniper', '2000', 3, NULL, 'Pandangan di balik layar yang jujur dan blak-blakan tentang kehidupan di dapur restoran.'),
(167, 'On Writing: A Memoir of the Craft', 'Stephen King', 'Scribner', '2000', 4, NULL, 'Bagian memoar, bagian kelas master dari salah satu penulis paling sukses sepanjang masa.'),
(168, 'The Diary of a Young Girl', 'Anne Frank', 'Pustaka Jaya', '1947', 8, NULL, 'Buku harian seorang gadis Yahudi yang bersembunyi bersama keluarganya selama pendudukan Nazi di Belanda.'),
(169, 'Steve Jobs', 'Walter Isaacson', 'Bentang Pustaka', '2011', 4, NULL, 'Biografi berdasarkan lebih dari empat puluh wawancara dengan Jobs serta lebih dari seratus wawancara dengan teman, musuh, pesaing, dan kolega.'),
(170, 'Elon Musk: Tesla, SpaceX, and the Quest for a Fantastic Future', 'Ashlee Vance', 'Gramedia Pustaka Utama', '2015', 5, NULL, 'Pandangan mendalam tentang kehidupan dan pikiran salah satu pengusaha paling berani di Silicon Valley.'),
(171, 'A Man Called Ove', 'Fredrik Backman', 'Noura Books', '2012', 6, NULL, 'Kisah yang menawan dan mengharukan tentang seorang duda pemarah yang persahabatan tak terduga mengubah dunianya.'),
(172, 'The Girl on the Train', 'Paula Hawkins', 'Noura Books', '2015', 5, NULL, 'Thriller psikologis tentang seorang wanita yang menyaksikan sesuatu yang mengejutkan selama perjalanan hariannya.'),
(173, 'Gone Girl', 'Gillian Flynn', 'Gramedia Pustaka Utama', '2012', 4, NULL, 'Thriller menegangkan tentang seorang wanita yang menghilang pada ulang tahun pernikahannya yang kelima.'),
(174, 'All the Light We Cannot See', 'Anthony Doerr', 'Qanita', '2014', 3, NULL, 'Kisah yang sangat indah tentang seorang gadis Prancis buta dan seorang anak laki-laki Jerman yang jalannya bertemu di Prancis yang diduduki saat mereka berdua mencoba bertahan dari kehancuran Perang Dunia II.'),
(175, 'The Nightingale', 'Kristin Hannah', 'Gramedia Pustaka Utama', '2015', 5, NULL, 'Kisah dua saudara perempuan di Prancis selama Perang Dunia II dan perjuangan mereka untuk bertahan hidup dan melawan.'),
(176, 'Pachinko', 'Min Jin Lee', 'Gramedia Pustaka Utama', '2017', 4, NULL, 'Sebuah saga epik tentang sebuah keluarga Korea yang berimigrasi ke Jepang, diceritakan selama beberapa generasi.'),
(177, 'Circe', 'Madeline Miller', 'Noura Books', '2018', 5, NULL, 'Penceritaan kembali mitos Yunani tentang Circe, seorang dewi sihir, dari sudut pandangnya sendiri.'),
(178, 'Dune', 'Frank Herbert', 'KPG', '1965', 5, NULL, 'Di planet gurun Arrakis, perebutan rempah-rempah melahirkan pahlawan mesianik.'),
(179, 'The Martian', 'Andy Weir', 'Gramedia Pustaka Utama', '2011', 8, NULL, 'Seorang astronot yang terdampar di Mars harus menggunakan kecerdikannya untuk bertahan hidup.'),
(180, 'Project Hail Mary', 'Andy Weir', 'Noura Books', '2021', 6, NULL, 'Seorang guru sains terbangun di kapal luar angkasa tanpa ingatan, dengan tugas menyelamatkan Bumi.'),
(181, 'Klara and the Sun', 'Kazuo Ishiguro', 'Bentang Pustaka', '2021', 4, NULL, 'Kisah seorang Teman Buatan (Artificial Friend) yang mengamati dunia manusia dengan harapan dan kesedihan.'),
(182, 'The Song of Achilles', 'Madeline Miller', 'Qanita', '2011', 7, NULL, 'Penceritaan kembali mitos Achilles dan Patroclus dari sudut pandang Patroclus.'),
(183, 'Where the Crawdads Sing', 'Delia Owens', 'Gramedia Pustaka Utama', '2018', 9, NULL, 'Kisah seorang gadis yang tumbuh terisolasi di rawa-rawa Carolina Utara dan terlibat dalam penyelidikan pembunuhan.'),
(184, 'The Silent Patient', 'Alex Michaelides', 'Elex Media Komputindo', '2019', 6, NULL, 'Seorang psikoterapis menjadi terobsesi dengan pasiennya yang bisu setelah dituduh membunuh suaminya.'),
(185, 'The Seven Husbands of Evelyn Hugo', 'Taylor Jenkins Reid', 'Gramedia Pustaka Utama', '2017', 10, NULL, 'Seorang ikon Hollywood yang menua menceritakan kisah hidupnya yang glamor dan penuh skandal kepada seorang reporter muda.'),
(186, 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Gramedia Pustaka Utama', '1982', 5, NULL, 'Trilogi yang mengisahkan kehidupan seorang penari ronggeng di sebuah desa kecil yang terisolasi.'),
(187, 'Burung-Burung Manyar', 'Y.B. Mangunwijaya', 'Djambatan', '1981', 4, NULL, 'Kisah tentang identitas dan sejarah Indonesia melalui kehidupan seorang tokoh yang kompleks.'),
(188, 'Atheis', 'Achdiat K. Mihardja', 'Balai Pustaka', '1949', 3, NULL, 'Konflik batin seorang pemuda yang dibesarkan dalam keluarga religius tetapi terpapar pada pemikiran modern.'),
(189, 'Salah Asuhan', 'Abdoel Moeis', 'Balai Pustaka', '1928', 4, NULL, 'Kisah tragis tentang seorang pemuda Minangkabau yang mencoba hidup sebagai orang Eropa.'),
(190, 'Sitti Nurbaya', 'Marah Rusli', 'Balai Pustaka', '1922', 6, NULL, 'Novel klasik tentang kawin paksa dan perjuangan melawan adat di Minangkabau.'),
(191, 'Tenggelamnya Kapal Van der Wijck', 'Hamka', 'Nusantara', '1938', 7, NULL, 'Kisah cinta tragis antara Zainuddin dan Hayati yang terhalang oleh perbedaan adat dan status sosial.'),
(192, 'Musashi', 'Eiji Yoshikawa', 'Gramedia Pustaka Utama', '1935', 3, NULL, 'Novel epik tentang kehidupan Miyamoto Musashi, samurai paling terkenal di Jepang.'),
(193, 'The Three-Body Problem', 'Cixin Liu', 'Gramedia Pustaka Utama', '2008', 5, NULL, 'Kontak pertama umat manusia dengan peradaban alien memicu perpecahan dan konspirasi global.'),
(194, 'Foundation', 'Isaac Asimov', 'KPG', '1951', 6, NULL, 'Kisah jatuhnya Kekaisaran Galaksi dan upaya sekelompok ilmuwan untuk melestarikan pengetahuan manusia.'),
(195, 'Ender\'s Game', 'Orson Scott Card', 'Mizan Fantasi', '1985', 8, NULL, 'Seorang anak jenius direkrut untuk sekolah pertempuran canggih untuk mempersiapkan invasi alien di masa depan.'),
(196, 'Flowers for Algernon', 'Daniel Keyes', 'Ufuk Press', '1959', 5, NULL, 'Kisah menyentuh seorang pria dengan keterbelakangan mental yang menjalani operasi eksperimental untuk meningkatkan kecerdasannya.'),
(197, 'Slaughterhouse-Five', 'Kurt Vonnegut', 'Serambi Ilmu Semesta', '1969', 4, NULL, 'Novel anti-perang satir yang menceritakan pengalaman seorang prajurit Amerika selama pengeboman Dresden.'),
(198, 'The Name of the Wind', 'Patrick Rothfuss', 'Qanita', '2007', 7, NULL, 'Awal dari kisah Kvothe, seorang penyihir, musisi, dan petualang legendaris.'),
(199, 'Mistborn: The Final Empire', 'Brandon Sanderson', 'Mizan Fantasi', '2006', 9, NULL, 'Di dunia di mana abu jatuh dari langit, sekelompok pemberontak mencoba menggulingkan seorang tiran abadi.'),
(200, 'American Gods', 'Neil Gaiman', 'Gramedia Pustaka Utama', '2001', 6, NULL, 'Perang antara dewa-dewa lama dari mitologi dan dewa-dewa baru dari teknologi dan media modern.'),
(201, 'Good Omens', 'Neil Gaiman & Terry Pratchett', 'Ufuk Press', '1990', 8, NULL, 'Seorang malaikat dan iblis yang telah hidup di Bumi sejak awal bekerja sama untuk mencegah kiamat.'),
(202, 'Guns, Germs, and Steel', 'Jared Diamond', 'KPG', '1997', 5, NULL, 'Sebuah eksplorasi tentang mengapa peradaban Eurasia menaklukkan, mengusir, atau memusnahkan peradaban lain.'),
(203, 'A Short History of Nearly Everything', 'Bill Bryson', 'Gramedia Pustaka Utama', '2003', 7, NULL, 'Perjalanan yang menghibur dan informatif melalui sejarah sains, dari Big Bang hingga kebangkitan peradaban.'),
(204, 'The Man Who Mistook His Wife for a Hat', 'Oliver Sacks', 'Serambi Ilmu Semesta', '1985', 4, NULL, 'Studi kasus klinis tentang pasien yang berjuang dengan gangguan neurologis.'),
(205, 'The Immortal Life of Henrietta Lacks', 'Rebecca Skloot', 'Gramedia Pustaka Utama', '2010', 6, NULL, 'Kisah seorang wanita kulit hitam yang sel-sel kankernya menjadi salah satu alat terpenting dalam kedokteran.'),
(206, 'Why We Sleep', 'Matthew Walker', 'Gramedia Pustaka Utama', '2017', 8, NULL, 'Eksplorasi tentang mengapa tidur sangat penting untuk kesehatan fisik dan mental kita.'),
(207, 'Bad Blood: Secrets and Lies in a Silicon Valley Startup', 'John Carreyrou', 'KPG', '2018', 5, NULL, 'Kisah nyata naik turunnya Theranos, sebuah startup bioteknologi bernilai miliaran dolar yang didirikan di atas penipuan.'),
(208, 'Catch-22', 'Joseph Heller', 'Penerbit Independen', '1961', 4, NULL, 'Novel satir tentang absurditas perang dan birokrasi militer.'),
(209, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Gramedia Pustaka Utama', '1979', 10, NULL, 'Petualangan lucu seorang pria Inggris yang malang setelah penghancuran Bumi.'),
(210, 'The Handmaid\'s Tale', 'Margaret Atwood', 'Gramedia Pustaka Utama', '1985', 6, NULL, 'Sebuah novel distopia tentang masyarakat teokratis di mana wanita dipaksa menjadi selir.'),
(211, 'The Road', 'Cormac McCarthy', 'Bentang Pustaka', '2006', 4, NULL, 'Perjalanan seorang ayah dan anak melintasi lanskap pasca-apokaliptik yang sunyi.'),
(212, 'Of Mice and Men', 'John Steinbeck', 'Penerbit Independen', '1937', 7, NULL, 'Kisah dua pekerja migran yang pindah dari peternakan ke peternakan untuk mencari pekerjaan selama Depresi Hebat.'),
(213, 'War and Peace', 'Leo Tolstoy', 'KPG', '0000', 3, NULL, 'Novel epik yang menceritakan dampak invasi Prancis ke Rusia terhadap lima keluarga bangsawan.'),
(214, 'Anna Karenina', 'Leo Tolstoy', 'Gramedia Pustaka Utama', '0000', 4, NULL, 'Kisah seorang wanita bangsawan yang sudah menikah dan berselingkuh dengan seorang perwira kaya.'),
(215, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 'Gramedia Pustaka Utama', '0000', 3, NULL, 'Novel filosofis yang membahas perdebatan tentang Tuhan, kehendak bebas, dan moralitas.'),
(216, 'Lolita', 'Vladimir Nabokov', 'Serambi Ilmu Semesta', '1955', 3, NULL, 'Kisah kontroversial seorang profesor sastra paruh baya yang menjadi terobsesi dengan seorang gadis berusia 12 tahun.'),
(217, 'Ulysses', 'James Joyce', 'Penerbit Independen', '1922', 2, NULL, 'Novel modernis yang menceritakan pengalaman biasa Leopold Bloom di Dublin dalam satu hari.'),
(218, 'Mrs Dalloway', 'Virginia Woolf', 'Penerbit Independen', '1925', 4, NULL, 'Novel yang merinci satu hari dalam kehidupan Clarissa Dalloway, seorang wanita bangsawan di Inggris pasca-Perang Dunia I.'),
(219, 'Beloved', 'Toni Morrison', 'Serambi Ilmu Semesta', '1987', 5, NULL, 'Kisah seorang budak yang dihantui oleh masa lalunya setelah Perang Saudara Amerika.'),
(220, 'Invisible Man', 'Ralph Ellison', 'Penerbit Independen', '1952', 4, NULL, 'Novel tentang seorang pria Afrika-Amerika yang identitas sosialnya tidak terlihat.'),
(221, 'Go Tell It on the Mountain', 'James Baldwin', 'Penerbit Independen', '1953', 4, NULL, 'Novel semi-otobiografi tentang seorang remaja di Harlem tahun 1930-an dan hubungannya dengan keluarga dan gereja.'),
(222, 'Between the World and Me', 'Ta-Nehisi Coates', 'Mizan', '2015', 6, NULL, 'Sebuah buku yang ditulis sebagai surat kepada putra remaja penulis tentang perasaan, simbolisme, dan realitas yang terkait dengan menjadi orang kulit hitam di Amerika Serikat.'),
(223, 'Caste: The Origins of Our Discontents', 'Isabel Wilkerson', 'Gramedia Pustaka Utama', '2020', 5, NULL, 'Sebuah eksplorasi tentang bagaimana Amerika saat ini telah dibentuk oleh sistem kasta tersembunyi.'),
(224, 'Team of Rivals: The Political Genius of Abraham Lincoln', 'Doris Kearns Goodwin', 'Penerbit Independen', '2005', 4, NULL, 'Biografi tentang bagaimana Abraham Lincoln naik ke kursi kepresidenan dan membentuk kabinetnya dengan saingan politiknya.'),
(225, 'Alexander Hamilton', 'Ron Chernow', 'Penerbit Independen', '2004', 4, NULL, 'Biografi komprehensif tentang salah satu Bapak Pendiri Amerika Serikat.'),
(226, 'Leonardo da Vinci', 'Walter Isaacson', 'Bentang Pustaka', '2017', 6, NULL, 'Biografi yang menghubungkan seni Leonardo dengan sainsnya, berdasarkan ribuan halaman dari buku catatannya.'),
(227, 'Shoe Dog: A Memoir by the Creator of Nike', 'Phil Knight', 'Gramedia Pustaka Utama', '2016', 9, NULL, 'Memoar tentang bagaimana Phil Knight membangun Nike dari sebuah startup kecil menjadi salah satu merek paling ikonik di dunia.'),
(228, 'When Breath Becomes Air', 'Paul Kalanithi', 'Gramedia Pustaka Utama', '2016', 7, NULL, 'Memoar seorang ahli bedah saraf yang didiagnosis menderita kanker paru-paru stadium IV pada usia 36 tahun.'),
(229, 'Just Mercy', 'Bryan Stevenson', 'Gramedia Pustaka Utama', '2014', 5, NULL, 'Kisah nyata seorang pengacara muda yang mendirikan Equal Justice Initiative, sebuah praktik hukum yang didedikasikan untuk membela mereka yang paling membutuhkan.'),
(230, 'The Glass Castle', 'Jeannette Walls', 'Gramedia Pustaka Utama', '2005', 6, NULL, 'Memoar tentang masa kecil penulis yang tidak konvensional dan miskin di tangan orang tua yang sangat tidak berfungsi.'),
(231, 'The Subtle Art of Not Giving a F*ck', 'Mark Manson', 'Grasindo', '2016', 12, NULL, 'Buku ini berpendapat bahwa kita harus merangkul perjuangan hidup dan memilih apa yang benar-benar penting.'),
(232, 'The Tipping Point', 'Malcolm Gladwell', 'Gramedia Pustaka Utama', '2000', 7, NULL, 'Bagaimana hal-hal kecil dapat membuat perbedaan besar, menjelajahi bagaimana ide-ide menyebar seperti epidemi.'),
(233, 'Nudge', 'Richard H. Thaler & Cass R. Sunstein', 'Gramedia Pustaka Utama', '2008', 6, NULL, 'Meningkatkan keputusan tentang kesehatan, kekayaan, dan kebahagiaan dengan menggunakan ekonomi perilaku.'),
(234, 'Influence: The Psychology of Persuasion', 'Robert B. Cialdini', 'Gramedia Pustaka Utama', '1984', 8, NULL, 'Buku tentang psikologi kepatuhan, yang menjelaskan enam prinsip persuasi universal.'),
(235, 'Stolen Focus', 'Johann Hari', 'Bentang Pustaka', '2022', 5, NULL, 'Penyelidikan mendalam mengapa kita kehilangan kemampuan untuk memperhatikan dan bagaimana cara mendapatkannya kembali.'),
(236, 'Kite Runner', 'Khaled Hosseini', 'Qanita', '2003', 9, NULL, 'Kisah persahabatan, pengkhianatan, dan penebusan yang berlatar belakang Afghanistan yang bergejolak.'),
(237, 'A Thousand Splendid Suns', 'Khaled Hosseini', 'Qanita', '2007', 8, NULL, 'Kisah dua generasi karakter yang disatukan oleh perang dahsyat di Afghanistan.'),
(238, 'The Book Thief', 'Markus Zusak', 'Mizan Fantasi', '2005', 7, NULL, 'Diceritakan oleh Kematian, kisah seorang gadis muda di Jerman Nazi yang mencuri buku untuk dibagikan kepada orang lain.'),
(239, 'Eat, Pray, Love', 'Elizabeth Gilbert', 'Gramedia Pustaka Utama', '2006', 6, NULL, 'Memoar tentang pencarian penulis untuk penemuan diri setelah perceraian yang sulit.'),
(240, 'Wild: From Lost to Found on the Pacific Crest Trail', 'Cheryl Strayed', 'Gramedia Pustaka Utama', '2012', 5, NULL, 'Memoar tentang perjalanan solo seorang wanita sejauh 1.100 mil di Pacific Crest Trail setelah serangkaian tragedi pribadi.'),
(241, 'Into the Wild', 'Jon Krakauer', 'Gramedia Pustaka Utama', '1996', 6, NULL, 'Kisah nyata Christopher McCandless, seorang pria muda yang meninggalkan peradabannya untuk hidup di padang gurun Alaska.'),
(242, 'Into Thin Air', 'Jon Krakauer', 'Gramedia Pustaka Utama', '1997', 5, NULL, 'Laporan orang pertama tentang bencana Everest tahun 1996.'),
(243, 'The Perfect Storm', 'Sebastian Junger', 'Penerbit Independen', '1997', 4, NULL, 'Kisah nyata tentang para nelayan komersial yang hilang di laut selama Badai Sempurna tahun 1991.'),
(244, 'Moneyball: The Art of Winning an Unfair Game', 'Michael Lewis', 'Penerbit Independen', '2003', 5, NULL, 'Kisah tentang bagaimana tim bisbol Oakland Athletics yang miskin menggunakan analisis statistik untuk bersaing dengan tim yang lebih kaya.'),
(245, 'The Big Short: Inside the Doomsday Machine', 'Michael Lewis', 'Penerbit Independen', '2010', 5, NULL, 'Kisah tentang beberapa investor yang cerdas yang melihat keruntuhan pasar perumahan yang akan datang dan bertaruh melawannya.'),
(246, 'Liar\'s Poker', 'Michael Lewis', 'Penerbit Independen', '1989', 4, NULL, 'Memoar tentang pengalaman penulis sebagai pedagang obligasi di Salomon Brothers pada 1980-an.'),
(247, 'Barbarians at the Gate', 'Bryan Burrough & John Helyar', 'Penerbit Independen', '1990', 4, NULL, 'Kisah pengambilalihan RJR Nabisco dengan leverage.'),
(248, 'The Smartest Guys in the Room', 'Bethany McLean & Peter Elkind', 'Penerbit Independen', '2003', 4, NULL, 'Kisah kebangkitan dan kejatuhan spektakuler Enron.'),
(249, 'Den of Thieves', 'James B. Stewart', 'Penerbit Independen', '1991', 4, NULL, 'Kisah skandal perdagangan orang dalam yang mengguncang Wall Street pada 1980-an.'),
(250, 'Red Notice', 'Bill Browder', 'Penerbit Independen', '2015', 5, NULL, 'Kisah nyata tentang bagaimana seorang manajer dana lindung nilai Amerika menjadi musuh bebuyutan Vladimir Putin.'),
(251, 'The Sixth Extinction: An Unnatural History', 'Elizabeth Kolbert', 'Gramedia Pustaka Utama', '2014', 4, NULL, 'Laporan tentang kepunahan massal keenam yang sedang berlangsung, yang disebabkan oleh manusia.'),
(252, 'The Gene: An Intimate History', 'Siddhartha Mukherjee', 'Gramedia Pustaka Utama', '2016', 5, NULL, 'Sejarah gen dan genetika, dari Mendel hingga CRISPR.'),
(253, 'The Emperor\'s New Mind', 'Roger Penrose', 'Penerbit Independen', '1989', 3, NULL, 'Buku tentang kesadaran dan hubungannya dengan fisika kuantum.'),
(254, 'Gödel, Escher, Bach: an Eternal Golden Braid', 'Douglas Hofstadter', 'Penerbit Independen', '1979', 3, NULL, 'Sebuah eksplorasi tentang kesadaran, kecerdasan, dan sistem formal.'),
(255, 'The Selfish Gene', 'Richard Dawkins', 'KPG', '1976', 5, NULL, 'Buku tentang evolusi yang memperkenalkan konsep gen egois.'),
(256, 'The Blind Watchmaker', 'Richard Dawkins', 'KPG', '1986', 5, NULL, 'Argumen menentang kritik kreasionis terhadap seleksi alam.'),
(257, 'The God Delusion', 'Richard Dawkins', 'Penerbit Independen', '2006', 6, NULL, 'Argumen menentang keberadaan Tuhan.'),
(258, 'A Devil\'s Chaplain', 'Richard Dawkins', 'Penerbit Independen', '2003', 4, NULL, 'Kumpulan esai dan tulisan lain oleh Richard Dawkins.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','kembali') NOT NULL,
  `denda` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `id_user`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `tanggal_kembali`, `status`, `denda`) VALUES
(3, 128, 2, '2025-06-17', NULL, '2025-06-17', 'kembali', 0),
(4, 225, 2, '2025-06-17', NULL, '2025-06-17', 'kembali', 0),
(5, 118, 2, '2025-06-17', NULL, '2025-06-17', 'kembali', 0),
(6, 132, 2, '2025-06-17', '2025-06-18', '2025-06-17', 'kembali', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `role` enum('admin','anggota') NOT NULL DEFAULT 'anggota',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `alamat`, `no_telepon`, `role`, `created_at`) VALUES
(1, 'admin', 'password', 'Administrator', NULL, NULL, 'admin', '2025-06-17 13:23:18'),
(2, 'budi', 'budi123', 'Budi Santoso', NULL, NULL, 'anggota', '2025-06-17 13:23:18'),
(3, 'citra', 'citra123', 'Citra Lestari', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'anggota', '2025-06-17 13:45:54'),
(4, 'dewi', 'dewi123', 'Dewi Anggraini', 'Jl. Sudirman Kav. 5, Bandung', '081234567891', 'anggota', '2025-06-17 13:45:54'),
(5, 'eko', 'eko123', 'Eko Prasetyo', 'Jl. Pahlawan No. 15, Surabaya', '081234567892', 'anggota', '2025-06-17 13:45:54'),
(6, 'fitri', 'fitri123', 'Fitriani Hartono', 'Jl. Gajah Mada No. 20, Semarang', '081234567893', 'anggota', '2025-06-17 13:45:54'),
(7, 'gunawan', 'gunawan123', 'Gunawan Wibisono', 'Jl. Diponegoro No. 25, Yogyakarta', '081234567894', 'anggota', '2025-06-17 13:45:54'),
(8, 'herman', 'herman123', 'Herman Susanto', 'Jl. Ahmad Yani No. 30, Medan', '081234567895', 'anggota', '2025-06-17 13:45:54'),
(9, 'indah', 'indah123', 'Indah Permatasari', 'Jl. Gatot Subroto No. 35, Makassar', '081234567896', 'anggota', '2025-06-17 13:45:54'),
(10, 'joni', 'joni123', 'Joni Iskandar', 'Jl. Imam Bonjol No. 40, Palembang', '081234567897', 'anggota', '2025-06-17 13:45:54'),
(11, 'kartika', 'kartika123', 'Kartika Chandra', 'Jl. Teuku Umar No. 45, Denpasar', '081234567898', 'anggota', '2025-06-17 13:45:54'),
(12, 'lukman', 'lukman123', 'Lukman Hakim', 'Jl. Hasanuddin No. 50, Banjarmasin', '081234567899', 'anggota', '2025-06-17 13:45:54'),
(13, 'maya', 'maya123', 'Maya Sari', 'Jl. Pattimura No. 55, Manado', '081345678900', 'anggota', '2025-06-17 13:45:54'),
(14, 'nina', 'nina123', 'Nina Marlina', 'Jl. Sisingamangaraja No. 60, Pekanbaru', '081345678901', 'anggota', '2025-06-17 13:45:54'),
(15, 'oki', 'oki123', 'Oki Setiawan', 'Jl. WR Supratman No. 65, Padang', '081345678902', 'anggota', '2025-06-17 13:45:54'),
(16, 'putri', 'putri123', 'Putri Ayu', 'Jl. Jenderal Sudirman No. 70, Balikpapan', '081345678903', 'anggota', '2025-06-17 13:45:54'),
(17, 'rahmat', 'rahmat123', 'Rahmat Hidayat', 'Jl. Urip Sumoharjo No. 75, Pontianak', '081345678904', 'anggota', '2025-06-17 13:45:54'),
(18, 'sari', 'sari123', 'Sari Novita', 'Jl. Sam Ratulangi No. 80, Jayapura', '081345678905', 'anggota', '2025-06-17 13:45:54'),
(19, 'Tono', 'tono123', 'Tono Martono', 'Jl. Veteran No. 85, Ambon', '081345678906', 'anggota', '2025-06-17 13:45:54'),
(20, 'Umar', 'umar123', 'Umar Abdullah', 'Jl. Perintis Kemerdekaan No. 90, Mataram', '081345678907', 'anggota', '2025-06-17 13:45:54'),
(21, 'Vina', 'vina123', 'Vina Panduwinata', 'Jl. Cendrawasih No. 95, Kupang', '081345678908', 'anggota', '2025-06-17 13:45:54'),
(22, 'Wati', 'wati123', 'Wati Susilawati', 'Jl. Melati No. 100, Bengkulu', '081345678909', 'anggota', '2025-06-17 13:45:54'),
(23, 'Yanto', 'yanto123', 'Yanto Basna', 'Jl. Anggrek No. 105, Gorontalo', '081345678910', 'anggota', '2025-06-17 13:45:54'),
(24, 'Zaki', 'zaki123', 'Zaki Mubarok', 'Jl. Mawar No. 110, Palu', '081345678911', 'anggota', '2025-06-17 13:45:54'),
(25, 'adi', 'adi123', 'Adi Nugroho', 'Jl. Kenanga No. 12, Kendari', '081345678912', 'anggota', '2025-06-17 13:45:54'),
(26, 'bella', 'bella123', 'Bella Swan', 'Jl. Kamboja No. 14, Pangkal Pinang', '081345678913', 'anggota', '2025-06-17 13:45:54'),
(27, 'cahyo', 'cahyo123', 'Cahyo Kumolo', 'Jl. Dahlia No. 16, Tanjung Pinang', '081345678914', 'anggota', '2025-06-17 13:45:54'),
(28, 'diana', 'diana123', 'Diana Putri', 'Jl. Flamboyan No. 18, Ternate', '081345678915', 'anggota', '2025-06-17 13:45:54'),
(29, 'evan', 'evan123', 'Evan Dimas', 'Jl. Garuda No. 22, Manokwari', '081345678916', 'anggota', '2025-06-17 13:45:54'),
(30, 'farah', 'farah123', 'Farah Quinn', 'Jl. Elang No. 24, Mamuju', '081345678917', 'anggota', '2025-06-17 13:45:54'),
(31, 'gilang', 'gilang123', 'Gilang Dirga', 'Jl. Rajawali No. 26, Sofifi', '081345678918', 'anggota', '2025-06-17 13:45:54'),
(32, 'hanif', 'hanif123', 'Hanif Sjahbandi', 'Jl. Merpati No. 28, Tanjung Selor', '081345678919', 'anggota', '2025-06-17 13:45:54'),
(33, 'irma', 'irma123', 'Irma Suryani', 'Jl. Nuri No. 32, Banda Aceh', '081345678920', 'anggota', '2025-06-17 13:45:54'),
(34, 'jaya', 'jaya123', 'Jaya Suprana', 'Jl. Cendana No. 34, Serang', '081345678921', 'anggota', '2025-06-17 13:45:54');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
