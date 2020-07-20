<?php

namespace App\Providers;

use App\Services\ImgViewer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ImgViewerProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ImgViewer::class, function (Application $app) {
            $config = $app->make('config')->get('img-viewer');

            return new ImgViewer($config['dir']);

            switch ($config['driver']) {
                case 'sms.ru':
                    $params = $config['drivers']['sms.ru'];
                    if (!empty($params['url'])) {
                        return new SmsRu($params['app_id'], $params['url']);
                    }
                    return new SmsRu($params['app_id']);
                case 'array':
                    return new ArraySender();
                default:
                    throw new \InvalidArgumentException('Undefined SMS driver ' . $config['driver']);
            }
        });
    }
}
