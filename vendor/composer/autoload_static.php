<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9a06b5c6a8dc4174cc2feee00d7c352a
{
    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pubnub\\' => 
            array (
                0 => __DIR__ . '/..' . '/pubnub/pubnub/composer/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit9a06b5c6a8dc4174cc2feee00d7c352a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}