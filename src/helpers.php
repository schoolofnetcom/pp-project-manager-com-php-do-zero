<?php

if (!function_exists('debug')) {
    function debug(...$data) {
        foreach ($data as $d) {
            var_dump($d);
        }

        echo '<hr>';
        echo 'Trace: <br><br>';

        echo '<ol>';
        foreach (debug_backtrace() as $trace) {
            echo '<li>';
                if (isset($trace['file'])) {
                    echo $trace['file'] . ':' . $trace['line'] . '<br>';
                }
                if (isset($trace['class'])) {
                    echo $trace['class'] . ':' . $trace['function'] . '<br>';
                }
            echo '</li>';
        }
        echo '</ol>';

        die();
    }
}
