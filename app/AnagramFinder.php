<?php

namespace Anagram;

/**
 * Check if an anagram of one string is contained in another string.
 * 
 * @author     Francesco Di Martino <dimartino.francesco@gmail.com>
 * @version    Release: 1.0
 */ 

final class AnagramFinder
{

    private  $max_string_length;

    /**
     * Inizialize the Class
     *
     * @param int $max_string_length        Max string that Finder can accept
     * 
     * @return AnagramFinder
     */ 
    public function __construct(int $max_string_length = 1024) {
        $this->max_string_length = $max_string_length;
    }

    /**
     * Search the anagram of the first string in the second one
     *
     * @param string $needle    The anagrammable string
     * @param string $haystack  The string within which to search for the anagram
     * 
     * @throws InvalidArgumentException if the argument are not well formatted
     * 
     * @return bool True if the haystack contains the anagram on the needle, false if not
     */ 
    public function searchAnagram(string $needle, string $haystack): bool {

        try {
            $this->validateStrings($needle, $haystack);
            
            $needle_len = strlen($needle);
            $haystack_len = strlen($haystack);

            $needle_array = str_split($needle, 1);
            sort($needle_array);

            $haystack_array = str_split($haystack, 1);

            $cursor = 0;
            $isAnagram = false;

            while($cursor + $needle_len <= $haystack_len && !$isAnagram){
                
                $haystack_sub = substr($haystack, $cursor, $needle_len);
                $haystack_sub_array = str_split($haystack_sub, 1);
                sort($haystack_sub_array);

                $dist = array_diff($needle_array, $haystack_sub_array);
                $distance = count($dist);

                $isAnagram = !$distance;
                $cursor += $distance;

            }

            return $isAnagram;

        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Validate String, checking length of the ones
     *
     * @param string $needle    The anagrammable string
     * @param string $haystack  The string within which to search for the anagram
     * 
     * @throws InvalidArgumentException if the argument are not well formatted
     * 
     * @return void
     */ 
    private function validateStrings(string $needle, string $haystack): void {

        $needle_len = mb_strlen($needle);
        $haystack_len = mb_strlen($haystack);

        if($needle_len > $this->max_string_length || $needle_len === 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Needle is not a valid string. Please use a string with number of char between 1 and %d ',
                    $this->max_string_length
                )
            );
        }

        if($haystack_len > $this->max_string_length || $needle_len === 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Haystack is not a valid string. Please use a string with number of char between 1 and %d ',
                    $this->max_string_length
                )
            );
        }

        if($needle_len > $haystack_len) {
            throw new \InvalidArgumentException('The length of the Needle cannot be greater than Haystack');
        }
    }

}