<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8295b147be5be466b5eded6880dad661
{
    public static $prefixesPsr0 = array (
        'F' => 
        array (
            'Faker' => 
            array (
                0 => __DIR__ . '/..' . '/fakerphp/faker/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit8295b147be5be466b5eded6880dad661::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit8295b147be5be466b5eded6880dad661::$classMap;

        }, null, ClassLoader::class);
    }
}
