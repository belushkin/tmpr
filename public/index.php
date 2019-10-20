<?php declare(strict_types=1);

use App\Http\Router;
use App\Http\Request;

require dirname(__DIR__).'/config/bootstrap.php';

$router = new Router(new Request());

$router->get('/', function() {
    return <<<HTML
  <h1>Hello world</h1>
HTML;
});

