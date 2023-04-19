<?php

if (!function_exists('prettyMoney')) {
    function prettyMoney($value){
        return number_format($value, 0, '', ' '). ' ' . __('HUF');
    }
}