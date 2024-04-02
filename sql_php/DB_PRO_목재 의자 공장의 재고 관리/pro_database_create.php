<?php
	$con = mysqli_connect('localhost', 'root', '1234', '') or die('MariaDB 접속 실패!');
	
	$sql = 'CREATE DATABASE projectDB';
	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'projectDB 성공적으로 생성';
	} else {
		echo 'projectDB 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>