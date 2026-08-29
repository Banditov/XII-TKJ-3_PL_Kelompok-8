<h1 align="center">Logimm</h1>

<!-- <img src=".github/images/banner/banner.png"> -->
<br>
<div align="center">
   <a href="https://github.com/Banditov/XII-TKJ-3_PWL_Kelompok-8?tab=readme-ov-file#changelog">
      <img src="https://img.shields.io/badge/GitHub Version-wip--0.2.0-red">
   </a>
   <!-- <a href="https://github.com/Banditov/XII-TKJ-3_PWL_Kelompok-8?tab=readme-ov-file#changelog">
      <img src="https://img.shields.io/badge/Latest Release-1.1.1-green">
   </a> --><br>
   <a href="https://github.com/Banditov/XII-TKJ-3_PL_Kelompok-8/blob/main/LICENSE">
      <img src="https://img.shields.io/badge/License-MIT-blue.svg">
   </a>
   <a href="https://github.com/Banditov/XII-TKJ-3_PWL_Kelompok-8?tab=readme-ov-file#kontributor">
      <img src="https://img.shields.io/badge/Contributor-3-yellow">
   </a>
   <!-- <a href="http://immaspark.page.gd">
      <img src="https://img.shields.io/badge/Hosted Version-1.1.1-11164b">
   </a> -->
</div>

## Table of Contents

<details>
   <summary>Tekan untuk Buka</summary>

<!-- - [Instalasi](#instalasi)
- [Penggunaan](#penggunaan) -->
- [Arsitektur](#arsitektur)
- [Kontributor](#kontributor)
- [Lisensi](#lisensi)
- [Changelog](#changelog)
- [Link](#link)
</details>

<!-- ## Instalasi

<details>
   <summary>Instalasi</summary>

### Step 1

<details>
   <summary>Pilih Versi</summary><br>

   <details>
      <summary>Unstable Version</summary>
1. Download repository ini (Cari tombol code warna hijau di bagian atas terus tekan "Download ZIP").
      <details>
         <summary>Step 1A-1</summary>
         <img src=".github/images/tutorial/A1A-1.png">
      </details>
2. Ekstrak file tersebut.
      <details>
         <summary>Step 1A-2</summary>
         <img src=".github/images/tutorial/A1A-2.png">
      </details>
3. Pindahkan folder yang telah diekstrak ke directory "C:\laragon\www\". Folder yang dipindahkan seharusnya dapat langsung melihat isi dari websitenya, apabila dalam folder yang dipindahkan terdapat sebuah folder lagi, keluarkan semua isi dari websitenya keluar dari foldernya.
      <details>
         <summary>Step 1A-3</summary>
         <img src=".github/images/tutorial/B1A-3--B-4.png">
      </details>
4. Buka Laragon.
      <details>
         <summary>Step 1A-4</summary>
         <img src=".github/images/tutorial/B1A-4--B-5.png">
      </details>
5. Tekan "Start All" dan tekan "Database".
      <details>
         <summary>Step 1A-5</summary>
         <img src=".github/images/tutorial/B1A-5--B-6.png">
      </details>
6. Login ke phpMyAdmin menggunakan username "root" dan password kosong.
      <details>
         <summary>Step 1A-6</summary>
         <img src=".github/images/tutorial/B1A-6--B-7.png">
      </details>
7. Buat database dengan nama "immaspark".
      <details>
         <summary>Step 1A-7</summary>
         <img src=".github/images/tutorial/B1A-7--B-8.png">
      </details>
8. Import file "immaspark.sql" yang terdapat di dalam folder yang telah dipindahkan.
      <details>
         <summary>Step 1A-8</summary>
         <img src=".github/images/tutorial/B1A-8--B-9.png">
      </details>
9. Lanjut ke Step 2.
   </details>
<br>
   <details>
      <summary>Stable Version</summary>
1. Buka page <a href="https://github.com/Banditov/XI-TKJ-3_PWL_Kelompok-8/releases">Releases</a> dari repository ini.
      <details>
         <summary>Step 1B-1</summary>
         <img src=".github/images/tutorial/A1B-1.png">
      </details>
2. Pilih salah satu release, tekan "Assets", dan tekan "Source code (zip)".
      <details>
         <summary>Step 1B-2</summary>
         <img src=".github/images/tutorial/A1B-2.png">
      </details>
3. Ekstrak file tersebut.
      <details>
         <summary>Step 1B-3</summary>
         <img src=".github/images/tutorial/A1B-3.png">
      </details>
4. Pindahkan folder yang telah diekstrak ke directory "C:\laragon\www\". Folder yang dipindahkan seharusnya dapat langsung melihat isi dari websitenya, apabila dalam folder yang dipindahkan terdapat sebuah folder lagi, keluarkan semua isi dari websitenya keluar dari foldernya.
      <details>
         <summary>Step 1B-4</summary>
         <img src=".github/images/tutorial/B1A-3--B-4.png">
      </details>
5. Buka Laragon.
      <details>
         <summary>Step 1B-5</summary>
         <img src=".github/images/tutorial/B1A-4--B-5.png">
      </details>
6. Tekan "Start All" dan tekan "Database".
      <details>
         <summary>Step 1B-6</summary>
         <img src=".github/images/tutorial/B1A-5--B-6.png">
      </details>
7. Login ke phpMyAdmin menggunakan username "root" dan password kosong.
      <details>
         <summary>Step 1B-7</summary>
         <img src=".github/images/tutorial/B1A-6--B-7.png">
      </details>
8. Buat database dengan nama "immaspark".
      <details>
         <summary>Step 1B-8</summary>
         <img src=".github/images/tutorial/B1A-7--B-8.png">
      </details>
9. Import file "immaspark.sql" yang terdapat di dalam folder yang telah dipindahkan.
      <details>
         <summary>Step 1B-9</summary>
         <img src=".github/images/tutorial/B1A-8--B-9.png">
      </details>
10. Lanjut ke Step 2.
   </details>
</details>

### Step 2

<details>
   <summary>Step 2</summary>
1. Buka terminal di Laragon.
      <details>
         <summary>Step 2-1</summary>
         <img src=".github/images/tutorial/B2-1.png">
      </details>
2. Ketikkan "cd (Nama folder yang diekstrak tadi)". Apabila lupa, ketikkan "ls" dan cari nama folder yang sesuai.
      <details>
         <summary>Step 2-2</summary>
         <img src=".github/images/tutorial/B2-2.png">
      </details>
3. Ketikkan "php -S localhost:5500 -t public" dan tekan link yang diberikan sambil menekan ctrl kiri.
      <details>
         <summary>Step 2-3</summary>
         <img src=".github/images/tutorial/B2-3.png">
      </details>
   <h3 align="center">Selesai!</h3>
</details>
</details>
</details>
<br>
<details>
   <summary>Hosted</summary>
<a href="http://immaspark.page.gd">Tekan aku!</a><br>

</details>
</details>
</details> -->

<!-- ## Penggunaan
ImmaSpark adalah sebuah website tempat siswa bisa menyimpan, membagikan, dan mengembangkan ide-ide kreatif mereka supaya tidak mudah lupa atau hilang begitu saja. Di website ini, siswa dapat membuat postingan ide, berdiskusi lewat komentar, serta memberi vote pada ide siswa lain. Jumlah vote yang didapat akan menunjukkan perkembangan dan ketertarikan pengguna terhadap ide tersebut, sehingga ide-ide yang menarik bisa lebih mudah berkembang dan dikenal banyak orang. Dengan adanya ImmaSpark, siswa memiliki wadah untuk lebih bebas berkreasi, berbagi pendapat, dan saling mendukung dalam mengembangkan ide baru. -->

## Arsitektur

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

Didistribusikan di bawah Lisensi MIT. Lihat [`LICENSE.txt`](./LICENSE.txt) untuk informasi lebih lanjut.

## Changelog

<details>
   <summary>Tekan untuk Buka</summary>

<details>
   <summary>Agustus</summary>

### 29/08/2026 - 0.2.0

<details>

- Menyelesaikan halaman login
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
