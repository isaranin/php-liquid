<?

/*
 * created by Ivan Saranin <ivan@saranin.com>, on 31.03.2015, at 17:04:19
 */

/*
 * Module autoload
 *
 * autload for liquid
 */


class LiquidAutoLoader {

    public static function loadClass($className) {
        $parts = explode('\\', ltrim($className,"\\"));
        if($parts[0]==="Liquid"){

            $full = __DIR__ . "/src/" . implode("/", $parts) . ".php";


            if(file_exists($full)){
                require_once $full;
            }

        }
     }
}

class InsalesAutoLoader {

    public static function loadClass($className) {
        $parts = explode('\\', ltrim($className,"\\"));
        if($parts[0]==="Insales"){

            $full = __DIR__ . "/src/" . implode("/", $parts) . ".php";


            if(file_exists($full)){
                require_once $full;
            }

        }
     }

}

spl_autoload_register(array('LiquidAutoLoader', 'loadClass'));
spl_autoload_register(array('InsalesAutoLoader', 'loadClass'));
