<?php

/*
 * FileInputStream.class.php
 * 
 * @author Dalmir da Silva <dalmir.silva@hp.com>
 */

/**
 * Obtains input bytes from a file in a file system.
 */

/**
 * Class for file input stream
 */
class FileInputStream extends InputStream {

    // File channel
    private $channel = null;
    // File
    private $file = null;

    /**
     * Constructor
     */
    public function FileInputStream($file) {
        $this->file = (is_string($file)) ? new File($file) : $file;
        if (!$this->getFile()->exists())
            throw new FileNotFoundException("File not found: " . $this->getFile()->name());
        if ($this->getFile()->isDirectory())
            throw new FileNotFoundException("Cannot stream a directory: " . $this->getFile()->name());
        $this->createChannel();
        $this->open();
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
     * Tests whether the file channel is available
     *
     * @return  bool	true if the file channel is available; false otherwise
     */
    public function available() {
        return $this->getChannel()->available();
    }

    /**
     * Reads $lenght from the channel
     *
     * @return	mixed	Value read
     */
    public function read($lenght = 1) {
        return $this->getChannel()->read($lenght);
    }

    /**
     * Opens the file channel
     *
     * @return	bool						true if success, false othewise
     * @throws	FileNotReadableException
     */
    public function open() {
        if (!$this->getFile()->isReadable())
            throw new FileNotReadableException("Cannot read from file: " . $this->getFile()->name());
        return $this->getChannel()->open("rb");
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
