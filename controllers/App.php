<?php

class App{
	
	private $user = null;    
    
    public function __construct($config) {
        Model::init($config['DB']['host'], $config['DB']['user'], $config['DB']['password'], $config['DB']['database']);
				
        $this -> init();
    }    
    
    private function init() {		
		$data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, b.id, name FROM books AS b LEFT JOIN authors AS a on b.author_id=a.id");
        include BASE . '/views/main.php';
    }    
}
