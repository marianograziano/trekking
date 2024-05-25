<?php

namespace App\Controllers;

class Controller {
    public function __construct() {
        $this->startSession();
    }

    protected function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            ob_start(); // Start output buffering
            @session_start(); // Use @ to suppress errors temporarily
            ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
        }
    }
}
