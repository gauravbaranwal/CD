<?php


if($_GET['action'] == 'filter') {

	$coupontype = $_GET['coupontype'] ;
	$store = $_GET['store'] ;
	$category = $_GET['category'] ;
	$offset = $_GET['offset'];

	require_once('daolayer.php');
	$dao = new DaoLayer($coupontype,$store,$category,0) ;
	$sqlquery = $dao->generateSqlQuery($offset);
    $resultset = $dao->executeQuery($sqlquery);
	$rows=array();
    while($row = $resultset->fetch_array(MYSQLI_ASSOC)){
	$rows[] = $row;
	}
	$countquery = $dao->generateCountQuery();
	$countresult = $dao->executeQuery($countquery );


	header('Content-type:application/json');
//print_r( $countresult->fetch_array(MYSQLI_ASSOC));
	echo json_encode(array('result' => $rows, 'count' => $countresult->fetch_array(MYSQLI_ASSOC)['count'])) ;

} 

?>