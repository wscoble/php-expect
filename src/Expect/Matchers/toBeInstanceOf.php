<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/28/12
 * Time: 8:32 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Asserts the class names of actual and expected using ==
 * @param $actual
 * @param $expected
 * @return array
 */
Expect::$matchers['toBeInstanceOf'] = function ($actual, $expected) {
    $actual_class = get_class($actual);
    return array(
        $positive_matcher = function () use ($actual_class, $expected) {
            assert( $actual_class == $expected );
        },
        "Expected $expected, found $actual_class.",

        $negative_matcher = function () use ($actual_class, $expected) {
            assert( $actual_class != $expected );
        },
        "$expected not expected, but found"
    );
};