<?php
// Librarie
require __DIR__ . '/../vendor/autoload.php';
// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// Project
require __DIR__ . '/../src/config/index.php';
require __DIR__ . '/../src/commons/index.php';
require __DIR__ . '/../src/middleware/index.php';
require __DIR__ . '/../src/routes/v1.php';
