<?php
declare(strict_types = 1);

namespace App\Http;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class JsonResponseListener implements EventSubscriberInterface
{
    /**
     * This Listens to controller action's result, set response to json if returned value is an array
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
     * @return void
     */
    public function onView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();

        if (is_array($response)) {
            $event->setResponse(new JsonResponse($response));
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return ['kernel.view' => 'onView'];
    }
}
