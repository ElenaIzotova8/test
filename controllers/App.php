<?php

class App{
	
	private $user = null;    
    
    public function __construct($config) {
        Model::init($config['DB']['host'], $config['DB']['user'], $config['DB']['password'], $config['DB']['database']);
        $this -> init();
    }    
    
    private function init() {
        if (isset($_GET['page']) && $_GET['page'] == 'a') {
            $this -> authors();
            die();
        }
        if (isset($_GET['page']) && $_GET['page'] == 'b') {
            $this -> books();
            die();
        }
        if (isset($_POST['login'])) {
            $access = User::isAdmin($_POST['login'], $_POST['password']);            
            if ($access['status']) {
                $this -> authors();
                die();
            }
        }
        $data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, b.id, name FROM books AS b LEFT JOIN authors AS a on b.author_id=a.id");
        $error = isset($access['error']) ? $access['error'] : '';
        include BASE . '/views/main.php';        
    }

    private function authors() {
        if (isset($_POST['add'])) {
            $patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
            Author::insert(['first_name' => $_POST['first_name'], 'patronymic' => $patronymic, 'last_name' => $_POST['last_name']]);
        }
        if (isset($_POST['save'])) {
            $patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
            Author::update(['first_name' => $_POST['first_name'], 'patronymic' => $patronymic, 'last_name' => $_POST['last_name'], 'last_modified' => date("Y.m.d H:i:s")], "id=".$_POST['save']);
        }
        if (isset($_GET['del'])) {
            Author::deldata($_GET['del']);
        }
        if (isset($_GET['edit'])) {
            $author = Author::getByParams(['id' => $_GET['edit']])[0];
        }
        $data = Model::getByQuery("SELECT a.id, first_name, patronymic, last_name, count(b.id) as count, a.created FROM  authors AS a LEFT JOIN books AS b on a.id=b.author_id GROUP BY a.id");
        include BASE . '/views/admin_a.php';     
    }
    
    private function books() {
        $data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, b.id, b.created, name FROM books AS b LEFT JOIN authors AS a on b.author_id=a.id");        
        include BASE . '/views/admin_b.php';     
    }
}
