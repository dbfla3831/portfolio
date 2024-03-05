<?php
    $con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
    
    $sql = '
    CREATE TABLE stock_outgoing_TBL (
        record_ID INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (record_ID),
        stock_ID VARCHAR(10) NOT NULL,
        outgoing_date DATETIME NOT NULL,
        outgoing_quantity INT(5) NOT NULL,
        FOREIGN KEY (stock_ID) REFERENCES stock_TBL(stock_ID)
    )';

    $ret = mysqli_query($con, $sql); // 데이터베이스 생성

    if ($ret) {
        echo 'stock_outgoing_TBL 성공적으로 생성';
    } else {
        echo 'stock_outgoing_TBL 생성 실패', '<br>';
        echo '실패 원인 : ', mysqli_error($con);
    }

    mysqli_close($con);
?>
