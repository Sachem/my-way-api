<?php

if (! function_exists('convertPhpDateToJavaScript')) {
    function convertPhpDateToJavaScript($date) 
    {
        return date("Y", strtotime($date)) . '-' .
                (date("n", strtotime($date))-1) . '-' .
                date("j", strtotime($date));
    }
}