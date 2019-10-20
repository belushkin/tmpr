<?php declare(strict_types=1);

namespace App\Persistence;

/**
 * CSV Persistence class.
 */
class CSV implements IPersistence
{

    private $file;

    private $handle = null;

    private $delimiter = ';';

    private $enclosure = '"';

    private $escape_char = '\\';

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function __destruct()
    {
        $this->closeFile();
    }

    public function openFile($mode = 'r'): void
    {
        if (!$this->handle) {
            $this->handle = fopen($this->file, $mode);
            if ($this->handle === false) {
                throw new \Exception(['Can not open CSV file.', 'file' => $this->file, 'mode' => $mode]);
            }
        }
    }

    public function closeFile(): void
    {
        if ($this->handle) {
            fclose($this->handle);
            $this->handle = null;
        }
    }

    public function getLine(): array
    {
        $data = fgetcsv($this->handle, 0, $this->delimiter, $this->enclosure, $this->escape_char);
        if ($data === FALSE) {
            return [];
        }
        return $data;
    }

    public function export(): array
    {
        $data = [];

        $this->getLine();
        while (($row = $this->getLine())) {
            $data[] = $row;
        }

        // need to close file otherwise file pointer is at the end of file
        $this->closeFile();

        return $data;
    }
}