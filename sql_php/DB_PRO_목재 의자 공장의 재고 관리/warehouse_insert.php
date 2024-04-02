<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
	$sql = "
		INSERT INTO warehouse_TBL VALUES
		('warehouse1', '수원시', '수원 창고'),
        ('warehouse2', '안산시', '안산 창고'),
        ('warehouse3', '화성시', '화성 창고'),
        ('warehouse4', '군포시', '군포 창고'),
        ('warehouse5', '시흥시', '시흥 창고')
    ";


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'warehouse_TBL에 데이터가 성공적으로 입력';
	} else {
		echo 'warehouse_TBL에 데이터 입력 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>