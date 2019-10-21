<?php declare(strict_types=1);

use App\DB\DBFactory;
use App\Http\Router;
use App\Http\Request;
use App\Persistence\CSV;
use App\View\View;
use App\Transformer\JSONTransformer;

require dirname(__DIR__).'/config/bootstrap.php';

$router = new Router(new Request());

$router->get('/', function() {
    $tpl = new View( dirname(__DIR__).'/src/Template' );

    $db = DBFactory::create(
        new CSV(dirname(__DIR__).'/data/export.csv')
    );
    return $tpl->render( 'home', [
        'json' => JSONTransformer::fromArray($db->export())
    ]);
});

