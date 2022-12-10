# Project Monitoring

## Étapes suivies pour la création du projet

### Création du projet

[Documentation Symfony](https://symfony.com/doc/current/setup.html)

```shell
composer create-project symfony/skeleton:"6.2.*" project-monitoring
```

J'ai ensuite ouvert le projet dans PHPStorm et activé le plugin Symfony.

### Installation de webapp

Cette étape permet d'installer l'ensemble des dépendances couramment utilisées
dans un projet Symfony (Doctrine, Twig, Forms...).

```shell
composer require webapp
```

### Installation de apache-pack

Cette étape est optionnelle, mais permet de faire fonctionner l'application
pour les utilisateurs d'Apache.
Il faut bien penser à répondre "yes" à la question posée par le script.

[Documentation Symfony](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules)

```shell
composer require symfony/apache-pack
```

### Création des entités

J'ai ensuite créé les entités nécessaires au projet.
J'ai tout d'abord créé les entités `Project`, `Category` et `Customer` avec la commande suivante :

```shell
php bin/console make:entity
```

Puis j'ai ensuite créé l'entité User avec la commande suivante :

```shell
php bin/console make:user
```

Ensuite, j'ai configuré la connexion à la base de données dans le fichier `.env.local` :

```shell
DATABASE_URL="mysql://root:@127.0.0.1:3306/project_monitoring?serverVersion=5.7&charset=utf8mb4"
```

J'ai ensuite créé la base de données avec la commande suivante :

```shell
php bin/console doctrine:database:create
```

Enfin, j'ai généré puis exécuté les fichiers de migration avec les commandes suivantes :

```shell
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
