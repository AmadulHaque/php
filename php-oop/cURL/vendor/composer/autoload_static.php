<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd364da438ff54c2139a5a9afdd121b9
{
    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'voku\\helper\\' => 12,
        ),
        'S' => 
        array (
            'Symfony\\Component\\CssSelector\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'voku\\helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/simple_html_dom/src/voku/helper',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Sunra\\PhpSimple\\HtmlDomParser' => 
            array (
                0 => __DIR__ . '/..' . '/sunra/php-simple-html-dom-parser/Src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd364da438ff54c2139a5a9afdd121b9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd364da438ff54c2139a5a9afdd121b9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitcd364da438ff54c2139a5a9afdd121b9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitcd364da438ff54c2139a5a9afdd121b9::$classMap;

        }, null, ClassLoader::class);
    }
}