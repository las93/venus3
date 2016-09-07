<?php

namespace Venus\src\Batch\Controller;

use \Venus\lib\Bash as Bash;
use \Venus\src\Batch\common\Controller as Controller;

class Phpunit extends Controller
{
    /**
     * new method to launch a web server
     * @param array $options
     * @tutorial php bin/console server:run
     *           php bin/console server:run -a 192.168.0.1:8000
     */
    public function phpunit(array $options = array())
    {
        ob_get_clean();

        $files = scandir(__DIR__.'/../../../../tests');

        foreach ($files as $one) {

            if (is_dir(__DIR__.'/../../../../tests/'.$one) && $one != '..' && $one != '.') {

                $controllerFiles = scandir(__DIR__.'/../../../../tests'.'/'.$one.'/app/Controller');

                foreach ($controllerFiles as $oneController) {

                    if (is_file(__DIR__.'/../../../../tests/'.$one.'/app/Controller/' . $oneController) && $oneController != '..' && $oneController != '.') {

                        $reflection = new \ReflectionClass('\Venus\tests\\'.$one.'\Controller\\' . str_replace('.php', '', $oneController));
                        $methods = $reflection->getMethods();

                        foreach ($methods as $oneMethod) {

                            if (preg_match('/^test[A-Z][a-z]/', $oneMethod->name)) {

                                $objectName= '\Venus\tests\\'.$one.'\Controller\\' . str_replace('.php', '', $oneController);
                                $object = new $objectName;
                                call_user_func_array([$object, $oneMethod->name], []);
                            }
                        }
                    }
                }
            }
        }
    }
}