<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf3af6266b1329250787734d82b676e03
{
    public static $files = array (
        '1c9051359cc4715f5f9b335dba6482da' => __DIR__ . '/..' . '/php-flasher/flasher/functions.php',
        'da91a01b5badbe5394c83814ef5982ea' => __DIR__ . '/..' . '/php-flasher/flasher/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Flasher\\Prime\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Flasher\\Prime\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-flasher/flasher',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf3af6266b1329250787734d82b676e03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf3af6266b1329250787734d82b676e03::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf3af6266b1329250787734d82b676e03::$classMap;

        }, null, ClassLoader::class);
    }
}
