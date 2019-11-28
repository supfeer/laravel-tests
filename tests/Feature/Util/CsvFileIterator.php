<?php


namespace Tests\Unit\Util;

/**
 * Iterates through csv file and returns rows in array by columns
 *
 * Class CsvFileIterator
 * @package Tests\Unit\Util
 */
class CsvFileIterator implements \Iterator
{
    /**
     * @var bool|resource
     */
    protected $file;
    /**
     * @var int
     */
    protected $key = 0;
    /**
     * @var
     */
    protected $current;

    /**
     * CsvFileIterator constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = fopen($file, 'r');
    }

    /**
     *
     */
    public function __destruct()
    {
        fclose($this->file);
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind()
    {
        rewind($this->file);
        $this->current = fgetcsv($this->file);
        $this->key     = 0;
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return !feof($this->file);
    }

    /**
     * Return the key of the current element
     *
     * @return int|mixed
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Return the current element
     *
     * @return mixed
     */
    public function current()
    {
        return $this->current;
    }

    /**
     * Move forward to next element
     */
    public function next()
    {
        $this->current = fgetcsv($this->file);
        $this->key++;
    }
}
