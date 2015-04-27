<?php

class DaoLayer{


	private $isDeal =null ;
	private  $store =null ;
	private  $category =null;
	private  $debug =0;

	public function __construct($isDeal, $website, $category,$debug){
		$this->isDeal= $isDeal;
		$this->store = $website;
		$this->category = $category;
		$this->debug = $debug;
	}

	public function generateSqlQuery($offset =0){
		//$sqlquery = 'select couponCode, description from coupon where 1 = 1 ' ;
		$sqlquery = 'select coupon.couponcode, website.websitename, coupon.description from coupon inner join website on coupon.websiteId = website.websiteId where 1 = 1 ' ;
		$sqlcountquery =' select count(*) from coupon inner join website on coupon.websiteId = website.websiteId where 1 = 1 ';
		

		if($this->isDeal != "-1"){
			//echo "in deal <br>";
			 $sqlquery.=' and isdeal = '."$this->isDeal" ;
			 $sqlquery.=' and isdeal = '."$this->isDeal" ;
		}
		if(!empty($this->store)){
			//echo "in store  <br>";
			$sqlquery.= ' and website.websiteId in (select websiteid from website where websitename like \'%'. "$this->store".'%\')' ;
			$sqlquery.= ' and website.websiteId in (select websiteid from website where websitename like \'%'. "$this->store".'%\')' ;
		}
		if($this->category!="-1"){
			//echo "in category <br>" ;
 			$sqlquery.= ' and couponID in (select couponID from CouponCategoryInfo where categoryID in (select categoryID from couponcategories where name like  \'%'. "$this->category".'%\'))' ;
		}

		 $sqlquery.=' and couponcode IS NOT NULL LIMIT 30 OFFSET '.$offset.' ;' ;
		 if($this->debug)
		 	echo 'sql query formed is : '. $sqlquery ;

		return $sqlquery ;

		}

		public function generateCountQuery(){

		$sqlcountquery =' select count(*) as count from coupon inner join website on coupon.websiteId = website.websiteId where 1 = 1 ';
		

		if($this->isDeal != "-1"){
			//echo "in deal <br>";
			 $sqlcountquery.=' and isdeal = '."$this->isDeal" ;
		}
		if(!empty($this->store)){
			//echo "in store  <br>";
			$sqlcountquery.= ' and website.websiteId in (select websiteid from website where websitename like \'%'. "$this->store".'%\')' ;
		}
		if($this->category!="-1"){
			//echo "in category <br>" ;
 			$sqlcountquery.= ' and couponID in (select couponID from CouponCategoryInfo where categoryID in (select categoryID from couponcategories where name like  \'%'. "$this->category".'%\'))' ;
		}

		 $sqlcountquery.=' and couponcode IS NOT NULL ;';
		 //LIMIT 20;';
		 if($this->debug)
		 	echo 'sql count query formed is : '. $sqlcountquery ;

		return $sqlcountquery ;

		}

		public function executeQuery($query){

				require_once('dbconn.php');
 				$connection = DatabaseConnection::getinstance()->getconnection();

 				if ($resultset = $connection->query($query)) {
 					if($this->debug)
   				 	echo "Database query successfull";
   				 }
				else{
					if($this->debug)
    				echo "database query unsuccessful " . $connection->error;
			     }

			//echo $resultset->num_rows;
			return $resultset ;
		}

		

	}





?>