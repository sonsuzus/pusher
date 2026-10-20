<?php

namespace Flarum\Pusher\Api\Controller;

use Flarum\Http\RequestUtil;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Pusher\Pusher; // GÜNCELLENDİ

class AuthController implements RequestHandlerInterface
{
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userChannel = 'private-user'.RequestUtil::getActor($request)->id;
        $body = $request->getParsedBody();

        if (Arr::get($body, 'channel_name') === $userChannel) {
            $options = [
                'host' => 'soketi.sessizbilgi.com',
                'port' => 443,
                'scheme' => 'https',
                'encrypted' => true,
                'useTLS' => true,
                'cluster' => $this->settings->get('flarum-pusher.app_cluster')
            ];

            $pusher = new Pusher(
                $this->settings->get('flarum-pusher.app_key'),
                $this->settings->get('flarum-pusher.app_secret'),
                $this->settings->get('flarum-pusher.app_id'),
                $options
            );

            $payload = json_decode($pusher->socket_auth($userChannel, Arr::get($body, 'socket_id')), true);

            return new JsonResponse($payload);
        }

        return new EmptyResponse(403);
    }
}