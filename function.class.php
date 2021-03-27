<?php
class Functions 
{
    protected $db_l_host = "localhost";
    protected $db_l_user = "root";
    protected $db_l_pass = "";
    protected $db_l_name = "test_db"; 

    protected $con  = false; 
    public $myconn;

    function __construct() {
        global $myconn;
        
        $myconn = @mysqli_connect($this->db_l_host,$this->db_l_user,$this->db_l_pass,$this->db_l_name);
        
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();die;
        }
    }

    public function getTeachers($rows = '*', $where = null, $order = null)
    {
        
        $results = array();
        $q = 'SELECT '.$rows.' FROM teachers';
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;

        if(@mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0)
        {
            $results = @mysqli_query($GLOBALS['myconn'],$q);
            return $results;
        }
        else
        {
            return false;
        }
    }

    public function getClasses($rows = '*', $where = null, $order = null)
    {
        
        $results = array();
        $q = 'SELECT '.$rows.' FROM classes';
        if($where != null)
            $q .= ' WHERE '.$where;
        if($order != null)
            $q .= ' ORDER BY '.$order;

        if(@mysqli_num_rows(mysqli_query($GLOBALS['myconn'],$q))>0)
        {
            $results = @mysqli_query($GLOBALS['myconn'],$q);
            return $results;
        }
        else
        {
            return false;
        }
    }

    public function studentEnroll($rows)
    {   
        $strquery = 'INSERT INTO `students` SET ';
        $keys = array_keys($rows);

        for($i = 0; $i < count($rows); $i++)
        {
            if(is_string($rows[$keys[$i]]))
            {
                $strquery .= $keys[$i].'="'.$rows[$keys[$i]].'"';
            }
            else
            {
                $strquery .= $keys[$i].'='.$rows[$keys[$i]];
            }
            if($i != count($rows)-1)
            {
                $strquery .= ',';
            }
        }

        if(@mysqli_query($GLOBALS['myconn'],$strquery) === TRUE)
        {
            $last_id = $myconn->insert_id;
            return $last_id;
        }
        else
        {
           return false;
        }
    }

    public function studentunEnroll($where = null)
    {
        if($where != null)
        {
            $delete = 'DELETE FROM `students` WHERE '.$where;
            $del = @mysqli_query($GLOBALS['myconn'],$delete);
        }
        if($del)
        {
            return true;
        }
        else
        {
           return false;
        }
    }
}
?>