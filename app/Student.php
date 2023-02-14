<?php

namespace App;

class Student
{
 private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(): void
    {
        $this->name = "Azizul";
    }

}

