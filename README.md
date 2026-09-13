<img src=".github/images/banner/banner.png">
<br>
<div align="center">
   <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8?tab=readme-ov-file#changelog">
      <img src="https://img.shields.io/badge/GitHub Version-0.8.0-red">
   </a>
   <!-- <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8?tab=readme-ov-file#changelog">
      <img src="https://img.shields.io/badge/Latest Release-1.1.1-green">
   </a> --><br>
   <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8/blob/main/LICENSE">
      <img src="https://img.shields.io/badge/License-MIT-blue.svg">
   </a>
   <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8?tab=readme-ov-file#kontributor">
      <img src="https://img.shields.io/badge/Contributor-3-yellow">
   </a>
   <!-- <a href="http://immaspark.page.gd">
      <img src="https://img.shields.io/badge/Hosted Version-1.1.1-11164b">
   </a> -->
</div>

## Table of Contents

<details>
   <summary>Tekan untuk Buka</summary>

- [Deskripsi](#deskripsi)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Fitur Utama](#fitur-utama)
- [Penggunaan](#penggunaan)
- [Arsitektur](#arsitektur)
- [Kontributor](#kontributor)
- [Lisensi](#lisensi)
- [Changelog](#changelog)
- [Link](#link)
</details>

## Deskripsi
Logimm adalah sebuah website yang digunakan untuk mengorganisir kelas-kelas yang terdapat di sekolah SMK Kristen Immanuel Pontianak agar siswa dapat berkomunikasi dengan lebih gampang dengan pihak sekolah. Website ini menyediakan fitur agenda per kelas, absensi siswa, daftar perlengkapan kelas, dan daftar siswa-siswa yang sudah memiliki SIM. Nama Logimm sendiri adalah gabungan dari Log yang merupakan catatan digital dan Immanuel untuk merepresentasikan nama sekolah.


## Prasyarat
- PHP versi >= 8.5
- Visual Studio Code
- Laragon versi terbaru

## Instalasi

<details>
   <summary>Tekan untuk Buka</summary>

### Step 1

<details>
   <summary>Pilih Versi</summary><br>

   <details>
      <summary>Unstable Version</summary>
1. Download repository ini (Cari tombol code warna hijau di bagian atas terus tekan "Download ZIP").<br>
2. Ekstrak file tersebut.<br>
3. Lanjut ke step selanjutnya.
   </details>
<br>
   <details>
      <summary>Stable Version</summary>
1. Buka page <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8/releases">Releases</a> dari repository ini.<br>
2. Pilih salah satu release, tekan "Assets", dan tekan "Source code (zip)".<br>
3. Ekstrak file tersebut.<br>
4. Lanjut ke step selanjutnya.
   </details>
</details>

### Step 2

<details>
   <summary>Step 2</summary>

1. Pindahkan folder yang telah diekstrak ke directory proyek-proyek laragon Anda, secara default berada di `C:\laragon\www`. Folder yang dipindahkan seharusnya dapat langsung melihat isi dari websitenya, apabila dalam folder yang dipindahkan terdapat sebuah folder lagi, keluarkan semua isi dari websitenya keluar dari foldernya.<br>
2. Buka dan jalankan laragon terus buka terminalnya.<br>
3. Pindah ke directory proyek yang telah diinstal.<br>
4. Instal dependencies proyek menggunakan command di bawah.
`composer install` & `npm install`<br>
5. Setelah semua sudah selesai, masuk ke dalam folder proyek (gunakan command `code .`), terus copy-paste file `.env.example` dan ganti namanya menjadi `.env`.<br>
6. Setelah membuat file baru tersebut, pindah kembali ke terminal dan gunakan command `php artisan key:generate` & `php artisan migrate`. Apabila command `php artisan migrate` menanyakan apakah ingin membuat database baru, respon dengan `yes`.<br>
7. Setelah database sudah dibuat, jalankan command `composer run dev` dan tekan link dengan label APP_URL.<br>
8. Selesai :D
</details>
</details>
</details>
</details>

## Fitur Utama
<details>
   <summary>Tekan untuk Buka</summary>

- **Login**

   Halaman digunakan untuk login ke dalam akun dan masuk ke dalam halaman utama.

- **Logout**

   Pengguna dapat logout melalui navbar kiri bawah.

- **Absensi**

   Pengguna dapat absen dan melihat status absensi yang lain pada hari yang sama.

- **Mendata Penggunaan SIM**

   Pengguna dapat mengupload foto SIM mereka agar pihak sekolah dapat tahu bahwa pengguna tersebut sudah memiliki SIM. Pengguna juga dapat melihat status SIM pengguna lainnya.

- **Mendata Perlengkapan Kelas**

   Pengguna dapat mendata kondisi perlengkapan kelas mereka agar apabila terdapat kerusakan, pihak sekolah dapat tahu dan menggantikan perlengkapan tersebut.

- **Agenda**

   Pengguna-pengguna dapat menambahkan isi agenda untuk kelas mereka semua agar semua orang di kelas tersebut dapat ingat untuk mengerjakan tugas tersebut.

   <details>
      <summary>Admin Pages</summary>

  - **Register User**

      Digunakan untuk menambahkan akun.

   </details>
  
</details>

## Penggunaan

<details>
<summary>Tekan untuk Buka</summary>

- **Login**

  Ketika website dibuka, user akan menemukan halaman login terlebih dahulu. User hanya perlu memasukkan email dan password mereka untuk login.

- **Navigasi**

  Setelah berhasil login, user akan diarahkan ke halaman utama. Navigasi dapat dilakukan melalui sidebar di sisi kiri pada perangkat desktop, atau melalui navbar di bagian bawah layar pada perangkat mobile. Setiap ikon pada navigasi mewakili satu halaman: Absensi, Agenda, Perlengkapan, dan Profil.

- **Absensi**

  Halaman ini menampilkan daftar kehadiran siswa untuk tanggal yang dipilih. User dapat mengubah tanggal melalui tombol Pilih Tanggal di bagian kanan atas. Di bagian atas halaman terdapat status absensi pribadi user, dengan tombol Absen Masuk dan Pengajuan Izin. Di bawahnya terdapat kartu statistik yang menampilkan jumlah total siswa, jumlah yang sudah absen, dan jumlah yang belum absen. Daftar siswa ditampilkan di bagian bawah beserta status masing-masing.

- **Agenda**

  Halaman ini menampilkan daftar agenda yang terbagi menjadi dua bagian: Tugas Sekarang dan Sudah Lewat. Setiap item menampilkan judul, deskripsi, tanggal, dan waktu. Untuk menambahkan agenda baru, user dapat menekan tombol Tambah di bagian kanan atas. Setiap item agenda memiliki tombol edit dan hapus.

- **Menambah Agenda**

  Form ini digunakan untuk membuat agenda baru. User perlu mengisi judul agenda, deskripsi, waktu mulai dan selesai, serta tanggal. Setelah semua terisi, tekan tombol Simpan untuk menyimpan agenda. Tombol Batal akan mengembalikan user ke halaman daftar agenda.

- **Edit Agenda**

  Form ini muncul ketika user menekan tombol edit pada salah satu item agenda. Seluruh data agenda akan dimuat secara otomatis ke dalam form. User dapat mengubah data yang diperlukan, lalu menekan tombol Perbarui untuk menyimpan perubahan.

- **Perlengkapan**

  Halaman ini menampilkan daftar seluruh perlengkapan kelas beserta jumlahnya. Setiap item dilengkapi tombol untuk menambah atau mengurangi jumlah secara langsung. Terdapat juga tombol edit dan hapus pada setiap item. Untuk menambahkan perlengkapan baru, user dapat menekan tombol Tambah di bagian kanan atas.

- **Menambah Perlengkapan**

  Form ini digunakan untuk menambahkan perlengkapan baru. User perlu mengisi nama perlengkapan, jumlah total, dan catatan tambahan jika diperlukan. Tombol Simpan akan menyimpan data perlengkapan baru.

- **Edit Perlengkapan**

  Form ini muncul ketika user menekan tombol edit pada salah satu item perlengkapan. Data perlengkapan akan dimuat secara otomatis. User dapat mengubah nama, jumlah, atau catatan, lalu menekan tombol Perbarui untuk menyimpan perubahan.

- **Logout**

  Untuk keluar dari akun, user dapat menekan tombol Logout yang terdapat di bagian bawah sidebar pada desktop, atau di ujung kanan navbar pada mobile.

</details>

## Teknologi

<b>-- Front-end Library --</b> <br>
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-%2338B2AC.svg?logo=tailwind-css&logoColor=white)
![Anime.js](https://img.shields.io/badge/Anime.js-FF2D55?style=flat&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsEAAA7BAbiRa+0AAAAZdEVYdFNvZnR3YXJlAFBhaW50Lk5FVCA1LjEuMTGKCBbOAAAAuGVYSWZJSSoACAAAAAUAGgEFAAEAAABKAAAAGwEFAAEAAABSAAAAKAEDAAEAAAACAAAAMQECABEAAABaAAAAaYcEAAEAAABsAAAAAAAAANl2AQDoAwAA2XYBAOgDAABQYWludC5ORVQgNS4xLjExAAADAACQBwAEAAAAMDIzMAGgAwABAAAAAQAAAAWgBAABAAAAlgAAAAAAAAACAAEAAgAEAAAAUjk4AAIABwAEAAAAMDEwMAAAAABZKX6wz+x41AAAAbxJREFUOE/FlE9IlFEUxc8LZ6E0IQqlm9lIm4jcCIEYrQIV/APujIh2YTujXUuFwEGwXLUJ0a2OC1v5B9GxghEkgqJW4oCSiIsBUZrg5+Z+w3tvJkgwOvAt7rnnnvfu++570v8AkAbSMV8LLiYSAO2SHku6J+mG0T8lbUqacc59jkpqA0gBWaDMn1E2TV1cH8DMFuPqWvh4BF2rrF+bZ6o5R3/iEbQMZCU9t/BE0rakXUklSb9N3yDp9sNP6lzar5S+KA25bCWSnZnX5g/gViDwADwY3YG7y9C5CvfXGIw1Aia9jkY8fgB4B8wBb4AM0AL0AiumnwjMPuQ3HFDwDL8Bs8Ar4L3lvlruqbfYtHGFwNDmbM8zfAlcB1KRLgO0efGC6feSOb3iFxgKzrkx59yhpAbgGTAOjEvqllSUpOPjkpOUiYslSVubQctvEx545O0a4BRotVwjsG982LIJkp/y2uOagCHgCTAM3PFyN4Ezq5msGHmCdksWgQ4gOA7gKtAH1FvcY/qyXdNq2HUC+AV8AdaBNSAPHNiOvtt3YNpwoH3Y1cuZ8G+QiyehChd8HKrM/v3zVQsXeWAvHedBNW9Pb9ocIgAAAABJRU5ErkJggg==)

<b>-- Bridge Library --</b> <br>
![Alpine.js](https://img.shields.io/badge/Alpine.js-ffffff?logo=alpinedotjs&logoColor=238BC0D0)
![Livewire](https://img.shields.io/badge/Livewire-4e56a6?logo=livewire&logoColor=white)

<b>-- Back-end Framework --</b> <br>
![Laravel](https://img.shields.io/badge/Laravel-f55247?logo=laravel&logoColor=white)

<b>-- UI/UX Design --</b> <br>
![Figma](https://img.shields.io/badge/Figma-F24E1E?logo=figma&logoColor=white)

<!-- <b>-- Hosting --</b> <br> -->

## Kontributor

<img src="https://avatars.githubusercontent.com/u/199484083" width="20"> [Christopher V. C. - "Banditov"](https://github.com/Banditov), sebagai ketua & full-stack developer.<br>
<img src="https://avatars.githubusercontent.com/u/253169611" width="20"> [Michelle N. - "MN ( o v o )"](https://github.com/idunno2467), sebagai UI/UX designer.<br>
<img src="https://avatars.githubusercontent.com/u/226641799" width="20"> [Valentino - "Naomikoshi"](https://github.com/Naomikoshi), sebagai front-end developer.

## Lisensi

Didistribusikan di bawah Lisensi MIT. Lihat [`LICENSE`](./LICENSE) untuk informasi lebih lanjut.

## Changelog

<details>
   <summary>Tekan untuk Buka</summary>

<details>
   <summary>September</summary>

### 13/09/2026 - 0.8.0

<details>

- Memperbarui README
- Menggabungkan data dummy absen dengan SIM
- Membuat halaman pendataan penggunaan SIM
</details>

### 11/09/2026 - 0.7.0

<details>

- Membuat halaman edit/tambah perlengkapan kelas
- Membuat dummy data agar dapat diview
- Memperbaiki class glass yang mengikuti scroll
- Memperbaiki loading page lambat
</details>

### 11/09/2026 - 0.6.1

<details>

- Memperbaiki halaman perlengkapan kelas
</details>


### 08/09/2026 - 0.6.0

<details>

- Membuat halaman edit/tambah agenda
</details>

### 08/09/2026 - 0.5.0

<details>

- Membuat halaman absensi
- Memperbaiki konsistensi style semua halaman
- Memperbaiki responsivitas halaman absensi
- Menambahkan bagian fitur utama pada README
- Membuat halaman perlengkapan kelas
</details>

### 05/09/2026 - 0.4.2

<details>

- Memperbaiki halaman agenda
</details>

### 01/09/2026 - 0.4.1

<details>

- Membuat loading screen
- Menyelesaikan view halaman agenda
- Perbaiki tombol kembali pada halaman admin registrasi
- Added banner for README
</details>

</details>

<details>
   <summary>Agustus</summary>

### 30/08/2026 - 0.3.0

<details>

- Menyelesaikan view halaman admin registrasi
- Memperbarui style gelas
</details>

### 29/08/2026 - 0.2.0

<details>

- Menyelesaikan view halaman login
- Membuat helper ikon
- Membuat README baru
</details>

### 27/08/2026 - 0.1.0

<details>

- Membuat halaman login
</details>

### 26/08/2026 - 0.0.0

<details>

- Menambahkan lisensi MIT
</details>

### 22/08/2026 - 0.0.0 ( First Commit )

<details>

- First Commit
</details>

</details>

</details>

## Link

- [Figma](https://www.figma.com/design/sRRJEFI7uuZzOvflsmt41e/Logimm?node-id=0-1&t=52io9Yi9WMViL7xb-1)
