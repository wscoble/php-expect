# Expect::your($test)->not->toSuck();

## I'm on Packigist!

```json
{
...
    "require": {
    ...
        "lvcodesmith/php-expect": "dev-master"
    ...
    }
...
}
```

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
}
```

Of course, you don't need to write _$positive_matcher =_ or _$negative_matcher =_, but it helps add context.

#### The _toSuck_ matcher:
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
};
```