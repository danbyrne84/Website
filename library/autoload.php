<?php

namespace library;

class Autoloader
{
    public static function autoload($name)
    {
        $path = strtolower($name . '.php');
        $path = str_replace('\\', '/', $path);

        $searchPaths = array(APP_PATH, APP_PATH . '/../');

        foreach($searchPaths as $searchPath) {
            $fullPath = $searchPath . '/' . $path;
            if (file_exists($fullPath)) {
                require_once($fullPath);
                return true;
            }
        }

        return false;
    }
}

// register the autoload function with the SPL autoloader
spl_autoload_register(__NAMESPACE__ . '\Autoloader::autoload');

?>
