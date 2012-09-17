<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sscoble
 * Date: 8/28/12
 * Time: 9:03 PM
 * Read and include all Expect matchers
 */

if ($handle = opendir(__DIR__ . "/Expect/Matchers")) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..")
            require_once __DIR__ . "/Expect/Matchers/$entry";
    }
    closedir($handle);
}
