<?php

function custom_error_handler( $errno ,  $errstr ,  $errfile ,  $errline) {
    
    // error was suppressed with the @-operator
    if (0 === error_reporting()) { return false;}
     
    echo '<div style="width: 100%; border-bottom: 1px solid #777">';
    echo '<p styld="font-weight: bold; color: red;">';
    switch ($errno) {
        case E_USER_WARNING:
            echo "E_USER_WARNING"; break;
        case E_USER_NOTICE:
            echo "E_USER_NOTICE"; break;
        case E_WARNING:
            echo "E_WARNING"; break;
        case E_CORE_WARNING:
            echo "E_CORE_WARNING"; break;
        case E_COMPILE_WARNING:
            echo "E_COMPILE_WARNING"; break;
        case E_NOTICE:
            echo "E_NOTICE"; break;
        case E_ERROR:
            echo "E_ERROR"; break;
        case E_PARSE:
            echo "E_PARSE"; break;
        case E_CORE_ERROR:
            echo "E_CORE_ERROR"; break;
        case E_COMPILE_ERROR:
            echo "E_COMPILE_ERROR"; break;
        case E_USER_ERROR:
            echo "E_USER_ERROR"; break;   
        default:
            echo "(unknown error)"; break;
    }
    echo '</p>';
    echo '<p><strong>'.$errstr.'</strong>'.'</p>';
    echo '<p>File:&nbsp;'.$errfile.'</p>';
    echo '<p>Line:&nbsp;'.$errline.'</p>';
    echo '</div>';
    
    return true;
}

set_error_handler('custom_error_handler',E_ALL|E_STRICT);