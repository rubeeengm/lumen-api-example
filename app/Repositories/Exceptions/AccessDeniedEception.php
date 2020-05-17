<?php

namespace App\Repositories\Exceptions;

use Exception;

class AccessDeniedEception extends Exception {

    /**
     * AccessDeniedEception constructor.
     * @param $message
     */
    public function __construct($message) {
        parent::__construct($message, 0, null);
    }
}
