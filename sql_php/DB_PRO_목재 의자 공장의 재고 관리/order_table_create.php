<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
    $sql = '
    CREATE TABLE order_TBL (
        order_ID INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (order_ID),
        product_ID VARCHAR(10) NOT NULL,
        product_name VARCHAR(10) NOT NULL,
        order_date DATETIME NOT NULL,
        order_quantity INT(10) NOT NULL,
        order_state VARCHAR(10) NOT NULL,
        FOREIGN KEY (product_ID) REFERENCES product_TBL(product_id)
    )';


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'order_TBL 성공적으로 생성';
	} else {
		echo 'order_TBL 생성 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>