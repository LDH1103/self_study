<?php
$result = 0;

function fnc_cal( &$post, &$param_num1, &$param_num2 ) {
    if( $post === "1" ) {
        $result = $param_num1 + $param_num2;
    } else if( $post === "2" ) {
        $result = $param_num1 - $param_num2;
    } else if( $post === "3" ) {
        $result = $param_num1 * $param_num2;
    } else if( $post === "4" ) {
        $result = $param_num1 / $param_num2;
    }
    return $result;
}

function fnc_echo_cal( &$param_result ) {
    if( strlen( (string)$param_result ) > 21 ) {
        echo mb_substr( $param_result, 0, 21 ) . "...";
    } else {
        echo $param_result;
    }
}

if( $_POST ) {
    $result = fnc_cal( $_POST["cal"], $_POST["num1"], $_POST["num2"] );
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/calculator.css">
</head>
<body>
    <div class="container1">
        <form action="calculator.php" method="POST">
        <?php
            if( !empty($_POST["checkbox"]) ) {
        ?>
            <input type="number" id="num1" name="num1" step="0.0000000001" placeholder="숫자를 입력해주세요." required autofocus value="<?php echo $result; ?>">
        <?php
            } else {
        ?>
            <input type="number" id="num1" name="num1" step="0.0000000001" placeholder="숫자를 입력해주세요." required autofocus>
        <?php 
            }
        ?>
            <br>
            <br>
            <div class="radio_ckeck">
                <input value="1" type="radio" name="cal" id="plus" checked>
                <label for="plus" class="position">+</label>
                <input value="2" type="radio" name="cal" id="minus" class="checkbox">
                <label for="minus" class="position">-</label>
                <input value="3" type="radio" name="cal" id="multipl" class="checkbox">
                <label for="multipl" class="position_multipl">x</label>
                <input value="4" type="radio" name="cal" id="division" class="checkbox">
                <label for="division" class="position_division">÷</label>
            </div>
            <br>
            <input type="number" id="num2" name="num2" step="0.0000000001" placeholder="숫자를 입력해주세요." required>
            <br>
            <br>
            <input value="1" type="checkbox" name="checkbox" id="checkbox">
            <label for="checkbox">계산결과를 첫 숫자로 설정</label>
            <br>
            <br>
            <input type="submit" value="계산" class="submit_btn btn btn-outline-dark">
        </form>
    </div>
    <div class="container2">
        <?php 
        fnc_echo_cal( $result );
        ?>
    </div>
</body>
</html>
