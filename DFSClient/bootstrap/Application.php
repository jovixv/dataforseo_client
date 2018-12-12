<?php

namespace DFSClient\bootstrap;

class Application
{
    private static $instance = [];

    protected $bindings = [];

    protected $models = [];

    public $config;

    protected function __construct()
    {
        //    $t
    }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a DFSClient.');
    }

    protected function __clone()
    {
        // TODO: Implement __invoke() method.
    }

    public function init()
    {
    }

    public function bind($object)
    {
        //$this->bindings[]
    }

    public function bindModel($name, $class)
    {
        $this->models[str_replace(' ', '', $name)] = $class;
    }

    public static function getInstance()
    {
        $class = get_called_class();

        if (!isset(self::$instance[$class])) {
            self::$instance[$class] =  new static();
        }

        return self::$instance[$class];
    }

    public function getModel($name)
    {
        if (!isset($this->models[$name])) {
            return false;
        }

        return $this->models[$name];
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }
}
