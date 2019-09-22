<?php


namespace App\Domains\Service\Config;

/**
 * Class Config
 * @package App\Domains\Service\Config
 */
class Config implements ConfigInterface
{

    const DELIMITER = ':';

    const PATH = ROOT . '/config/config.current.php';

    /**
     * @var array
     */
    private $config = [];

    public function __construct(string $path = self::PATH)
    {
        if (file_exists($path)) {
            $this->config = require $path;
        }
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->getInternal($key, $this->config);
    }

    /**
     * @param $key
     * @param $config
     * @return mixed|null
     */
    private function getInternal($key, $config)
    {
        $paths = explode(static::DELIMITER, $key);
        $path = array_shift($paths);
        $config = $config[$path] ?? null;
        if (null === $config) {
            return null;
        }
        if (is_array($config) && !empty($paths)) {
            $key = implode(static::DELIMITER, $paths);
            return $this->getInternal($key, $config);
        } else {
            return $config;
        }
    }

    public function setConfigArray(array $config)
    {
        $this->config = $config;
    }

}