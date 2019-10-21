<?php declare(strict_types=1);

namespace App\Tests\DB;

use App\DB\DBFactory;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class CSVDriverTest extends TestCase
{

    public function tearDown(): void
    {
        m::close();
    }

    public function testExport(): void
    {
        $persister   = m::mock('App\Persistence\CSV');
        $persister->shouldReceive('openFile')->once();
        $persister->shouldReceive('closeFile')->never();
        $persister->shouldReceive('export')->once()->andReturn([1]);

        $db = DBFactory::create($persister);
        assertThat($db->export(), is(equalTo([1])));
    }

}