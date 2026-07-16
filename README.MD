# Aurtistic

Application web calme et accessible destinée aux personnes neurodivergentes, aux personnes en questionnement ainsi qu’aux proches souhaitant mieux comprendre la neurodivergence.

Projet réalisé dans le cadre du titre professionnel Développeur Web et Web Mobile.

## Description du projet

Aurtistic est une application d’auto-accompagnement pensée pour proposer un espace numérique simple, lisible et rassurant.

L’application permet notamment de consulter des contenus courts de microlearning, de créer un compte utilisateur, de gérer un profil personnel, d’adapter certains paramètres d’accessibilité et d’utiliser un journal personnel.

Le projet a été conçu avec une attention particulière portée à l’accessibilité, à la lisibilité, au responsive design et à une expérience utilisateur adaptée aux personnes neurodivergentes.

## Stack technique

- Symfony 7.4
- PHP 8.3
- Doctrine ORM
- MySQL
- Twig
- Webpack Encore
- JavaScript vanilla
- CSS vanilla
- PHPUnit
- Git et GitHub

## Prérequis

Avant d’installer le projet, il faut avoir :

- PHP 8.3 ou supérieur
- Composer
- MySQL
- Node.js
- npm
- Git

## Installation

Cloner le dépôt :

```bash
git clone https://github.com/Jboum7/final_app_aurtistic.git
cd final_app_aurtistic/aurtistic
```

Installer les dépendances PHP :

```bash
composer install
```

Installer les dépendances JavaScript :

```bash
npm install
```

Créer un fichier `.env.local` à la racine du projet et configurer la connexion à la base de données :

```env
DATABASE_URL="mysql://utilisateur:motdepasse@127.0.0.1:3306/dataaurtis?serverVersion=8.0&charset=utf8mb4"
```

Le fichier `.env.local` contient des informations sensibles. Il ne doit pas être versionné sur GitHub.

Créer la base de données si elle n’existe pas encore :

```bash
php bin/console doctrine:database:create
```

Appliquer les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

Compiler les fichiers CSS et JavaScript avec Webpack Encore :

```bash
npm run dev
```

Lancer le serveur de développement :

```bash
php -S 127.0.0.1:8002 -t public
```

Le site est ensuite accessible à l’adresse :

```text
http://127.0.0.1:800
```
```text
Fonctionnalités principales
Côté visiteur
Consultation de la page d’accueil
Consultation de la page About Us
Consultation des contenus de microlearning
Création d’un compte
Connexion à l’application
Accès aux pages futures Routine tracker, Community et Print shop
Côté utilisateur connecté
Accès au dashboard
Gestion du profil utilisateur
Choix d’un profil neurodivergent
Gestion des paramètres d’accessibilité
Choix du thème clair ou sombre
Création d’un journal personnel
Ajout de notes dans un journal
Déconnexion
Côté administrateur
Création de catégories de microlearning
Création de lessons
Ajout de subjects dans les lessons
Organisation du contenu pédagogique
Accessibilité
Le projet Aurtistic a été pensé avec une attention particulière à l’accessibilité :
structure HTML sémantique ;
navigation simple ;
textes lisibles ;
couleurs douces ;
responsive design ;
paramètres d’accessibilité personnalisables ;
mode clair et mode sombre ;
interface volontairement calme pour limiter la surcharge visuelle.
Architecture du projet
Le projet suit l’organisation classique d’une application Symfony.
src/Controller contient les contrôleurs.
src/Entity contient les entités liées à la base de données.
src/Repository contient les classes permettant de récupérer les données.
src/Form contient les formulaires Symfony.
templates contient les vues Twig.
assets contient les fichiers CSS et JavaScript sources.
migrations contient les migrations de base de données.
tests contient les tests automatisés.
Tests
Les tests automatisés peuvent être lancés avec la commande :
php bin/phpunit
Le projet contient des tests permettant de vérifier certaines pages principales ainsi que des comportements simples liés aux entités.
Qualité du code
Le projet a été analysé avec SonarCloud afin d’obtenir un retour sur la qualité du code, la maintenabilité, la fiabilité et les éventuels points de sécurité à améliorer.
Fonctionnalités futures
Plusieurs évolutions sont envisagées :
enrichissement du contenu de microlearning ;
développement d’un Routine tracker plus complet ;
création d’un espace Community safe space ;
amélioration de la personnalisation du profil ;
développement d’une page Print shop en lien avec une imprimerie marseillaise.
La page Print shop aurait pour objectif de présenter des objets personnalisables et de rediriger l’utilisateur vers le site officiel de l’imprimerie. Aucun paiement ne serait réalisé directement dans l’application Aurtistic.
Auteur
Oumaïma BENSEGHIR-EL JAMOUDI
M2i Formation
Titre professionnel Développeur Web et Web Mobile
Promotion 2025 / 2026
```