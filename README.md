## Persyaratan Sistem

Sebelum memulai, pastikan kamu sudah menginstal:
- **PHP 8.1^** atau lebih baru  
- **Composer**  
- **PostgreSQL**  
- **Git**

---

## Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini secara lokal:

### 1. Clone Repository

<pre>
git clone https://github.com/RizkyS2/ToDo-List-Project.git
cd todolist  
</pre>


### 2. Install Dependency

<pre>
composer install  
</pre>


### 3. Salin File Environment 

<pre>
cp .env.example .env  
</pre>

Kemudian edit file .env sesuai dengan konfigurasi lokal anda, sebagai contoh:

<pre>
APP_NAME="ToDoList"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=todolist
DB_USERNAME=root
DB_PASSWORD=
</pre>


### 4. Generate Key Aplikasi

<pre>
  php artisan key:generate
</pre>


### 5. Jalan Migrasi dan Seeder

<pre>
  php artisan migrate:fresh --seed
</pre>


### 6. Jalankan Server Laravel

<pre>
  php -S localhost:{port} -t public
</pre>
