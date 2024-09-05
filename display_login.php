<html>
<head>
<title>Display data</title>
</head>
<style type="text/css">
table{
border: 2px solid red;
background-color:#FFC;
}
th{
border-bottom: 5px solid #000;
}
td{
border-bottom: 2px solid #666;
}
</style>
</head>
<body>
<h1>Display Data</h1>
<?php

    $connect = mysqli_connect("localhost", "request", "request","youtube");
$sqlget = "SELECT * FROM login";
$sqldata = mysqli_query($connect, $sqlget);
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Address</th><th>DOB</th><th>password</th><th>Gender</th><th>email</th><th>phone</th></tr>";
while($row=mysqli_fetch_array($sqldata , MYSQLI_ASSOC)){
echo "<tr><td>";
echo $row['id'];
echo "</td><td>";
echo $row['username'];
echo "</td><td>";
echo $row['address'];
echo "</td><td>";
echo $row['DOB'];
echo "</td><td>";
echo $row['password'];
echo "</td><td>";
echo $row['gender'];
echo "</td><td>";
echo $row['email'];
echo "</td><td>";
echo $row['phone'];
echo "</td></tr>";
}
echo "</table>";
?>
</body>
</html>