<?php

namespace App\Providers;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use As247\Flysystem\GoogleDrive\GoogleDriveAdapter;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Storage::extend('google', function ($app, $config) {
            $client = new GoogleClient();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
    
            $service = new GoogleDriveService($client);
    
            $options = [];
            if (isset($config['teamDriveId'])) {
                $options['teamDriveId'] = $config['teamDriveId'];
            }
    
            $adapter = new GoogleDriveAdapter($service, $config['folderId'] ?? null, $options);
    
            return new Filesystem($adapter);
        });
        
    }
}
