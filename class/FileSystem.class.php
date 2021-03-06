<?php

/*
 * FileSystem.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * Filesystem abstraction.
 */

/**
 * Class for filesystem abstraction.
 */
final class FileSystem {

    /**
     * Constructor
     */
    public function FileSystem() {
        
    }

    /**
     * Get operation system
     * 
     * @return	string	OS
     */
    public static function getOS() {
        return strtoupper(substr(PHP_OS, 0, 3));
    }

    /**
     * Returns the path separator.
     * 
     * @return	string	The path separator.
     */
    public static function getPathSeparator() {
        return ((self::getOS() == "WIN") ? "\\" : "/");
    }

    /**
     * Convert the given pathname string to normal form.
     */
    public static function normalize($path) {
        return $path; //TODO
    }

    /**
     * Returns the canonical pathname string of this abstract pathname.
     * 
     * @return	mixed	The canonical pathname string denoting the same file or
     *          		directory as this abstract pathname
     */
    public static function canonicalize($path) {
        return realpath($path);
    }

    /**
     * Returns the pathname string of this pathname's parent, or
     * null if this pathname does not name a parent directory.
     * 
     * @param	$file	File object
     * @return	string	The pathname string of the parent directory named by this
     *          		pathname, or null if this pathname
     *          		does not name a parent
     */
    public static function getParent($file) {
        $path_parts = explode(self::getPathSeparator(), $file->getPath());
        if (count($path_parts) == 1)
            return null;

        $reverse = array_reverse($path_parts);
        return $reverse[1];
    }

    /**
     * Tests whether the file or directory denoted by this pathname exists.
     *
     * @param	$file	File object
     * @return  bool	true if and only if the file or directory exists; false otherwise
     */
    public static function fileExists($file) {
        return file_exists($file->getPath());
    }

    /**
     * Tests whether the file or directory is readable.
     *
     * @param	$file	File object
     * @return  bool	true if and only if the file or directory is readable; false otherwise
     */
    public static function isReadable($file) {
        return is_readable($file->getPath());
    }

    /**
     * Tests whether the file or directory writable.
     *
     * @param	$file	File object
     * @return  bool	true if and only if the file or directory is writable; false otherwise
     */
    public static function isWritable($file) {
        return is_writable($file->getPath());
    }

    /**
     * Tests whether the file is a directory.
     *
     * @param	$file	File object
     * @return  bool	true if and only if the file exists and is a directory;
     *          		false otherwise
     */
    public static function isDirectory($file) {
        return is_dir($file->getPath());
    }

    /**
     * Return the time at which the file or directory denoted by the given 
     * pathname was last modified.
     * 
     * @param	$file	File object
     */
    public static function getLastModifiedTime($file) {
        return fileatime($file->getPath());
    }

    /**
     * Return the length in bytes of the file denoted by the given 
     * file.
     * 
     * NOTE: Maximum size in bytes representable in this way, without loss of bits is: (2^53) -1 = 9007199254740991
     * WARNING: This only works if the system calls are allowed on the server.
     * 
     * @param	$file	File object
     * @return	double	The length of the file in bytes (max: (2^53) -1)
     */
    public static function getLength($file) {

        // The '$x' sequence may be interpreted as variable in the shell
        $path = str_replace("$", "\\\$", $file->getPath());

        if (is_dir($path)) {
            return 0;
        }

        if (self::getOS() == "WIN") {
            $fs_obj = new COM("Scripting.FileSystemObject");
            return (double) $fs_obj->GetFile($path)->Size;
        }
        else
            return (double) trim(`stat -c%s "$path"`);
    }

    /**
     * List the elements of the directory denoted by the given pathname.
     * 
     * @param	$file		File object
     * @return 	array		Return an array of strings naming the elements of the
     * 						directory if successful; otherwise, an empty array.
     */
    public static function dirList($file) {
        if (!self::isDirectory($file) || !self::isReadable($file))
            return array();
        $dir_handle = opendir($file->getPath());
        $dir_etries = array();
        while ($entry = readdir($dir_handle)) {
            if (strpos($entry, ".") === 0)
                continue;
            array_push($dir_etries, $entry);
        }
        closedir($dir_handle);
        return $dir_etries;
    }

    /**
     * Create new folder.
     *
     * @param string $path
     * @return bool
     */
    public static function mkdir($path) {
        return mkdir($path);
    }

}

