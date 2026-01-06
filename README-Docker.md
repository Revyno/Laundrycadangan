# Laundrycadangan - Docker Setup

Panduan lengkap untuk menjalankan aplikasi LaundryMengemenSystem menggunakan Docker.

## Persyaratan Sistem

- Docker Engine 20.10+
- Docker Compose 2.0+
- Minimal 4GB RAM
- Minimal 10GB ruang disk

## Struktur Setup

```
laundrycadangan/
├── Dockerfile              # Konfigurasi container aplikasi
├── docker-compose.yml      # Orkestrasi container
├── .dockerignore          # File yang dikecualikan dari build
├── .env.example           # Template konfigurasi environment
└── docker/
    └── nginx/             # Konfigurasi nginx (opsional)
```

## Quick Start

### 1. Clone Repository
```bash
git clone <repository-url>
cd laundrycadangan
```

### 2. Setup Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
echo "APP_KEY=$(php artisan key:generate --show)" >> .env
```

### 3. Jalankan dengan Docker
```bash
# Build dan jalankan semua container
docker-compose up -d --build

# Lihat status container
docker-compose ps
```

### 4. Akses Aplikasi
- **Aplikasi Utama**: http://localhost:8000
- **MailHog (Testing Email)**: http://localhost:8025
- **Database MySQL**: localhost:3306

## Akun Default

Setelah setup selesai, Anda dapat login dengan akun berikut:

### Admin Panel
- **URL**: http://localhost:8000/admin
- **Super Admin**: superadmin@laundry.com / password123
- **Admin**: admin@laundry.com / password123
- **Operator**: operator@laundry.com / password123

### Customer Panel
- **URL**: http://localhost:8000/customer
- **Customer 1**: john@example.com / password123
- **Customer 2**: jane@example.com / password123
- **Customer 3**: bob@example.com / password123
- **Customer 4**: alice@example.com / password123

## Docker Commands

### Manajemen Container
```bash
# Jalankan container
docker-compose up -d

# Hentikan container
docker-compose down

# Rebuild container
docker-compose up -d --build

# Lihat logs
docker-compose logs -f app

# Masuk ke container
docker-compose exec app bash
```

### Database Management
```bash
# Masuk ke database container
docker-compose exec db mysql -u laundry_user -p laundry_db

# Backup database
docker-compose exec db mysqldump -u laundry_user -p laundry_db > backup.sql

# Restore database
docker-compose exec -T db mysql -u laundry_user -p laundry_db < backup.sql
```

### Laravel Commands
```bash
# Jalankan artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan queue:work

# Clear cache
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
```

## Troubleshooting

### Container Tidak Bisa Start
```bash
# Cek logs container
docker-compose logs app

# Cek status container
docker-compose ps

# Restart container
docker-compose restart app
```

### Database Connection Error
```bash
# Pastikan database container running
docker-compose ps db

# Cek logs database
docker-compose logs db

# Reset database
docker-compose down
docker volume rm laundrycadangan_db_data
docker-compose up -d db
```

### Permission Issues
```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Port Conflict
Jika port 8000 atau 3306 sudah digunakan, ubah di `docker-compose.yml`:
```yaml
services:
  app:
    ports:
      - "8001:80"  # Ubah dari 8000 ke 8001
  db:
    ports:
      - "3307:3306"  # Ubah dari 3306 ke 3307
```

## Environment Variables

### Penting untuk Docker
```env
# Database
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laundry_db
DB_USERNAME=laundry_user
DB_PASSWORD=laundry_password

# Application
APP_URL=http://localhost:8000
APP_ENV=local
APP_DEBUG=true

# Mail (untuk testing)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
```

## Development Workflow

### Menambah Dependencies PHP
1. Edit `composer.json`
2. Rebuild container:
```bash
docker-compose down
docker-compose up -d --build
```

### Menambah Dependencies Node.js
1. Edit `package.json`
2. Build assets dalam container:
```bash
docker-compose exec app npm install
docker-compose exec app npm run build
```

### Modifikasi Database
1. Buat migration baru
2. Jalankan migration:
```bash
docker-compose exec app php artisan migrate
```

## Production Deployment

Untuk production, pastikan:

1. **Environment Variables**:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_KEY` yang aman

2. **Database**:
   - Gunakan password yang kuat
   - Backup database secara teratur

3. **Security**:
   - Ubah default password admin
   - Setup HTTPS
   - Regular updates

## Support

Jika mengalami masalah, cek:
- Docker dan Docker Compose terinstall dengan benar
- Port 8000, 3306, 1025, 8025 tidak digunakan aplikasi lain
- Minimal requirements terpenuhi
- Logs container untuk error details

## File Structure dalam Container

```
/var/www/html/
├── app/              # Source code aplikasi
├── public/           # Web root
├── storage/          # File storage Laravel
├── bootstrap/        # Bootstrap files
├── config/           # Konfigurasi Laravel
├── database/         # Migrations, seeders
├── resources/        # Views, assets
├── routes/           # Route definitions
└── vendor/           # Composer dependencies
