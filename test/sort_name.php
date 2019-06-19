<?php  
include 'sort_name_class.php';

	if (isset($_FILES)) {

		/* cors untuk semua domain */
		header('Access-Control-Allow-Origin: *');

		/* instance Class sortString */
		$sortString = new sortString();

		$checkFile 	= $sortString->checkFile($_FILES['file']);
		$result 	= $sortString->explodeString($checkFile);

		echo $result;
	}

?>