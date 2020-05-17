<?php

namespace App\Repositories\Interfaces;

interface IIdentityRepository {
    /**
     * @param string $email
     * @param string $password
     * @return array
     */
    public function signin(string $email, string $password) : array;
}
