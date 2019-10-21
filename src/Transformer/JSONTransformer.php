<?php declare(strict_types=1);

namespace App\Transformer;

/**
 * JSON Transformer class.
 */
class JSONTransformer implements ITransformer
{

    public static function fromArray(array $data): string {

//        print_r($data);
//        $f = array_map(
//            function($row) { return explode(",", $row); },
//            $data
//        );
        return json_encode($data);
    }

}