<?php

namespace App\Providers;

use App\Services\Aws\AwsClientInterface;
use App\Services\Aws\Client;
use Aws\S3\S3Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AwsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AwsClientInterface::class, function (Application $app) {
            $config = [
                'version' => 'latest',
                'region' => config('aws.region'),
                'endpoint' => config('aws.endpoint'),
            ];

            return new Client(new S3Client($config));
        });
    }
}
