<?php

class Model{
    public static $db;
    public static $table = 'table_name';
    
	public static function r($data){
		return self::$db -> real_escape_string($data);
	}
    
    public static function init($host, $user, $pass, $dbName) {
        self::$db = new \mysqli($host, $user, $pass, $dbName);        
    }    
	
	public static function getByParams($params, $limit = '', $table = ''){
		$where = []; 
        if (count($params) > 0) {
            foreach ($params as $key => $value){
            
                $where[] = $key."='".$value."'";			 
            }	
            $where = "WHERE " . implode(' AND ', $where);
        } else {
            $where = '';
        }
        
        if (!empty($limit)) {
            $limit = "LIMIT $limit";
        } else {
            $limit = '';
        }
        
        if (!empty($table)) {
            $table = $table;
        } else {
            $table = static::$table;
        }
        
        $query = "SELECT * FROM $table $where $limit";
        
        $data = [];		
		$res = self::$db -> query($query);
		if ($res -> num_rows > 0) {
			while ($d = $res -> fetch_assoc()) {
                $data[] = $d;
            }
		}
		return $data;
    }
	
    public static function getByQuery($query){        
        $data = [];		
		$res = self::$db -> query($query);
		if ($res && $res -> num_rows > 0) {
			while ($d = $res -> fetch_assoc()) {
                $data[] = $d;
            }
		}
		return $data;
    }
    
	public static function insert($params){
		$fields = [];
		$values = [];
		foreach ($params as $key => $value){
			$fields[] = $key;
			$values[] = "'".$value."'"; 
		}
		self::$db -> query("INSERT INTO ".static::$table." (".implode(',', $fields).") VALUES (".implode(',', $values).")");
		return self::$db->insert_id;
	}
    
    public static function update($field, $value, $where){		
		self::$db -> query("UPDATE  ".static::$table." SET ".$field."='".$value."' WHERE ".$where);		
	}
	
	public static function deldata($id){		
        self::$db -> query("DELETE FROM ".static::$table." WHERE id =$id");
    }
    
}

