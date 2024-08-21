-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 02 Jul 2024 pada 05.17
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik-surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dashboard_news`
--

CREATE TABLE `dashboard_news` (
  `id` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `body` varchar(191) DEFAULT NULL,
  `img_url` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dashboard_news`
--

INSERT INTO `dashboard_news` (`id`, `title`, `body`, `img_url`, `status`, `sort_order`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('00d77181-1a8c-4981-ac13-d1c7ce83d73d', 'https://s.id/Persyaratan_Pengambilan_Ijazah_Transkrip_SKPI', 'Persyaratan Pengambilan Ijazah dan Transkip', 'file/berita-dashboard/banner.jpg', 'Active', 1, 'System', 'System', NULL, NULL),
('27656303-7171-4bad-ba60-f554a415ca2b', 'https://www.sci.ui.ac.id/aturan-dan-pedoman/', NULL, 'file/berita-dashboard/banner3.jpg', 'Active', 3, 'System', 'System', NULL, NULL),
('61c6fe14-66e8-49f2-8673-cfbb6a159ba4', 'https://www.sci.ui.ac.id/it-support/', 'https://www.sci.ui.ac.id/it-support/', 'file/berita-dashboard/banner2.png', 'Active', 2, 'System', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` varchar(191) NOT NULL,
  `department_code` varchar(191) NOT NULL,
  `department_name` varchar(191) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `departments`
--

INSERT INTO `departments` (`id`, `department_code`, `department_name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('49b2a4b3-c60c-4e21-a9cb-a260c277cc47', 'M01', 'Matematika', 'Active', 'System', 'System', NULL, NULL),
('5831b2c9-511c-4e1c-b36e-97dad5f33df4', 'B01', 'Biologi', 'Active', 'System', 'System', NULL, NULL),
('7f613eaf-1d94-46af-b5ee-cc2f1bd6646e', 'G02', 'Geosains', 'Active', 'System', 'System', NULL, NULL),
('cd19c0e4-c4ad-48ab-8087-9da76c4912de', 'G01', 'Geografi', 'Active', 'System', 'System', NULL, NULL),
('cecb90ac-de5a-4a49-8cd1-fa882588d999', 'K01', 'Kimia', 'Active', 'System', 'System', NULL, NULL),
('ffa0c5a1-71be-4d00-af42-363cfc35097f', 'F01', 'Fisika', 'Active', 'System', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` varchar(191) NOT NULL,
  `user_id` varchar(191) DEFAULT NULL,
  `form_status` varchar(191) DEFAULT NULL,
  `department_id` varchar(191) DEFAULT NULL,
  `study_program_id` varchar(191) DEFAULT NULL,
  `form_template_id` varchar(191) DEFAULT NULL,
  `size_file` varchar(191) DEFAULT NULL,
  `url_file` varchar(191) DEFAULT NULL,
  `signed_file` varchar(191) DEFAULT NULL,
  `signed_size_file` varchar(191) DEFAULT NULL,
  `submission_date` timestamp NULL DEFAULT NULL,
  `processed_date` timestamp NULL DEFAULT NULL,
  `keterangan` longtext DEFAULT NULL,
  `komentar` longtext DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_templates`
--

CREATE TABLE `form_templates` (
  `id` varchar(191) NOT NULL,
  `template_name` varchar(191) NOT NULL,
  `size_file` varchar(191) DEFAULT NULL,
  `url_file` varchar(191) DEFAULT NULL,
  `type_id` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `form_templates`
--

INSERT INTO `form_templates` (`id`, `template_name`, `size_file`, `url_file`, `type_id`, `status`, `sort_order`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('072a3911-8778-44b9-a122-f6af3249bef3', 'Form Pengantar Magang', '127309', 'file/template-surat/Formulir-Permohonan-Pengantar-Magang-(Recommendation-Letter-Request-Form-for-Internship).docx', 'FT01', 'Active', 10, 'System', 'System', NULL, NULL),
('0bae17a6-cd0c-48f1-9339-7f32a18fa4fa', 'Form Penyerahan Berkas Kelengkapan Penerbitan Ijazah dan Transkrip', '130065', 'file/template-surat/Borang-Berkas-kelengkapan-Penerbitan-Ijasah-dan-Transkrip.docx', 'FT01', 'Active', 12, 'System', 'System', NULL, NULL),
('0cedfff2-9449-47b2-ab56-266bf108e4eb', 'Form Keterangan Mahasiswa Aktif', '178688', 'file/template-surat/Formulir-Permohonan-Surat-Keterangan-Mahasiswa-Aktif-BR-(Statement-Letter-as-Registered-Student-Request-Form).doc', 'FT01', 'Active', 1, 'System', 'System', NULL, NULL),
('0e97a01b-6a96-4fdb-8ed4-cfb22a2e93bf', 'Form Cuti Akademik', '125815', 'file/template-surat/Formulir-Permohonan-Cuti-Akademik-(Academic-Leave-Form).docx', 'FT01', 'Active', 15, 'System', 'System', NULL, NULL),
('208fc9cf-30d7-41bd-9e6f-521deb8a5bd8', 'Form Pengunduran Diri', '128999', 'file/template-surat/Formulir-Permohonan-pengunduran-diri-(Resignation-Form).docx', 'FT01', 'Active', 14, 'System', 'System', NULL, NULL),
('34b7542d-e185-43d2-844a-950e0f5bff58', 'Form Permohonan Pengantar Data', '127552', 'file/template-surat/Formulir-Permohonan-Pengantar-Data-(Recommendation-Letter-Request-Form-for-Institution-or-Company).docx', 'FT01', 'Active', 17, 'System', 'System', NULL, NULL),
('34f67c55-c133-40ae-a3ee-967ddc617b1c', 'Form Permohonan Tunda Kuliah S2 dan S3', '125807', 'file/template-surat/Formulir-Permohonan-Tunda-Kuliah-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Master-and-Doctorate-Study-Postponement).docx', 'FT01', 'Active', 7, 'System', 'System', NULL, NULL),
('35605b7d-b7b5-4315-b83e-2d779522cded', 'Form Permohonan Transkrip Nilai', '149504', 'file/template-surat/Formulir-Permohonan-Transkrip-Nilai-(Faculty-Transcripts-Request-Form).doc', 'FT01', 'Active', 2, 'System', 'System', NULL, NULL),
('4c0954a2-5d51-43d6-b2d8-d8f5e6d6f396', 'Form Pernyataan Kehilangan Transkrip', '145408', 'file/template-surat/Formulir-Pernyataan-Kehilangan-Transkrip-(Statement-Letter-for-the-Lost-Transcript).doc', 'FT01', 'Active', 5, 'System', 'System', NULL, NULL),
('6da46423-ef13-4feb-888e-8017831cc664', 'Form Permohonan Perbaikan Nilai', '126989', 'file/template-surat/Formulir-Permohonan-Perbaikan-Nilai-(Grade-Improvement-Request-Form).docx', 'FT01', 'Active', 16, 'System', 'System', NULL, NULL),
('6fd114f0-82de-4d4c-8175-b3a6b867c35d', 'Form Pengantar Kerja Praktik', '127772', 'file/template-surat/Formulir-permohonan-Pengantar-kerja-Praktek-(Recommendation-Letter-Request-Form-for-Professional-Placement).docx', 'FT01', 'Active', 9, 'System', 'System', NULL, NULL),
('74ae7f89-28d4-46cd-a349-dcbe6a611fb0', 'Form Keterangan Pengambilan Ijazah, Transkrip Nilai, dan SKPI', '191488', 'file/template-surat/Formulir-Persyaratan-Pengambilan-Ijazah,-Transkrip-Nilai,-dan-SKPI-(Statement-Form-of-Diploma,-Transcript,-and-DS).doc', 'FT01', 'Active', 13, 'System', 'System', NULL, NULL),
('969b160f-c36e-4149-bb7c-dea2642b5489', 'Form Permohonan Transfer Kredit Fakultas', '126695', 'file/template-surat/Borang-Transfer-Kredit_Credit-Earning-untuk-Fakultas-(Academic-Credit-Earning-Transfer-Form).docx', 'FT01', 'Active', 20, 'System', 'System', NULL, NULL),
('a571deef-b990-4a46-a856-fc4cadaf873a', 'Form Permohonan Aktif Kuliah S2 dan S3', '127566', 'file/template-surat/Formulir-Permohonan-Aktif-Kuliah-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Registered-Post-graduate-Student).docx', 'FT01', 'Active', 8, 'System', 'System', NULL, NULL),
('bae4f1da-fb10-4920-8ee8-f87ce434268f', 'Form Permohonan Pengantar Rekomendasi', '126024', 'file/template-surat/Formulir-Permohonan-Pengantar-Rekomendasi-(Recommendation-Letter-Request-Form-for-General-Purposes).docx', 'FT01', 'Active', 19, 'System', 'System', NULL, NULL),
('bc0351c6-7f37-43fc-b785-1d36229c34b9', 'Form Tunda Registrasi S2 dan S3(Diterima Gasal Gel.1 Registrasi ke Gel.2)', '126113', 'file/template-surat/Formulir-Permohonan-Tunda-Registrasi-S2-dan-S3-(Recommendation-Letter-Request-Form-for-Master-and-Doctorate-Registration-Postponement).docx', 'FT01', 'Active', 6, 'System', 'System', NULL, NULL),
('bd91d876-607d-40e1-a05c-d58877fa9bef', 'Form Permohonan Transfer Kredit Departemen', '124624', 'file/template-surat/Borang-Transfer-Kredit_Credit-Earning-untuk-Departemen-(Academic-Credit-Earning-Transfer-Form).docx.docx', 'FT01', 'Active', 21, 'System', 'System', NULL, NULL),
('bde14d78-40f0-41da-91ec-e45dbd7f2b0c', 'Form Add u0026 Drop MK', '126650', 'file/template-surat/Formulir-Permohonan-Add-dan-Drop-Mata-Kuliah-(Adding-and-Dropping-Course-Request-Form).docx', 'FT01', 'Active', 18, 'System', 'System', NULL, NULL),
('bf2ea00f-34e5-4ce1-b5d9-7a03377d69fa', 'Form Pendaftaran Skripsi', '240305', 'file/template-surat/Borang-Pendaftaran-Skripsi-(Undergraduate-Thesis-Application-Form).docx', 'FT02', 'Active', 1, 'System', 'System', NULL, NULL),
('dd4f7204-3495-442c-a182-624d904da2b4', 'Form Syarat Pembuatan SKL', '139911', 'file/template-surat/Borang_Syarat_Pembuatan_SKL-(Statement-Form-of-Diploma-and-Transcripts)-.docx', 'FT01', 'Active', 3, 'System', 'System', NULL, NULL),
('efd6c9f3-6a5a-4dad-a5fe-bda506cb6fab', 'Form Pendaftaran Promosi Doktor', '348277', 'file/template-surat/Borang-Pendaftaran-Promosi-(Doctoral-Promotion-Application-Form).docx', 'FT02', 'Active', 3, 'System', 'System', NULL, NULL),
('fce6e39f-e2f4-4ccb-8fc4-b60491a3405f', 'Form Pernyataan Kehilangan Ijazah', '145920', 'file/template-surat/Formulir-Pernyataan-Kehilangan-Ijazah-(Statement-Letter-for-the-Lost-Diploma).doc', 'FT01', 'Active', 4, 'System', 'System', NULL, NULL),
('febb6cd1-b119-4d18-85ee-1ffb2787d475', 'Form Pendaftaran Tesis', '348513', 'file/template-surat/Borang-Pendaftaran-Tesis-(Thesis-Application-Form).docx', 'FT02', 'Active', 2, 'System', 'System', NULL, NULL),
('ff274dd1-5697-4aaa-90bf-e0e693973c1e', 'Form Permohonan Kuliah Lintas Fakultas', '127029', 'file/template-surat/Formulir-Permohonan-Kuliah-Lintas-Fakultas-2-(Recommendation-Letter-Request-Form-for-Cross-Faculty-Study).docx', 'FT01', 'Active', 11, 'System', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_types`
--

CREATE TABLE `form_types` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `form_types`
--

INSERT INTO `form_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('FT01', 'Akademik', 'Active', NULL, NULL, NULL, NULL),
('FT02', 'Skripsi, Tesis, Promosi', 'Active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_11_01_000001_create_role_memberships_table', 1),
(5, '2023_11_01_000005_create_departments_table', 2),
(6, '2023_11_01_000006_create_study_programs_table', 3),
(7, '2023_11_01_000002_create_users_table', 4),
(8, '2023_11_01_000003_create_form_types_table', 5),
(9, '2023_11_01_000004_create_form_templates_table', 5),
(10, '2023_11_01_000007_create_form_submissions_table', 5),
(11, '2023_11_01_000008_create_dashboard_news_table', 5),
(12, '2023_11_01_000009_create_other_menus_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `other_menus`
--

CREATE TABLE `other_menus` (
  `id` varchar(191) NOT NULL,
  `menu_name` varchar(191) DEFAULT NULL,
  `url` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `other_menus`
--

INSERT INTO `other_menus` (`id`, `menu_name`, `url`, `status`, `sort_order`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('c72e0460-a016-4306-963e-08c2091f2ff6', 'test', 'https://docs.google.com/forms/d/e/1FAIpQLScCVyyilZU_We_yq7T2WyG8y4XJ3qyHYICyx0fGwVTcdS9UcQ/closedform', 'Active', 3, 'administrator', NULL, '2024-07-02 03:13:35', '2024-07-02 03:13:35'),
('MENU1', 'Pengambilan Ijazah', 'https://s.id/Persyaratan_Pengambilan_Ijazah_Transkrip_SKPI', 'Active', 1, 'System', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_memberships`
--

CREATE TABLE `role_memberships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_memberships`
--

INSERT INTO `role_memberships` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `study_programs`
--

CREATE TABLE `study_programs` (
  `id` varchar(191) NOT NULL,
  `study_program_code` varchar(191) NOT NULL,
  `study_program_name` varchar(191) NOT NULL,
  `department_id` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `study_programs`
--

INSERT INTO `study_programs` (`id`, `study_program_code`, `study_program_name`, `department_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('05830b5c-9c96-4789-b826-ca20b37374c3', 'KM02', 'S2 Ilmu Kimia', 'cecb90ac-de5a-4a49-8cd1-fa882588d999', 'Active', 'System', 'System', NULL, NULL),
('0d4faa03-ef10-4bc3-9ae9-dcf8a2cbe045', 'FS02', 'S2 Ilmu Fisika', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('0e329a98-ac38-4235-a5fb-19112d5a73f8', 'BL02', 'S2 Biologi', '5831b2c9-511c-4e1c-b36e-97dad5f33df4', 'Active', 'System', 'System', NULL, NULL),
('1668158f-02f7-46fe-aeda-3d7cea16eafd', 'GG01', 'S1 Geografi', 'cd19c0e4-c4ad-48ab-8087-9da76c4912de', 'Active', 'System', 'System', NULL, NULL),
('2a7e4cb8-590a-44b7-a6ef-e4208bd319e0', 'ST01', 'S1 Statistika', '49b2a4b3-c60c-4e21-a9cb-a260c277cc47', 'Active', 'System', 'System', NULL, NULL),
('5afd20b4-f96c-4b70-aab4-0014bf3ff8aa', 'GG02', 'S2 Ilmu Geografi', 'cd19c0e4-c4ad-48ab-8087-9da76c4912de', 'Active', 'System', 'System', NULL, NULL),
('842a94c2-0aec-437a-bd78-57e6c09d4bb5', 'FM01', 'S2 Fisika Medis', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('90aaf562-7994-4644-9ac7-20337a4611bf', 'FI01', 'S1 Fisika Instrumen', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('90d5833b-4141-4db6-b152-bff34d4429ef', 'GL01', 'S1 Geologi', '7f613eaf-1d94-46af-b5ee-cc2f1bd6646e', 'Active', 'System', 'System', NULL, NULL),
('93cb7b3d-01d4-4502-a13b-ddcedb8ad06e', 'IK01', 'S2 Ilmu Kelautan', '5831b2c9-511c-4e1c-b36e-97dad5f33df4', 'Active', 'System', 'System', NULL, NULL),
('abff7b74-8239-4228-97ff-6dcbd405026f', 'IB02', 'S3 Ilmu Bahan\\/Material', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('b6283e42-e385-4da4-94fc-d43b42345007', 'KM01', 'S1 Kimia', 'cecb90ac-de5a-4a49-8cd1-fa882588d999', 'Active', 'System', 'System', NULL, NULL),
('c4de6a3b-6b47-4ece-9cf6-8e0dcf20cc6d', 'MM01', 'S1 Matematika', '49b2a4b3-c60c-4e21-a9cb-a260c277cc47', 'Active', 'System', 'System', NULL, NULL),
('c97b8afa-b270-45e2-bb9e-68b39531f2a1', 'IB01', 'S2 Ilmu Bahan\\/Material', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('dcb1ec1f-595a-448a-821f-7ff3f2e05680', 'BL01', 'S1 Biologi', '5831b2c9-511c-4e1c-b36e-97dad5f33df4', 'Active', 'System', 'System', NULL, NULL),
('dcdc8430-4ef5-4178-90c3-2d36fdaefed8', 'KM03', 'S3 Ilmu Kimia', 'cecb90ac-de5a-4a49-8cd1-fa882588d999', 'Active', 'System', 'System', NULL, NULL),
('e3985b94-4b63-4048-bec0-f38c0fdd55d1', 'F01', 'S1 Fisika', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('f8260697-cc41-4bd4-ad02-8aa482b470e2', 'GF01', 'S1 Geofisika', '7f613eaf-1d94-46af-b5ee-cc2f1bd6646e', 'Active', 'System', 'System', NULL, NULL),
('f87d592b-144e-48ef-af4b-b931d601f3a4', 'FS03', 'S3 Ilmu Fisika', 'ffa0c5a1-71be-4d00-af42-363cfc35097f', 'Active', 'System', 'System', NULL, NULL),
('f9453762-88b3-4cd8-8de6-468d5c548b69', 'IA01', 'S1 Ilmu Aktuaria', '49b2a4b3-c60c-4e21-a9cb-a260c277cc47', 'Active', 'System', 'System', NULL, NULL),
('ff928a29-2e01-4a92-a602-b500958d4864', 'MM02', 'S2 Matematika', '49b2a4b3-c60c-4e21-a9cb-a260c277cc47', 'Active', 'System', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `gender` varchar(191) DEFAULT NULL,
  `npm` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `department_id` varchar(191) DEFAULT NULL,
  `study_program_id` varchar(191) DEFAULT NULL,
  `img_url` varchar(191) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) DEFAULT NULL,
  `is_membership` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_by` varchar(191) DEFAULT NULL,
  `updated_by` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `npm`, `phone`, `department_id`, `study_program_id`, `img_url`, `role_id`, `status`, `is_membership`, `email`, `email_verified_at`, `password`, `remember_token`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('34208168-7d29-446c-8220-4cb16fbfc8b4', 'Admin', 'Dummy', NULL, NULL, '087657890377', NULL, NULL, 'file/avatars/admin.png', 1, 'Active', 0, 'admin@gmail.com', NULL, '$2y$10$.KxSrcwulVdW3cZr74y/G.NUyhXZdALaFgNdWtWWk72SzFb/ZTItq', NULL, NULL, NULL, NULL, NULL),
('administrator', 'Administrator', 'SIPA', NULL, NULL, '087657890377', NULL, NULL, 'file/avatars/administrator.png', 1, 'Active', 0, 'sipa@sci.ui.ac.id', NULL, '$2y$10$VnIX3sxMxaoOSHTIQIriVOiTNR6KJmG6TrkmXpOneUlB.XhjUqamm', NULL, NULL, NULL, NULL, NULL),
('c3516e65-c306-46d7-bb41-f2de6422e861', 'User', 'Dummy', NULL, '2306000000', '087657890377', '5831b2c9-511c-4e1c-b36e-97dad5f33df4', 'dcb1ec1f-595a-448a-821f-7ff3f2e05680', 'file/avatars/user.jpg', 2, 'Active', 0, 'user@gmail.com', NULL, '$2y$10$rFCQhexKLk8fdCbJ2Emwj.fK4ZU5qLRZCXXGtwusFRDgH2FWXFU.K', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dashboard_news`
--
ALTER TABLE `dashboard_news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_submissions_user_id_foreign` (`user_id`),
  ADD KEY `form_submissions_department_id_foreign` (`department_id`),
  ADD KEY `form_submissions_study_program_id_foreign` (`study_program_id`),
  ADD KEY `form_submissions_form_template_id_foreign` (`form_template_id`);

--
-- Indeks untuk tabel `form_templates`
--
ALTER TABLE `form_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_templates_type_id_foreign` (`type_id`);

--
-- Indeks untuk tabel `form_types`
--
ALTER TABLE `form_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `other_menus`
--
ALTER TABLE `other_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `role_memberships`
--
ALTER TABLE `role_memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `study_programs`
--
ALTER TABLE `study_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_programs_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_study_program_id_foreign` (`study_program_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role_memberships`
--
ALTER TABLE `role_memberships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD CONSTRAINT `form_submissions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `form_submissions_form_template_id_foreign` FOREIGN KEY (`form_template_id`) REFERENCES `form_templates` (`id`),
  ADD CONSTRAINT `form_submissions_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `study_programs` (`id`),
  ADD CONSTRAINT `form_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `form_templates`
--
ALTER TABLE `form_templates`
  ADD CONSTRAINT `form_templates_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `form_types` (`id`);

--
-- Ketidakleluasaan untuk tabel `study_programs`
--
ALTER TABLE `study_programs`
  ADD CONSTRAINT `study_programs_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role_memberships` (`id`),
  ADD CONSTRAINT `users_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `study_programs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
