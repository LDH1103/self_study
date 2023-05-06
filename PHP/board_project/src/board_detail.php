<?php
include_once( "./common/constant.php" );
include_once( DB_COMMON );
include_once( FUNCTION_FILE );

$method = $_SERVER["REQUEST_METHOD"];
$obj_db_select = new Db_select;
$obj_date = new Date;
$arr = $obj_db_select->fnc_sel_board_no( $_GET["board_no"] );
$comment = $obj_db_select->fnc_sel_comment( $_GET["board_no"] );

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>board</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board_detail.css">
</head>
<body>
    <?php include_once( SRC_HEADER ) ?>
    <div class="contents">
        <div class="contents_title">
            <span><?php echo $arr["board_no"] ?></span>
            <span>제목</span>
            <span><?php echo $arr["board_title"] ?></span>
            <span>조회수</span>
            <span><?php echo $arr["board_views"] ?></span>
            <span>작성일</span>
            <?php
            $obj_date->fnc_echo_date( $arr["board_write_date"] );
            ?>
        </div>
        <div class="contents">
        <span><?php echo $arr["board_content"] ?></span>
        <span><?php echo $arr["board_good_num"] ?></span>
        <span><?php echo $arr["board_bad_num"] ?></span>
        </div>
        <div>
        <?php
        foreach( $comment as $val ) {
        ?>
            <div class="comment">
            <?php
                echo "<span>" . $val["comment_nickname"] . "</span>";
                echo "<span>" . $val["comment_contents"] . "</span>";
                $obj_date->fnc_echo_date( $val["comment_write_date"] );
            ?>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
</body>
</html>