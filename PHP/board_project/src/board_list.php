<?php
include_once( "./common/constant.php" );
include_once( DB_COMMON );
include_once( FUNCTION_FILE );

$obj_db_select = new Db_select;
$obj_date = new Date;
$arr = $obj_db_select->fnc_sel_board_all(); // 글정보 가져와서 $arr에 담기

?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>board</title>
        <link rel="stylesheet" href="<?php echo SRC_COMMON_CSS ?>">
        <link rel="stylesheet" href="./css/board_list.css">
    </head>
    <body>
    <?php include_once( SRC_HEADER ); ?>
    <!-- 상단 글 번호,  글 제목, 조회수, 작성일, 추천수, 비추천수 -->
    <div class="div_info">
        <span>글 번호</span>
        <span class="text_cen">글 제목</span>
        <span class="text_cen">작성일</span>
        <span class="text_cen">추천수</span>
        <span class="text_cen">비추천수</span>
    </div>
    <!-- 글 정보 출력, 댓글수는 글제목 옆 []안에 출력 -->
    <div class="div_content">
        <?php
        foreach( $arr as $val ) {
        ?>
            <span><a href="board_detail.php?board_no=<?php echo $val["board_no"] ?>"><?php echo $val["board_no"] ?></a></span>
            <span class='text_cen'><a href="board_detail.php?board_no=<?php echo $val["board_no"] ?>"><?php echo $val["board_title"] ?></a></span>
        <?php
            $obj_date->fnc_echo_date( $val["board_write_date"] );
            echo "<span class='text_cen'>" . $val["board_good_num"] . "</span>";
            echo "<span class='text_cen'>" . $val["board_bad_num"] . "</span>";
        }
        ?>
    </div>
    <!-- 페이징 버튼 -->
    <div>

    </div>
</body>
</html>