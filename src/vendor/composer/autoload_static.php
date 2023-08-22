<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit791e62f6e9f02ffc60428ad5fe03576c
{
    public static $classMap = array (
        'ComposerAutoloaderInit791e62f6e9f02ffc60428ad5fe03576c' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit791e62f6e9f02ffc60428ad5fe03576c' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Controllers\\AuthController' => __DIR__ . '/../..' . '/controllers/AuthController.php',
        'Controllers\\HikeController' => __DIR__ . '/../..' . '/controllers/HikeController.php',
        'Controllers\\PageController' => __DIR__ . '/../..' . '/controllers/PageController.php',
        'Controllers\\TagsController' => __DIR__ . '/../..' . '/controllers/TagsController.php',
        'Controllers\\UserController' => __DIR__ . '/../..' . '/controllers/UserController.php',
        'Models\\Database' => __DIR__ . '/../..' . '/models/Database.php',
        'Models\\Hike' => __DIR__ . '/../..' . '/models/Hike.php',
<<<<<<< HEAD
        'Models\\Tags' => __DIR__ . '/../..' . '/models/Tags.php',
=======
>>>>>>> Özlem
        'Models\\User' => __DIR__ . '/../..' . '/models/User.php',
        'core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit791e62f6e9f02ffc60428ad5fe03576c::$classMap;

        }, null, ClassLoader::class);
    }
}
