# 🚗 Application de Gestion de Voitures

Une application web moderne développée avec Laravel pour la gestion et la vente de voitures d'occasion.

## 📋 Description

Cette application permet aux utilisateurs de :
- **Publier des annonces** de voitures avec photos multiples
- **Parcourir** les voitures disponibles
- **Ajouter/retirer** des voitures de leurs favoris
- **Gérer leurs annonces** personnelles
- **Rechercher** des voitures par différents critères

## ✨ Fonctionnalités

### 🔐 Authentification
- Inscription et connexion utilisateur
- Gestion des profils utilisateur
- Vérification des emails
- Réinitialisation de mot de passe

### 🚗 Gestion des Voitures
- **Création d'annonces** avec informations détaillées
- **Upload d'images multiples** avec gestion des positions
- **Gestion des favoris** (ajout/suppression)
- **Publication/dépublication** d'annonces
- **Recherche et filtrage** des voitures

### 📱 Interface Utilisateur
- Design responsive avec Tailwind CSS
- Interface moderne et intuitive
- Navigation fluide entre les pages
- Composants réutilisables

## 🛠️ Technologies Utilisées

### Backend
- **Laravel 12** - Framework PHP
- **PHP 8.2+** - Langage de programmation
- **MySQL/SQLite** - Base de données
- **Eloquent ORM** - Gestion des données

### Frontend
- **Tailwind CSS** - Framework CSS
- **Alpine.js** - JavaScript réactif
- **Vite** - Build tool
- **Blade** - Template engine

### Outils de Développement
- **Pest** - Framework de tests
- **Laravel Sail** - Environnement Docker
- **Laravel Pint** - Code style fixer

## 📦 Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- MySQL ou SQLite

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone <url-du-repo>
cd project-laravel
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
# Modifier le fichier .env avec vos paramètres de base de données
php artisan migrate
php artisan db:seed
```

6. **Compiler les assets**
```bash
npm run build
```

7. **Démarrer le serveur**
```bash
php artisan serve
```

## 🗄️ Structure de la Base de Données

### Tables Principales

#### `users`
- Informations utilisateur (nom, email, téléphone)
- Gestion des profils

#### `cars`
- **Informations de base** : marque, modèle, année, prix
- **Détails techniques** : kilométrage, type de carburant, VIN
- **Localisation** : ville, état, adresse
- **Contact** : téléphone
- **Médias** : image principale, URL vidéo
- **Fonctionnalités** : tableau JSON des équipements
- **Statut** : publié/non publié

#### `car_images`
- Images multiples par voiture
- Gestion des positions pour l'ordre d'affichage

#### `favorites`
- Relation many-to-many entre utilisateurs et voitures
- Gestion des favoris

## 🚀 Utilisation

### Pour les Utilisateurs
1. **S'inscrire/Se connecter** sur l'application
2. **Parcourir** les voitures disponibles sur la page d'accueil
3. **Ajouter des favoris** en cliquant sur l'icône cœur
4. **Consulter ses favoris** dans la section dédiée

### Pour les Vendeurs
1. **Créer une annonce** via le bouton "Ajouter une voiture"
2. **Remplir les informations** détaillées de la voiture
3. **Uploader des images** (supports multiples)
4. **Gérer les images** (réorganiser, supprimer)
5. **Publier l'annonce** ou la garder en brouillon

## 🔧 Commandes Artisan Utiles

```bash
# Démarrer l'environnement de développement complet
composer run dev

# Lancer les tests
composer run test

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Régénérer l'autoloader
composer dump-autoload

# Créer un utilisateur de test
php artisan tinker
```

## 📁 Structure du Projet

```
project-laravel/
├── app/
│   ├── Http/Controllers/     # Contrôleurs
│   ├── Models/              # Modèles Eloquent
│   └── Providers/           # Fournisseurs de services
├── database/
│   ├── migrations/          # Migrations de base de données
│   ├── seeders/            # Seeders pour les données de test
│   └── factories/          # Factories pour les tests
├── resources/
│   ├── views/              # Templates Blade
│   ├── css/                # Styles CSS
│   └── js/                 # JavaScript
├── routes/                 # Définition des routes
├── public/                 # Fichiers publics (images, etc.)
└── tests/                  # Tests automatisés
```

## 🧪 Tests

L'application utilise Pest pour les tests :

```bash
# Lancer tous les tests
php artisan test

# Lancer les tests avec couverture
php artisan test --coverage
```

## 🐳 Docker (Optionnel)

L'application inclut une configuration Docker avec Laravel Sail :

```bash
# Démarrer avec Docker
./vendor/bin/sail up

# Ou avec docker-compose
docker-compose up -d
```

## 🔒 Sécurité

- **Authentification** Laravel Breeze
- **Validation** des données côté serveur
- **Protection CSRF** automatique
- **Sanitisation** des entrées utilisateur
- **Gestion des permissions** par utilisateur

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📞 Support

Pour toute question ou problème :
- Ouvrir une issue sur GitHub
- Contacter l'équipe de développement

---

**Développé avec ❤️ en utilisant Laravel**
