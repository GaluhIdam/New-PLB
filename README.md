<!-- Tentang Project -->
## Tentang Aplikasi PLB (Pusat Logistik Berikat) 

Sebagai User CSSM, Ada tiga point penting yang saya inginkan
* Dapat melihat semua data Mutasi pesawat baik itu A/C Delivery maupun A/C Redelivery dalam satu table yang dapat difilter berdasarkan keinginan.
* Dapat melaporkan kedatangan Aircraft di area hangar untuk melakukan maintenance. Sehingga, Tim Bonded dapat melakukan perhitungan perkiran untuk biaya PLB yang akan dibayarkan ketika Aircraft meninggalkan Area GMF
* Dapat melporkan Aircraft Redelivery di area hangar yang sudah selesai melakukan maintenance. Sehingga, bisa memonitor aktivitas aircaft dan melakukan Updating Report pada Aircraft Mutation berupa file PDF



### Dibuat Dengan

Pada Project PLB ini ada beberapa framework/library yang digunakan, antara lain :

* [Laravel](https://laravel.com)
* [Laravel UI](https://github.com/laravel/ui)
* [Vue.js](https://vuejs.org/)
* [Vue-Router](https://router.vuejs.org/)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [SweetAlert2](https://sweetalert2.github.io/)
* [DataTables](https://datatables.net/)
* [Font Awesome](https://fontawesome.com/)


<!-- Mulai Meenggunakan -->
## Mulai Menggunakan

Cara Menggunakan Project ini

### Persyaratan

Persyaratan paket saat ini adalah :
* [Composser](https://getcomposer.org/download/)
* [Node.js](https://nodejs.org/en/)
* Laravel >= 9.x
* PHP >= 8.0 - 8.1

### Cara Install

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. Clone Repository
   ```sh
   git clone https://gitprayoga@bitbucket.org/weareopencloud/plb.git
   ```
2. Pergi ke Folder yang sudah di Clone
   ```sh
   cd plb
   ```
3. ```sh
   composer install
   ```
4. ```sh
   npm install --save-dev
   ```
5. Setelah selesai menginstall dependencies, buat `.env` file. Baca dokumentasi Laravel di: https://laravel.com/docs/9.x/configuration#environment-configuration

6. Selanjutnya, jalankan program key generation dan commands migration
   ```sh
   php artisan key:generate
   php artisan migrate:refresh --seed
   ```
7. Jalankan juga, Perintah dibawah ini
   ```sh
   php artisan storage:link
   ```
   ```sh
   npm run dev
   ```
8. Terakhir, Jalankan webserver
   ```sh
   php artisan serve
   ```
9. Setelah menjalankan webserver, buka alamat ini dibrowser kamu:
   ```sh
   http://127.0.0.1:8000
   ```
<!-- CONTACT -->
## Contact

Sigit Prayoga - sigit.prayoga@opencloud.id \
Rizky Ibrahim - rizky.ibrahim@opencloud.id \
Alnuria Vanadia Equila - vanadia.equila@opencloud.id