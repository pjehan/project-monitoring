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

### Création des fixtures

J'ai installé le bundle `DoctrineFixturesBundle` avec la commande suivante :

```shell
composer require --dev doctrine/doctrine-fixtures-bundle
```

J'ai ensuite supprimé le fichier `src/DataFixtures/AppFixtures.php` et créé un fichier de fixtures par entité Doctrine la commande suivante :

```shell
php bin/console make:fixtures
```

Après avoir créé les fixtures, j'ai exécuté la commande suivante pour les charger en base de données :

```shell
php bin/console doctrine:fixtures:load
```

### Configuration des assets

Pour ce projet, j'ai décidé d'utiliser Webpack Encore, SASS ainsi que
les librairies Bootstrap 5 et Font Awesome 5.

En utilisant Webpack Encore, je n'aurai pas besoin d'importer les fichiers
CSS ou JS qui seront automatiquement importés grâce aux lignes suivantes
déjà présentes dans le fichier `templates/base.html.twig` :

```twig
{% block stylesheets %}
    {{ encore_entry_link_tags('app') }}
{% endblock %}

{% block javascripts %}
    {{ encore_entry_script_tags('app') }}
{% endblock %}
```

#### Installation de webpack encore

[Documentation Symfony](https://symfony.com/doc/current/frontend.html)

J'ai installé le bundle `Webpack Encore` pour gérer la compilation des assets
avec la commande suivante :

```shell
composer require symfony/webpack-encore-bundle
npm install
```

#### Mise en place de SASS

[Documentation Symfony](https://symfony.com/doc/current/frontend/encore/css-preprocessors.html)

J'ai renommé le fichier `assets/app.css` en `assets/app.scss` et j'ai modifié
le fichier `assets/app.js` pour importer le fichier `assets/app.scss` :

```javascript
// assets/app.js
import '../css/app.scss';
```

Ensuite, j'ai décommenté la ligne suivante dans le fichier `webpack.config.js`
pour activer la compilation des fichiers SASS :

```javascript
// webpack.config.js
.enableSassLoader()
```

Enfin, si on execute la commande `npm run watch` on obtient une erreur nous
indiquant d'installer sass-loader et sass (attention, la version de sass-loader
peut être différente) :

```shell
npm install sass-loader@^13.0.0 sass --save-dev
```

#### Installation de bootstrap

[Documentation Symfony](https://symfony.com/doc/current/frontend/encore/bootstrap.html)

J'ai commencé par installer Bootstrap avec la commande suivante :

```shell
npm install bootstrap
```

J'ai ensuite ajouté la ligne suivante dans le fichier `assets/app.scss` 
pour importer les styles de Bootstrap :

```scss
// assets/app.scss
@import '~bootstrap/scss/bootstrap';
```

J'ai volontairement omis d'importer les scripts de Bootstrap car je ne les
utiliserai pas dans ce projet, mais je vous invite à consulter la documentation
pour plus d'informations sur la mise en place du JS de Bootstrap.

#### Installation de Font Awesome

[Documentation Symfony](https://symfony.com/doc/current/frontend/encore/fontawesome.html)

Pour l'installation de Font Awesome, j'ai tapé la commande suivante :

```shell
npm install @fortawesome/fontawesome-free
```

J'ai ensuite ajouté les lignes suivantes dans le fichier `assets/app.scss` :

```scss
// assets/app.scss
$fa-font-path: "~@fortawesome/fontawesome-free/webfonts";

@import "~@fortawesome/fontawesome-free/scss/fontawesome.scss";
@import "~@fortawesome/fontawesome-free/scss/regular.scss";
@import "~@fortawesome/fontawesome-free/scss/solid.scss";
```
