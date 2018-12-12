<?php

namespace DFSClient;

use DFSClient\bootstrap\Application;

class DFSClient
{
    /**
     * @var Application|mixed
     */
    public $app;

    /**
     * DFSClient constructor.
     *
     * @param string $login
     * @param string $password
     * @param bool   $timeout
     * @param bool   $apiVersion
     * @param bool   $url
     */
    public function __construct( $login,  $password, $timeout = null, $apiVersion = null, $url = null)
    {
        $config = include 'config.php';


        $config['DATAFORSEO_LOGIN'] = ($login) ? $login : $config['DATAFORSEO_LOGIN'];
        $config['DATAFORSEO_PASSWORD'] = ($password) ? $password : $config['DATAFORSEO_PASSWORD'];
        $config['timeoutForEachRequests'] = ($timeout) ? $timeout : $config['timeoutForEachRequests'];
        $config['apiVersion'] = ($apiVersion) ? $apiVersion : $config['apiVersion'];
        $config['url'] = ($url) ? $url : $config['url'];

        Application::getInstance()->setConfig($config);

        //$this->bindings(); it will be available for version 1.0.0-stable;
    }

    /**
     * @param $name
     *
     * @throws \Exception
     *
     * @return bool|mixed
     */
    public function __get($name)
    {
        if (!$model = $this->app->getModel($name)) {
            throw new \Exception('Dynamic property, not found. Or DFSClient property does not exist');
        }
        return $model;
    }

    private function bindings()
    {
        $this->app->bindModel('ranked_keyword', '\\DFSClient\\Models\\RankedKeywordFinder');
        $this->app->bindModel('kwrd_sv', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordLive');
        $this->app->bindModel('kwrd_sv_tasks_post', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordSetTask');
        $this->app->bindModel('kwrd_sv_tasks_get', '\\DFSClient\\Models\\KeywordsDataApi\\Search_Volume_for_Keyword\\SearchVolumeForKeywordGetCompletedTasks');
        //$this->app->bindModel();
    }
}
