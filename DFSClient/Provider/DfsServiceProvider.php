<?php

namespace DFSClient\Provider;
use DFSClient\DFSClient;
use DFSClient\DFSContract;

class DfsServiceProvider extends \Illuminate\Support\ServiceProvider
{


    public function boot()
    {
        $this->publishes([__DIR__.'/../dfs_config.php' => config_path('dfs_config.php')]);

    }

    public function register()
    {
        $this->app->singleton(DFSClient::class, function($app){
            $login = config('dfs_config.DATAFORSEO_LOGIN');
            $password = config('dfs_config.DATAFORSEO_PASSWORD');
            return new DFSClient($login, $password);
        });
    }
}