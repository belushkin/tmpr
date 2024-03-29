<?php declare(strict_types=1);

namespace App\Transformer;

interface ITransformer
{
    public static function fromArray(array $data): string;
}