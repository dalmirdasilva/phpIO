<?php

/*
 * HttpMultipleOutputStream.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * A specific output stream for writing data in http output with multiple parts
 */

/**
 * Class for http multiple output stream.
 */
final class HttpMultipleOutputStream extends FileOutputStream {

    // The associated input streams
    private $input_stream = array();

    /**
     * Constructor
     */
    public function HttpMultipleOutputStream() {
        parent::__construct("php://output");
    }

    /**
     * Sends headers to the client
     */
    public function sendHeaders() {
        ob_end_clean();
        header("Content-type: multipart/x-mixed-replace;boundary=AMZ90RFX875LKMFasdf09DDFF3");
        header("Content-Transfer-Encoding: binary");
    }

    /**
     * Sets the associated input stream
     * 
     * @param	FileInputStream	File input stream
     */
    public function addInputStream($input_stream) {
        array_push($this->input_stream, $input_stream);
    }

    /**
     * Returns one associated input stream
     * 
     * @return	FileInputStream	File input stream
     */
    public function getInputStream($index) {
        return $this->input_stream[$index];
    }

    /**
     * Returns the number of associated input streams
     * 
     * @return	int	
     */
    public function countInputStream() {
        return count($this->input_stream);
    }

    /**
     * Starts the stream to the client
     *
     * @param	int	Buffer length
     */
    public function startStream($lenght = 1) {
        $this->sendHeaders();
        $this->write("\n--AMZ90RFX875LKMFasdf09DDFF3\n");
        for ($i = ($this->countInputStream() - 1); $i >= 0; $i--) {
            $current_input_stream = $this->getInputStream($i);
            $this->write("Content-type: " . $current_input_stream->getFile()->getMimeType() . "\n");
            $this->write("Content-Transfer-Encoding: binary\n");
            $this->write("Content-Length: " . $current_input_stream->getFile()->length() . "\n");
            $this->write("Content-Disposition: attachment; filename=" . $current_input_stream->getFile()->name() . "\n\n");
            while ($current_input_stream->available()) {
                $this->write($current_input_stream->read($lenght), $lenght);
            }
            $current_input_stream->close();
            $this->write("--AMZ90RFX875LKMFasdf09DDFF3\n");
        }
        $this->write("--AMZ90RFX875LKMFasdf09DDFF3--");
        $this->close();
    }

    /**
     * Override the write method, just for add ob_flush(), is required to work with http output stream
     *
     * @param	mixed	Content
     * @param	int		Length of data
     */
    public function write($content, $lenght = null) {
        parent::write($content, $lenght);
        ob_flush();
    }

}
