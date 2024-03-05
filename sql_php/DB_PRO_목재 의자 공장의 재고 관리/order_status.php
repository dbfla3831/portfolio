<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

	$sql = 'SELECT *
		FROM order_TBL';

	$ret = mysqli_query($con, $sql);

	if ($ret) {
		$count = mysqli_num_rows($ret);
	}
	else {
		echo 'order_TBL 데이터 조회 실패!!'.'<br>';
		echo '실패 원인 : ', mysqli_error($con);
		exit();
	}

	// 화면에 보여줄 내용
	echo '<h1> 주문 기록 </h1>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
	echo '<TH>주문 번호</TH>
		  <TH>상품 아이디</TH>
		  <TH>상품명</TH>
          <TH>주문 날짜</TH>
          <TH>주문 수량</TH>
          <TH>배송 상태</TH>';
	echo '</TR>';

	while ($row = mysqli_fetch_array($ret)) {
		echo '<TR>';
		echo '<TD>', $row['order_ID'], '</TD>';
		echo '<TD>', $row['product_ID'], '</TD>';
		echo '<TD>', $row['product_name'], '</TD>';
		echo '<TD>', $row['order_date'], '</TD>';
		echo '<TD>', $row['order_quantity'], '</TD>';
		echo '<TD>', $row['order_state'], '</TD>';

    }

	mysqli_close($con);
	echo '</TABLE>';
?>