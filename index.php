<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

require_once "vendor/autoload.php";
try {
    $class = new \Codepunker\CodepunkerApi\Client();
} catch (Exception $e) {
    echo $e->getMessage();
}

echo '<pre>'; var_dump($class); echo '</pre>';