<?php
class Db_conn {
    private $host = null;
    private $user = null;
    private $pass = null;
    private $charset = null;
    private $db_name = null;
    private $dns = null;
    private $pdo_option = null;
    private $param_conn = null;

    // ---------------------------------
    // 함수명	: __construct
    // 기능		: DB Connection
    // 파라미터	: Obj	&$param_conn
    // 리턴값	: $this->param_conn
    // ---------------------------------
    public function __construct( &$param_conn ) {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "root506";
        $this->charset = "utf8mb4";
        $this->db_name = "board_project";
        $this->dns = "mysql:host=".$this->host.";dbname=".$this->db_name.";charset=".$this->charset;
        $this->pdo_option =
            array(
                PDO::ATTR_EMULATE_PREPARES         => false 
                ,PDO::ATTR_ERRMODE                 => PDO::ERRMODE_EXCEPTION 
                ,PDO::ATTR_DEFAULT_FETCH_MODE      => PDO::FETCH_ASSOC 
            );

        try
        {
            echo "db연결 성공\n";
            $this->param_conn = new PDO( $this->dns, $this->user, $this->pass, $this->pdo_option );
            return $this->param_conn;
        } catch( Exception $e) {   
            echo "에러 발생\n$e";
            throw new Exception( $e->getMessage() );
            $this->param_conn = null;
        }
    }

    public function get_param_conn() {
        return $this->param_conn;
    }
}

// $conn = null;
// $obj_db_conn = new Db_conn( $conn );

class Db_select {
    private $sql = null;
    private $arr_prepare = null;
    private $conn = null;
    private $stmt = null;
    private $result = null;
    private $obj_db_conn = null;

    public function __construct() {
        $this->obj_db_conn = new Db_conn( $this->obj_db_conn );
        $this->conn = $this->obj_db_conn->get_param_conn();
    }
    // ---------------------------------
    // 함수명	: fnc_sel_board_all
    // 기능		: board_info의 모든글 조회
    // 파라미터	: 없음
    // 리턴값	: 없음
    // ---------------------------------
    public function fnc_sel_board_all() {
        $this->sql =
        " SELECT "
        ."      * "
        ." FROM " 
        ."      board_info "
        ." ORDER BY "
        ."      board_no DESC "
        ;

        $this->arr_prepare = array();
        try {
            $this->stmt = $this->conn->prepare( $this->sql );
            $this->stmt->execute( $this->arr_prepare );
            $this->result = $this->stmt->fetchAll();
        } catch ( Exception $e ) {
            echo "에러 발생\n$e";
            throw new Exception( $e->getMessage() );
        } finally {
            $this->conn = null;
        }
        return $this->result ;
    }
}

$obj_db_select = new Db_select;
$arr = $obj_db_select->fnc_sel_board_all();
var_dump( $arr );
?>