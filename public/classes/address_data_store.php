<?
require_once('classes/filestore.php');

class AddressDataStore extends Filestore{


    public function __construct($filename = 'address_book.csv')
    {	
    	$filename = strtolower($filename);
    	parent::__construct($filename);
    	//echo $this->filename; 

    }

}



