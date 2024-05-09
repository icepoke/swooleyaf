<?php

namespace League\CLImate\Util\Writer;

class Buffer implements WriterInterface
{
    /**
     * @var string the buffered data
     */
    protected $contents = '';

    /**
     * Write the content to the buffer.
     *
     * @param string $content
     */
    public function write($content)
    {
        $this->contents .= $content;
    }

    /**
     * Get the buffered data.
     *
     * @return string
     */
    public function get()
    {
        return $this->contents;
    }

    /**
     * Clean the buffer and throw away any data.
     */
    public function clean()
    {
        $this->contents = '';
    }
}