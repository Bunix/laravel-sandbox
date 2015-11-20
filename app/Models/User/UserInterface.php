<?php

namespace App\Models\User;

interface UserInterface
{

    /**
     * Get Full Name
     *
     * @return string
     */
    public function getFullName();

}