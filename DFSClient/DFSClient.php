<?php


namespace DFSClient;

use \DFSClient\bootstrap\Application;


class DFSClient
{

    /**
     * @var Application|mixed $app
     */

    public $app;

    /**
     * DFSClient constructor.
     * @param string $login
     * @param string $password
     * @param bool $timeout
     * @param bool $apiVersion
     * @param bool $url
     */
    public function __construct(string $login, string $password, $timeout = false, $apiVersion = false, $url=false)
    {

        $config = include 'config.php';
        $this->app = Application::getInstance();

        $config['timeoutForEachRequests'] = $timeout     ?? $config['timeoutForEachRequests'];
        $config['apiVersion']             = $apiVersion  ?? $config['apiVersion'];
        $config['url']                    = $url         ?? $config['url'];

        $this->app->config = $config;

        //$this->bindings(); it will be available for version 1.0.0-stable;
    }

    /**
     * @param $name
     * @return bool|mixed
     * @throws \Exception
     */
    public function __get($name)
    {
        if (!$model = $this->app->getModel($name))
            throw new \Exception('Dynamic property, not found. Or DFSClient property does not exist');

        return $model;
    }

    private function bindings(){
        $this->app->bindModel('ranked_keyword','\\DFSClient\\Models\\RankedKeywordFinder');
        $this->app->bindModel('kwrd_sv', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordLive');
        $this->app->bindModel('kwrd_sv_tasks_post', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordSetTask');
        $this->app->bindModel('kwrd_sv_tasks_get', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordGetCompletedTask');
        //$this->app->bindModel();
    }

}