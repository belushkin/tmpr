<?php declare(strict_types=1);

use App\Http\Router;
use App\Http\Request;
use App\View\View;

require dirname(__DIR__).'/config/bootstrap.php';

$router = new Router(new Request());

$router->get('/', function() {
    $tpl = new View( dirname(__DIR__).'/src/Template' );
    return $tpl->render( 'home');
});

