<?php
	$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');
	
	$pro_sql = 'SELECT *
			FROM product_TBL
			ORDER BY product_ID';

	$pro_ret = mysqli_query($con, $pro_sql);
	echo '<h1>  상품 주문 하기 </h1>';

	echo '<h3> 상품 </h3>';
	echo '<TABLE border = 1>';
	echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
	echo '<TH>상품 아이디</TH>
		  <TH>상품명</TH>';
	echo '</TR>';

	while ($row = mysqli_fetch_array($pro_ret)) {
		echo '<TR>';
		
		echo '<TD>', $row['product_ID'], '</TD>'; //내용(table data)
		echo '<TD>', $row['product_name'], '</TD>';
    }


	$sql = 'SELECT product_ID, product_name, product_price FROM product_TBL';

	$ret = mysqli_query($con, $sql);

	if (!$ret) {
		echo 'product_TBL 데이터 조회 실패!!'.'<br>';
		echo '실패 원인 : ', mysqli_error($con);
		exit();
	}

	// 화면에 보여줄 내용
	echo '<div style="float: right; margin-right: 400px;">';
    
	echo '<form action="order_result.php" method="post" id="orderForm">';
	echo '<label for="productSelect">제품 선택  :  </label>';
	echo '<select id="productSelect" name="product_ID" onchange="updateProductDetails()">';
	echo '<option value="none">=== 상품 선택 ===</option>';

	while ($row = mysqli_fetch_array($ret)) {
		echo '<option value="' . $row["product_ID"] . '" data-price="' . $row["product_price"] . '">' . $row["product_ID"] . ' - ' . $row["product_name"] . '</option>'; // 수정된 부분
	}

	echo '</select><br><br>';
	echo '<label for="productName">제품명 : </label>';
	echo '<input type="text" id="productName" name="product_name" required readonly><br><br>'; // 수정된 부분
	echo '<label for="productPrice">가격 : </label>';
	echo '<input type="text" id="productPrice" name="product_price" required readonly><br><br>'; // 수정된 부분
	echo '<label for="quantityInput"> 수량  :  </label>';
	echo '<input type="number" id="quantityInput" name="order_quantity" required style="width: 80px;"><br><br><br>'; // style 속성으로 크기 조절
	echo '<button type="submit">주문하기</button>';
	echo '</form>';

	echo '<script>
		function updateProductDetails() {
			var selectedProductId = document.getElementById("productSelect").value;
			var productNameInput = document.getElementById("productName");
			var productPriceInput = document.getElementById("productPrice");

			// Find the corresponding product name and price based on the selected product ID
			var options = document.getElementById("productSelect").options;
			for (var i = 0; i < options.length; i++) {
				if (options[i].value === selectedProductId) {
					productNameInput.value = options[i].text.split(" - ")[1];
					productPriceInput.value = options[i].getAttribute("data-price");
					break;
				}
			}
		}
	</script>';
	echo '</div>';

	mysqli_close($con);
?>
