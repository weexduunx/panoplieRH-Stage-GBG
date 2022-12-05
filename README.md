# Boite à Outils Commercial et RH 

Salut, ce référentiel contient un projet Laravel avec Sneat pour la création d'une application servant de panoplie pour les commercials et RH, c'est dans le cadre d'un stage à Global Business Group.

[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/ntbk-source/laravel-sneat/issues)

## Qu'est-ce qu'il y a à l'intérieur?

-   Required PHP 8
-   Laravel ^9.x - [laravel.com/docs/9.x](https://laravel.com/docs/9.x)
-   Sneat admin template bootstrap 5 - [https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/html/](https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/html/)

## Quoi ensuite?

Cloner ou télécharger ce référentiel
```shell
# Clone Repository
$ git clone https://github.com/weexduunx/panoplieRH-Stage-GBG.git.git
```

After clone or download this repository, next step is install all dependency required by laravel and laravel-mix.

```shell
# install composer-dependency
$ composer install
```

Before we start web server make sure we already generate app key, configure `.env` file and do migration.

```shell
# create copy of .env && configuration the database
$ cp .env.example .env
# create laravel key
$ php artisan key:generate
# laravel migrate
$ php artisan migrate
```


