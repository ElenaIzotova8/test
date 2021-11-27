<?php

class App{
	
	private $user = null;    
    
    public function __construct($config) {
        Model::init($config['DB']['host'], $config['DB']['user'], $config['DB']['password'], $config['DB']['database']);
				
        $this -> init();
    }    
    
    private function init() {		
		
    }    
}
