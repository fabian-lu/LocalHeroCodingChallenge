<?php

namespace App;


class PostalCodeRegexValidator {
    /*
        List example: 76143, 762*, ...
            - 5 digits postal codes
            - asterisks imply all other possibilities (here: 76200 - 76299)
    */

    
    /**
     * Array with List including the postal codes of all sales guys
     * @var array
     */
    protected $totalExpressions = [];

     
    /**
     * Array with List including the postal codes of the new sales area
     * @var array
     */
    protected $newExpressions = [];
    
     /**
     * Construct the Validator with the two lists.
     *
     * @param string $listTotal
     * @param string $listNew
     */
    public function __construct($listTotal, $listNew) {
        //Given list as string converted into array 
        $totalExpressions = explode (",", $listTotal);
        $newExpressions = explode (",", $listNew);
    }

    /**
     * Checks wether the new Postal Codes are already 
     * within the catchment area of other sales people
     * and returns all the conflicting areas
     *  
     * @return array
     */
    public function checkExpressions() {
        $testArray = array("76200", "76299");
        return $testArray;
    }
}