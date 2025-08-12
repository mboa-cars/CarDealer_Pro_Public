# 📊 Diagrammes UML - CarDealer Pro

Ce dossier contient les diagrammes UML de l'application CarDealer Pro, une plateforme complète de gestion de voitures d'occasion.

## 🎯 Diagrammes Disponibles

### 1. **Diagramme de Classe** (`diagramme_classe.puml`)
Représente la structure des classes et leurs relations dans l'application.

**Classes principales :**
- **User** : Utilisateur authentifié avec gestion des favoris
- **Car** : Voiture mise en vente avec images multiples
- **CarImage** : Images des voitures avec positionnement
- **Favorite** : Table pivot pour les favoris utilisateur

**Relations :**
- Un User peut posséder plusieurs Cars
- Un User peut avoir plusieurs Favorites
- Une Car peut avoir plusieurs CarImages
- Une Car peut être favorie par plusieurs Users

### 2. **Diagramme de Séquence** (`diagramme_sequence.puml`)
Illustre le processus d'ajout d'une voiture dans l'application.

**Étapes principales :**
1. Authentification de l'utilisateur
2. Saisie des données du formulaire
3. Validation des champs requis
4. Création de la voiture en base
5. Gestion des images uploadées
6. Redirection vers "Mes Voitures"

### 3. **Diagramme d'Architecture** (`diagramme_architecture.puml`)
Montre l'architecture globale du système.

**Couches :**
- **Frontend** : Vue.js, Blade Templates, CSS/JS
- **Backend** : Laravel avec Controllers, Models, Middleware
- **Base de Données** : MySQL avec 4 tables principales
- **Stockage** : Images publiques et uploadées
- **Infrastructure** : Docker, Nginx, PHP-FPM

## 🚀 Génération des Diagrammes

### Prérequis
- Java (JRE)
- PlantUML

### Installation automatique
```bash
./generate_diagrams.sh
```

### Installation manuelle
```bash
# Installer Java
sudo apt update
sudo apt install -y default-jre

# Installer PlantUML
wget https://github.com/plantuml/plantuml/releases/download/v1.2023.10/plantuml-1.2023.10.jar -O plantuml.jar
sudo mv plantuml.jar /usr/local/bin/
echo '#!/bin/bash' | sudo tee /usr/local/bin/plantuml
echo 'java -jar /usr/local/bin/plantuml.jar "$@"' | sudo tee -a /usr/local/bin/plantuml
sudo chmod +x /usr/local/bin/plantuml
```

### Génération manuelle
```bash
# Créer le dossier
mkdir -p diagrams

# Générer les diagrammes
plantuml -tpng diagramme_classe.puml -o diagrams/
plantuml -tpng diagramme_sequence.puml -o diagrams/
plantuml -tpng diagramme_architecture.puml -o diagrams/
```

## 📁 Structure des Fichiers

```
project-laravel/
├── diagramme_classe.puml          # Diagramme de classe
├── diagramme_sequence.puml        # Diagramme de séquence
├── diagramme_architecture.puml    # Diagramme d'architecture
├── generate_diagrams.sh           # Script de génération
├── README_DIAGRAMMES.md          # Ce fichier
└── diagrams/                     # Dossier des images générées
    ├── CarDealer_Pro_Class_Diagram.png
    ├── CarDealer_Pro_Sequence_Diagram.png
    └── CarDealer_Pro_Architecture.png
```

## 🔧 Modifications

Pour modifier les diagrammes :

1. **Éditer les fichiers .puml** avec un éditeur de texte
2. **Exécuter le script** : `./generate_diagrams.sh`
3. **Vérifier les images** dans le dossier `diagrams/`

## 📋 Fonctionnalités Documentées

### Gestion des Voitures
- ✅ Création d'une voiture
- ✅ Modification d'une voiture
- ✅ Suppression d'une voiture
- ✅ Gestion des images multiples
- ✅ Système de favoris

### Authentification
- ✅ Inscription utilisateur
- ✅ Connexion/Déconnexion
- ✅ Gestion du profil
- ✅ Middleware d'authentification

### Interface Utilisateur
- ✅ Templates Blade
- ✅ Composants Vue.js
- ✅ Styles CSS modernes
- ✅ JavaScript interactif

## 🎨 Style des Diagrammes

Les diagrammes utilisent un style moderne avec :
- Couleurs douces et professionnelles
- Police Arial pour la lisibilité
- Arrière-plan blanc
- Bordures arrondies
- Icônes et emojis pour la clarté

## 📞 Support

Pour toute question sur les diagrammes ou l'architecture :
- Consultez la documentation Laravel
- Vérifiez les modèles Eloquent
- Examinez les contrôleurs pour les relations

---

**CarDealer Pro** - Une plateforme moderne de gestion de voitures d'occasion 🚗 