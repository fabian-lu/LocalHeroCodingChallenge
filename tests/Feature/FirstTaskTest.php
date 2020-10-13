<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PostalCodeRegexValidator;



class FirstTaskTest extends TestCase
{
       /*
       * Unit test for the checkExpressions function 
       * Writing the tests before the actual function .. 
       */

   
   public function testEmpty() {
    
       $listTotal = "";
       $listNew = "";
       $expectedResult = array("");
       $validator = new PostalCodeRegexValidator($listTotal, $listNew);
       $this->assertEquals($expectedResult, $validator->checkExpressions());
   }

   public function testNewEmpty() {
    
        $listTotal = "76143, 762*";
        $listNew = "";
        $expectedResult = array("");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testTotalEmpty() {
    
        $listTotal = "";
        $listNew = "76143";
        $expectedResult = array("");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testWrongPostalInTotal() {
    
        $listTotal = "7614, 76143";
        $listNew = "76143";
        $expectedResult = array("Error! Wrong postal format in the sales people postals list.");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testLetterInTotal() {
    
        $listTotal = "7614b, 76143";
        $listNew = "76143";
        $expectedResult = array("Error! Wrong postal format in the sales people postals list.");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testWrongPostalInNew() {
    
        $listTotal = "76141, 76143";
        $listNew = "7614";
        $expectedResult = array("Error! Wrong postal format in the new postal list.");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testLetterInNew() {
    
        $listTotal = "76141, 76143";
        $listNew = "7614b";
        $expectedResult = array("Error! Wrong postal format in the new postal list.");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }
    

    public function testNoAsteriks() {
    
        $listTotal = "76143, 76141, 76142, 76149, 76148";
        $listNew = "76143, 76141, 76145";
        $expectedResult = array("76143", "76141");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }


    public function testWithAsteriksInTotal() {
    
        $listTotal = "761*, 77777";
        $listNew = "76143, 76141, 71234";
        $expectedResult = array("76143", "76141");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testWithAsteriksInNew() {
    
        $listTotal = "76143, 76141, 76142, 76149, 76148, 77777";
        $listNew = "761*";
        $expectedResult = array("76143", "76141", "76142", "76149", "76148");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testNoMatch() {
    
        $listTotal = "76143, 76141, 76142, 76149, 76148, 77777";
        $listNew = "1*";
        $expectedResult = array("");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testZeroAtFirst() {
    
        $listTotal = "01234, 01235, 01236";
        $listNew = "01234";
        $expectedResult = array("01234");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    public function testAsteriksinMiddle() {
    
        $listTotal = "01234, 01*35, 01236";
        $listNew = "01234";
        $expectedResult = array("Error! Wrong postal format in the sales people postals list.");
        $validator = new PostalCodeRegexValidator($listTotal, $listNew);
        $this->assertEquals($expectedResult, $validator->checkExpressions());
    }

    

    

  
}
