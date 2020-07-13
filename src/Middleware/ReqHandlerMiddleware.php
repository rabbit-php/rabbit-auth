<?php
declare(strict_types=1);

namespace Rabbit\Auth\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Rabbit\Auth\AbstractAuth;
use Rabbit\Base\Core\Context;
use Rabbit\Web\AttributeEnum;
use Rabbit\Web\HttpException;
use Rabbit\Web\NotFoundHttpException;
use Throwable;

/**
 * Class ReqHandlerMiddleware
 * @package rabbit\auth\middleware
 */
class ReqHandlerMiddleware implements MiddlewareInterface
{
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
        if ($class instanceof AbstractAuth && !$class->auth($request)) {
            throw new HttpException(401, 'Your request was made with invalid credentials.');
        }
        /**
         * @var ResponseInterface $response
         */
        $response = $class($request->getQueryParams(), $request);
        if (!$response instanceof ResponseInterface) {
            /**
             * @var ResponseInterface $newResponse
             */
            $newResponse = Context::get('response');
            $newResponse->withAttribute(AttributeEnum::RESPONSE_ATTRIBUTE, $response);
        }

        return $handler->handle($request);
    }
}
