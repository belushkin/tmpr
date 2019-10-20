<?php declare(strict_types=1);

namespace App\DB;

use App\Persistence\IPersistence;
use App\Persistence\CSV;

class DBFactory {

    public static function create(IPersistence $persister): IDriver
    {
        if ($persister instanceof CSV) {
            return new CSVDriver($persister);
        }
    }

}
