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