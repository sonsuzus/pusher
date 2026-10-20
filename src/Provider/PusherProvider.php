<?php

namespace Flarum\Pusher\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Settings\SettingsRepositoryInterface;
use Pusher\Pusher; // GÜNCELLENDİ

class PusherProvider extends AbstractServiceProvider
{
    public function register()
    {
        $this->app->bind(Pusher::class, function () {
            $settings = $this->app->make(SettingsRepositoryInterface::class);
            $options = [
                'host' => 'soketi.sessizbilgi.com',
                'port' => 443,
                'scheme' => 'https',
                'encrypted' => true,
                'useTLS' => true,
            ];

            if ($cluster = $settings->get('flarum-pusher.app_cluster')) {
                $options['cluster'] = $cluster;
            }

            return new Pusher(
                $settings->get('flarum-pusher.app_key'),
                $settings->get('flarum-pusher.app_secret'),
                $settings->get('flarum-pusher.app_id'),
                $options
            );
        });
    }
}