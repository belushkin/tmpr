<?php declare(strict_types=1);

namespace App\Transformer;

/**
 * JSON Transformer class.
 */
class JSONTransformer implements ITransformer
{

    public static function fromArray(array $data): string {
        return json_encode($data);
    }

}