# MyBestPro

Afin de rejoindre l'équipe de MyBestPro, un test technique m'a été demandé.
La contrainte était de le faire sous Symfony, j'ai donc décidé d'utiliser Symfony 5.

# Installation

Pour commencer, rendez vous dans le dossier htdocs de votre MAMP.

```bash
/Applications/MAMP/htdocs/
```

Cloner le projet

```bash
git clone https://github.com/Starwox/subskill.git
```

Une fois le projet récupéré, accéder au projet, et installer les dépendances

```bash
cd MyBestPro/
composer install
```

Il vous faudra modifier le fichier .env

```bash
DATABASE_URL=mysql://username:password@127.0.0.1:3306/mybestpro

SQL
username = Pseudo
password = Mot de passe
3306 = Port PhpMyAdmin
mybestpro = Nom de la base de donnée
```

Il faut créer la base de donnée
```bash
php bin/console doctrine:database:create

```

Nous pouvons donc démarrer le projet ! (N'oubliez pas de lancer MAMP)

```bash
symfony server:start
```

