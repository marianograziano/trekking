<?php

namespace App\Helpers;

class Redirector {
    public static function redirect($url) {
        header("Location: $url");
        exit();
    }
}
