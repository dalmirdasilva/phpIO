<?php

/*
 * IOException.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Class for IO exception.
 */
class IOException extends Exception {

    /**
     * Constructor
     */
    public function __construct($message = "") {
        parent::__construct("IOException: " . $message . ".");
    }

}
