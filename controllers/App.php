<?php

class App{
	
	private $user = null;    
    
    public function __construct($config) {
        Model::init($config['DB']['host'], $config['DB']['user'], $config['DB']['password'], $config['DB']['database']);
				
        $this -> init();
    }    
    
    private function init() {
        if ($_POST) {
            $access = User::isAdmin($_POST['login'], $_POST['password']);            
            if ($access['status']) {
                $data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, count(b.id) as count, a.created FROM  authors AS a LEFT JOIN books AS b on a.id=b.author_id GROUP BY author_id");
                include BASE . '/views/admin.php';
                die();
            }
        }
        $data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, b.id, name FROM books AS b LEFT JOIN authors AS a on b.author_id=a.id");
        $error = isset($access['error']) ? $access['error'] : '';
        include BASE . '/views/main.php';
        
    }    
}
