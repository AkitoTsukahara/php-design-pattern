<?php

class A
{
    protected $person;

    public function __construct(PersonInterface $person)
    {
        $this->person = $person;
    }

    public function say()
    {
        return $this->person->say();
    }
}

interface PersonInterface
{
    public function say();
}

class Alice implements PersonInterface
{
    public function say()
    {
        return "アリスだよ～";
    }
}
$alice = new Alice();
$classA = new A($alice);