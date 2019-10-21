<?php declare(strict_types=1);

namespace App\Tests\View;

use App\Transformer\JSONTransformer;
use PHPUnit\Framework\TestCase;

class JSONTransformerTest extends TestCase
{

    public function testTransformer(): void
    {
        assertThat(JSONTransformer::fromArray([1]), is(equalTo("[1]")));
    }
}
