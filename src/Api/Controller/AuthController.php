<?php

namespace Flarum\Pusher\Api\Controller;

use Flarum\Http\RequestUtil;
use Illuminate\Support\Arr;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Pusher\Pusher;

class AuthController implements RequestHandlerInterface
{
    public function __construct(
        protected Pusher $pusher
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $userChannel = 'private-user'.RequestUtil::getActor($request)->id;
        $body = $request->getParsedBody();

        if (Arr::get($body, 'channel_name') === $userChannel) {
            $payload = json_decode(
                $this->pusher->authorizeChannel($userChannel, Arr::get($body, 'socket_id')),
                true
            );

            return new JsonResponse($payload);
        }

        return new EmptyResponse(403);
    }
}