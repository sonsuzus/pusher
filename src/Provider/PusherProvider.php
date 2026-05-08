<?php

namespace Flarum\Pusher\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Settings\SettingsRepositoryInterface;
use Pusher\Pusher;

class PusherProvider extends AbstractServiceProvider
{
    public function register()
    {
        // Pusher sınıfını IoC konteynerine bağlayalım
        $this->app->bind(Pusher::class, function () {
            /** @var SettingsRepositoryInterface $settings */
            $settings = $this->app->make(SettingsRepositoryInterface::class);

            $options = [];

            // Ayarların varlığını kontrol ederek options dizisini oluşturalım
            if ($cluster = $settings->get('flarum-pusher.app_cluster')) {
                $options['cluster'] = $cluster;
            }
            if ($host = $settings->get('flarum-pusher.app_host')) {
                $options['host'] = $host;
            }
            if ($port = $settings->get('flarum-pusher.app_port')) {
                $options['port'] = $port;
            }
            if ($scheme = $settings->get('flarum-pusher.app_scheme')) {
                $options['scheme'] = $scheme;
            }

            return new Pusher(
                (string) $settings->get('flarum-pusher.app_key'),
                (string) $settings->get('flarum-pusher.app_secret'),
                (string) $settings->get('flarum-pusher.app_id'),
                $options
            );
        });
    }
}
