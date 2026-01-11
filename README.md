# GestionPharma - Système de Gestion de Pharmacie

Bienvenue dans **GestionPharma**, une application web simple et efficace pour gérer le stock, les achats et les ventes d'une pharmacie. Ce projet est conçu pour être facile à installer et à utiliser.

---

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir les outils suivants installés sur votre ordinateur :

1.  **XAMPP** (ou WAMP/MAMP) : Pour avoir PHP et MySQL (la base de données).
2.  **Composer** : Pour installer les bibliothèques PHP de Laravel.
3.  **Node.js** (optionnel) : Seulement si vous devez modifier les styles CSS/JS.

---

## 🚀 Installation (Étape par Étape)

Ouvrez votre terminal (PowerShell ou CMD) dans le dossier du projet et suivez ces commandes :

### 1. Installer les dépendances PHP
Cette commande télécharge tous les composants nécessaires au fonctionnement de Laravel.
```bash
composer install
```

### 2. Configurer l'environnement
Nous devons créer le fichier de configuration `.env` à partir de l'exemple fourni.
```bash
copy .env.example .env
```
*(Si la commande `copy` ne fonctionne pas, copiez-collez manuellement le fichier `.env.example` et renommez-le en `.env`)*

### 3. Générer la clé de l'application
C'est une clé de sécurité unique pour votre projet.
```bash
php artisan key:generate
```

### 4. Configurer la Base de Données
1.  Ouvrez **phpMyAdmin** (généralement `http://localhost/phpmyadmin`).
2.  Créez une nouvelle base de données vide nommée **`pharmacy`**.
3.  Ouvrez le fichier `.env` avec un éditeur de texte (Bloc-notes ou VS Code) et vérifiez ces lignes :
    ```ini
    DB_DATABASE=pharmacy
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *(Mettez un mot de passe si votre root en a un, sinon laissez vide)*

### 5. Créer les tables et les comptes par défaut
Cette commande crée toutes les tables dans la base de données et ajoute les utilisateurs par défaut (Admin, etc.).
```bash
php artisan migrate:fresh --seed
```

### 6. Lancer l'application !
Démarrez le serveur de développement local.
```bash
php artisan serve
```
Vous pouvez maintenant accéder à l'application via : **http://127.0.0.1:8000**

---

## 👤 Comptes de Connexion par Défaut

Une fois l'installation terminée, utilisez ces identifiants pour vous connecter :

### Super Admin (Accès complet)
*   **Email :** `admin@admin.com`
*   **Mot de passe :** `password`

### Gérant Pharmacie (Admin)
*   **Email :** `saci@gmail.com`
*   **Mot de passe :** `password`

### Vendeur (Sales Person)
*   **Email :** `vendeur@gmail.com`
*   **Mot de passe :** `password`

---

## 🛠 Commandes Utiles

Voici quelques commandes que vous pourriez avoir besoin d'utiliser plus tard :

*   **Vider le cache** (si vous faites des modifications qui ne s'affichent pas) :
    ```bash
    php artisan optimize:clear
    ```

*   **Créer un lien vers les images** (si les images des produits ne s'affichent pas) :
    ```bash
    php artisan storage:link
    ```

---

## 📝 Fonctionnalités Principales

*   **Tableau de bord :** Vue d'ensemble des ventes et du stock.
*   **Gestion des Achats :** Entrée de stock (Fournisseurs, Dates de péremption).
*   **Catalogue Produits :** Liste des médicaments en vente.
    *   *Note :* Possibilité d'ajouter des produits périmés ou hors stock pour régularisation.
*   **Point de Vente (POS) :** Interface pour effectuer les ventes au comptoir.
*   **Rapports :** Historique des ventes.

---

## ⚠️ Notes Techniques

*   Les notifications de péremption sont visuelles (couleur rouge) dans les listes, pas de pop-up intrusif.
*   Le système autorise la vente de produits même si le stock est à 0 dans certains cas de régularisation.

**Besoin d'aide ?** Contactez l'administrateur système.
