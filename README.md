# ExerciceJs

installer composer + un environnement de base de données.

lancer composer install pour installer symfony puis yarn install pour la gestion du javascript.

Créer un fichier .env depuis .env.dist 
remplacer la ligne mysql://bd-user:db-pwd@db-name

Après avoir créer et lier votre bdd faite php bin/console make:migration

Insérer une ou plusieurs ligne dans la table fraichement créée.

Afin de lancer l'api, faire php bin/console server:run

Rendez vous à localhost:8000 

Puis tester le formulaire.
