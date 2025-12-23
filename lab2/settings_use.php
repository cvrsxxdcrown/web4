<?php
class Settings {
    private static ?Settings $instance = null;
    private array $data = [];

    private function __construct() {}

    public static function getInstance(): Settings {
        if (!self::$instance) {
            self::$instance = new Settings();
        }
        return self::$instance;
    }

    public function get(string $key) {
        return $this->data[$key] ?? null;
    }

    public function set(string $key, $value): void {
        $this->data[$key] = $value;
    }
}

$s = Settings::getInstance();
$s->set('site','Demo');
echo $s->get('site');
