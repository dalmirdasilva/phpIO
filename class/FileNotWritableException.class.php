<?php

/*
 * FileNotWritableException.class.php
 * 
 * @author Dalmir da Silva <dalmir.silva@hp.com>
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
