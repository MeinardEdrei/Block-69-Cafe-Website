<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

function get_connection(): mysqli {
  $conn = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_NAME']
  );
  return $conn;
}
?>
