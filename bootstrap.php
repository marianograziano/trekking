<?php

ob_start(); // Start output buffering to capture any output
require_once 'vendor/autoload.php';
ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
