<?php

/*
 * File.class.php
 * 
 * @author	Dalmir da Silva	<dalmirdasilva@gmail.com>
 */

/**
 * An abstract representation of file and directory pathnames.
 */

/**
 * Class for file
 */
final class File {

    // File path
    private $path = "";

    /**
     * Constructor
     * 
     * @param 	string	File path
     * @throws	ArgumentException
     */
    public function File($path = null) {
        if ($path == null)
            throw new ArgumentException("File name is empty");

        $this->path = FileSystem::normalize($path);
    }

    /**
     * Magic method
     */
    public function __toString() {
        return $this->getPath();
    }

    /**
     * Tests whether this file or directory exists.
     *
     * @return  bool	true if this file exists; false otherwise
     */
    public function exists() {
        return FileSystem::fileExists($this);
    }

    /**
     * Return the name of this file.
     * 
     * NOTE: Standard PHP function basename() is not safe. 
     * 	If filenames start with non-latin characters: all of them had been stripping.
     * 
     * @return	string	File name
     */
    public function name() {
        return preg_replace("/^.+[\\/]/", "", trim(trim($this->path, "/"), "\\"));
    }

    /**
     * Return the path of this file.
     * 
     * @return	string	File path
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Return the mime content type of this file.
     * 
     * @return	string	File mime content type
     */
    public function getMimeType() {
        return ""; //TODO
    }

    /**
     * Return the parent of this file.
     * 
     * @return	string	File parent
     */
    public function getParent() {
        return FileSystem::getParent($this);
    }

    /**
     * Tests whether this file or directory is readable.
     *
     * @return  bool	true if this file is readable; false otherwise
     */
    public function isReadable() {
        return FileSystem::isReadable($this);
    }

    /**
     * Tests whether this file or directory is writable.
     *
     * @return  bool	true if this file is writable; false otherwise
     */
    public function isWritable() {
        return FileSystem::isWritable($this);
    }

    /**
     * Tests whether this file or directory is a directory.
     *
     * @return  bool	true if this file is a directory; false otherwise
     */
    public function isDirectory() {
        return FileSystem::isDirectory($this);
    }

    /**
     * Return the last modified time of this file.
     * 
     * @return	string	Last modified time
     */
    public function lastModifiedTime() {
        return FileSystem::getLastModifiedTime($this);
    }

    /**
     * Return the length of this file.
     * 
     * @return	string	File length
     */
    public function length() {
        return FileSystem::getLength($this);
    }

    /**
     * Return all entries of this file (if is dir)
     * 
     * @return	array	Directory list
     */
    public function dirList() {
        return FileSystem::dirList($this);
    }

}
