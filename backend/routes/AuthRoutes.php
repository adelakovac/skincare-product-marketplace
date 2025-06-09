<?php
require_once __DIR__ . '/../controllers/AuthController.php';

Flight::route('POST /login', ['AuthController', 'login']);
