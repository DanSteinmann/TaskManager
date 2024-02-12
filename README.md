# Task Manager

![Rendu du projet](/resources/img/Main.png "TaskManager")

## Introduction
Ce projet est une application web conçue pour faciliter la gestion de projets et de tâches associées, offrant aux utilisateurs une plateforme intuitive pour organiser efficacement leur travail. Développé avec Laravel et intégrant Laravel Breeze pour l'authentification, l'application permet de créer, d'éditer, d'assigner et de suivre l'avancement des tâches au sein de différents projets.

## Dépendances

Ce projet est construit avec [Laravel](https://laravel.com/), un framework PHP pour le développement web. Outre Laravel, ce projet utilise plusieurs autres dépendances pour fonctionner correctement :

- **[Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)** : Laravel Breeze fournit une implémentation simple pour l'authentification, incluant le login, l'enregistrement et la modification des mots de passe.

- **[Tailwind CSS](https://tailwindcss.com/)** : Un framework CSS utility-first pour un design rapide et réactif.

- **[MySQL](https://www.mysql.com/)** : Système de gestion de base de données relationnelle utilisé pour stocker toutes les données de l'application. Bien que Laravel supporte plusieurs systèmes de base de données, ce projet est configuré pour utiliser MySQL.

- **[Composer](https://getcomposer.org/)** : Gestionnaire de dépendances pour PHP, utilisé pour installer et gérer les bibliothèques sur lesquelles le projet s'appuie.

- **[Node.js et npm](https://nodejs.org/)** (optionnel) : Utilisés pour compiler les ressources frontend si vous modifiez le JavaScript ou le CSS Tailwind personnalisé. Laravel Mix, qui repose sur Webpack, est utilisé pour compiler les assets.


## Installation
Pour installer et exécuter ce projet, suivez les étapes ci-dessous :

0. **Prérequis**

    - Installer docker

1. **Cloner le dépôt**

Tout d'abord, clonez le dépôt sur votre machine locale en utilisant la commande suivante :  

   ```
   git clone https://github.com/DanSteinmann/TaskManager.git
   ```
2. **Configurer l'environnement**

    Copiez le fichier `.env.example` en un nouveau fichier nommé `.env` et configurez vos variables d'environnement (base de données, mail, etc.) selon besoin :

3. **Installer les dépendances**

Ensuite, naviguez dans le répertoire du projet cloné et l'installation des dépendances :  

    
    cd TaskManager
    docker run --rm --interactive --tty   --volume $PWD:/app   --user $(id -u):$(id -g)   composer install
    ./vendor/bin/sail up
    

Dans un second terminal, générez la clé, installet et démarrer VITE  
    
    
    cd TaskManager
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
        

## Mise en route

Après l'installation, vous pouvez démarrer le serveur de développement local pour accéder à l'application :  
Si vous n'avez pas modifier le fichier de configuration, il se trouve ici [https://localhost/](https://localhost/).  


![Welcome page](/resources/img/WelcomePage.png "Welcome")

### Création de compte et login
1. Créer un Compte: Register  
Visitez la page d'inscription pour créer un nouveau compte utilisateur  
Vous devrez renseigner:  
    - votre nom (il sera visible par les autres utilisateurs)
    - Votre e-mail
    - Un mot de passe de minimum 6 caractères

![Register page](/resources/img/Register.png "Register")

2. Se connecter (si déjà enregistrer)
Si votre compte a déjà été créer, vous pourrez vous connecter via le login
3. Modifier user
Dans le coin supérieur droit, en cliquant sur votre nom, vous pourrez modifier votre profile.
Vous avez le posibilité de changer:
    - votre nom
    - votre e-mail
    - votre mot de passe
Vous avez également la possibilité de supprimer votre compte utilisateur.

### Création de votre premier projet
Dans l'onglet Management, vous avez une vue d'ensemble des vos projets et tâches à effectuer.
Pour créer votre premier projet, cliquer sur le bouton `Create a new project` ou cliquer sur l'onglet `Create Project`
Vous devrez remplir les 4 attributs qui sont:
    - name (nom du projet)
    - Description (description du projet)
    - Start date (date de début du projet)
    - End date (date de fin du projet)

Cliquer sur Create pour créer le projet.  

![New Project](/resources/img/NewProject.png "New Project")

Vous serez rediriger vers la page Management.  
Vous avez la possibilité d'éditer ou de supprimer le projet.  

![New Project Home](/resources/img/NewProjectHome.png "New Project home")

### Création de tâches
Dans l'onglet Management, vous avez une vue d'ensemble des vos projets et tâches à effectuer.  
Pour créer votre première tâche, cliquer sur le bouton `Create a new task` sous le projet ou cliquer sur l'onglet `Create Task`  
Vous devrez remplir les 6 attributs qui sont:  
- Title (titre de la tâche)
- Description (description de la tâche)
- State (état de la tâche, pending ou completed)
- Deadline (date de fin de la tâche)
- User (utilisateur chargé de la réalisation, nobody permet de laisser l'attribut vide)
- Project (nom du projet parmis les projets existant)

Cliquer sur Create pour créer la tâche.  
Vous serez rediriger vers la page Management.  

![New Task](/resources/img/NewTask.png "New Task")

Vous avez 3 actions que vous pouvez effectuer avec les tâches:  
- Editer
- Inverser son état (pending - completed - pending)
- Supprimer

![New Task Home](/resources/img/NewTaskHome.png "New Task home")

### Remarques d'ordre général, limitations et sécurité

Tout utilisateur connecté pour créer / modifier / supprimer du contenu, il n'y a pas de propriété.  
Les tâches peuvent êtres suppriées en tout temps, il n'y a pas de limitation.  
Les projets ne peuvent être supprimés que s'ils n'ont plus de tâches actives (pending).  
Si vous supprimer votre compte utilisateur, vos tâches ne seront pas supprimées mais vous ne serez plus attribué à cette tâche.  

### Améliorations

- Augmenter la sécurité en demandant une confirmation pour la suppression d'éléments, car cette action est iréversible.  
- Indiquer qu'un projet est en retard  
- Indiquer qu'un tâche est hors délais d'un projet  
