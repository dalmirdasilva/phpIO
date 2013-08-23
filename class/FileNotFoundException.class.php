<?php

/*
 * FileNotFoundException.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Class for file not found exception.
 */
class FileNotFoundException extends IOException {

    /**
     * Constructor
     */
    public function __construct($message = "") {
        parent::__construct("FileNotFoundException: " . $message . ".");
    }

}
