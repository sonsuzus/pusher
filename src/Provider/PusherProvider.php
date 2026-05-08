namespace Flarum\Pusher\Provider;

use Flarum\Foundation\AbstractServiceProvider;
use Flarum\Settings\SettingsRepositoryInterface;
use Pusher\Pusher; // Sınıfı import edin

class PusherProvider extends AbstractServiceProvider
{
    public function register()
    {
        // Doğru sınıf adını bind edin
        $this->app->bind(Pusher::class, function () {
            $settings = $this->app->make(SettingsRepositoryInterface::class);
            $options = [];

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

            // Tam namespace ile yeni bir Pusher objesi oluşturun
            return new Pusher(
                $settings->get('flarum-pusher.app_key'),
                $settings->get('flarum-pusher.app_secret'),
                $settings->get('flarum-pusher.app_id'),
                $options
            );
        });
    }
}
