<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
	$sql = "
		INSERT INTO stock_TBL VALUES
		('stock1', '바퀴', 'warehouse1', 0),
        ('stock2', '나무', 'warehouse2', 0),
        ('stock3', '핑크 페인트', 'warehouse3', 0),
        ('stock4', '파란 페인트', 'warehouse4', 0),
        ('stock5', '몫', 'warehouse5', 0),
        ('stock6', '빨간 페인트', 'warehouse4', 0),
        ('stock7', '네모난 쿠션', 'warehouse3', 0),
        ('stock8', '사포', 'warehouse2', 0),
        ('stock9', '플라스틱', 'warehouse1', 0),
        ('stock10', '스피링', 'warehouse1', 0),
        ('stock11', '플라스틱 다리', 'warehouse2', 0),
        ('stock12', '동그란 쿠션', 'warehouse5', 0)
    ";


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'stock_TBL에 데이터가 성공적으로 입력';
	} else {
		echo 'stock_TBL에 데이터 입력 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>