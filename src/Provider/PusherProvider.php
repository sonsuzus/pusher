<?php

namespace Flarum\Pusher\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Settings\SettingsRepositoryInterface;
use Pusher\Pusher;

class PusherProvider extends AbstractServiceProvider
{
    public function register(): void
    {
        $this->container->bind(Pusher::class, function () {
            $settings = $this->container->make(SettingsRepositoryInterface::class);

            $options = ['useTLS' => true];

            if ($cluster = $settings->get('flarum-pusher.app_cluster')) {
                $options['cluster'] = $cluster;
            }

            // Kendi sunucun (Soketi vb.) için: boş bırakılırsa Pusher bulutu kullanılır.
            if ($host = trim((string) $settings->get('flarum-pusher.server_hostname'))) {
                $options['host'] = $host;
            }

            if ($port = (int) $settings->get('flarum-pusher.server_port')) {
                $options['port'] = $port;
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