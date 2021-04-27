<?php
// Librarie
require __DIR__ . '/../vendor/autoload.php';
// Load ENV
    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->safeLoad();
// Project
require __DIR__ . '/../src/config/index.php';
require __DIR__ . '/../src/commons/index.php';
require __DIR__ . '/../src/middleware/index.php';
require __DIR__ . '/../src/routes/v1.php';
