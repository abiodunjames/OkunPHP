<?php
declare(strict_types = 1);
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

$container = new DependencyInjection\ContainerBuilder();

$container->register('context', Routing\RequestContext::class);
$container->register('route_collection', Routing\RouteCollection::class);

$container->register('matcher', Routing\Matcher\UrlMatcher::class)->setArguments([$routes, new Reference('context')]);

$container->register('request_stack', HttpFoundation\RequestStack::class);

$container->register('controller_resolver', \App\Framework\ControllerResolver::class)->setArguments([$container]);;

$container->register('argument_resolver', HttpKernel\Controller\ArgumentResolver::class);

$container->register('listener.router', HttpKernel\EventListener\RouterListener::class)->setArguments([
    new Reference('matcher'),
    new Reference('request_stack'),
]);

/**
 *  Register Event Listeners;
 */
$container->register('listener.response', HttpKernel\EventListener\ResponseListener::class)->setArguments(['UTF-8']);
$container->register('listener.exception', HttpKernel\EventListener\ExceptionListener::class)->setArguments(['App\Exceptions\ControllerExceptionHandler::exceptionAction']);
$container->register('listener.jsonResponse', \App\Http\JsonResponseListener::class);

// Register dispatcher
$container->register('dispatcher', EventDispatcher::class)->addMethodCall('addSubscriber', [new Reference('listener.router')])->addMethodCall('addSubscriber', [new Reference('listener.response')])->addMethodCall('addSubscriber', [new Reference('listener.exception')])->addMethodCall('addSubscriber', [new Reference('listener.jsonResponse')]);

$container->register('app', \App\Framework\Application::class)->setArguments([
    new Reference('dispatcher'),
    new Reference('controller_resolver'),
    new Reference('request_stack'),
    new Reference('argument_resolver'),
]);

/**
 *  Register key services
 */
$container->register('app.user_service', \App\Service\UserService::class)->setArguments([$entityManager]);
$container->register('app.token_service', \App\Http\Auth\TokenService::class);

$container->register('app.base_controller', Symfony\Component\DependencyInjection\ContainerAwareInterface::class)->addMethodCall('setContainer', [new Reference('service')]);
return $container;

