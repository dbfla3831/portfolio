<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

	$sql = 'SELECT *
		FROM stock_outgoing_TBL';

	$ret = mysqli_query($con, $sql);

	if ($ret) {
		$count = mysqli_num_rows($ret);
	}
	else {
		echo 'stock_outgoing_TBL 데이터 조회 실패!!'.'<br>';
		echo '실패 원인 : ', mysqli_error($con);
		exit();
	}

	// 화면에 보여줄 내용
	echo '<h1> 원자재 출고 기록 </h1>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
	echo '<TH>출고 번호</TH>
		  <TH>원자재 아이디</TH>
          <TH>출고 날짜</TH>
          <TH>출고 수량</TH>';
	echo '</TR>';

	while ($row = mysqli_fetch_array($ret)) {
		echo '<TR>';
		echo '<TD>', $row['record_ID'], '</TD>';
		echo '<TD>', $row['stock_ID'], '</TD>';
		echo '<TD>', $row['outgoing_date'], '</TD>';
		echo '<TD>', $row['outgoing_quantity'], '</TD>';

    }

	mysqli_close($con);
	echo '</TABLE>';
?>