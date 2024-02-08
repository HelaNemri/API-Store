# API-Store

# Installation du projet :

- composer install
- Importer le fichier "dump.sql" pour la génération de la base de donnée.

# Structure du projet

- Le endpoint est situé dans le dossier public
- Api :

  - MagasinController
  - AuthController
  - middleware : Pour authentifier l'utilisateur en fonction de l'en-tête 'Authorization' de la requête.
  - Model : le Modèle Magasin avec tous ses champs.
  - MagasinRepository : responsable de l'interaction avec la base des données pour le modèle Magasin.

- Core :
  La classe Route est utilisée pour acheminer les requêtes HTTP vers le contrôleur et l'action appropriés en fonction de l'URL et de la méthode demandées.

- Services :

  - HelperService : un service qui fournit des méthodes utilitaires réutilisables .

- database : La classe Database gère la connexion à la base de données et fournit des méthodes pour exécuter des requêtes SQL et récupérer les résultats.

- docs : Pour accéder à la documentation il suffit de copier le contenue du fichier swagger.yaml dans l'éditeur en ligne https://editor.swagger.io/ ou utiliser votre propre éditeur swagger installé.

- routes : api.php contient tous les routes pour la gestion du magasin de l'API.

# Documentation de l'API

## Introduction

API permettant à WSHOP d'accéder à une liste de magasins, de filtrer, trier, ajouter, supprimer ou modifier les magasins.

## Endpoint de base

- URL de base : http://127.0.0.1
- Méthodes HTTP prises en charge : GET, POST, PUT, DELETE

## Authentification

L'API utilise le "Bearer token" JWT pour l'authentification
Il faudrait générer un token pour pouvoir utiliser les APIs.
La durée de vie de chaque token est limitée à une heure.

## Ressources

### Magasin

- Propriétés :
  - `id` (integer) : Identifiant unique du magasin.
  - `nom` (string) : Nom du magasin.
  - `ville` (string) : Ville du magasin.
  - `categorie` (string) : Catégorie du magasin.
  - `adresse` (string) : Adresse du magasin.
  - `code_postal` (string) : Code postal du magasin.
  - `telephone` (string) : Numéro de téléphone du magasin.
  - `email` (string) : Adresse e-mail du magasin.
  - `site_web` (string) : Site web du magasin.
  - `date_ouverture` (string) : Date d'ouverture du magasin (format : "YYYY-MM-DD").
  - `description` (string) : Description du magasin.
  - `tr_date_updated` (string) : Date de mise à jour du magasin (format ISO 8601).

## Endpoints spécifiques

### GET /magasins

- Description : Récupère la liste des magasins.
- Paramètres :

  - `champs` (string, facultatif) : Filtre par le champs choisi.
  - `tri` (string, facultatif) : Champ de tri (par défaut : "nom").
  - `ordre` (string, facultatif) : Ordre de tri (par défaut : "asc").

  - Réponse (200 OK) :

    - `id` (integer) : Identifiant unique du magasin.
    - `nom` (string) : Nom du magasin.
    - `ville` (string) : Ville du magasin.
    - `categorie` (string) : Catégorie du magasin.
    - `adresse` (string) : Adresse du magasin.
    - `code_postal` (string) : Code postal du magasin.
    - `telephone` (string) : Numéro de téléphone du magasin.
    - `email` (string) : Adresse e-mail du magasin.
    - `site_web` (string) : Site web du magasin.
    - `date_ouverture` (string) : Date d'ouverture du magasin (format : "YYYY-MM-DD").
    - `description` (string) : Description du magasin.
    - `tr_date_updated` (string) : Date de mise à jour du magasin (format ISO 8601).

  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.

### POST /magasins

- Description : Ajoute un nouveau magasin.
- Sécurité : Requiert une authentification avec un jeton (Bearer token).
- Corps de la requête (application/json) :

  - `nom` (string) : Nom du magasin.
  - `ville` (string, requis) : Ville du magasin.
  - `categorie` (string) : Catégorie du magasin.
  - `adresse` (string) : Adresse du magasin.
  - `code_postal` (string) : Code postal du magasin.
  - `telephone` (string) : Numéro de téléphone du magasin.
  - `email` (string) : Adresse e-mail du magasin.
  - `site_web` (string) : Site web du magasin.
  - `date_ouverture` (string) : Date d'ouverture du magasin (format : "YYYY-MM-DD").
  - `description` (string) : Description du magasin.

  - Réponse (200 OK) : Magasin ajouté avec succès.
  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.

### GET /magasins/{id}

- Description : Récupère un magasin par son ID.
- Paramètres :

  - `id` (integer, requis) : ID du magasin à récupérer.

  - Réponse (200 OK) :

    - `id` (integer) : Identifiant unique du magasin.
    - `nom` (string) : Nom du magasin.
    - `ville` (string) : Ville du magasin.
    - `categorie` (string) : Catégorie du magasin.
    - `adresse` (string) : Adresse du magasin.
    - `code_postal` (string) : Code postal du magasin.
    - `telephone` (string) : Numéro de téléphone du magasin.
    - `email` (string) : Adresse e-mail du magasin.
    - `site_web` (string) : Site web du magasin.
    - `date_ouverture` (string) : Date d'ouverture du magasin (format : "YYYY-MM-DD").
    - `description` (string) : Description du magasin.
    - `tr_date_updated` (string) : Date de mise à jour du magasin (format ISO 8601).

  - Réponse (404 Not Found) : Magasin non trouvé.
  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.

### PUT /magasins/{id}

- Description : Met à jour un magasin par son ID.
- Paramètres :
  - `id` (integer, requis) : ID du magasin à mettre à jour.
- Sécurité : Requiert une authentification avec un jeton (Bearer token).
- Corps de la requête (application/json) :

  - `nom` (string) : Nouveau nom du magasin.
  - `ville` (string) : Nouvelle ville du magasin.
  - `categorie` (string) : Nouvelle catégorie du magasin.
  - `adresse` (string) : Nouvelle adresse du magasin.
  - `code_postal` (string) : Nouveau code postal du magasin.
  - `telephone` (string) : Nouveau numéro de téléphone du magasin.
  - `email` (string) : Nouvelle adresse e-mail du magasin.
  - `site_web` (string) : Nouveau site web du magasin.
  - `date_ouverture` (string) : Nouvelle date d'ouverture du magasin (format : "YYYY-MM-DD").
  - `description` (string) : Nouvelle description du magasin.

  - Réponse (200 OK) : Magasin mis à jour avec succès.
  - Réponse (404 Not Found) : Magasin non trouvé.
  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.

### DELETE /magasins/{id}

- Description : Supprime un magasin par son ID.
- Paramètres :
  - `id` (integer, requis) : ID du magasin à supprimer.
- Sécurité : Requiert une authentification avec un jeton (Bearer token).

  - Réponse (200 OK) : Magasin supprimé avec succès.
  - Réponse (404 Not Found) : Magasin non trouvé.
  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.

### GET /auth

- Description : Génère un jeton d'authentification.
- Sécurité : Requiert une authentification avec un jeton (Bearer token).

  - Réponse (200 OK) : Jeton d'authentification généré avec succès.
    - Exemple : 'Bearer [token]'
  - Réponse (401 Unauthorized) : Non autorisé. L'authentification est requise.
