<?php 
namespace coding\app\models;
use coding\app\system\AppSystem;
class Model{
    public static  $tblName;
    public $table, $columns = [], $sql, $bindValues, $join,
    $where, $orWhere, $whereCount=0, $isOrWhere = false,
    $rowCount=0, $limit, $orderBy;
   

   
   
    function save():bool{
        
      
        $values=array();
        $columns=array();
        //get_object_
        foreach(get_object_vars($this) as $key=> $property){
            //echo $property;
            if($property!=self::$tblName)
            {
                $values[]=is_string($property)?"'".$property."'":$property;
                $columns[]=$key;}

        }
        $values=implode(",",$values);
        $columns=implode(",",$columns);
       $sql_query="insert into ".self::$tblName." (".$columns." ) values (".$values.")";
   //echo $sql_query;
   
        $stmt=AppSystem::$appSystem->database->pdo->prepare($sql_query);
        if($stmt->execute())
        return true;
        return false;
       // return true;
     //echo $sql_query;
    }

    public function getAll(){
        $sql_query="select * from ".self::$tblName."";
        $stmt=AppSystem::$appSystem->database->pdo->prepare($sql_query);
        $stmt->execute();
        return $stmt->fetchAll();

    }
    
	private function resetQuery(){
		$this->table = null;
		$this->columns = null;
		$this->sql = null;
		$this->bindValues = null;
		$this->join = null;
		$this->limit = null;
		$this->orderBy = null;
		$this->where = null;
		$this->orWhere = null;
		$this->whereCount = 0;
		$this->isOrWhere = false;
	}
    public function table($table_name){
		$this->resetQuery();
		$this->table = $table_name;
		return $this;
	}
    public function select($columns){
		$columns = explode(',', $columns);
		foreach ($columns as $key => $column) {
			$columns[$key] = $column;
		}
		
		$columns = implode('`, `', $columns);
		$this->columns = `[$columns]`;
		return $this;
	}
	public function where(){
		if ($this->whereCount == 0) {
			$this->where .= " WHERE ";
			$this->whereCount+=1;
		}else{
			$this->where .= " AND ";
		}
		$this->isOrWhere= false;

		$num_args = func_num_args();
		$args = func_get_args();
		if ($num_args == 1) {
			if (is_numeric($args[0])) {
				$ids = NULL;
				$this->where .= "$args[0] = ?";
				$this->bindValues[] =  $args[0];
            }
		}elseif ($num_args == 2) {
			$operators = explode(',', "=,>,<,>=,>=,<>");
			$operatorFound = false;
			foreach ($operators as $operator) {
				if ( strpos($args[0], $operator) !== false ) {
					$operatorFound = true;
					break;
				}
			}
			if ($operatorFound) {
				$this->where .= $args[0]." ?";
			}else{
				$this->where .= "`".trim($args[0])."` = ?";
			}
			$this->bindValues[] =  $args[1];
		}elseif ($num_args == 3) {
			$this->where .= "`".trim($args[0]). "` ". $args[1]. " ?";
			$this->bindValues[] =  $args[2];
		}
		return $this;
	}

    public function get(){
		$this->assimbleQuery();
		$this->getSQL = $this->sql;
		$stmt=AppSystem::$appSystem->database->pdo->prepare($this->sql);
		$stmt->execute($this->bindValues);
		$this->rowCount = $stmt->rowCount();
		$rows = $stmt->fetchAll();
		$collection= [];
		foreach ($rows as $key => $row) {
			$collection[] = (array) $row;
		}
		return $collection;
	}
    public function getFetch(){
		$this->assimbleQuery();
		$this->getSQL = $this->sql;
		$stmt=AppSystem::$appSystem->database->pdo->prepare($this->sql);
		$stmt->execute($this->bindValues);
		$this->rowCount = $stmt->rowCount();
		$rows = $stmt->fetch();
		return (array) $rows;
	}
    private function assimbleQuery(){
		if ( $this->columns !== null ) {
			$select = $this->columns;
		}else{
			$select = "*";
		}

		$this->sql = "SELECT $select FROM `$this->table`";
        if ($this->join !== null) {
			$this->sql .= $this->join;
		}

		if ($this->where !== null) {
			$this->sql .= $this->where;
		}

		if ($this->orderBy !== null) {
			$this->sql .= $this->orderBy;
		}

		if ($this->limit !== null) {
			$this->sql .= $this->limit;
		}
	}

	public function limit($limit){
		$this->limit = " LIMIT {$limit}";
		return $this;
	}
	public function orderBy($field_name, $order = 'ASC'){
		$this->orderBy = " ORDER BY $field_name $order";
		return $this;
	}
    public function count()
	{
		// Start assimble Query
		$countSQL = "SELECT COUNT(id) as co FROM `$this->table`";

		if ($this->where !== null) {
			$countSQL .= $this->where;
		}

		if ($this->limit !== null) {
			$countSQL .= $this->limit;
		}
		// End assimble Query

		$stmt=AppSystem::$appSystem->database->pdo->prepare($countSQL);
		$stmt->execute($this->bindValues);

		$this->getSQL = $countSQL;

		return $stmt->fetch()[0];
	}

    
}
?>