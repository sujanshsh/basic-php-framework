<?php

function session_get($key)
{
    return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL; 
}

function session_set($key, $value)
{
    $_SESSION[$key] = $value;
}