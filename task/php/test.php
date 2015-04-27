<?php
ini_set('display_errors', 1);

echo "in test file <br> ";


require_once('daolayer.php');
	$dao = new DaoLayer(0,'','automotive',0) ;
	$query = $dao->generateSqlQuery();



  // require_once('daolayer.php');
	//$dao = new DaoLayer($coupontype,$store,$category,0) ;
	//$query = $dao->generateSqlQuery();
    $resultset = $dao->executeQuery($query);
    $rows=array();
    while($row = $resultset->fetch_array()){
		$rows[] = $row;
	}

	//foreach($rows as $row){
	//	echo $row['couponCode'].'    '.$row['description']."<br>"    ;
	//
//}

	echo json_encode($rows);
  
  //echo 'generated sql query is   '."$query" ;


/*require_once('dbconn.php');

 //$db = DatabaseConnection::getinstance();
 $connection = DatabaseConnection::getinstance()->getconnection();

 $sql = "select * from coupon limit 30" ;
 if ($rs = $connection->query($sql)) {
    echo "Database query successfull";
} else {
    echo "database query unsuccessful " . $connection->error;
}

echo $rs->num_rows;
*/

?>