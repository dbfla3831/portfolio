<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
	$sql = "
		INSERT INTO stock_info_TBL VALUES
		('warehouse1', 'stock1', '바퀴', 1000),
        ('warehouse1', 'stock9', '플라스틱', 15000),
        ('warehouse1', 'stock10', '스피링', 2000),

        ('warehouse2', 'stock2', '나무', 100000),
        ('warehouse2', 'stock8', '사포', 2000),
        ('warehouse2', 'stock11', '플라스틱 다리', 30000),

        ('warehouse3', 'stock3', '핑크 페인트', 50000),
        ('warehouse3', 'stock7', '네모난 쿠션', 30000),

        ('warehouse4', 'stock4', '파란 페인트', 40000),
        ('warehouse4', 'stock6', '빨간 페인트', 40000),

        ('warehouse5', 'stock5', '몫', 1000),
        ('warehouse5', 'stock12', '동그란 쿠션', 30000)";


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'stock_info_TBL에 데이터가 성공적으로 입력';
	} else {
		echo 'stock_info_TBL에 데이터 입력 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>