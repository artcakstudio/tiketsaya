<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInitec8b1c43dd0b90234cd90e500fe2d173
=======
class ComposerAutoloaderInitcc7afcc448c23c3ad61f2f0c5928af55
>>>>>>> b8c0bfcd40ad3565526158cee0397a0db6023c94
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInitec8b1c43dd0b90234cd90e500fe2d173', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitec8b1c43dd0b90234cd90e500fe2d173', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInitcc7afcc448c23c3ad61f2f0c5928af55', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitcc7afcc448c23c3ad61f2f0c5928af55', 'loadClassLoader'));
>>>>>>> b8c0bfcd40ad3565526158cee0397a0db6023c94

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequireec8b1c43dd0b90234cd90e500fe2d173($file);
=======
            composerRequirecc7afcc448c23c3ad61f2f0c5928af55($file);
>>>>>>> b8c0bfcd40ad3565526158cee0397a0db6023c94
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequireec8b1c43dd0b90234cd90e500fe2d173($file)
=======
function composerRequirecc7afcc448c23c3ad61f2f0c5928af55($file)
>>>>>>> b8c0bfcd40ad3565526158cee0397a0db6023c94
{
    require $file;
}
