<?php

use Ecotone\Modelling\Attribute\EventHandler;

class PersonRegistrationEventSubscriber
{
    #[EventHandler]
    public function sendWelcomeEmail(PersonWasRegistered $event, EmailSender $emailSender): void
    {
        $person = $this->userRepository->getById($event->getPersonId());
        $emailSender->sendWelcomeTo($person);
    }

    #[EventHandler]
    public function storeLog(PersonWasRegistered $event, LogRepository $logRepository): void
    {
        $log = new Log("person_was_registered", $event->getPersonId());
        $logRepository->store($log);
    }

    #[EventHandler]
    public function synchronizeExternalService(PersonWasRegistered $event, ExternalIntegratedService $externalService): void
    {
        $person = $this->userRepository->getById($event->getPersonId());
        $externalService->synchronizeUser($person);
    }
}
