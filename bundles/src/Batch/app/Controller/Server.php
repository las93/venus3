<?php

namespace Venus\src\Batch\Controller;

use \Venus\lib\Bash as Bash;
use \Venus\src\Batch\common\Controller as Controller;

class Server extends Controller
{
    public function run(array $aOptions = array())
    {
        ob_get_clean();
        echo "\n\n";
        echo Bash::setBackground("                                              ", 'green');
        echo Bash::setBackground("          [OK] Start web server               ", 'green');
        echo Bash::setBackground("                                              ", 'green');
        echo "\n\n";
        echo "        > Clic Ctrl+C to stop the web server";
        echo "\n\n";

        sleep(1);
        exec('php -S localhost:8000 /public/index.php');
    }
}