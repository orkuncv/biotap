# GitHub Actions Deployment naar TransIP

Deze repository gebruikt GitHub Actions voor automatische deployment naar TransIP.

## Required GitHub Secrets

Ga naar je repository → Settings → Secrets and variables → Actions en voeg de volgende secrets toe:

### Verplichte Secrets

| Secret Name | Beschrijving | Voorbeeld |
|-------------|--------------|-----------|
| `SSH_HOST` | IP adres of hostname van je TransIP server | `123.456.789.012` |
| `SSH_USERNAME` | SSH gebruikersnaam | `root` of `ubuntu` |
| `SSH_PRIVATE_KEY` | Volledige inhoud van je private SSH key | `-----BEGIN OPENSSH PRIVATE KEY-----...` |
| `DEPLOY_PATH` | Absolute path waar de site gedeployed wordt | `/data/sites/web/biotapnl/www` |

### Optionele Secrets

| Secret Name | Beschrijving | Default | Voorbeeld |
|-------------|--------------|---------|-----------|
| `SSH_PORT` | SSH poort | `22` | `2222` |
| `SITE_URL` | URL voor health check | `http://localhost` | `https://rektra.nl` |

## Server Voorbereiding

### 1. SSH Key Setup
```bash
# Genereer SSH key pair (op je lokale machine)
ssh-keygen -t rsa -b 4096 -C "github-actions@rektra.nl"

# Kopieer public key naar server
ssh-copy-id -i ~/.ssh/id_rsa.pub user@your-server-ip

# Test de verbinding
ssh -i ~/.ssh/id_rsa user@your-server-ip
```

### 2. Server Requirements
```bash
# PHP 8.1+ installeren
sudo apt update
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip php8.1-gd

# Composer installeren
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# WP-CLI installeren (voor Nederlandse taalbestanden)
curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/v2.8.1/utils/wp-cli-completion.bash
curl -O https://raw.githubusercontent.com/wp-cli/wp-cli/v2.8.1/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp

# Webserver (Nginx voorbeeld)
sudo apt install nginx mysql-server
```

### 3. Database Setup
```bash
# MySQL/MariaDB database aanmaken
sudo mysql -u root -p

CREATE DATABASE rektra_db;
CREATE USER 'rektra_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON rektra_db.* TO 'rektra_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 4. .env File op Server
Maak een `.env` bestand aan op je server in `$DEPLOY_PATH`:

```bash
sudo nano /var/www/html/rektra/.env
```

```env
WP_ENV=production
WP_HOME=https://jouw-domein.nl
WP_SITEURL=${WP_HOME}/wp
WP_DEBUG_LOG=false

# Database
DB_NAME=rektra_db
DB_USER=rektra_user
DB_PASSWORD=strong_password
DB_HOST=localhost

# Nederlandse WordPress
WPLANG=nl_NL

# Security Keys (genereer nieuwe via https://roots.io/salts.html)
AUTH_KEY='genereer-een-nieuwe-key'
SECURE_AUTH_KEY='genereer-een-nieuwe-key'
LOGGED_IN_KEY='genereer-een-nieuwe-key'
NONCE_KEY='genereer-een-nieuwe-key'
AUTH_SALT='genereer-een-nieuwe-key'
SECURE_AUTH_SALT='genereer-een-nieuwe-key'
LOGGED_IN_SALT='genereer-een-nieuwe-key'
NONCE_SALT='genereer-een-nieuwe-key'
```

### 5. Nginx Configuratie
```nginx
server {
    listen 80;
    server_name jouw-domein.nl;
    root /var/www/html/rektra/web;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

## Deployment Proces

1. **Push naar main/master branch** → Automatische deployment
2. **Manual deployment** → Ga naar Actions tab → Run workflow
3. **Rollback** → Automatische backup wordt gemaakt in `${DEPLOY_PATH}_backup_TIMESTAMP`

## Troubleshooting

### Veelvoorkomende problemen:

1. **Permission denied**: Controleer SSH key en server permissions
2. **Composer errors**: Zorg dat PHP en composer geïnstalleerd zijn op server
3. **Database connection**: Controleer .env configuratie en database credentials
4. **File permissions**: Script zet automatisch juiste permissions (755/644)

### Logs bekijken:
- GitHub Actions logs: Repository → Actions → Selecteer workflow run
- Server logs: `/var/log/nginx/error.log` of `/var/log/apache2/error.log`
- PHP logs: `/var/log/php8.1-fpm.log`
