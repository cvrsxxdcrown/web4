<?php
namespace Singleton;

final class Settings
{
    private static ?Settings $_object = null;
    private array $_settings = [];

    private function __construct() {}

    private function __clone() {}

    public static function get(): Settings
    {
        if (self::$_object === null) {
            self::$_object = new self();
        }
        return self::$_object;
    }

    public function __get($key)
    {
        return $this->_settings[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->_settings[$key] = $value;
    }
}
