<?php
include_once( DB_COMMON );

class Date {
    // ---------------------------------------------------
    // 함수명	: fnc_echo_date
    // 기능		: 글 작성일을 사용해 작성일 출력방식을 정함
    // 파라미터	: String            &$param_date
    // 리턴값	: 없음
    // ---------------------------------------------------
    function fnc_echo_date( &$param_date ) {
        // 글 작성일이 오늘이라면 시간 출력
        if( mb_substr( $param_date, 0, 10 ) === TODAY_DATE ) {
            echo "<span class='text_cen'>" . mb_substr( $param_date, -9 ) . "</span>";
        } else { // 오늘이 아니라면 날짜 출력
            echo "<span class='text_cen'>" . mb_substr( $param_date, 0, 10 ) . "</span>";
        }
    }
}
?>