<?php

function fnc_count_array( $num, $arr_num ) {
    $cnt = 0;
    foreach ( $arr_num as $find_no ) {
        $cnt += substr_count( $num, $find_no );
    }
    return $cnt;
}

$max = 9999;
$arr = array( 3, 6, 9 );

for ( $i = 1; $i <= $max; $i++ ) {
    if ( strpos( (string)$i, "3" ) !== false || strpos( (string)$i, "6" ) !== false || strpos( (string)$i, "9" ) !== false ) {
        $cnt = fnc_count_array( $i, $arr );
        for ( $j = 1; $j <= $cnt; $j++ ) {
            echo "*";
        }
        echo "\n";
    } else {
        echo $i."\n";
    }
}

?>