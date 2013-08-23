<?php

/*
 * FileNotWritableException.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Class for file not writable exception
 */
class FileNotWritableException extends IOException {

    /**
     * Constructor
     */
    public function __construct($message = "") {
        parent::__construct("FileNotWritableException: " . $message . ".");
    }

}
