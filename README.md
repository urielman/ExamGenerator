[![Build Status](https://travis-ci.org/urielman/ExamGenerator.svg?branch=master)](https://travis-ci.org/urielman/ExamGenerator) [![Coverage Status](https://coveralls.io/repos/github/urielman/ExamGenerator/badge.svg?branch=master)](https://coveralls.io/github/urielman/ExamGenerator?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/urielman/ExamGenerator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/urielman/ExamGenerator/?branch=master)
#### Usar ExamGenerator
Una vez descargado el repositorio, ejecutar `composer install` para instalar las dependencias (como Symfony Yaml). Para visualizar Laravel, hostear el repositorio en un servidor local como puede ser con Xampp, y dirigirse a `./public`, el homepage de ExamGenerator.

#### Objetivo del Trabajo:
Recrear el sistema del profesor para hacer pruebas desde cero.

#### Puntos clave:
- Dada una lista de preguntas generar multiples temas.
- Mezclar preguntas y opciones, guardar las correctas.
- Cada tema tiene una opcion correcta, las opciones "todas" y "ninguna" son opcionales, de haber dos opciones correctas generar una - opcion extra que incluya a ambas.
- Generar dos versiones del examen, la original con la correcta marcada y las de examen para uso del alumno.
- Hacer tests  e incluir coveralls.

#### Herramientas sugeridas:
- PHP -> Codigo de opciones, mezclar, reconocer correctas, interactuar con html
- Symfony yaml -> leer archivo yml y convertirlo en un array
- Twig (dejar para el final) -> escribe una plantilla que se convierte en HTML
- CSS grid -> Para hacer la grilla de la prueba

#### Recordar:
- En ips.dagos.info tenemos el material para empezar y otros recursos.
- La documentacion de Symfony Yaml está en https://symfony.com/doc/current/components/yaml.html

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
