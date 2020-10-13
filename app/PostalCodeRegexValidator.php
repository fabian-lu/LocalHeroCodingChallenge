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
     * 
     */
    protected $totalExpressions;

     
    /**
     * Array with List including the postal codes of the new sales area
     *
     */
    protected $newExpressions;
    
     /**
     * Construct the Validator with the two lists.
     *
     * @param string $totalExpressions
     * @param string $newExpressions
     */
    public function __construct($totalExpressions, $newExpressions) {

        if(empty($totalExpressions) || empty($newExpressions)) {
          $this->totalExpressions = null;
          $this->newExpressions = null;
        } else {
          //Given list as string converted into array WITHOUT whitespaces
          $this->totalExpressions = array_map('trim', explode(",", $totalExpressions));
          $this->newExpressions = array_map('trim', explode(",", $newExpressions));
        }
  
      }

    /**
     * Checks wether the new Postal Codes are already 
     * within the catchment area of other sales people
     * and returns all the conflicting areas
     *  
     * @return array
     */
    public function checkExpressions() {
        //----------------------- error cases --------------------------------

        //one of the expression lists is empty
        if(empty($this->totalExpressions) || empty($this->newExpressions)) {
            return array("");
        }

        //letter in totalExpressions array
        //"/[^\d\*]|.*(?<!\*)$/i" => get each entry that either contains something other than a letter or asteriks,
        //                          OR get each entry that contains an asterik which is not at the end of the string
        $letterCheckTotal = preg_grep("/[^\d\*]|^.+\*.+$/i", $this->totalExpressions);
        if(!empty($letterCheckTotal)) {
            $errMessage = array("Error! Wrong postal format in the sales people postals list.");
            return $errMessage;
        }

        //letter in newExpressions array
        $letterCheckNew = preg_grep("/[^\d\*]|^.+\*.+$/i", $this->newExpressions);
        if(!empty($letterCheckNew)) {
            $errMessage = array("Error! Wrong postal format in the new postal list.");
            return $errMessage;
        }

        //get rid of the entries with an asterik at the end 
        $deletedAsterikEntriesTotal = preg_grep("/.\*$|\*/i", $this->totalExpressions);
        $keys = array_keys($deletedAsterikEntriesTotal);
        foreach ($keys as $keyToDelete) {
          unset($this->totalExpressions[$keyToDelete]);
        }

        $deletedAsterikEntriesNew = preg_grep("/.\*$|\*/i", $this->newExpressions);
        $keys = array_keys($deletedAsterikEntriesNew);
        foreach ($keys as $keyToDelete) {
          unset($this->newExpressions[$keyToDelete]);
        }


        //one lists contains an entry with more than 5 digits
        //"/^.{6,}$|^.{1,4}$/" => string length must equal 5 
        $digitLengthTotal = preg_grep("/^.{6,}$|^.{1,4}$/", $this->totalExpressions);
        if(!empty($digitLengthTotal)) {
            $errMessage = array("Error! Wrong postal format in the sales people postals list.");
            return $errMessage;
        }

        $digitLengthNew = preg_grep("/^.{6,}$|^.{1,4}$/", $this->newExpressions);
        if(!empty($digitLengthNew)) {
            $errMessage = array("Error! Wrong postal format in the new postal list.");
            return $errMessage;
        }

       

        



        //find any entries with asteriks



        //---------------------- actual function -----------------------------
    }
}