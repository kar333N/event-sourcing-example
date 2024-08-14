<?php

class PersonWasRegistered
{
    public function __construct(
        private string $personId
    )
    {
    }

    public function getPersonId(): string
    {
        return $this->personId;
    }
}
