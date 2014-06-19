<?
require_once('classes/filestore.php');

class AddressDataStore extends Filestore{


    public function __construct($filename = 'address_book.csv')
    {	
    	$filename = strtolower($filename);
    	parent::__construct($filename);
    	echo $this->filename; 

    }

    public function read_address_book()
    {
        
    }

    public function write_address_book($big_array) 
    {

	}

}



