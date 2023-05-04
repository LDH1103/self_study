<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Russian roulette game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/russian_roulette.css">
</head>
<body>
    <form method="POST" action="russian_roulette.php">
    <?php
    // 세션 시작
    session_start();

    // 리셋 버튼을 누를경우 세션 종료 후 새로고침
    if ( isset( $_POST["reset"] ) ) {
        session_destroy();
        header( "Location: russian_roulette.php" );
    }
    // 탄창 배열이 설정되지 않은경우 설정
    if ( !isset( $_SESSION["chamber"] ) ) {
        $chamber = array( 0, 0, 0, 0, 0, 1 );
        shuffle( $chamber );
        $_SESSION["chamber"] = $chamber;
    } else { // 탄창 배열이 설정되어 있는 경우, 세션에 현재 탄창 상태를 반영함
        $chamber = $_SESSION["chamber"];
    }
    // shot 버튼을 누를 경우, 탄창의 마지막값을 제거하고 $bullet 변수에 반환함
    if ( isset( $_POST["shot"] ) ) {
        $bullet = array_pop( $chamber );
        // 총알이 1일경우 게임 오버 메세지 출력후, 리셋버튼 출력 및 세션 종료
        if ( $bullet === 1 ) {
            echo "<div class='game_over'>게임 오버!</div><br><br>";
            echo "<button type='submit' name='reset' class='btn btn-outline-dark'>reset</button>";
            session_destroy();
        } else { 
            // 총알이 1가 아닐경우, 메세지와 shot버튼 출력후, 세션에 현재 탄창 상태를 반영함
            echo "<div class='msg'>패스!</div>";
            echo "<div class='msg'>남은 탄창 : ".count( $chamber )."</div><br>";
            echo "<button type='submit' name='shot' class='btn btn-outline-dark'>shot</button>";
            $_SESSION["chamber"] = $chamber;
        }
    } else {
        echo "<div class='new_game'>새 게임</div><br><br>";
        echo "<button type='submit' name='shot' class='btn btn-outline-dark'>shot</button>";
    }
    ?>
	</form>
</body>
</html>
