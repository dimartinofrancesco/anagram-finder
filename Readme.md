
# Anagram Finder
A simple PHP class that search the anagram of a string in a haystack.

## Usage

```php
$anagramFinder = new Anagram\AnagramFinder();
$result = $anagramFinder->searchAnagram('abc', 'itookablackcab');
```

## Execute PhpUnit Test

```bash
docker run --rm --interactive --tty   --volume $PWD:/app   composer install
```

```bash
docker run --rm -v $(pwd):/app jitesoft/phpunit --configuration phpunit.xml
```