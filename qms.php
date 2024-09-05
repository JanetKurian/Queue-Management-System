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


     $INSERT = "INSERT Into departure (username, address, DOB, password, gender, email, phone) values(?, ?, ?, ?, ?, ?, ?)";
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
        <meta charset="utf-8">
        <title>QMS</title>
    </head>
    <body>
    
        <h1>QUEUE MANAGEMNT SYSTEM</h1>
		<p>
        <a href="new.html">NEW REGISTRATION</a>
		</p>
		<p>
		<a href="http://localhost/test/php_search_in_mysql_database.php">AlREADY REGISTERED</a>
        </p>
		<p>
		<a href="http://localhost/test/display.php">LIST OF REGISTERED USERS</a>
        </p><p>
		<a href="http://localhost/test/display_login.php">RECORD OF ENTERY</a>
        </p><p>
		<a href="http://localhost/test/display_departure.php">RECORD OF EXIT</a>
        </p>
		<form action="qms.php" method="post">

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