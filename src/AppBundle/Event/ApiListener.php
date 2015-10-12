<?php

namespace AppBundle\Event;

use AppBundle\Controller\ApiController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ApiListener
{
    /**
     * @var
     */
    protected $allowedUsers;

    /**
     * @param $dm
     */
    public function __construct($allowedUsers){

        $this->allowedUsers = $allowedUsers;
    }

    /**
     * @param FilterControllerEvent $event
     * @throws AccessDeniedHttpException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller) || !($controller[0] instanceof ApiController)) {
            return;
        }

        $requestHeaders = $event->getRequest()->headers;

        if (!$requestHeaders->has('x-apitoken')) {
            throw new AccessDeniedHttpException('Missing Authorization header');
        }

        $email = array_search($requestHeaders->get('x-apitoken'), $this->allowedUsers);
        if($email === false){
            throw new AccessDeniedHttpException('User api token is invalid');
        }


        $event->getRequest()->attributes->set('REQ_EMAIL', $email);
    }
}