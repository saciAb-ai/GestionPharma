# GestionPharma - Système de Gestion de Pharmacie

Bienvenue dans le projet **GestionPharma**. Ce document détaille l'installation, la structure et les bonnes pratiques pour le développement de l'application Laravel.

## 📋 Description
GestionPharma est une application web conçue pour gérer le stock, les ventes et les achats d'une pharmacie. Elle permet :
- La gestion des produits et des catégories.
- L'enregistrement des ventes et des achats.
- La gestion des utilisateurs et des permissions (Admin, Pharmacien(sale person)).

---

## 🛠 Prérequis

Avant de commencer, assurez-vous d'avoir installé :
- **PHP** >= 7.3 
- **Composer** (Gestionnaire de dépendances PHP)
- **MySQL**
- **Node.js & NPM** (Pour compiler les assets CSS/JS)

---

##  Installation étape par étape

1.  **Cloner le projet ou extraire l'archive**
    ```bash
    cd GestionPharma
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Installer les dépendances JS (NPM)**
    Pour que le design (CSS/JS) fonctionne, il faut installer et compiler les assets.
    ```bash
    npm install
    npm run dev
    ```

4.  **Configurer l'environnement**
    Dupliquez le fichier `.env.example` et renommez-le en `.env`.
    ```bash
    cp .env.example .env
    ```
    Ouvrez `.env` et configurez votre base de données :
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gestionpharma
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6.  **Générer la clé d'application**
    ```bash
    php artisan key:generate
    ```

7.  **Créer la Base de Données et les Données de test**
    Cette commande crée les tables et injecte les faux utilisateurs/produits.
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Lancer le serveur de développement**
    ```bash
    php artisan serve
    ```
    L'application est accessible sur `http://127.0.0.1:8000`.

---

##  Structure du Backend Métier (`Backend Logic`)

### 1. Modèles (`app/Models`)
Les objets PHP représentant vos données.
- **User** : Les employés de la pharmacie.
- **Product** : Médicaments et articles en stock.
- **Sale** : Enregistrement d'une vente (liée à un produit).
- **Purchase** : Enregistrement d'un achat fournisseur.
- **Category** : Familles de produits.
- **Supplier** : Fournisseurs.

### 2. Migrations (`database/migrations`)
L'historique de structure de la base de données.
- Chaque fichier crée ou modifie une table.
- Ordre chronologique important (ex: on crée `products` avant `sales` car une vente a besoin d'un produit).

### 3. Relations Clés
- **Sale** `belongsTo` **Product** : Une vente concerne un produit spécifique.
- **Product** `belongsTo` **Category** (logique métier) : Un produit est classé.

---

##  Commandes Utiles

| Action | Commandes |
| :--- | :--- |
| **Lancer le serveur** | `php artisan serve` |
| **Mettre à jour la BDD** | `php artisan migrate` |
| **Réinitialiser la BDD + Données** | `php artisan migrate:fresh --seed` |
| **Créer un Modèle + Migration** | `php artisan make:model NomModel -m` |
| **Voir les routes** | `php artisan route:list` |

---


*Documentation générée pour l'équipe de développement GestionPharma.*
