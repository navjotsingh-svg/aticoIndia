<?php

namespace App\Helper;

use App\Models\Profile;

class ImportWord
{
    /**
     * Handle word file Import.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function import($filePath)
    {
    	$xmlResult = self::read_docx($filePath);
    	
    	if (empty($xmlResult)) {
    		return false;
    	}
		return self::getElements($xmlResult);
    }

    /**
     * Extract elements from word file's XML format.
     *
     * @param  String $xml
     * @param  Array $fields
     * @return Array
     */
    private static function getElements($xml)
    {
    	$data = [];

    	$domDoc = new \DOMDocument;

    	// Load xml content as DOM elements
		$domDoc->loadXML($xml);

		$rows = $domDoc->getElementsByTagName("tr");

		if (!$rows->length) {
			return false;
		}

		$currentQuestion = 0;

		//	-- Loop through Each Table Row of table 
		foreach ($rows as $el) {
			
			//	-- get columns data 
			$els = $el->getElementsByTagName("tc");

			if ($els->length == 1) {
				$currentQuestion++;
			}

			//	-- check if there exists at least 2 columns
			if ($els->length >= 2) {

				$field = snake_case(trim($els[0]->textContent));	//-- Get first column elements
				$fieldVal = trim($els[1]->textContent);	//-- Get second column elements

				if (!empty($field) && !empty($fieldVal)) {
					if (isset($data[$currentQuestion][$field])) {
						if (is_array($data[$currentQuestion][$field])) {
							$data[$currentQuestion][$field][] = $fieldVal;
						} else {
							$data[$currentQuestion][$field] = [$data[$currentQuestion][$field], $fieldVal];
						}
					} else {
						$data[$currentQuestion][$field] = $fieldVal;
					}
				}
			}

		}
		return $data;
    }

    /**
     * Extract elements from word file's XML format.
     *
     * @param  String $xml
     * @param  Array $fields
     * @return Array
     */
    private static function getElements__old($xml, $fields, $arrayFields = [])
    {
    	$data = [];

    	$domDoc = new \DOMDocument;

    	// Load xml content as DOM elements
		$domDoc->loadXML($xml);

		//	-- Loop through Each Table Row of table 
		foreach ($domDoc->getElementsByTagName("tr") as $el) {
			
			//	-- get columns data 
			$els = $el->getElementsByTagName("tc");
			
			//	-- check if there exists at least 2 columns
			if ($els->length >= 2) {

				$elements = $els[0]->getElementsByTagName('p');	//-- Get first column elements
				$valElements = $els[1]->getElementsByTagName('p');	//-- Get second column elements

				if ($elements->length > 0) {

					//-- check if first column have equal no. of corresponding values as second's
					if ($elements->length == $valElements->length) {
						
						//-- Loop through each sub-element in column
						for ($j = 0; $j < $elements->length; $j++ ) {
							$checkField = trim($elements[$j]->textContent);
							
							//-- check if given value is field name
							if (in_array($checkField, $fields)) {
								
								if (in_array(strtolower($checkField), $arrayFields)) {
									$data[strtolower($checkField)][] = trim($valElements[$j]->textContent);
								} else {
									//-- store value to its corresponding field
									$data[strtolower($checkField)] = trim($valElements[$j]->textContent);
								}
							}

						}

						//-- check if first column has only one element
					} elseif ($elements->length == 1) {	
						$checkField = trim($elements[0]->textContent);

						//-- check if given value is field name
						if (in_array($checkField, $fields)) {
						
							$valEls = [];

							//-- get second column's elements in array
							foreach ($valElements as $childChildElemnt) {
								$valEls[] = trim($childChildElemnt->textContent);
							}

							if (in_array(strtolower($checkField), $arrayFields)) {
								$data[strtolower($checkField)][] = implode('\n', $valEls);
							} else {
								//-- store field value by imploding values by new line
								$data[strtolower($checkField)] = implode('\n', $valEls);
							}


						}
					}
				}
			}
		}

		return $data;
    }

    /**
     * Read docx file & return xml content of file.
     *
     * @param  String $xml
     * @param  Array $fields
     * @return Array
     */
	private  static function read_docx($filename)
	{
		$striped_content = '';
	    $content = '';

	    if (!$filename || !file_exists($filename)) {
	    	return false;
	    }

	    $zip = zip_open($filename);
	    
	    if (!$zip || is_numeric($zip)) {
	    	return false;
	    }

	    while ($zip_entry = zip_read($zip)) {

	        if (zip_entry_open($zip, $zip_entry) == FALSE) {
	        	continue;
	        }

	        if (zip_entry_name($zip_entry) != "word/document.xml") {
	        	continue;
	        }

	        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
	        
			zip_entry_close($zip_entry);
	    }

	    zip_close($zip);

		return $content;
	}


}
