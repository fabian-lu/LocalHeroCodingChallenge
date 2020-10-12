<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\PostalCodeRegexValidator;



class FirstTaskTest extends TestCase
{
   public function testTest() {
       $stringOne = "Hallo";
       $stringTwo = "Tschüss";
       $testArray = array("76200", "76299");
       $validator = new PostalCodeRegexValidator($stringOne, $stringTwo);
       $this->assertEquals($testArray, $validator->checkExpressions());
   }
}
