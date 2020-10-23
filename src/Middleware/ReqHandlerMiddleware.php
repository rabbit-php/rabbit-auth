<?php

declare(strict_types=1);

namespace Rabbit\Auth\Middleware;

use Throwable;
use Rabbit\Web\ResponseContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Rabbit\HttpServer\Middleware\AcceptTrait;
use Rabbit\HttpServer\Exceptions\HttpException;
use Rabbit\HttpServer\Exceptions\NotFoundHttpException;

/**
 * Class ReqHandlerMiddleware
 * @package Rabbit\Auth\Middleware
 */
class ReqHandlerMiddleware implements MiddlewareInterface
{
    use AcceptTrait;
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = explode('/', ltrim($request->getUri()->getPath(), '/'));
        if (count($route) !== 2) {
            throw new NotFoundHttpException("the route type error:" . $request->getUri()->getPath());
        }
        list($module, $action) = $route;
        $class = 'apis\\' . $module . "\\handlers\\" . $action;

        $class = getDI($class, false);
        if ($class === null) {
            throw new NotFoundHttpException("can not find the route:" . $request->getUri()->getPath());
        }
        if (method_exists($class, 'auth') && !$class->auth($request)) {
            throw new HttpException(401, 'Your request was made with invalid credentials.');
        }
        /**
         * @var ResponseInterface $response
         */
        $response = $class($request->getQueryParams(), $request);
        if (!$response instanceof ResponseInterface) {
            $newResponse = ResponseContext::get();
            return $this->handleAccept($request, $newResponse, $response);
        }

        return $handler->handle($request);
    }
}
