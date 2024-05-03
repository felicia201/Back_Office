Back Office Symfony 7 - 

Ce projet est un back office développé en utilisant Symfony 7 pour l'entreprise L'Amusée. Il permet la gestion des utilisateurs et des devis, ainsi que les fonctionnalités de connexion, inscription et déconnexion.
Fonctionnalités

    Authentification et Gestion des Utilisateurs
        Connexion : Les utilisateurs peuvent se connecter à leur compte.
        Inscription : Les utilisateurs peuvent s'inscrire pour créer un nouveau compte. Une option d'inscription via email est disponible.
        Déconnexion : Les utilisateurs peuvent se déconnecter de leur compte.

    Gestion des Utilisateurs
        CRUD Utilisateur : Opérations de Create, Read, Update et Delete pour gérer les utilisateurs.
        Attributs Utilisateur : Les utilisateurs sont définis par les attributs suivants : Nom, Prénom, Email, Genre et RGPD.

    Gestion des Devis
        CRUD Devis : Opérations de Create, Read, Update et Delete pour gérer les devis.
        Téléchargement PDF : Les utilisateurs ont la possibilité de télécharger les devis au format PDF.

Configuration
Configuration de Mailtrap

Pour la fonctionnalité d'inscription via email, configurez Mailtrap en suivant ces étapes :

    Inscrivez-vous sur Mailtrap et créez un compte.

    Dans votre fichier .env, ajoutez les informations de connexion Mailtrap :

    arduino

    MAILER_DSN=smtp://your-smtp-server:port?encryption=your-encryption&auth_mode=login&username=your-username&password=your-password

Base de Données MySQL

Ce projet utilise MySQL comme base de données. Vous pouvez configurer les paramètres de connexion dans le fichier .env.
Installation

    Clonez ce repository sur votre machine locale.

    Installez les dépendances en exécutant la commande suivante :

composer install

Créez la base de données en exécutant les commandes suivantes :

bash

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Lancez le serveur Symfony en exécutant la commande suivante :

    symfony serve




