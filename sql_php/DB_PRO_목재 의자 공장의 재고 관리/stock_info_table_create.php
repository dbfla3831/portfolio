<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
    $sql = '
    CREATE TABLE stock_info_TBL (
		warehouse_ID  VARCHAR(10) NOT NULL,
		stock_ID VARCHAR(10) NOT NULL,
        stock_name VARCHAR(10) NOT NULL,
        stock_price INT(5) NOT NULL,
		FOREIGN KEY (warehouse_ID) REFERENCES warehouse_TBL(warehouse_ID),
		FOREIGN KEY (stock_ID) REFERENCES stock_TBL(stock_ID)
	)';


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'stock_info_TBL 성공적으로 생성';
	} else {
		echo 'stock_info_TBL 생성 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>