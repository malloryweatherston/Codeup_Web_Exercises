<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') 
    {
        $this->filename = $filename
    }

    /**
     * Returns array of lines in $this->filename
     */
    function read_lines()
    {
        $items = []; 
        $filesize = filesize($filename);
        $read = fopen($filename, "r"); 
        $string_list = trim(fread($read, $filesize));
        $items = explode(PHP_EOL, $string_list);
        fclose($read);
        return $items;
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function write_lines($array)
    {
         $handle = fopen($filename, 'w');
        foreach ($items as $item) {
            fwrite($handle, $item . PHP_EOL);
        }
    fclose($handle);
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv()
    {
        $entries = [];
            $handle = fopen($this->filename, 'r');
            while(!feof($handle)) {
                $row = fgetcsv($handle);
                if(is_array($row)) {
                    $entries[] = $row;
                }
            }
            fclose($handle);
            return $entries;

    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function write_csv($big_array)
    {
        $handle = fopen($this->filename, 'w');
        foreach($big_array as $fields) {
            fputcsv($handle, $fields); 
        }
        fclose($handle);


    }

}