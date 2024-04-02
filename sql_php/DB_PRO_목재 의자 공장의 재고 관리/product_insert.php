<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
	$sql = "
		INSERT INTO product_TBL VALUES
		('chair1', '바퀴달린 의자', 50000, '2023-01-04', 1),
        ('chair2', '높이조절 의자', 100000, '2023-01-04', 3),
        ('chair3', '빨간색 의자', 30000, '2023-01-04', 0),
        ('chair4', '파란색 의자', 30000, '2023-01-04', 1),
        ('chair5', '핑크색 의자', 60000, '2023-01-04', 2),
        ('chair6', '식탁 의자', 20000, '2023-01-04', 4),
        ('chair7', '게임용 의자', 200000, '2023-01-04', 2),
        ('chair8', '카페 의자', 20000, '2023-01-04', 7),
        ('chair9', '동그란 의자', 10000, '2023-01-04', 10),
        ('chair10', '아기 의자', 150000, '2023-01-04', 2)

    ";


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'product_TBL에 데이터가 성공적으로 입력';
	} else {
		echo 'product_TBL에 데이터 입력 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>