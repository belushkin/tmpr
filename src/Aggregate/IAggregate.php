<?php declare(strict_types=1);

namespace App\Aggregate;

interface IAggregate
{
    public function aggregate(): array ;
}