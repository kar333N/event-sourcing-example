<?php

use Ecotone\Modelling\EventBus;

class PersonRegistrationService
{
    public function __construct(
        private UserRepository $userRepository,
        private EventBus       $event
    )
    {
    }

    public function registerUser($registerPersonData)
    {
        $person = new Person($registerPersonData);
        $this->userRepository->save($person);

        $this->event->publish(new PersonWasRegistered($person->getPersonId()));
    }
}
