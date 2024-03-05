<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Selection Form</title>
</head>
<body>
    <h1>Date Selection Form</h1>

    <form action="" method="post">
        <label for="selectedDate">Select a Date:</label>
        <input type="date" id="selectedDate" name="selectedDate" required>
        <button type="submit" name="submit_date">Submit</button>
    </form>
</body>
</html>


<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

	$sql = 'SELECT *
    	FROM stock_incoming_TBL';

	$ret = mysqli_query($con, $sql);

	

	// 화면에 보여줄 내용
	echo '<h1> 원자재 입고 기록 </h1>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
	echo '<TH>기록 아이디</TH>
		  <TH>원자재 아이디</TH>
		  <TH>원자재 입고 날짜</TH>
		  <TH>원자재 입고 수량</TH>';
	echo '</TR>';

	while ($row = mysqli_fetch_array($ret)) {
		echo '<TR>';
		echo '<TD>', $row['record_ID'], '</TD>';
		echo '<TD>', $row['stock_ID'], '</TD>';
		echo '<TD>', $row['incoming_date'], '</TD>';
		echo '<TD>', $row['incoming_quantity'], '</TD>';
		echo '</TR>';
    }
	echo '</TABLE>';

		

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// 사용자로부터 날짜를 받아옴
		$userSelectedDate = $_POST["selectedDate"];

		// 현재 날짜로부터 지난 7일 동안의 입고 기록을 조회
		$weekAgo = (new DateTime($userSelectedDate))->sub(new DateInterval('P7D'))->format('Y-m-d');

		// 데이터베이스 연결
		$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

		// 원자재 아이디별로 지난 7일 동안의 총 입고 수량 조회
		$sqlRecentIncoming = "SELECT stock_ID, SUM(incoming_quantity) as total_incoming
							FROM stock_incoming_TBL
							WHERE DATE_FORMAT(incoming_date, '%Y-%m-%d') >= '$weekAgo' AND DATE_FORMAT(incoming_date, '%Y-%m-%d') <= '$userSelectedDate'
							GROUP BY stock_ID";

		$retRecentIncoming = mysqli_query($con, $sqlRecentIncoming);

		if (!$retRecentIncoming) {
			echo '입고된 원자재 데이터 조회 실패!!'.'<br>';
			echo '실패 원인 : ', mysqli_error($con);
			exit();
		}

		// 화면에 보여줄 내용
		echo '<h1> 입고된 원자재 목록 (', $weekAgo, ' ~ ', $userSelectedDate, ')</h1>';
		echo '<TABLE border = 1>';
		echo '<TR bgcolor = "#D9E5FF">';
		echo '<TH>원자재 아이디</TH>
				<TH>총 입고 수량</TH>';
		echo '</TR>';

		while ($rowRecentIncoming = mysqli_fetch_array($retRecentIncoming)) {
			echo '<TR>';
			echo '<TD>', $rowRecentIncoming['stock_ID'], '</TD>';
			echo '<TD>', $rowRecentIncoming['total_incoming'], '</TD>';
			echo '</TR>';
		}

		echo '</TABLE>';
	}

	mysqli_close($con);
	


	
?>