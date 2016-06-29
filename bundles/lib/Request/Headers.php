<?php
/**
 * Created by PhpStorm.
 * User: las
 * Date: 28/06/2016
 * Time: 22:22
 */
namespace \Venus\lib\Request;

class Headers implements RequestInterface
{
    /**
     * get parameter
     * @param string $name
     * @param string $default
     * @return string
     */
    public function get(string $name, string $default = null) : string
    {
        if (isset(apache_request_headers()[$name]) && apache_request_headers()[$name] != '') {
            return apache_request_headers()[$name];
        }
        else if ($default != null) {
            return $default;
        }
    }
}