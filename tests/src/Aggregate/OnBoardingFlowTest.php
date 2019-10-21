<?php declare(strict_types=1);

namespace App\Tests\Aggregate;

use App\Aggregate\OnBoardingFlow;
use App\DB\DBFactory;
use App\Persistence\CSV;
use PHPUnit\Framework\TestCase;
use App\Transformer\JSONTransformer;

class OnBoardingFlowTest extends TestCase
{

    public function testAggregate(): void
    {
        $db = DBFactory::create(
            new CSV(dirname(__DIR__).'/../fixtures/export.csv')
        );
        $aggregator = new OnBoardingFlow($db->export());
        assertThat(
            JSONTransformer::fromArray($aggregator->aggregate()),
        is(equalTo("[{\"name\":\"1 weeks later\",\"data\":[100,0,100,0,0,0,0,0]}]")));
    }

}