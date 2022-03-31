<?php

use Anagram\AnagramFinder;
use PHPUnit\Framework\TestCase;

class AnagramFinderTest extends TestCase{

    protected $anagramFinder;

    private function generateRandomString($length = 25) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function setUp(): void
    {
        $this->anagramFinder = new AnagramFinder();
    }

    /** @test */
    public function needleCantHaveMoreThan1024Chars()
    {
        try {
            $haystack = "hey";
            $needle = $this->generateRandomString(1025);
            $this->anagramFinder->searchAnagram($needle, $haystack);
            $this->fail('A InvalidArgumentException should have been thrown');
            
        } catch (InvalidArgumentException $error) {
            $this->assertStringStartsWith("Needle is not a valid string", $error->getMessage());
        }
    }

    /** @test */
    public function haystackCantHaveMoreThan1024Chars()
    {
        try {
            $needle = "hey";
            $haystack = $this->generateRandomString(1025);
            $this->anagramFinder->searchAnagram($needle, $haystack);
            $this->fail('A InvalidArgumentException should have been thrown');
            
        } catch (InvalidArgumentException $error) {
            $this->assertStringStartsWith("Haystack is not a valid string", $error->getMessage());
        }
    }


    /** @test */
    public function needleLongerThanHaystack()
    {
        try {
            $needle = "PXBuboIgYKHHWOCB0HqQydPO";
            $haystack = "hey";
            $this->anagramFinder->searchAnagram($needle, $haystack);
            $this->fail('A InvalidArgumentException should have been thrown');
            
        } catch (InvalidArgumentException $error) {
            $this->assertStringStartsWith("The length of the Needle cannot be greater than", $error->getMessage());
        }
    }

    /** @test */
    public function anagramFound()
    {
        $needle = "abc";
        $haystack = "itookablackcab";
        $result = $this->anagramFinder->searchAnagram($needle, $haystack);
        $this->assertEquals(true, $result);
    }

    /** @test */
    public function anagramNotFound()
    {
        $needle = "abc";
        $haystack = "itookablackcb";
        $result = $this->anagramFinder->searchAnagram($needle, $haystack);
        $this->assertEquals(false, $result);
    }

}