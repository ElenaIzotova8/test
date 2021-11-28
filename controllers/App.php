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
        $msg = '';
        if (isset($_POST['add'])) {
            $patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
            Author::insert(['first_name' => $_POST['first_name'], 'patronymic' => $patronymic, 'last_name' => $_POST['last_name']]);
        }
        if (isset($_POST['save'])) {
            $patronymic = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
            Author::update(['first_name' => $_POST['first_name'], 'patronymic' => $patronymic, 'last_name' => $_POST['last_name'], 'last_modified' => date("Y.m.d H:i:s")], "id=".$_POST['save']);
        }
        if (isset($_GET['del'])) {
            $books  = [];
            $books  = Book::getByParams(['author_id' => $_GET['del']]);
            if (count($books) == 0 || (isset($_GET['all']) && $_GET['all'] == 1)) {
                foreach ($books as $book) {
                    Book::deldata($book['id']);
                }
                Author::deldata($_GET['del']);
            } else {
                $aid = $_GET['del'];
                $msg = 'У автора, которого Вы хотите удалить, есть книги. Удалить автора и все его книги?'; 
            }
        }
        if (isset($_GET['edit'])) {
            $author = Author::getByParams(['id' => $_GET['edit']])[0];
        }
        $having = [];
        if (isset($_POST['filtr'])) {            
            if(isset($_POST['first_name']) && $_POST['first_name'] != '') {
                $having[] = "LOWER(first_name) LIKE '%".mb_strtolower($_POST['first_name'])."%'";
            }
            if(isset($_POST['patronymic']) && $_POST['patronymic'] != '') {
                $having[] = "LOWER(patronymic) LIKE '%".mb_strtolower($_POST['patronymic'])."%'";
            }
            if(isset($_POST['last_name']) && $_POST['last_name'] != '') {
                $having[] = "LOWER(last_name) LIKE '%".mb_strtolower($_POST['last_name'])."%'";
            }
            if(isset($_POST['date_start']) && $_POST['date_start'] != '') {
                $having[] = "a.created >='".$_POST['date_start']."'";
            }
            if(isset($_POST['date_end']) && $_POST['date_end'] != '') {
                $having[] = "a.created <='".$_POST['date_end']." 23:59:59'";
            }
            if(isset($_POST['count']) && $_POST['count'] != '') {
                $having[] = "count=".($_POST['count']);
            }            
        }
        if (count($having) > 0) {
            $where = ' HAVING '.implode(' AND ',$having);
            echo $where;
        } else {
            $where = '';
        }
        $desc  = isset($_GET['desc']) && $_GET['desc'] == 1 ? ' DESC' : '';
        $order = isset($_GET['ord']) ? ' ORDER BY '. $_GET['ord'] . $desc : '';        
        $data  = Model::getByQuery("SELECT a.id, first_name, patronymic, last_name, count(b.id) as count, a.created FROM  authors AS a LEFT JOIN books AS b on a.id=b.author_id GROUP BY a.id".$where.$order);
        include BASE . '/views/admin_a.php';     
    }
    
    private function books() {
        $data = Model::getByQuery("SELECT author_id, first_name, patronymic, last_name, b.id, b.created, name FROM books AS b LEFT JOIN authors AS a on b.author_id=a.id");        
        include BASE . '/views/admin_b.php';     
    }
}
