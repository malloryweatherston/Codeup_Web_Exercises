<?
class AddressDataStore {

    public $filename = '';

    public function __construct($filename = 'address_book.csv')
    {
    	$this->filename = $filename;
    }

    public function read_address_book()
    {
        // Code to read file $this->filename

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

    public function write_address_book($big_array) 
    {
        // Code to write $addresses_array to file $this->filename
        $handle = fopen($this->filename, 'w');
		foreach($big_array as $fields) {
			fputcsv($handle, $fields); 
		}
		fclose($handle);

    }


}