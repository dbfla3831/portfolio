<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

	$sql = 'SELECT *
		FROM warehouse_TBL';

	$ret = mysqli_query($con, $sql);

	if ($ret) {
		$count = mysqli_num_rows($ret);
	}
	else {
		echo 'warehouse_TBL 데이터 조회 실패!!'.'<br>';
		echo '실패 원인 : ', mysqli_error($con);
		exit();
	}

	// 화면에 보여줄 내용
	echo '<h1> 원자재 공급 업체 정보 </h1>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
	echo '<TH>원자재 공급 업체 아이디</TH>
		  <TH>원자재 공급 업체 주소</TH>
		  <TH>원자재 공급 업체 명</TH>';
	echo '</TR>';

	while ($row = mysqli_fetch_array($ret)) {
		echo '<TR>';
		echo '<TD><a href="?warehouse_id=' . $row['warehouse_ID'] . '">' . $row['warehouse_ID'] . '</a><br><br></TD>'; //내용(table data)
		echo '<TD>', $row['warehouse_addr'], '</TD>';
		echo '<TD>', $row['warehouse_name'], '</TD>';
		echo '</TR>';
    }
	echo '</TABLE>';

	// stock_info_TBL 테이블 정보 조회 (선택한 상품에 대한 정보)
	if(isset($_GET['warehouse_id'])){
		$selected_warehouse_id = mysqli_real_escape_string($con, $_GET['warehouse_id']);
		
		$sql_info_selected = 'SELECT *
								FROM stock_info_TBL
								WHERE warehouse_ID = "' . $selected_warehouse_id . '"';

		$ret_info_selected = mysqli_query($con, $sql_info_selected);

		if ($ret_info_selected) {
			$count_info_selected = mysqli_num_rows($ret_info_selected);
		}
		else {
			echo '선택한 상품 정보 조회 실패!!'.'<br>';
			echo '실패 원인 : ', mysqli_error($con);
			exit();
		}

		// 선택한 상품의 stock_info_TBL 정보 출력
		
		echo '<h1>', $selected_warehouse_id, ' 정보 </h1>';
		echo '<TABLE border = 1>';
		echo '<TR bgcolor = "#D9E5FF">';
		echo '<TH>창고 아이디</TH>
			<TH>원자재 아이디</TH>
			<TH>원자재 명</TH>
			<TH>원자재 가격</TH>';
		echo '</TR>';

		while ($row_info_selected = mysqli_fetch_array($ret_info_selected)) {
			echo '<TR>';
			echo '<TD>', $row_info_selected['warehouse_ID'], '</TD>';
			echo '<TD>', $row_info_selected['stock_ID'], '</TD>';
			echo '<TD>', $row_info_selected['stock_name'], '</TD>';
			echo '<TD>', $row_info_selected['stock_price'], '</TD>';
			echo '</TR>';
		}

		echo '</TABLE>';
	}
	mysqli_close($con);
?>
