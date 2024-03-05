<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');
	
	$sql = "
		INSERT INTO product_info_TBL VALUES
		('chair1', '바퀴달린 의자', 'stock1', '바퀴', 4),
		('chair1', '바퀴달린 의자', 'stock9', '플라스틱', 5),
		('chair1', '바퀴달린 의자', 'stock10', '스프링', 2),
		('chair1', '바퀴달린 의자', 'stock5', '몫', 10),

        ('chair2', '높이조절 의자', 'stock1', '바퀴', 4),
        ('chair2', '높이조절 의자', 'stock9', '플라스틱', 5),
        ('chair2', '높이조절 의자', 'stock10', '스프링', 2),
        ('chair2', '높이조절 의자', 'stock5', '몫', 10),
        ('chair2', '높이조절 의자', 'stock7', '네모난 쿠션', 1),


        ('chair3', '빨간색 의자', 'stock2', '나무', 1),
        ('chair3', '빨간색 의자', 'stock8', '사포', 5),
        ('chair3', '빨간색 의자', 'stock6', '바퀴', 1),
        ('chair3', '빨간색 의자', 'stock5', '몫', 5),

        ('chair4', '파란색 의자', 'stock2', '나무', 1),
        ('chair4', '파란색 의자', 'stock8', '사포', 5),
        ('chair4', '파란색 의자', 'stock4', '파란 페인트', 1),
        ('chair4', '파란색 의자', 'stock5', '몫', 5),

        ('chair5', '핑크색 의자', 'stock2', '나무', 1),
        ('chair5', '핑크색 의자', 'stock8', '사포', 5),
        ('chair5', '핑크색 의자', 'stock3', '핑크 페인트', 2),
        ('chair5', '핑크색 의자', 'stock5', '몫', 5),

        ('chair6', '식탁 의자', 'stock2', '나무', 1),
        ('chair6', '식탁 의자', 'stock8', '사포', 5),
        ('chair6', '식탁 의자', 'stock7', '네모난 쿠션', 12),
        ('chair6', '식탁 의자', 'stock5', '몫', 4),

        ('chair7', '게임용 의자', 'stock1', '바퀴', 4),
        ('chair7', '게임용 의자', 'stock9', '플라스틱', 6),
        ('chair7', '게임용 의자', 'stock10', '스프링', 4),
        ('chair7', '게임용 의자', 'stock7', '네모난 쿠션', 1),

        ('chair8', '카페 의자', 'stock2', '나무', 1),
        ('chair8', '카페 의자', 'stock8', '사포', 2),
        ('chair8', '카페 의자', 'stock7', '네모난 쿠션', 2),
        ('chair8', '카페 의자', 'stock5', '몫', 4),

        ('chair9', '동그란 의자', 'stock2', '나무', 1),
        ('chair9', '동그란 의자', 'stock5', '몫', 4),
        ('chair9', '동그란 의자', 'stock12', '동그란 쿠션', 1),

        ('chair10', '아기 의자', 'stock9', '플라스틱', 4),
        ('chair10', '아기 의자', 'stock7', '네모난 쿠션', 5)
    ";


	$ret = mysqli_query($con, $sql); // 데이터베이스 생성

	if ($ret) {
		echo 'product_info_TBL 데이터가 성공적으로 입력';
	} else {
		echo 'product_info_TBL 데이터 입력 실패', '<br>';
		echo '실패 원인 : ', mysqli_error($con);
	}
	
	mysqli_close($con);
?>