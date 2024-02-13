# APINS 14.02
### <i>Aplikasi Penilaian dan Informasi Nilai Siswa (SD) Kurikulum 2013 dan Kurikulum Merdeka</i>

## Introduction
<strong>APINS</strong> adalah aplikasi pengolahan nilai untuk Sekolah Dasar yang memakai Kurikulum 2013 atau Kurikulum Merdeka.

## System Requirements
- PHP version >= 7.2.x;
- MySQL version 5.7.40
- PHP curl enabled
- PHP mbstring enabled

## Installation
- ubah konfigurasi alamat web di config/config.php
- ubah database di config/db_connect.php

## Version
14.02
- [Update] Perubahan tabel data_register (skhun --> file_ijazah [varchar 250])
- [FIX] Alamat Siswa pada bagian Edit Siswa
- [Update] Pemisahan Menu Identitas Sekolah
- [Update] Penambahan Menu Mata Pelajaran
- [Update] Nilai Rapor tidak bisa di Generate apabila Nilai STS dan SAS nya masih kosong.

14.01.23c
- Perbaikan NIP menjadi NIY NIGK
- Penggunaan API Wilayah Indonesia
- Penambahan field Nama Panggilan pada tabel siswa

## Login
Operator<br/>
username : admin<br/>
password : 20258088<br/>
Guru<br/>
username : guru1<br/>
password : 20258088<br/>

### Screenshot
<img src="https://github.com/nandangsetianugraha/APINS-14/blob/main/images/login.png">
<img src="https://github.com/nandangsetianugraha/APINS-14/blob/main/images/beranda.png">

### Demo
https://demos.sdi-aljannah.web.id

## Contributors
<table>
  <tr>
    <td align="center"><a href="https://github.com/nandangsetianugraha"><img src="https://avatars.githubusercontent.com/u/48231636?v=4" width="100px;" alt=""/><br /><sub><b>Nandang Setia Nugraha</b></sub></a><br /><a href="#design-nandangsetianugraha" title="Design">🎨</a></td>
    <td align="center"><a href="https://github.com/shoelyshtya"><img src="https://avatars.githubusercontent.com/u/60667662?v=4" width="100px;" alt=""/><br /><sub><b>shoelysh</b></sub></a><br /><a href="#design-shoelysh" title="Design">💻</a></td>
  </tr>
</table>

## Trakteer
https://teer.id/nandangsetianugraha

