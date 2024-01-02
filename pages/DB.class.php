<?php 
/* 
 * DB Class 
 * This class is used for database related (connect, insert, update, and delete) operations 
 * @author    CodexWorld.com 
 * @url        http://www.codexworld.com 
 * @license    http://www.codexworld.com/license 
 */ 
include_once 'dbs.php'; // Include configuration file 
class DB{ 
    private $dbHost     = DB_HOST; 
    private $dbUsername = DB_USERNAME; 
    private $dbPassword = DB_PASSWORD; 
    private $dbName     = DB_NAME; 
    private $proTbl     = 'kegiatans'; 
    private $imgTbl     = 'kegiatans_images'; 
     
    public function __construct(){ 
        if(!isset($this->db)){ 
            // Connect to the database 
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName); 
            if($conn->connect_error){ 
                die("Failed to connect with MySQL: " . $conn->connect_error); 
            }else{ 
                $this->db = $conn; 
            } 
        } 
    } 
     
    /* 
     * Returns rows from the database based on the conditions 
     * @param array select, where, order_by, limit and return_type conditions 
     */ 
    public function getRows($conditions = array()){ 
        $sql = "SELECT "; 
        $sql .= array_key_exists("select", $conditions)?$conditions['select']:"P.*,I.file_name"; 
        $sql .= " FROM {$this->proTbl} AS P"; 
        $sql .= " LEFT JOIN {$this->imgTbl} AS I ON (I.product_id = P.id AND I.id = (SELECT MAX(id) FROM kegiatans_images WHERE product_id=P.id)) "; 
 
        if(array_key_exists("where", $conditions)){ 
            $sql .= " WHERE "; 
            $i = 0; 
            foreach($conditions['where'] as $key => $value){ 
                $pre = ($i > 0)?" AND ":''; 
                $alias_key = strpos($key, '.') !== false?$key:"P.$key"; 
                $sql .= $pre."$alias_key = '".$value."'"; 
                $i++; 
            } 
        } 
         
        if(array_key_exists("order_by", $conditions)){ 
            $sql .= " ORDER BY P.{$conditions['order_by']} ";  
        }else{ 
            $sql .= " ORDER BY P.waktu DESC "; 
        } 
         
        if(array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){ 
            $sql .= " LIMIT {$conditions['start']},{$conditions['limit']}";  
        }elseif(!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){ 
            $sql .= " LIMIT {$conditions['limit']}";  
        } 
         
        $result = $this->db->query($sql); 
         
        if(array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all'){ 
            switch($conditions['return_type']){ 
                case 'count': 
                    $data = $result->num_rows; 
                    break; 
                case 'single': 
                    $data = $result->fetch_assoc(); 
                    if(!empty($data['id'])){ 
                        $data['images'] = array(); 
 
                        $sub_query = "SELECT * FROM {$this->imgTbl} WHERE product_id={$data['id']} ORDER BY id DESC"; 
                        $sub_result = $this->db->query($sub_query); 
                        if($sub_result->num_rows > 0){ 
                            while($img_row = $sub_result->fetch_assoc()){ 
                                $data['images'][] = $img_row; 
                            } 
                        } 
                    } 
                    break; 
                default: 
                    $data = ''; 
            } 
        }else{ 
            if($result->num_rows > 0){ 
                while($row = $result->fetch_assoc()){ 
                    $data[] = $row; 
                } 
            } 
        } 
        return !empty($data)?$data:false; 
    } 
 
    public function get_image_row($id){ 
        $sql = "SELECT * FROM {$this->imgTbl} WHERE id=$id"; 
        $result = $this->db->query($sql); 
        return $result->num_rows > 0?$result->fetch_assoc():false; 
    } 
     
    /* 
     * Insert data into the database 
     * @param array the data for inserting into the table 
     */ 
    public function insert($data){ 
        if(!empty($data) && is_array($data)){ 
            $columns = ''; 
            $values  = ''; 
            $i = 0; 
            if(!array_key_exists('created',$data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists('modified',$data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
            foreach($data as $key=>$val){ 
                $pre = ($i > 0)?', ':''; 
                $columns .= $pre.$key; 
                $values  .= $pre."'".$this->db->real_escape_string($val)."'"; 
                $i++; 
            } 
            $query = "INSERT INTO {$this->proTbl} ($columns) VALUES ($values)"; 
            $insert = $this->db->query($query); 
            return $insert?$this->db->insert_id:false; 
        }else{ 
            return false; 
        } 
    } 
 
    public function insert_image($data){ 
        if(!empty($data) && is_array($data)){ 
            $columns = ''; 
            $values  = ''; 
            $i = 0; 
            if(!array_key_exists('created',$data)){ 
                $data['created'] = date("Y-m-d H:i:s"); 
            } 
            foreach($data as $key=>$val){ 
                $pre = ($i > 0)?', ':''; 
                $columns .= $pre.$key; 
                $values  .= $pre."'".$this->db->real_escape_string($val)."'"; 
                $i++; 
            } 
            $query = "INSERT INTO {$this->imgTbl} ($columns) VALUES ($values)"; 
            $insert = $this->db->query($query); 
            return $insert?$this->db->insert_id:false; 
        }else{ 
            return false; 
        } 
    } 
     
    /* 
     * Update data into the database 
     * @param array the data for updating into the table 
     * @param array where condition on updating data 
     */ 
    public function update($data, $conditions){ 
        if(!empty($data) && is_array($data)){ 
            $colvalSet = ''; 
            $whereSql = ''; 
            $i = 0; 
            if(!array_key_exists('modified',$data)){ 
                $data['modified'] = date("Y-m-d H:i:s"); 
            } 
            foreach($data as $key=>$val){ 
                $pre = ($i > 0)?', ':''; 
                $colvalSet .= $pre.$key."='".$this->db->real_escape_string($val)."'"; 
                $i++; 
            } 
            if(!empty($conditions)&& is_array($conditions)){ 
                $whereSql .= " WHERE "; 
                $i = 0; 
                foreach($conditions as $key => $value){ 
                    $pre = ($i > 0)?" AND ":''; 
                    $whereSql .= $pre.$key." = '".$value."'"; 
                    $i++; 
                } 
            } 
            $query = "UPDATE {$this->proTbl} SET $colvalSet $whereSql"; 
            $update = $this->db->query($query); 
            return $update?$this->db->affected_rows:false; 
        }else{ 
            return false; 
        } 
    } 
     
    /* 
     * Delete data from the database 
     * @param array where condition on deleting data 
     */ 
    public function delete($conditions){ 
        $whereSql = ''; 
        if(!empty($conditions)&& is_array($conditions)){ 
            $whereSql .= " WHERE "; 
            $i = 0; 
            foreach($conditions as $key => $value){ 
                $pre = ($i > 0)?" AND ":''; 
                $whereSql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
        } 
        $query = "DELETE FROM {$this->proTbl} $whereSql"; 
        $delete = $this->db->query($query); 
        return $delete?true:false; 
    } 
 
    public function delete_images($conditions){ 
        $whereSql = ''; 
        if(!empty($conditions)&& is_array($conditions)){ 
            $whereSql .= " WHERE "; 
            $i = 0; 
            foreach($conditions as $key => $value){ 
                $pre = ($i > 0)?" AND ":''; 
                $whereSql .= $pre.$key." = '".$value."'"; 
                $i++; 
            } 
        } 
        $query = "DELETE FROM {$this->imgTbl} $whereSql"; 
        $delete = $this->db->query($query); 
        return $delete?true:false; 
    } 
}