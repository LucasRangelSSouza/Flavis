PAG Standard Edition
========================

Welcome to the PAG Standard Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.


Initial Setup
--------------

  * cd [PROJECT PATH]
  * composer.phar install
  * ./app/console doctrine:database:create
  * ./app/console doctrine:schema:create --force
  * ./app/console fos:user:create admin --super-admin
  * ./app/console assets:install web --symlink
  * ./app/console cache:clear


What's inside?
--------------

The PAG Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * SonataAdminBundle;

  * SonataBlockBundle;

  * SonataEasyExtendsBundle;

  * SonataDoctrineORMAdminBundle

  * SonataUserBundle

  * FOSUserBundle;

  * KNPMenuBundle;

  * SimpleThingsEntityAuditBundle;

  * DoctrineMigrationsBundle;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][12] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev/test env) - Adds code generation
    capabilities

Enjoy!

[1]:  http://symfony.com/doc/2.6/book/installation.html
[6]:  http://symfony.com/doc/2.6/bundles/SensioFrameworkExtraBundle/index.html
[7]:  http://symfony.com/doc/2.6/book/doctrine.html
[8]:  http://symfony.com/doc/2.6/book/templating.html
[9]:  http://symfony.com/doc/2.6/book/security.html
[10]: http://symfony.com/doc/2.6/cookbook/email.html
[11]: http://symfony.com/doc/2.6/cookbook/logging/monolog.html
[12]: http://symfony.com/doc/2.6/cookbook/assetic/asset_management.html
[13]: http://sonata-project.org/bundles/
[14]: http://sonata-project.org/bundles/doctrine-orm-admin/master/doc/reference/audit.html
[15]: https://github.com/FriendsOfSymfony/FOSUserBundle
