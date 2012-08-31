<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/28/12
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */

/**
 * Asserts equality between actual and expected using ===
 * @param $actual
 * @param $expected
 * @return array
 */
Expect::$matchers['toBeSameAs'] = function ($actual, $expected) {
    return array(
        $positive_matcher = function () use ($actual, $expected) {
            assert( $actual === $expected );
        }, "Expected objects to be the same",

        $negative_matcher = function () use ($actual, $expected) {
            assert( $actual !== $expected );
        }, "Expected objects to not be the same"
    );
};