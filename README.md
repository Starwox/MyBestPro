# MyBestPro

Afin de rejoindre l'équipe de MyBestPro, un test technique m'a été demandé.
La contrainte était de le faire sous Symfony, j'ai donc décidé d'utiliser Symfony 5.

Environnement de travail: Mac OSX

Le projet nécessite: Php 7, Symfony 5 et MySQL pour son bon fonctionnement

# Installation

Lancer MAMP pour commencer

Cloner le projet

```bash
git clone https://github.com/Starwox/MyBestPro.git
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
mybestpro = Nom de la base de données
```

Il faut créer la base de données
```bash
php bin/console doctrine:database:create
```

Une fois la base de données crée, il faut y implenter les migrations.
```bash
php bin/console d:m:m
```

J'ai crée une commande pour compléter la table Status
```bash
php bin/console app:status
OR
php bin/console app:status -f
```

Il faut compiler le CSS / JS avec cette commande
```bash
yarn encore dev
```

Nous pouvons donc démarrer le projet ! (N'oubliez pas de lancer MAMP)

```bash
symfony server:start
```

Le projet fonctionne !
