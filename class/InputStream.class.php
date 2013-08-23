<?php

/*
 * InputStream.class.php
 * 
 * @author Dalmir da Silva <dalmir.silva@hp.com>
 */

/**
 * This abstract class is the superclass of all classes representing an input stream of bytes.
 */

/**
 * Abstract class for input stream
 */
abstract class InputStream {

    /**
     * Reads $lenght chars from stream
     * 
     * @param	int		Lenght
     * @return 	char	$lenght chars from string
     */
    abstract public function read($lenght = 1);

    /**
     * Tests whether the stream is available.
     * 
     * @return 	bool	true if the stream is available; false otherwise
     */
    abstract public function available();
}
