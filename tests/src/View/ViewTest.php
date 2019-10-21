<?php declare(strict_types=1);

namespace App\Tests\View;

use App\View\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{

    public function testView(): void
    {
        $view = new View(dirname(__DIR__).'/../fixtures');
        assertThat($view->render( 'home'), is(equalTo("Hello World!")));
    }

}
