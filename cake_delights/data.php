<?php

//data.php

$connect = new PDO("mysql:host=localhost;dbname=a_plus", "root", "");

if(isset($_POST["action"]))
{

	if($_POST["action"] == 'fetch')
	{
		$query = "SELECT tbl_ratings.server_id, tbl_users.surname, tbl_roles.role_id, tbl_users.user_id, SUM(tbl_ratings.rating) AS Total
FROM tbl_ratings
JOIN tbl_roles
ON tbl_ratings.server_id=tbl_roles.role_id
JOIN tbl_users
ON tbl_users.user_id=tbl_roles.role_id
GROUP BY tbl_users.surname";
		// $query = "
		// SELECT server_id, SUM(rating) AS Total 
		// FROM tbl_ratings 
		// GROUP BY server_id
		// ";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["surname"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}
}

	if($_POST["action"] == 'fetch1')
	{   

		$query = "
		SELECT food_name, SUM(quantity) AS Total 
		FROM tbl_orderdetails
		GROUP BY food_name
		";

		$result = $connect->query($query);

		$data = array();

		foreach($result as $row)
		{
			$data[] = array(
				'language'		=>	$row["food_name"],
				'total'			=>	$row["Total"],
				'color'			=>	'#' . rand(100000, 999999) . ''
			);
		}

		echo json_encode($data);
	}

?>