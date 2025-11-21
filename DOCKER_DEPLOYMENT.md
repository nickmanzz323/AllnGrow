# Docker Deployment Guide - AllnGrow

Complete guide untuk deploy aplikasi AllnGrow menggunakan Docker.

---

## 📦 Architecture

```
┌─────────────────────────────────────────┐
│         Docker Container: app           │
│  ┌─────────────┐   ┌─────────────────┐ │
│  │   Nginx     │──▶│   PHP-FPM 8.2   │ │
│  │  (Port 80)  │   │   + Laravel     │ │
│  └─────────────┘   └─────────────────┘ │
│         │                               │
│    Supervised by Supervisor             │
└─────────────────────────────────────────┘
         │                    │
         ▼                    ▼
┌──────────────────┐  ┌──────────────────┐
│  MySQL 8.0       │  │   Redis 7        │
│  (Port 3307)     │  │  (Port 6380)     │
└──────────────────┘  └──────────────────┘
```

---

## 🚀 Quick Start

### Prerequisites

- Docker Engine 20.10+
- Docker Compose 2.0+
- Git

### 1. Clone Repository

```bash
git clone <repository-url>
cd AllnGrow
```

### 2. Setup Environment

```bash
# Copy Docker environment template
cp .env.docker .env

# Generate application key (if needed)
docker-compose run --rm app php artisan key:generate
```

### 3. Build and Start

```bash
# Build images
docker-compose build

# Start services
docker-compose up -d

# Check status
docker-compose ps
```

### 4. Initialize Database

```bash
# Run migrations
docker-compose exec app php artisan migrate --force

# Seed database (optional)
docker-compose exec app php artisan db:seed --force

# Create storage link
docker-compose exec app php artisan storage:link
```

### 5. Access Application

- **Web**: http://localhost:8001
- **MySQL**: localhost:3307
- **Redis**: localhost:6380

---

## 🔧 Configuration

### Services

| Service | Container Name | Port (Host:Container) | Purpose |
|---------|----------------|----------------------|---------|
| app | allngrow-app | 8001:80 | Laravel + Nginx + PHP-FPM |
| mysql | allngrow-mysql | 3307:3306 | Database |
| redis | allngrow-redis | 6380:6379 | Cache & Session |

### Environment Variables

Edit `.env` file:

```env
# Application
APP_NAME=AllnGrow
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

# Database (Docker MySQL)
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=allngrow
DB_USERNAME=allngrow
DB_PASSWORD=Bejo123

# Cache & Session (Docker Redis)
CACHE_STORE=redis
SESSION_DRIVER=redis
REDIS_HOST=redis
REDIS_PORT=6379

# Mail (Brevo)
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-brevo-smtp-key
```

---

## 📋 Common Commands

### Container Management

```bash
# Start all services
docker-compose up -d

# Stop all services
docker-compose down

# Restart specific service
docker-compose restart app

# View logs
docker-compose logs -f app

# View all logs
docker-compose logs -f
```

### Laravel Commands

```bash
# Run artisan commands
docker-compose exec app php artisan [command]

# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear

# Run migrations
docker-compose exec app php artisan migrate

# Queue worker status (managed by Supervisor)
docker-compose exec app supervisorctl status
```

### Database Operations

```bash
# Access MySQL CLI
docker-compose exec mysql mysql -u allngrow -pBejo123 allngrow

# Backup database
docker-compose exec mysql mysqldump -u allngrow -pBejo123 allngrow > backup.sql

# Restore database
cat backup.sql | docker-compose exec -T mysql mysql -u allngrow -pBejo123 allngrow
```

### Debugging

```bash
# Enter container shell
docker-compose exec app sh

# Check PHP version
docker-compose exec app php -v

# Check installed extensions
docker-compose exec app php -m

# View Nginx logs
docker-compose exec app tail -f /var/log/nginx/allngrow-error.log

# View PHP-FPM logs
docker-compose exec app tail -f /var/log/php_errors.log

# Check supervisor status
docker-compose exec app supervisorctl status
```

---

## 🔐 Security Best Practices

### 1. Change Default Passwords

Update di `.env`:

```env
DB_PASSWORD=YourStrongPassword123!
MYSQL_ROOT_PASSWORD=YourRootPassword456!
```

Update di `docker-compose.yml`:

```yaml
environment:
  MYSQL_PASSWORD: YourStrongPassword123!
  MYSQL_ROOT_PASSWORD: YourRootPassword456!
```

### 2. Generate New APP_KEY

```bash
docker-compose exec app php artisan key:generate
```

### 3. Disable Debug Mode

```env
APP_DEBUG=false
APP_ENV=production
```

### 4. Setup Firewall

```bash
# Allow only necessary ports
sudo ufw allow 8001/tcp   # Web
sudo ufw allow 22/tcp     # SSH
sudo ufw enable
```

### 5. Use HTTPS (Production)

Gunakan reverse proxy seperti:
- **Nginx Proxy Manager** (recommended)
- **Traefik**
- **Caddy**

Dengan Let's Encrypt untuk SSL certificate gratis.

---

## 📊 Monitoring

### Health Checks

```bash
# Check all services health
docker-compose ps

# Check app health
curl http://localhost:8001

# Check MySQL health
docker-compose exec mysql mysqladmin ping -h localhost -u allngrow -pBejo123

# Check Redis health
docker-compose exec redis redis-cli ping
```

### Logs

```bash
# Application logs
docker-compose logs -f app

# Laravel logs
docker-compose exec app tail -f storage/logs/laravel.log

# Nginx access log
docker-compose exec app tail -f /var/log/nginx/allngrow-access.log

# Queue worker logs
docker-compose exec app tail -f storage/logs/queue-worker.log
```

### Resource Usage

```bash
# Container stats
docker stats

# Disk usage
docker system df

# Volume usage
docker volume ls
```

---

## 🔄 Updates & Maintenance

### Update Application

```bash
# Pull latest code
git pull origin main

# Rebuild image
docker-compose build app

# Restart with zero downtime
docker-compose up -d --force-recreate app

# Run migrations
docker-compose exec app php artisan migrate --force

# Clear cache
docker-compose exec app php artisan optimize:clear
docker-compose exec app php artisan optimize
```

### Backup

```bash
# Backup database
docker-compose exec mysql mysqldump -u allngrow -pBejo123 allngrow > backup-$(date +%Y%m%d).sql

# Backup uploads
tar -czf storage-backup-$(date +%Y%m%d).tar.gz storage/app/public

# Backup .env
cp .env .env.backup
```

### Restore

```bash
# Restore database
cat backup-20250121.sql | docker-compose exec -T mysql mysql -u allngrow -pBejo123 allngrow

# Restore uploads
tar -xzf storage-backup-20250121.tar.gz
```

---

## 🐛 Troubleshooting

### Issue: Container fails to start

```bash
# Check logs
docker-compose logs app

# Check if ports are already in use
sudo netstat -tulpn | grep :8001

# Remove and recreate
docker-compose down
docker-compose up -d
```

### Issue: Permission denied on storage

```bash
# Fix permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Issue: Database connection refused

```bash
# Check MySQL is running
docker-compose ps mysql

# Wait for MySQL to be ready
docker-compose exec mysql mysqladmin ping -h localhost -u allngrow -pBejo123

# Check database credentials in .env
```

### Issue: Nginx 502 Bad Gateway

```bash
# Check PHP-FPM is running
docker-compose exec app supervisorctl status php-fpm

# Restart PHP-FPM
docker-compose exec app supervisorctl restart php-fpm

# Check PHP error logs
docker-compose exec app tail -f /var/log/php_errors.log
```

---

## 🚀 Production Deployment

### 1. Server Requirements

- Ubuntu 22.04 LTS or Debian 11+
- 2GB+ RAM
- 20GB+ Disk Space
- Docker & Docker Compose installed

### 2. Setup Domain

Point your domain A record to server IP:

```
A    @         123.456.789.0
A    www       123.456.789.0
```

### 3. Install Docker

```bash
# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Install Docker Compose
sudo apt install docker-compose-plugin

# Add user to docker group
sudo usermod -aG docker $USER
```

### 4. Deploy Application

```bash
# Clone repository
git clone <repository-url>
cd AllnGrow

# Setup environment
cp .env.docker .env
nano .env  # Edit configuration

# Build and start
docker-compose up -d

# Initialize
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan storage:link
docker-compose exec app php artisan optimize
```

### 5. Setup SSL (Nginx Proxy Manager)

Install Nginx Proxy Manager:

```bash
cd ~
mkdir nginx-proxy-manager
cd nginx-proxy-manager

cat > docker-compose.yml <<EOF
version: '3.8'
services:
  app:
    image: 'jc21/nginx-proxy-manager:latest'
    restart: unless-stopped
    ports:
      - '80:80'
      - '443:443'
      - '81:81'
    volumes:
      - ./data:/data
      - ./letsencrypt:/etc/letsencrypt
EOF

docker-compose up -d
```

Access: http://your-ip:81
- Email: admin@example.com
- Password: changeme

Add proxy host:
- Domain: yourdomain.com
- Forward to: allngrow-app:80
- Enable SSL (Let's Encrypt)

---

## 📈 Performance Optimization

### Enable OPcache

Already enabled in `docker/php/php.ini`:

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
```

### Database Optimization

```bash
# Add indexes (if needed)
docker-compose exec app php artisan db:seed --class=OptimizationSeeder

# Analyze tables
docker-compose exec mysql mysqlcheck -u allngrow -pBejo123 --analyze allngrow
```

### Redis Caching

Already configured for:
- Session storage
- Cache storage
- Queue driver

### CDN for Static Assets

Upload `public/` assets to CDN and update `.env`:

```env
ASSET_URL=https://cdn.yourdomain.com
```

---

## 💡 Tips

1. **Monitor Disk Space**: Queue workers and logs can grow large
   ```bash
   docker system prune -a  # Clean unused images
   ```

2. **Backup Regularly**: Automate with cron
   ```bash
   0 2 * * * /path/to/backup-script.sh
   ```

3. **Use Volumes**: Data persists even if container is deleted

4. **Check Logs**: Monitor for errors regularly
   ```bash
   docker-compose logs -f app | grep ERROR
   ```

5. **Update Regularly**: Keep Docker images updated
   ```bash
   docker-compose pull
   docker-compose up -d
   ```

---

## 📞 Support

- Documentation: Read this file
- Laravel Docs: https://laravel.com/docs
- Docker Docs: https://docs.docker.com

**Created for AllnGrow by Claude Code** 🚀
