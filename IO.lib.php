<?php

/**
 * IO library. Includes all needed classes.
 * 
 *
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

include_once(dirname(__FILE__) . "/class/FileSystem.class.php");
include_once(dirname(__FILE__) . "/class/File.class.php");
include_once(dirname(__FILE__) . "/class/FileChannel.class.php");
include_once(dirname(__FILE__) . "/class/InputStream.class.php");
include_once(dirname(__FILE__) . "/class/OutputStream.class.php");
include_once(dirname(__FILE__) . "/class/FileInputStream.class.php");
include_once(dirname(__FILE__) . "/class/FileOutputStream.class.php");
include_once(dirname(__FILE__) . "/class/HttpSingleOutputStream.class.php");
include_once(dirname(__FILE__) . "/class/HttpMultipleOutputStream.class.php");

include_once(dirname(__FILE__) . "/class/IOException.class.php");
include_once(dirname(__FILE__) . "/class/FileNotWritableException.class.php");
include_once(dirname(__FILE__) . "/class/FileNotReadableException.class.php");
include_once(dirname(__FILE__) . "/class/FileNotFoundException.class.php");
include_once(dirname(__FILE__) . "/class/ArgumentException.class.php");
?>
