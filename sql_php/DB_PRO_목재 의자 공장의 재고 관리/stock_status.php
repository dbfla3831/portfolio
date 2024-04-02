<?php
$con = mysqli_connect('localhost', 'root', '1234', 'projectDB') or die('MariaDB 접속 실패!');


$sql = 'SELECT *
FROM stock_TBL
ORDER BY stock_ID';

$ret = mysqli_query($con, $sql);

echo '<h1> 원자재 기록 </h1>';
echo '<TABLE border = 1>';
echo '<TR bgcolor = "#D9E5FF">'; //하나의 행을 정의(table row)
echo '<TH>원자재 아이디</TH>
    <TH>원자재명</TH>
    <TH>공급 업체 아이디</TH>
    <TH>원자재 수량</TH>
    ';
echo '</TR>';

while ($row = mysqli_fetch_array($ret)) {
    echo '<TR>';
    echo '<TD>', $row['stock_ID'], '</TD>';
    echo '<TD>', $row['stock_name'], '</TD>';
    echo '<TD>', $row['warehouse_ID'], '</TD>';
    echo '<TD>', $row['stock_quantity'], '</TD>';
    echo '</TR>';
}

mysqli_close($con);
?>
