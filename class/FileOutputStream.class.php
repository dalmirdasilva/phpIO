<?php

/*
 * FileOutputStream.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * An output stream for writing data to a file.
 */

/**
 * Class for file output stream
 */
class FileOutputStream extends OutputStream {

    // File channel
    private $channel = null;
    // File
    private $file = null;

    /**
     * Constructor
     */
    public function FileOutputStream($file) {
        $this->setFile((is_string($file)) ? new File($file) : $file);
        if ($this->getFile()->isDirectory())
            throw new FileNotFoundException("Cannot stream to a directory: " . $this->getFile()->name());
        $this->createChannel();
        $this->open();
    }

    /**
     * Sets the associated file
     *
     * @param	File	Associated file
     */
    protected function setFile($file) {
        $this->file = $file;
    }

    /**
     * Returns the associated file
     *
     * @return	File	Associated file
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Creates the file channel
     */
    public function createChannel() {
        $this->channel = new FileChannel($this->getFile());
    }

    /**
     * Returns the file channel
     *
     * @return	FileChannel	The file channel
     */
    public function getChannel() {
        return $this->channel;
    }

    /**
     * Writes $content to the channel
     *
     * @param	mixed	Content
     * @param	int		Lenght of content
     * @return	bool	true if success; false othewise
     */
    public function write($content, $lenght = null) {
        $write = $this->getChannel()->write($content, $lenght);
        if ($write)
            $this->getChannel()->flush();
        return $write;
    }

    /**
     * Opens the file channel
     *
     * @return	bool						true if success, false othewise
     * @throws	FileNotWritableException
     */
    public function open() {
        if (!$this->getFile()->isWritable())
            throw new FileNotWritableException("Cannot write to file: " . $this->getFile()->name());
        return $this->getChannel()->open("wb");
    }

    /**
     * Closes the file channel
     *
     * @return	bool	true if success, false othewise
     */
    public function close() {
        return $this->getChannel()->close();
    }

}
