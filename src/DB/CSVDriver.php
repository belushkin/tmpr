<?php declare(strict_types=1);

namespace App\DB;

use App\Persistence\CSV;

class CSVDriver implements IDriver {

    private $persister;

    public function __construct(CSV $persister)
    {
        $this->persister = $persister;
    }

    public function export(): array
    {
        $this->persister->openFile();
        return $this->persister->export();
    }

}
