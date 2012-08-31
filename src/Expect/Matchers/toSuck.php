<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/30/12
 * Time: 6:07 PM
 * To change this template use File | Settings | File Templates.
 */


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