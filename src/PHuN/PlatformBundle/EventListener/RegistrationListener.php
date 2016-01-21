<?php

// src/Acme/DemoBundle/EventListener/RegistrationListener.php

namespace Acme\DemoBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener responsible for adding the default user role at registration
 */
class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted',
        );
    }

    public function onRegistrationCompleted(FormEvent $event)
    {
        //$rolesArr = array('ROLE_USER');

        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getUser();
        $user->addRole( 'ROLE_AUTEUR' );
    }
}