<?php
namespace KernelEngine;

require_once realpath(__DIR__.'/../src/Symfony/Component/ClassLoader/UniversalClassLoader.php');

use Symfony\Component\ClassLoader\UniversalClassLoader;

/**
 * Description of KernelEngine
 *
 * @author cred02
 */

class KernelEngine{
    
    function __construct(){
        
        return $this->registerBundles();
    }
    
    function registerBundles(){
        $loader = new UniversalClassLoader();
        $loader->register();
        $loader->registerNamespaces(array(
            "Symfony\Component" => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src',
            "KernelBundle" => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src',
            "UserBundle" => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src',
            "ClienteBundle" => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src',
            "DocumentBundle" => __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src',
        ));
    }
    
}