<?php



class ShopingCart
{
    public function getProducts()
    {
	
		require "connect.php";
		
		$mysqli = new mysqli($host,$db_user,$db_password,$db_name);
		
		if($mysqli->connect_errno!=0)
		{
			echo "Error: ".$mysqli->connect_errno;
		}
		
		if ($result = $mysqli->query("SELECT * FROM store"))
		{
			
			$data = [];
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
					
				}
			}
			return $data;
		}
		else {
		


			
		}
		$mysqli->close();
		
    }
	public function getCategory()
    {
		require "connect.php";
		
		$mysqli = new mysqli($host,$db_user,$db_password,$db_name);
		if($mysqli->connect_errno!=0)
		{
			echo "Error: ".$mysqli->connect_errno;
		}
		if ($result = $mysqli->query("SELECT kategoria FROM store GROUP BY kategoria"))
		{
			
			$data = [];
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
					
				}
			}
			return $data;
		}
		$mysqli->close();
	}
}


?>