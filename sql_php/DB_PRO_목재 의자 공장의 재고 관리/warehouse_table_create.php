<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
    $sql = '
    CREATE TABLE warehouse_TBL (
        warehouse_ID VARCHAR(10) NOT NULL PRIMARY KEY,
        warehouse_addr VARCHAR(10) NOT NULL,
        warehouse_name VARCHAR(10) NOT NULL
    )';


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'warehouse_TBL 성공적으로 생성';
	} else {
		echo 'warehouse_TBL 생성 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>