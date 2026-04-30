# 📋 TaskManager — Application de Gestion de Tâches Laravel

Application web développée avec Laravel permettant à chaque employé de gérer ses tâches personnelles. Chaque utilisateur dispose d'un espace isolé : il ne voit que ses propres tâches.

---

## ✨ Fonctionnalités

- **Authentification** : inscription, connexion, déconnexion sécurisée
- **CRUD complet** : créer, lire, modifier, supprimer des tâches
- **Changement de statut rapide** : directement depuis la liste, sans ouvrir le formulaire
- **Filtrage** : par statut (à faire / en cours / terminé) et par catégorie
- **Isolation des données** : un utilisateur ne peut jamais voir ou modifier les tâches d'un autre
- **Compteur de tâches** par statut affiché sur le dashboard *(bonus)*
- **Date d'échéance** avec alerte visuelle rouge si dépassée *(bonus)*
- **Pagination** : 8 tâches par page *(bonus)*

---

## 🛠️ Stack Technique

| Technologie | Version |
|-------------|---------|
| PHP | >= 8.1 |
| Laravel | 10.x |
| MySQL / MariaDB | — |
| Bootstrap | 5.3 |
| Laravel Debugbar | dev only |
| Laravel Telescope | dev only |

---

## ⚙️ Installation

### Pré-requis

- PHP >= 8.1
- Composer
- MySQL ou MariaDB
- Git

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/ton-repo/taskmanager.git
cd taskmanager

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier de configuration
cp .env.example .env

# 4. Générer la clé d'application Laravel
php artisan key:generate
```

### Configuration de la base de données

Dans le fichier `.env`, modifier ces lignes :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskmanager
DB_USERNAME=root
DB_PASSWORD=
```

Créer la base de données dans MySQL :

```sql
CREATE DATABASE taskmanager;
```

### Lancer les migrations et les seeders

```bash
# Crée toutes les tables + insère les données de test
php artisan migrate --seed
```

### Installer les outils de debugging (développement)

```bash
# Laravel Debugbar — panneau SQL en bas de page
composer require barryvdh/laravel-debugbar --dev

# Laravel Telescope — interface d'analyse sur /telescope
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
```

### Démarrer le serveur

```bash
php artisan serve
```

Accéder à l'application : **http://localhost:8000**

---

## 👤 Compte de test

Créé automatiquement par le seeder :

| Champ | Valeur |
|-------|--------|
| Email | test@example.com |
| Mot de passe | password |

---

## 📁 Structure du projet

```
app/
├── Http/Controllers/
│   ├── AuthController.php      # Inscription, connexion, déconnexion
│   └── TaskController.php      # CRUD tâches + filtres + statut rapide
└── Models/
    ├── User.php                 # hasMany Task
    ├── Task.php                 # belongsTo User, belongsTo Category
    └── Category.php             # hasMany Task

database/
├── migrations/                  # Toutes les tables via migrations Laravel
└── seeders/
    ├── CategorySeeder.php       # 5 catégories de base
    └── DatabaseSeeder.php       # Utilisateur + tâches de test

resources/views/
├── layouts/
│   └── app.blade.php            # Layout principal (@auth / @guest)
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
└── tasks/
    ├── index.blade.php          # Liste + filtres + compteur + pagination
    ├── create.blade.php         # Formulaire création
    └── edit.blade.php           # Formulaire modification

routes/
└── web.php                      # Toutes les routes nommées groupées sous middleware auth
```

---

## 🗄️ Modèle de données

```
users
  id, name, email, password, timestamps

categories
  id, name, timestamps

tasks
  id, title, description, status (todo|in_progress|done),
  due_date, user_id (FK), category_id (FK), timestamps
```

**Relations Eloquent :**
- `User` → `hasMany` → `Task`
- `Task` → `belongsTo` → `User`
- `Task` → `belongsTo` → `Category`
- `Category` → `hasMany` → `Task`

---

## 🔒 Sécurité

- Toutes les routes tâches protégées par `middleware('auth')`
- Vérification de propriété avant chaque modification ou suppression :
  ```php
  if ($task->user_id !== auth()->id()) abort(403);
  ```
- `@csrf` présent sur tous les formulaires
- Validation `$request->validate()` sur tous les inputs
- `$fillable` défini dans chaque modèle (protection mass assignment)

---

## 🔍 Debugging

### Laravel Debugbar
Actif automatiquement si `APP_DEBUG=true` dans `.env`.
Affiche en bas de page : requêtes SQL, temps d'exécution, mémoire utilisée.

### Laravel Telescope
Accessible sur : **http://localhost:8000/telescope**
Permet de consulter chaque requête HTTP : payload, queries SQL associées, exceptions levées.

---

## 🧪 Commandes utiles

```bash
# Voir toutes les routes nommées
php artisan route:list

# Réinitialiser la base de données avec les seeders
php artisan migrate:fresh --seed

# Console interactive Laravel
php artisan tinker

# Vider le cache
php artisan cache:clear
php artisan config:clear
```

---

## 🌿 Branches Git

| Branche | Contenu |
|---------|---------|
| `main` | Code stable final |
| `feature/auth` | Authentification (inscription / connexion) |
| `feature/task-crud` | CRUD complet des tâches |
| `feature/filters` | Filtrage par statut et catégorie |

---

## 👨‍💻 Auteur

Projet réalisé dans le cadre de la formation **Développeur Web et Web Mobile (DWWM)**.
