<?php

/*
 * ArgumentException.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Class for argument exception.
 */
class ArgumentException extends IOException {

    /**
     * Constructor
     */
    public function __construct($message = "") {
        parent::__construct("ArgumentException: " . $message . ".");
    }

}
