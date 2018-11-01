<?php


namespace DFSClient;


use \DFSClient\bootstrap\Application;
use DFSClient\Models\RankedKeywordFinder;


class DFSClient
{

    /**
     * @var Application|mixed $app
     */

    public $app;

    public function __construct()
    {
        $this->app = Application::getInstance();

        $this->app->config = include 'config.php';

        $this->bindings();
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