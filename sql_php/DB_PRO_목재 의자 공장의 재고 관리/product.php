<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');

	// product_TBL 테이블 정보 조회
	$sql_product = 'SELECT *
		FROM product_TBL
		ORDER BY product_ID';

	$ret_product = mysqli_query($con, $sql_product);

	if ($ret_product) {
		$count_product = mysqli_num_rows($ret_product);
	}
	else {
		echo 'product_TBL 데이터 조회 실패!!'.'<br>';
		echo '실패 원인 : ', mysqli_error($con);
		exit();
	}

	// product_TBL 정보 출력
	echo '<h1> 상품 </h1>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">';
	echo '<TH>상품 아이디</TH>
		  <TH>상품명</TH>
		  <TH>상품 개별 가격</TH>
		  <TH>현재 시간</TH>
		  <TH>상품 현재 수량</TH>';
	echo '</TR>';

	while ($row_product = mysqli_fetch_array($ret_product)) {
		echo '<TR>';
		echo '<TD><a href="?product_id=' . $row_product['product_ID'] . '">' . $row_product['product_ID'] . '</a><br><br></TD>';
		echo '<TD>', $row_product['product_name'], '</TD>';
		echo '<TD>', $row_product['product_price'], '</TD>';
		echo '<TD>', $row_product['product_date'], '</TD>';
		echo '<TD>', $row_product['product_quantity'], '</TD>';
		echo '</TR>';
	}
	echo '</TABLE>';

	// product_info_TBL 테이블 정보 조회 (선택한 상품에 대한 정보)
	if(isset($_GET['product_id'])){
		$selected_product_id = mysqli_real_escape_string($con, $_GET['product_id']);
		
		$sql_info_selected = 'SELECT *
			FROM product_info_TBL
			WHERE product_ID = "' . $selected_product_id . '"';

		$ret_info_selected = mysqli_query($con, $sql_info_selected);

		if ($ret_info_selected) {
			$count_info_selected = mysqli_num_rows($ret_info_selected);
		}
		else {
			echo '선택한 상품 정보 조회 실패!!'.'<br>';
			echo '실패 원인 : ', mysqli_error($con);
			exit();
		}

		// 선택한 상품의 product_info_TBL 정보 출력
		echo '<div style="float: right; margin-right: 400px;">';
		
		echo '<h1>', $selected_product_id, ' 정보 </h1>';
		echo '<TABLE border = 1>';
		echo '<TR bgcolor = "#D9E5FF">';
		echo '<TH>상품 아이디</TH>
			  <TH>상품명 명</TH>
			  <TH>원자재 아이디</TH>
			  <TH>원자재 명</TH>
			  <TH>필요한 원자재 수량</TH>';
		echo '</TR>';

		while ($row_info_selected = mysqli_fetch_array($ret_info_selected)) {
			echo '<TR>';
			echo '<TD>', $row_info_selected['product_ID'], '</TD>';
			echo '<TD>', $row_info_selected['product_name'], '</TD>';
			echo '<TD>', $row_info_selected['stock_ID'], '</TD>';
			echo '<TD>', $row_info_selected['stock_name'], '</TD>';
			echo '<TD>', $row_info_selected['stock_quantity'], '</TD>';
			echo '</TR>';
		}

		echo '</TABLE>';
	}

	mysqli_close($con);
?>
