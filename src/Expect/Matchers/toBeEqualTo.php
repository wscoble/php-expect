<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/28/12
 * Time: 9:09 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Asserts using == against actual and expected.
 * @param $actual
 * @param $expected
 * @return array
 */
Expect::$matchers['toBeEqualTo'] = function ($actual, $expected) {
    return array(
        $positive_matcher = function () use ($actual, $expected) {
            assert( $actual == $expected );
        }, "Expected objects to be equal",

        $negative_matcher = function () use ($actual, $expected) {
            assert( $actual != $expected );
        }, "Expected objects to not be equal"
    );
};