<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/28/12
 * Time: 5:56 PM
 * To change this template use File | Settings | File Templates.
 */

require_once __DIR__ . '/__init__.php';

/**
 * Use to chain up some assertions
 */
class Expect
{
    /**
     * Factory to start Expect chaining
     * @static
     * @param $name
     * @param $args
     * @return Expect
     */
    public static function __callStatic($name, $args) {
        return new Expect($actual = $args[0]);
    }

    public static $matchers = array();
    protected $actual;
    protected $not;

    public function __construct($actual) {
        $this->actual = $actual;
        $this->not = false;
    }

    /**
     * Some magic to add some context to chains and set negative assertions
     * @param $name
     * @return Expect
     */
    public function __get($name) {
        switch ($name) {
            case "not":
                $this->not = true;
                break;
            case "or":
            case "and":
                $this->not = false;
                break;
            default:
                return $this->$name;
        }
        return $this;
    }

    /**
     * Some magic to call dynamically loaded matchers.
     * @param $name
     * @param $args
     * @return mixed
     */
    public function __call($name, $args) {
        $expected = $args[0];
        $expect = $this;
        $do = function() use ($name, $expected, $expect) {
            $func = Expect::$matchers[$name];
            list($p_callback, $p_message, $n_callback, $n_message) = $func($expect->actual, $expected);
            return $expect->toBe($p_callback, $p_message, $n_callback, $n_message);
        };
        return $do();
    }

    /**
     * The work horse of Expect.  Send in a positive assertion callback and associated failure message,
     * negative assertion call back and associated failure message, get back testing goodness.
     *
     * See Expect/Matchers for examples.
     *
     * @param $p_callback
     * @param $p_message
     * @param $n_callback
     * @param $n_message
     * @return Expect
     * @throws Expect_Exception
     */
    public function toBe($p_callback, $p_message, $n_callback, $n_message) {
        try {
            if ($this->not) {
                $n_callback();
            } else {
                $p_callback();
            }
        } catch (\PHPUnit_Framework_Error_Warning $e) {
            if ($this->not) {
                throw new Expect_Exception($n_message);
            } else {
                throw new Expect_Exception($p_message);
            }
        }
        return $this;
    }
}
