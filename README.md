# Expect::your($test)->not->toSuck();

## Matching that doesn't suck ... mostly

It is very easy to create a matcher using php-expect. Just put it in the Expect::$matchers static array. Here's how.

#### Matcher skeleton
```php
Expect::$matchers['matcher'] = function($actual, $expected) {
    return array(
        $positive_matcher = function() use ($actual, $expected) {

        }, "What to say when the positive matcher fails",

        $negative_matcher = function() use ($actual, $expected) {

        }, "What to say when the negative matcher fails"
    );
}```

Of course, you don't need to write ```$positive_matcher = ``` or ```$negative_matcher = ```, but it helps add context.

Here is the _toSuck_ matcher:
```php
Expect::$matchers['toSuck'] = function ($actual, $expected) {
    $class = get_class($actual);
    return array(
        $positive_matcher = function () use ($class) {
            assert( $class == 'Suck' );
        }, "Expected object to suck",

        $negative_matcher = function () use ($class) {
            assert( $class != 'Suck' );
        }, "Expected object not to suck"
    );
};```