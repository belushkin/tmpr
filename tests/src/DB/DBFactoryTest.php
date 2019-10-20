<?php declare(strict_types=1);

namespace App\Tests\DB;

use App\DB\DBFactory;
use App\DB\IDriver;
use App\Persistence\CSV;
use PHPUnit\Framework\TestCase;

class DBFactoryTest extends TestCase
{

    public function testDriverInterface(): void
    {
        $db = DBFactory::create(
            new CSV(dirname(__DIR__).'/../../data/export.csv')
        );
        assertThat($db, is(anInstanceOf( IDriver::class)));
    }

    public function testExportCount(): void
    {
        $db = DBFactory::create(
            new CSV(dirname(__DIR__).'/../../data/export.csv')
        );
        assertThat($db->export(), arrayWithSize(339));
    }
}