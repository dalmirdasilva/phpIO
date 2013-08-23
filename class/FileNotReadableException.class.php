<?php

/*
 * FileNotReadableException.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Class for file not readable exception
 */
class FileNotReadableException extends IOException {

    /**
     * Constructor
     */
    public function __construct($message = "") {
        parent::__construct("FileNotReadableException: " . $message . ".");
    }

}
