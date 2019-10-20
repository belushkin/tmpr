<?php declare(strict_types=1);

namespace App\Tests\Persistence;

use App\Persistence\IPersistence;
use App\Persistence\CSV;
use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase
{

    public function testLoadFile(): void
    {
        $persister = new CSV(dirname(__DIR__).'/../../data/export.csv');
        assertThat($persister, is(anInstanceOf( IPersistence::class)));
    }

    public function testHeader(): void
    {
        $persister = new CSV(dirname(__DIR__).'/../../data/export.csv');
        $persister->openFile();
        assertThat($persister->getLine(), nonEmptyArray());
    }

    public function testExportCount(): void
    {
        $persister = new CSV(dirname(__DIR__).'/../../data/export.csv');
        $persister->openFile();
        assertThat($persister->export(), arrayWithSize(339));
    }

}
