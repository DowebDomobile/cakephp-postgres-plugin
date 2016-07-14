<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 09.03.16
 * Time: 17:10
 */

namespace App\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

/**
 * Class JsonbType
 * @package App\Database\Type
 */
class JsonbType extends Type
{
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        return json_decode($value, true);
    }

    public function marshal($value)
    {
        if (is_array($value) || $value === null) {
            return $value;
        }
        return json_decode($value, true);
    }

    public function toDatabase($value, Driver $driver)
    {
        return isset($value) ? json_encode($value) : null;
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
} 