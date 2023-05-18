<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8e153576829617aacf9dfec4ac344b6f
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TelegramBot\\Api\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TelegramBot\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/telegram-bot/api/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8e153576829617aacf9dfec4ac344b6f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8e153576829617aacf9dfec4ac344b6f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8e153576829617aacf9dfec4ac344b6f::$classMap;

        }, null, ClassLoader::class);
    }
}