<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
        $date = $_POST['date'];
        $query = "SELECT * FROM tblbooking WHERE BookingFrom = '$date'";
        $sqlobj = $dbh->prepare($query);
        $sqlobj->execute();

        if ($sqlobj->rowCount()> 0) {
            echo "The venue is already booked on " . $date;
        } else {
            echo "The venue is available on " . $date;
        }

    // Close the database connection
  }}
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Check Availability</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        input[type=date] {
            padding: 5px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }
        button[type=submit] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button[type=submit]:hover {
            background-color: #3e8e41;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .available {
            background-color: #cfc;
        }
        .booked {
            background-color: #fcc;
        }
    </style>
</head>
<body>
    <h1>Check Availability</h1>



    <form method="post">
        <label for="date">Enter a date:</label>
        <input type="date" name="date" id="date">
        <button type="submit" name="submit">Check Availability</button>
    </form>
</body>
</html>