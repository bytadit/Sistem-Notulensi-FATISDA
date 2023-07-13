# SINORA - Sistem Notulensi Rapat FATISDA UNS
## Deskripsi 
SINORA adalah Sistem Notulensi Rapat Berbasis Web untuk keperluan Fakultas Teknologi Informasi dan Sains Data (FATISDA) UNS. 
## Role dan Fitur
Aplikasi ini memiliki 5 Role Utama, sebagai berikut:
### SuperAdministrator
SuperAdministrator adalah role dengan privilege tertinggi di aplikasi. Seorang user dengan role superadministrator memiliki hak akses terhadap fitur sebagai berikut:
1. Atur User <br>
   SuperAdmin dapat melihat informasi Role, Unit, dan Permission dari tiap user yang terregistrasi, serta dapat mengubahnya.
2. Atur Role <br>
   SuperAdmin dapat membuat dan mengatur role yang ada pada aplikasi, dimana role ini berperan sebagai reference feature yang akan digunakan di fitur lain.
3. Atur Permission <br>
   SuperAdmin dapat membuat dan mengatur permission yang ada pada aplikasi, dimana permission ini berperan sebagai reference feature yang akan digunakan di fitur lain.
4. Atur Unit <br>
   SuperAdmin dapat membuat dan mengatur unit/team yang ada pada aplikasi, dimana unit ini berperan sebagai reference feature yang akan digunakan di fitur lain.
5. Atur Jabatan <br>
   SuperAdmin dapat membuat dan mengatur jabatan yang ada pada aplikasi, dimana jabatan ini berperan sebagai reference feature yang akan digunakan di fitur lain, seperti fitur pejabat.
### Administrator
Administrator adalah role dengan privilege tertinggi di tiap Unit, sehingga role ini terhubung dengan Unit. Seorang user dengan role administrator memiliki hak akses terhadap seluruh inisiasi kegiatan rapat di tiap unit. Berikut adalah fitur-fitur yang dimiliki oleh role administrator:
1. Kategori Rapat <br>
   Kategori Rapat adalah fitur reference yang digunakan oleh administrator ketika membuat rapat.
2. Topik Rapat <br>
   Topik Rapat adalah fitur reference yang digunakan oleh administrator ketika membuat rapat.
5. Atur Pejabat <br>
   Administrator dapat mengatur/mengassign siapa saja pegawai yang berhak masuk dalam suatu unit, dengan jabatan tertentu.
7. Daftar Rapat <br>
   Administrator dapat mengatur (CRUD) Rapat di suatu Unit dimana ia berada, termasuk status rapat (dijadwalkan, berlangsung, atau selesai). Administrator juga dapat mengatur siapa saja yang menjadi anggota dalam suatu rapat, serta siapa yang menjadi notulis dan penanggungjawab rapat.
### User
User adalah role default yang dimiliki seorang user yang baru teregsitrasi. Ketika seorang dengan role user memiliki unit tertentu, maka dia memiliki akses terhadap fitur-fitur sebagai berikut:
1. Jadwal Rapat <br>
   Jika user terdaftar sebagai anggota rapat, maka dia dapat melihat daftar rapat yang masih dijadwalkan atau berlangsung di fitur jadwal rapat. Dalam fitur ini, user dapat melihat informasi detail rapat, melakukan konfirmasi kehadiran (jika status rapat dijadwalkan, melakukan presensi (jika status rapat berlangsung), melihat & mengunduh dokumentasi, dan melihat anggota rapat beserta status presensinya. Dalam konfirmasi kehadiran dan presensi, user dapat menambahkan detail (jika perlu).
2. Riwayat Rapat <br>
   Jika user terdaftar sebagai anggota rapat, maka dia dapat melihat daftar rapat yang sudah selesai di fitur riwayat rapat. Dalam fitur ini, user dapat melihat notulensi rapat (kesimpulan dan hasil), melihat & mengunduh dokumentasi, melihat daftar hadir, dan detail rapat.
### PenanggungJawab Rapat
Role PenanggungJawab Rapat adalah role yang hanya bisa diassign oleh Administrator di suatu Unit (seorang superadministrator tidak bisa). Role ini adalah sebagai penanggungjawab/pemimpin dari tiap rapat yang dibuat oleh admin. User yang memiliki akses role ini, maka dapat merubah susunan anggota rapat, menambah dokumentasi rapat, serta melihat detail konfirmasi dan presensi anggota rapat.
### Notulis
Role Notulis adalah role yang hanya bisa diassign oleh Administrator di suatu Unit (seorang superadministrator tidak bisa). Role ini adalah sebagai notulis dari tiap rapat yang dibuat oleh admin. User yang memiliki akses role ini, maka dapat menambah/merubah notulensi rapat, menambah atau mengubah dokumentasi, dan melihat detail konfirmasi dan presensi anggota rapat.

## Tools
1. Laravel 10
2. Livewire v2.12.3
3. Laratrust by Santigarcor
4. Velzon Premium by ThemeForest
   

    
