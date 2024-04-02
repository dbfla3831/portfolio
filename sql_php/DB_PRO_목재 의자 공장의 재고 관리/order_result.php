<?php
// db 접속
$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!!');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 주문한 제품 정보 확인
    $product_ID = isset($_POST['product_ID']) ? $_POST['product_ID'] : '';
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $order_date = date('Y-m-d h:i:s');

    $orderDateTime = new DateTime();

    // 1시간을 더하기
    $orderDateTime->modify('+1 hour');
    
    // 수정된 날짜와 시간을 $order_date 변수에 저장
    $out_date = $orderDateTime->format('Y-m-d H:i:s');

    $orderDateTime1 = new DateTime();

    // 1시간을 더하기
    $orderDateTime1->modify('+2 hour');

    // 수정된 날짜와 시간을 $order_date 변수에 저장
    $out_date1 = $orderDateTime1->format('Y-m-d H:i:s');

    $order_quantity = isset($_POST['order_quantity']) ? intval($_POST['order_quantity']) : 0;
    $order_state = '배송 전';

    // 주문 정보를 order_TBL에 저장
    $sql_insert_order = "INSERT INTO order_TBL (product_ID, product_name, order_date, order_quantity, order_state) VALUES('".$product_ID."','".$product_name."', '".$order_date."', ".$order_quantity.", '".$order_state."')";
    $ret_insert_order = mysqli_query($con, $sql_insert_order);

    // 만약 product_TBL에 수량이 있으면 물건을 상태를 배송 상태로 변경 후 product_TBL 수량 변경 후 product_outgoing_TBL에 기록하기
    $sql_get_product_quantity = "SELECT product_quantity,  product_date FROM product_TBL WHERE product_ID = '".$product_ID."'";
    $result_product_quantity = mysqli_query($con, $sql_get_product_quantity);

    if ($result_product_quantity) {
        $row_product_quantity = mysqli_fetch_assoc($result_product_quantity);
        $product_quantity = $row_product_quantity['product_quantity'];

        if ($product_quantity >= $order_quantity) {
            // 배송 상태 변경
            $sql_update_order_state = "UPDATE order_TBL SET order_state = '배송중' WHERE product_ID = '".$product_ID."'";
            $ret_update_order_state = mysqli_query($con, $sql_update_order_state);

            // 상품 수량 변경
            $sql_update_product_quantity = "UPDATE product_TBL SET product_quantity = product_quantity - $order_quantity,
                                                                    product_date = '".$order_date."'
                                             WHERE product_ID = '".$product_ID."'";
            $ret_update_product_quantity = mysqli_query($con, $sql_update_product_quantity);

            // 상품 출고 현황에 추가
            $sql_insert_product_out_quantity = "INSERT INTO product_outgoing_TBL (product_ID, product_name, outgoing_date, outgoing_quantity) VALUES('".$product_ID."', '".$product_name."', '".$order_date."', '".$order_quantity."')";
            $ret_insert_product_out_quantity = mysqli_query($con, $sql_insert_product_out_quantity);

            // 주문 상세 정보 출력
            echo_order_info($order_date, $product_name, $order_quantity, $order_state);
        }
        // product_TBL에 수량이 적을 경우 필요한 원자재를 주문 후, stock_incoming_TBL에 추가 후, stock_TBL의 총 수량을 변경한다
        else {
            // 필요한 원자재 주문
            // 필요한 원자재 정보 조회
            $sql_get_materials = "SELECT stock_ID, stock_quantity FROM product_info_TBL WHERE product_ID = '".$product_ID."'";
            $result_materials = mysqli_query($con, $sql_get_materials);


            if ($ret_insert_order && $result_materials) {
                echo '<h1>주문 상세 정보</h1>';
                echo_order_info($order_date, $product_name, $order_quantity, $order_state);
                echo '<p>필요한 원자재 수량:</p>';

                // 배열을 사용하여 각 원자재별 필요한 수량을 저장
                $stock_quantity_needed_array = array();

                while ($row_material = mysqli_fetch_assoc($result_materials)) {
                    $stock_ID = $row_material['stock_ID'];
                    $stock_quantity_needed = $row_material['stock_quantity'] * $order_quantity;
                    $stock_quantity_needed_array[$stock_ID] = $stock_quantity_needed; // 배열에 저장
                    echo '<p>'.$stock_ID.': '.$stock_quantity_needed.' 개</p>';
                }

                echo '<form action="" method="post">';
                echo '<h1>부족한 원자재 주문하기</h1>';

                // 각 원자재에 대해 폼 생성
                $stock_quantity_want = false;
                foreach ($stock_quantity_needed_array as $stock_ID => $stock_quantity_needed) {
                    echo '<input type="hidden" name="stock_quantity_want['.$stock_ID.']" value="'.$stock_quantity_want.'">';
                    $sql_want_materials = "SELECT stock_quantity FROM stock_TBL WHERE stock_ID = '".$stock_ID."'";
                    $result_want_materials = mysqli_query($con, $sql_want_materials);

                    if ($result_want_materials) {
                        $row_want_material = mysqli_fetch_assoc($result_want_materials);
                        $stock_quantity_want = $stock_quantity_needed;
                        echo '<p>'.$stock_ID.': '.$stock_quantity_want.' 개</p>';
                    
                
                        // 부족한 경우 주문 폼 생성(stock_quantity_want는 음수)
                        if ($stock_quantity_want > 0) {
                            echo '<input type="hidden" name="stock_ID[]" value="'.$stock_ID.'">';
                            echo '<label for="order_quantity_'.$stock_ID.'">주문 수량('.$stock_ID.'): </label>';
                            echo '<input type="number" id="order_quantity_'.$stock_ID.'" name="order_quantity['.$stock_ID.']" required>';
                        }
                        echo '<input type="hidden" name="stock_quantity_want['.$stock_ID.']" value="'.$stock_quantity_want.'">';
                    }
                    
                }
                // 부족한 원자재가 하나라도 있을 경우 주문하기 버튼 표시
                if (count($stock_quantity_needed_array) > 0) {
            
                    echo '<button type="submit" name="submit_order">주문하기</button>';
                    echo '</form>'; // 주문 폼 종료
                    
                }
            }
            if (isset($_POST['submit_order'])) {
                if (isset($_POST['order_quantity']) && is_array($_POST['order_quantity'])) {
                    $stock_ID_array = array_keys($_POST['order_quantity']);
                    $incoming_date = new DateTime();
            
                    // 1시간을 더하기
                    $incoming_date->modify('+1 hour');
            
                    // 수정된 날짜와 시간을 $order_date 변수에 저장
                    $out_date = $incoming_date->format('Y-m-d H:i:s');
            
                    $orderDateTime1 = new DateTime();
            
                    // 1시간을 더하기
                    $orderDateTime1->modify('+2 hour');
            
                    // 수정된 날짜와 시간을 $order_date 변수에 저장
                    $out_date1 = $orderDateTime1->format('Y-m-d H:i:s');
            
                    foreach ($stock_ID_array as $key => $stock_ID) {
                        echo_material_order_info($order_date, $stock_ID);
                        $incoming_quantity = abs($_POST['order_quantity'][$stock_ID]);
            
                        // stock_incoming_TBL에 추가
                        $sql = "INSERT INTO stock_incoming_TBL (stock_ID, incoming_date, incoming_quantity) VALUES('".$stock_ID."','".$out_date."', ".$incoming_quantity.")";
                        $ret = mysqli_query($con, $sql);
            
                        // 원자재 수량(현황) 갱신 쿼리
                        if (isset($_POST['stock_quantity_want']) && is_array($_POST['stock_quantity_want'])) {
                            $stock_quantity_want = abs($_POST['stock_quantity_want'][$stock_ID]);
                            // 원자재 수량 변경(+원자재 입고)
                            $update_incoming_sql = "UPDATE stock_TBL SET stock_quantity = abs(stock_quantity + $incoming_quantity)
                                                    WHERE stock_ID = '$stock_ID'";
                            $ret_update_incoming = mysqli_query($con, $update_incoming_sql);
                            
                            // stock_outgoinh_TBL에 추가
                            $sotck_out_insert = "INSERT INTO stock_outgoing_TBL (stock_ID, outgoing_date, outgoing_quantity) 
                                    VALUES('".$stock_ID."','".$out_date."', ".$stock_quantity_want.")";
                            $ret_sotck_out_insert = mysqli_query($con, $sotck_out_insert);
                            
                            // 원자재 수량 변경(-원자재 출고)
                            $update_outgoing_sql = "UPDATE stock_TBL SET stock_quantity = stock_quantity - $stock_quantity_want
                                                    WHERE stock_ID = '$stock_ID'";
                            $ret_update_outgoing = mysqli_query($con, $update_outgoing_sql);
                        }
                    }
                }
            }
                             
            // product_incoming_TBL 상품 입고 추가
            $sql_insert_product_in_quantity = "INSERT INTO product_incoming_TBL (product_ID, product_name, incoming_date, incoming_quantity) 
                VALUES('".$product_ID."', '".$product_name."', '".$out_date1."', ".$order_quantity.")";   
            $ret_insert_product_out_quantity = mysqli_query($con, $sql_insert_product_in_quantity);
    
            // 배송 상태 변경
            $sql_update_order_state = "UPDATE order_TBL SET order_state = '배송 시작',
                                    order_date = '".$out_date1."'
                        WHERE product_ID = '".$product_ID."'";
    
            $ret_update_order_state = mysqli_query($con, $sql_update_order_state);
    
            // 상품 수량 변경
            $sql_update_product_quantity = "UPDATE product_TBL SET product_quantity = product_quantity + $order_quantity, 
                                                    product_date = '".$out_date1."'
                                            WHERE product_ID = '".$product_ID."'";
            $ret_update_product_quantity = mysqli_query($con, $sql_update_product_quantity);
    
            // product_outgoing_TBL에 추가하기
            $sql_insert_product_out_quantity = "INSERT INTO product_outgoing_TBL (product_ID, product_name, outgoing_date, outgoing_quantity) 
                VALUES('".$product_ID."', '".$product_name."', '".$out_date1."', ".$order_quantity.")";  
            $ret_insert_product_out_quantity = mysqli_query($con, $sql_insert_product_out_quantity);
    
            // 상품 수량 변경
            $sql_update_product_quantity = "UPDATE product_TBL SET product_quantity = product_quantity - $order_quantity, product_date = '".$out_date1."'
                            WHERE product_ID = '".$product_ID."'";
            $ret_update_product_quantity = mysqli_query($con, $sql_update_product_quantity);
            
        }
               
    }
}
 


// DB 연결 해제
mysqli_close($con);


// 주문 정보 출력 함수
function echo_order_info($order_date, $product_name, $order_quantity) {
    echo '<h3> 주문 정보 </h3>';
    echo '<p>주문 날짜: '.$order_date.'</p>';
    echo '<p>주문 제품: '.$product_name.'</p>';
    echo '<p>주문 수량: '.$order_quantity.'</p>';
}

// 원자재 주문 출력 함수
function echo_material_order_info($order_date, $stock_ID) {
    echo '<h3> 원자재 주문 정보 </h3>';
    echo '<p>주문 날짜: '.$order_date.'</p>';
    echo '<p>주문 원자재: '.$stock_ID.'</p>';
}
?>
