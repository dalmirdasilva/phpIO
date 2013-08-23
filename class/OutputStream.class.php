<?php

/*
 * OutputStream.class.php
 * 
 * @author Dalmir da Silva <dalmir.silva@hp.com>
 */

/**
 * This abstract class is the superclass of all classes representing an output stream of bytes.
 */

/**
 * Abstract class for output stream
 */
abstract class OutputStream {

    /**
     * Writes $content into output stream
     * 
     * @param	mixed	Content to write
     * @return 	int		Max lenght
     */
    abstract public function write($content, $size = null);
}
