<?php

/*
 * FileChannel.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * A channel for open, close, read, write... a file.
 */

/**
 * Class for file channel
 */
class FileChannel {

    // Source of file (file path)
    private $source = null;
    // The channel itself
    private $channel = null;

    /**
     * Constructor
     * 
     * @param	file	File
     */
    public function FileChannel($file) {
        $this->source = $file->getPath();
    }

    /**
     * Open the file channel
     * 
     * @param	string	Options ex: "r", "w", "a"...
     */
    public function open($options) {
        $this->channel = @fopen($this->source, $options);
    }

    /**
     * Tests whether this file channel is opened
     *
     * @return  bool	true if this file channel is open; false otherwise
     */
    public function isOpened() {
        return (bool) $this->channel;
    }

    /**
     * Read from file channel
     * 
     * @param	int		Lenght of content
     * @return	mixed	Content
     * @throws	IOexception
     */
    public function read($lenght = 1) {

        if (!$this->isOpened())
            throw new IOexception("Stream closed");

        return @fread($this->channel, $lenght);
    }

    /**
     * Write from file channel
     * 
     * @param	int		Content
     * @param	int		Lenght of content
     * @return	bool	true if success; false otherwise
     * @throws	IOexception
     */
    public function write($content, $lenght = null) {

        if (!$this->isOpened())
            throw new IOexception("Stream closed");

        $lenght = (!$lenght) ? strlen($content) : $lenght;
        return @fwrite($this->channel, $content, $lenght);
    }

    /**
     * Tests whether this file channel have content to read
     *
     * @return  bool	true if this file channel have; false otherwise
     * @throws	IOexception
     */
    public function available() {

        if (!$this->isOpened())
            throw new IOexception("Stream closed");

        return !@feof($this->channel);
    }

    /**
     * Flush file channel buffer
     * 
     * @return	bool	true if success; false otherwise
     * @throws	IOexception
     */
    public function flush() {

        if (!$this->isOpened())
            throw new IOexception("Stream closed");

        return @fflush($this->channel);
    }

    /**
     * Close file channel
     * 
     * @return	bool	true if success; false otherwise
     */
    public function close() {

        if ($this->isOpened()) {
            $close = @fclose($this->channel);
            $this->channel = null;
            return $close;
        }
    }

}
