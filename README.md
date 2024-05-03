# Projet Symfony

Ce projet utilise Symfony pour construire une application web.

## Installation

### Prérequis

Assurez-vous d'avoir les prérequis suivants installés sur votre système :
- PHP
- Composer
- Symfony CLI
- MySQL

### Étapes d'installation

cd projet-symfony
dependance composer
composer install
creer la base de donnees et la migration :
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
demarrer le sever
symfony serve

Configuration de Mailtrap

Pour la réinitialisation de mot de passe via e-mail, configurez Mailtrap en suivant ces étapes :

    Inscrivez-vous sur Mailtrap et créez un compte.

    Dans votre fichier .env, ajoutez les informations de connexion Mailtrap :

MAILER_DSN=smtp://your-smtp-server:port?encryption=your-encryption&auth_mode=login&username=your-username&password=your-password

Authentification par E-mail

Ce projet utilise l'authentification par e-mail. Les utilisateurs peuvent se connecter en utilisant leur adresse e-mail et leur mot de passe.
Gestion des Rôles Utilisateur

Ce projet comprend trois rôles utilisateur :

    Utilisateur normal
    Administrateur
    Super Administrateur

Les administrateurs ont des autorisations supplémentaires par rapport aux utilisateurs normaux, et les super administrateurs ont des autorisations supplémentaires par rapport aux administrateurs.
Base de Données MySQL

Ce projet utilise MySQL comme base de données. Vous pouvez configurer les paramètres de connexion dans le fichier .env.
