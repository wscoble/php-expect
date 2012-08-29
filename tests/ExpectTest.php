<?php

class ExpectTest extends \PHPUnit_Framework_TestCase
{
    public function testExpectAReturnsExpectObject() {
        Expect::that(new Expect(''))->toBeInstanceOf('Expect');
    }

    public function testExpectDoesNotReturnException() {
        Expect::a(new Expect(''))->not->toBeInstanceOf('Expect_Exception');
    }

    public function testExpectToBeSame() {
        Expect::a('stuff')->toBeSameAs('stuff');
    }

    public function testNotExpectToBeSame() {
        Expect::a('stuff')->not->toBeSameAs("stuffed");
        Expect::a(new Expect(''))->not->toBeSameAs(new Expect(''));
    }

    public function testExpectToBeEqual() {
        Expect::a(new Expect(''))->toBeEqualTo(new Expect(''));
    }

    public function testExpectNotToBeEqual() {
        Expect::a(new Expect('stuff'))->not->toBeEqualTo(new Expect(''));
    }

    public function testExpectChaining() {
        Expect::that("string")
            ->toBeEqualTo('string')
            ->and->toBeSameAs("string")
            ->not->toBeEqualTo("another string")
            ->or->not->toBeSameAs(1000);
    }
}
