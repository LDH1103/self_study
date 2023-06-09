<?php
class Db_conn {
    private $param_conn = null;

    // ---------------------------------
    // 함수명	: __construct
    // 기능		: DB Connection
    // 파라미터	: Obj	&$param_conn
    // 리턴값	: $this->param_conn
    // ---------------------------------
    public function __construct( &$param_conn ) {
        $host = "localhost";
        $user = "root";
        $pass = "root506";
        $charset = "utf8mb4";
        $db_name = "board_project";
        $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
        $pdo_option =
            array(
                PDO::ATTR_EMULATE_PREPARES         => false 
                ,PDO::ATTR_ERRMODE                 => PDO::ERRMODE_EXCEPTION 
                ,PDO::ATTR_DEFAULT_FETCH_MODE      => PDO::FETCH_ASSOC 
            );

        try
        {
            $this->param_conn = new PDO( $dns, $user, $pass, $pdo_option );
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

class Db_select {
    private $conn = null;

    // ---------------------------------------------------
    // 함수명	: __construct
    // 기능		: Db_conn 클래스를 인스턴스화 하여 DB연결 객체를 얻음
    // 파라미터	: 없음
    // 리턴값	: 없음
    // ---------------------------------------------------
    public function __construct() {
        $obj_db_conn = new Db_conn( $obj_db_conn );
        $this->conn = $obj_db_conn->get_param_conn();
    }

    // ---------------------------------------------------
    // 함수명	: fnc_sel_board_all
    // 기능		: board_info의 모든글 조회
    // 파라미터	: 없음
    // 리턴값	: Array/String      $this->result/ErrMSG
    // ---------------------------------------------------
    public function fnc_sel_board_all() {
        $sql =
        " SELECT "
        ."      * "
        ." FROM " 
        ."      board_info "
        ." ORDER BY "
        ."      board_no DESC "
        ;

        $arr_prepare = array();
        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        } catch ( Exception $e ) {
            echo "에러 발생\n$e";
            throw new Exception( $e->getMessage() );
        } finally {
            $conn = null;
        }
        return $result ;
    }

    // ---------------------------------------------------
    // 함수명	: fnc_sel_board_no
    // 기능		: board_no로 삭제되지 않은 특정글 조회
    // 파라미터	: Int               $board_no
    // 리턴값	: Array/String      $this->result/ErrMSG
    // ---------------------------------------------------
    public function fnc_sel_board_no( &$param_no ) {
        $sql =
        " SELECT "
        ."      * "
        ." FROM " 
        ."      board_info "
        ." WHERE "
        ."      :board_no = board_no "
        ." AND "
        ."      board_del_flg = 0 "
        ;

        $arr_prepare = 
            array(
                ":board_no" => $param_no
            );

        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        } catch ( Exception $e ) {
            echo "에러 발생\n$e";
            throw new Exception( $e->getMessage() );
        } finally {
            $conn = null;
        }
        return $result[0];
    }

    // ---------------------------------------------------
    // 함수명	: fnc_sel_comment
    // 기능		: board_no로 댓글 조회
    // 파라미터	: Int               $board_no
    // 리턴값	: Array/String      $this->result/ErrMSG
    // ---------------------------------------------------
    public function fnc_sel_comment( &$param_no ) {
        $sql =
        " SELECT "
        ."      comment.comment_no "
        ."      ,comment.comment_contents "
        ."      ,comment.comment_write_date "
        ."      ,comment.comment_nickname "
        ."      ,comment.comment_password "
        ." FROM " 
        ."      board_comments comment "
        ."      INNER JOIN "
        ."          board_info board "
        ."          ON comment.board_no = board.board_no "
        ." WHERE "
        ."      comment.board_no = :board_no "
        ." AND "
        ."      board.board_del_flg = 0 "
        ." AND "
        ."      comment.comment_del_flg = 0 "
        ." ORDER BY "
        ."      comment.comment_no DESC "
        ;

        $arr_prepare = 
            array(
                ":board_no" => $param_no
            );

        try {
            $stmt = $this->conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        } catch ( Exception $e ) {
            echo "에러 발생\n$e";
            throw new Exception( $e->getMessage() );
        } finally {
            $conn = null;
        }
        return $result;
    }
}

// --------------------------------TEST--------------------------------

// $conn = null;
// $obj_db_conn = new Db_conn( $conn );

$obj_db_select = new Db_select;
// $arr = $obj_db_select->fnc_sel_board_all();
// var_dump( $arr );

// $param = 1;
// $arr = $obj_db_select->fnc_sel_board_no( $param );
// var_dump( $arr );

// $param = 1;
// $arr = $obj_db_select->fnc_sel_comment( $param );
// var_dump( $arr );
// --------------------------------TEST--------------------------------

?>