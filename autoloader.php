<?php

spl_autoload_register(function ($class) {
    if (file_exists('models/'.$class.'.php')){
        include 'models/'.$class.'.php';
    } else {        
		include 'controllers/'.$class.'.php';
    }
});

