<?php

// php code to search data in mysql database and set it in input text

if(isset($_POST['search']))
{
    // id to search
    $id = $_POST['id'];
    
    // connect to mysql
    $connect = mysqli_connect("localhost", "request", "request","youtube");
    
    // mysql search query
 $query="SELECT `username`, `address`, `DOB`, `password`, `gender`, `email`, `phone`, `id` FROM `register` WHERE `id`= $id LIMIT 1";
    
 $result = $connect->query($query);
    
    // if id exist 
    // show data in inputs
    if(mysqli_num_rows($result) > 0)
    {
      while ($row = mysqli_fetch_array($result))
      {
        $username = $row['username'];
        $address = $row['address'];
        $DOB = $row['DOB'];
		$password = $row['password'];
		$gender = $row['gender'];
		$email = $row['email'];
		$phone = $row['phone'];
      } 


     $INSERT = "INSERT Into login (username, address, DOB, password, gender, email, phone) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $connect->prepare($query);

     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $connect->prepare($INSERT);
      $stmt->bind_param("ssssssi", $username, $address, $DOB, $password, $gender, $email, $phone);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "unsucccessful attempt";
     }
   

  
    }
    // if the id not exist
    // show a message and clear inputs
    else {
        echo "Undifined ID";
             $username = "";
        $address = "";
        $DOB = "";
		$password = "";
		$gender ="";
		$email = "";
		$phone = "";
    }

   
}

// in the first time inputs are empty
else{
            $username = "";
        $address = "";
        $DOB = "";
		$password = "";
		$gender ="";
		$email = "";
		$phone = "";
}



?>

<!DOCTYPE html>

<html>

    <head>

        <title> PHP FIND DATA </title>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>

    <form action="php_search_in_mysql_database.php" method="post">

        Id:<input type="text" name="id"><br><br>

        Name:<input type="text" name="username" value="<?php echo $username;?>"><br>
<br>

        Address:<input type="text" name="address" value="<?php echo $address;?>"><br><br>

        DOB:<input type="text" name="DOB" value="<?php echo $DOB;?>"><br><br>
		        Password:<input type="text" name="password" value="<?php echo $password;?>"><br><br>
				        Gender<input type="text" name="gender" value="<?php echo $gender;?>"><br><br>
						       email:<input type="text" name="email" value="<?php echo $email;?>"><br><br>
								        Phone:<input type="text" name="phone" value="<?php echo $phone?>"><br><br>
						

        <input type="submit" name="search" value="Find">

           </form>

    </body>

</html>
