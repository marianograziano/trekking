<?php

// Clean output buffer to avoid any accidental output
ob_clean();

echo 'Session save path: ' . session_save_path() . PHP_EOL;
echo 'Session status before: ' . session_status() . PHP_EOL;

if (session_status() == PHP_SESSION_NONE) {
    ob_start(); // Start output buffering
    session_start();
    ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering
    echo 'Session status after: ' . session_status() . PHP_EOL;
}
