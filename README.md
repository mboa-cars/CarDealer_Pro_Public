# 🚗 **CarDealer Pro** - Application de Gestion de Voitures

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC.svg)](https://tailwindcss.com)
[![Docker](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://docker.com)
[![GitHub](https://img.shields.io/github/stars/mboa-cars/CarDealer_Pro_Public?style=social)](https://github.com/mboa-cars/CarDealer_Pro_Public)

> **Une application web moderne et complète** pour la gestion et la vente de voitures d'occasion, développée avec Laravel et une interface utilisateur moderne.
>
> **Nouveautés 2025 :** Système de favoris et bookmarks, configuration Docker améliorée, interface utilisateur enrichie.

## 📋 **Table des Matières**

- [🎯 Vue d'ensemble](#-vue-densemble)
- [✨ Fonctionnalités](#-fonctionnalités)
- [🆕 Fonctionnalités Récentes](#-fonctionnalités-récentes)
- [🛠️ Technologies](#️-technologies)
- [🚀 Installation Rapide](#-installation-rapide)
- [🐳 Installation avec Docker](#-installation-avec-docker)
- [📊 Structure de la Base de Données](#-structure-de-la-base-de-données)
- [🎨 Interface Utilisateur](#-interface-utilisateur)
- [🔧 Configuration Avancée](#-configuration-avancée)
- [🧪 Tests](#-tests)
- [📦 Déploiement](#-déploiement)
- [🤝 Contribution](#-contribution)
- [🗺️ Roadmap](#-roadmap)

## 🎯 **Vue d'ensemble**

**CarDealer Pro** est une plateforme complète de gestion de voitures d'occasion qui permet aux utilisateurs de publier, rechercher et gérer des annonces de véhicules. L'application offre une expérience utilisateur moderne avec une interface intuitive et des fonctionnalités avancées.

### 🎯 **Objectifs du Projet**

- ✅ **Faciliter la vente** de voitures d'occasion
- ✅ **Simplifier la recherche** de véhicules
- ✅ **Gérer les favoris** des utilisateurs
- ✅ **Système de bookmarks** pour retrouver rapidement ses annonces préférées
- ✅ **Offrir une interface moderne** et responsive
- ✅ **Assurer la sécurité** des données utilisateur

## 🆕 **Fonctionnalités Récentes**

- ⭐ Système de favoris et bookmarks complet
- 🐳 Docker prêt à l'emploi (installation simplifiée)
- 📱 Interface utilisateur enrichie et animations modernes
- 🔔 Notifications toast pour actions utilisateur
- 📊 Nouvelle structure de base de données optimisée
- 🛡️ Sécurité renforcée (validation, sessions, etc.)

## ✨ **Fonctionnalités**

### 🔐 **Système d'Authentification**
- **Inscription/Connexion** avec validation en temps réel
- **Gestion des profils** utilisateur complète
- **Vérification des emails** avec notifications
- **Réinitialisation de mot de passe** sécurisée
- **Sessions persistantes** avec "Remember me"

### 🚗 **Gestion des Voitures**
- **Création d'annonces** avec formulaire multi-étapes
- **Upload d'images multiples** avec drag & drop
- **Gestion des positions** d'images (réorganisation)
- **Système de favoris** avec synchronisation
- **Publication/dépublication** d'annonces
- **Recherche avancée** avec filtres multiples

### 📱 **Interface Utilisateur**
- **Design responsive** adapté mobile/desktop
- **Animations fluides** et transitions modernes
- **Composants réutilisables** (cards, modals, forms)
- **Validation en temps réel** des formulaires
- **Notifications toast** pour les actions utilisateur

### 🔍 **Recherche et Filtrage**
- **Recherche par texte** dans tous les champs
- **Filtres par marque/modèle**
- **Filtres par prix** (min/max)
- **Filtres par année** de fabrication
- **Tri par pertinence/prix/date**

## 🛠️ **Technologies**

### **Backend**
| Technologie | Version | Usage |
|-------------|---------|-------|
| **Laravel** | 12.x | Framework PHP principal |
| **PHP** | 8.2+ | Langage de programmation |
| **MySQL** | 8.0+ | Base de données principale |
| **Eloquent ORM** | - | Gestion des données |
| **Laravel Breeze** | - | Authentification |

### **Frontend**
| Technologie | Version | Usage |
|-------------|---------|-------|
| **Tailwind CSS** | 3.x | Framework CSS |
| **Alpine.js** | 3.x | JavaScript réactif |
| **Vite** | 5.x | Build tool |
| **Blade** | - | Template engine |

### **Outils de Développement**
| Outil | Usage |
|-------|-------|
| **Pest** | Framework de tests |
| **Laravel Sail** | Environnement Docker |
| **Laravel Pint** | Code style fixer |
| **Git** | Version control |

## 🚀 **Installation Rapide**

### **Prérequis**
- PHP 8.2 ou supérieur
- Composer 2.x
- Node.js 18+ et npm
- MySQL 8.0+ ou SQLite
- Git

### **Étapes d'Installation**

1. **Cloner le projet**
```bash
git clone <url-du-repo>
cd laravel1
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances Node.js**
```bash
npm install
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
```bash
# Modifier .env avec vos paramètres DB
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_dealer
DB_USERNAME=root
DB_PASSWORD=
```

6. **Exécuter les migrations et seeders**
```bash
php artisan migrate
php artisan db:seed
```

7. **Compiler les assets**
```bash
npm run build
```

8. **Démarrer le serveur**
```bash
php artisan serve
```

9. **Accéder à l'application**
```
http://localhost:8000
```

## 🐳 **Installation avec Docker**

### **Prérequis Docker**
- Docker
- Docker Compose

### **Démarrage Rapide**

1. **Cloner et naviguer**
```bash
git clone <url-du-repo>
cd laravel1
```

2. **Démarrer les conteneurs**
```bash
docker compose up -d
```

3. **Installer les dépendances (dans le conteneur)**
```bash
docker compose exec app composer install
docker compose exec app npm install
```

4. **Configurer l'environnement**
```bash
docker compose exec app cp .env.example .env
docker compose exec app php artisan key:generate
```

5. **Exécuter les migrations**
```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

6. **Compiler les assets**
```bash
docker compose exec app npm run build
```

7. **Accéder à l'application**
```
http://localhost:8000
```

### **Commandes Docker Utiles**

```bash
# Voir les logs
docker compose logs -f

# Arrêter les conteneurs
docker compose down

# Reconstruire les images
docker compose up -d --build

# Accéder au shell du conteneur
docker compose exec app bash
```

## 📊 **Structure de la Base de Données**

### **Diagramme ERD**
```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│    users    │    │    cars     │    │ car_images  │
├─────────────┤    ├─────────────┤    ├─────────────┤
│ id          │    │ id          │    │ id          │
│ name        │    │ user_id     │    │ car_id      │
│ email       │    │ brand       │    │ image_path  │
│ phone       │    │ model       │    │ position    │
│ password    │    │ year        │    │ created_at  │
│ created_at  │    │ price       │    └─────────────┘
└─────────────┘    │ mileage     │
                   │ fuel_type   │    ┌─────────────┐
                   │ vin         │    │  favorites  │
                   │ city        │    ├─────────────┤
                   │ state       │    │ id          │
                   │ address     │    │ user_id     │
                   │ phone       │    │ car_id      │
                   │ main_image  │    │ created_at  │
                   │ video_url   │    └─────────────┘
                   │ features    │
                   │ is_published│
                   │ created_at  │
                   └─────────────┘
```

### **Tables Principales**

#### **`users`**
| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Clé primaire |
| `name` | varchar(255) | Nom complet |
| `email` | varchar(255) | Email unique |
| `phone` | varchar(20) | Téléphone |
| `password` | varchar(255) | Mot de passe hashé |
| `email_verified_at` | timestamp | Vérification email |
| `created_at` | timestamp | Date création |
| `updated_at` | timestamp | Date modification |

#### **`cars`**
| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Clé primaire |
| `user_id` | bigint | Propriétaire |
| `brand` | varchar(100) | Marque |
| `model` | varchar(100) | Modèle |
| `year` | int | Année |
| `price` | decimal(10,2) | Prix |
| `mileage` | int | Kilométrage |
| `fuel_type` | varchar(50) | Type carburant |
| `vin` | varchar(17) | Numéro VIN |
| `city` | varchar(100) | Ville |
| `state` | varchar(100) | État/Région |
| `address` | text | Adresse complète |
| `phone` | varchar(20) | Contact |
| `main_image` | varchar(255) | Image principale |
| `video_url` | varchar(255) | URL vidéo |
| `features` | json | Équipements |
| `is_published` | boolean | Statut publication |
| `created_at` | timestamp | Date création |
| `updated_at` | timestamp | Date modification |

#### **`car_images`**
| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Clé primaire |
| `car_id` | bigint | Voiture associée |
| `image_path` | varchar(255) | Chemin image |
| `position` | int | Ordre d'affichage |
| `created_at` | timestamp | Date création |
| `updated_at` | timestamp | Date modification |

#### **`favorites`**
| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Clé primaire |
| `user_id` | bigint | Utilisateur |
| `car_id` | bigint | Voiture favorite |
| `created_at` | timestamp | Date ajout |
| `updated_at` | timestamp | Date modification |

## 🎨 **Interface Utilisateur**

### **Pages Principales**

#### **🏠 Page d'Accueil**
- **Carrousel** de voitures en vedette
- **Filtres rapides** par marque/prix
- **Recherche globale** en temps réel
- **Navigation intuitive** vers les sections

#### **🔐 Pages d'Authentification**
- **Design moderne** avec animations
- **Validation en temps réel** des formulaires
- **Messages d'erreur** contextuels
- **Récupération de mot de passe** sécurisée

#### **🚗 Gestion des Voitures**
- **Formulaire multi-étapes** pour les annonces
- **Upload d'images** avec prévisualisation
- **Gestion des positions** par drag & drop
- **Édition en temps réel** des informations

#### **❤️ Système de Favoris**
- **Ajout/Suppression** en un clic
- **Synchronisation** automatique
- **Liste personnalisée** des favoris
- **Notifications** de mise à jour

### **Composants UI**

#### **🎨 Design System**
- **Palette de couleurs** cohérente
- **Typographie** hiérarchisée
- **Espacement** harmonieux
- **Animations** fluides

#### **📱 Responsive Design**
- **Mobile-first** approach
- **Breakpoints** optimisés
- **Navigation** adaptative
- **Touch-friendly** interface

## 🔧 **Configuration Avancée**

### **Variables d'Environnement**

```env
# Application
APP_NAME="CarDealer Pro"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_dealer
DB_USERNAME=root
DB_PASSWORD=

# Mail (pour vérification email)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Stockage des fichiers
FILESYSTEM_DISK=local
```

### **Commandes Artisan Utiles**

```bash
# Cache et optimisation
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Base de données
php artisan migrate:fresh --seed
php artisan migrate:rollback
php artisan db:seed

# Développement
php artisan serve
php artisan tinker
php artisan make:controller
php artisan make:model

# Production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **Optimisations de Performance**

#### **Cache**
```bash
# Cache des configurations
php artisan config:cache

# Cache des routes
php artisan route:cache

# Cache des vues
php artisan view:cache
```

#### **Base de Données**
```sql
-- Index pour les performances
CREATE INDEX idx_cars_brand ON cars(brand);
CREATE INDEX idx_cars_price ON cars(price);
CREATE INDEX idx_cars_year ON cars(year);
CREATE INDEX idx_cars_published ON cars(is_published);
```

## 🧪 **Tests**

### **Structure des Tests**

```
tests/
├── Feature/           # Tests d'intégration
│   ├── Auth/         # Tests d'authentification
│   ├── Cars/         # Tests de gestion voitures
│   └── Profile/      # Tests de profil
├── Unit/             # Tests unitaires
└── Pest.php          # Configuration Pest
```

### **Exécution des Tests**

```bash
# Tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage

# Tests spécifiques
php artisan test --filter=AuthTest
php artisan test tests/Feature/Auth/

# Tests en parallèle
php artisan test --parallel
```

### **Exemples de Tests**

```php
// Test d'authentification
test('user can login with valid credentials', function () {
    $user = User::factory()->create();
    
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
    
    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
});

// Test de création de voiture
test('user can create a car listing', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $carData = Car::factory()->make()->toArray();
    
    $response = $this->post('/cars', $carData);
    
    $response->assertRedirect();
    $this->assertDatabaseHas('cars', $carData);
});
```

## 📦 **Déploiement**

### **Environnement de Production**

#### **Serveur Web (Nginx)**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### **Configuration PHP**
```ini
; php.ini optimisations
memory_limit = 512M
max_execution_time = 60
upload_max_filesize = 10M
post_max_size = 10M
```

### **Déploiement avec Docker**

```bash
# Build de production
docker build -t car-dealer-pro .

# Démarrage en production
docker run -d \
  --name car-dealer-pro \
  -p 80:80 \
  -e APP_ENV=production \
  car-dealer-pro
```

### **CI/CD Pipeline**

```yaml
# .github/workflows/deploy.yml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Deploy to server
        run: |
          # Scripts de déploiement
```

## 🤝 **Contribution**

### **Guide de Contribution**

1. **Fork le projet**
```bash
git clone https://github.com/votre-username/car-dealer-pro.git
cd car-dealer-pro
```

2. **Créer une branche feature**
```bash
git checkout -b feature/AmazingFeature
```

3. **Développer et tester**
```bash
# Installer les dépendances
composer install
npm install

# Lancer les tests
php artisan test

# Vérifier le style de code
./vendor/bin/pint
```

4. **Commit et push**
```bash
git add .
git commit -m 'feat: Add amazing feature'
git push origin feature/AmazingFeature
```

5. **Créer une Pull Request**

### **Standards de Code**

#### **PHP (Laravel)**
- Suivre les [PSR-12](https://www.php-fig.org/psr/psr-12/) standards
- Utiliser Laravel Pint pour le formatage
- Documenter les méthodes complexes
- Écrire des tests pour les nouvelles fonctionnalités

#### **JavaScript**
- Utiliser ES6+ syntax
- Préférer les fonctions fléchées
- Commenter le code complexe
- Utiliser des noms de variables descriptifs

#### **CSS/Tailwind**
- Utiliser les classes Tailwind quand possible
- Organiser les styles personnalisés
- Maintenir la cohérence du design
- Optimiser pour mobile-first

### **Conventions de Commit**

```bash
# Format: type(scope): description

feat(auth): add two-factor authentication
fix(cars): resolve image upload issue
docs(readme): update installation instructions
style(ui): improve button hover effects
refactor(models): optimize database queries
test(auth): add login validation tests
chore(deps): update Laravel to 12.x
```

## 📞 **Support**

### **Ressources d'Aide**

- 📖 **Documentation Laravel** : [laravel.com/docs](https://laravel.com/docs)
- 🎨 **Documentation Tailwind** : [tailwindcss.com/docs](https://tailwindcss.com/docs)
- 🐳 **Documentation Docker** : [docs.docker.com](https://docs.docker.com)

### **Contact**

- 🐛 **Signaler un bug** : [Créer une issue](https://github.com/votre-username/car-dealer-pro/issues)
- 💡 **Suggérer une fonctionnalité** : [Créer une issue](https://github.com/votre-username/car-dealer-pro/issues)
- 📧 **Email** : support@cardealer-pro.com

### **Communauté**

- 💬 **Discord** : [Rejoindre le serveur](https://discord.gg/cardealer-pro)
- 🐦 **Twitter** : [@CarDealerPro](https://twitter.com/CarDealerPro)
- 📺 **YouTube** : [Tutoriels vidéo](https://youtube.com/c/CarDealerPro)

## 📄 **Licence**

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

<div align="center">

**Développé avec ❤️ en utilisant [Laravel](https://laravel.com)**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC.svg)](https://tailwindcss.com)

</div>

## 🗺️ **Roadmap**

- [x] Système de favoris et bookmarks
- [x] Installation Docker simplifiée
- [x] Notifications toast et interface enrichie
- [ ] Ajout d’un module de chat entre acheteurs/vendeurs
- [ ] Statistiques avancées pour les annonces
- [ ] API publique pour intégration tierce

## 🔗 **Liens Utiles**

- [Documentation Laravel](https://laravel.com/docs)
- [Documentation Tailwind CSS](https://tailwindcss.com/docs)
- [Documentation Docker](https://docs.docker.com)
- [Dépôt GitHub](https://github.com/mboa-cars/CarDealer_Pro_Public)
