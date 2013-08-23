<?php

/*
 * FileNotReadableException.class.php
 * 
 * @author Dalmir da Silva <dalmir.silva@hp.com>
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
