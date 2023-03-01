<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
  	$bid=$_GET['bookid'];
  	$uid=$_SESSION['obbsuid'];
 $bookingfrom=$_POST['bookingfrom'];
 $Startime=$_POST['Startime'];
 $Endtime=$_POST['Endtime'];
 $eventtype=$_POST['eventtype'];
 $nop=$_POST['nop'];
 $message=$_POST['message'];
 $query12="select Startime,Endtime from tblbooking where BookingFrom=:date ;";
 $sqlobj=$dbh->prepare($query12);
 $sqlobj->bindParam(':date',$bookingfrom,PDO::PARAM_STR);
 $sqlobj->execute();
 $res=$sqlobj->fetchAll(PDO::FETCH_OBJ);
 if($sqlobj->rowCount()>0){
	$flag=0;
	$stt=(int)$Startime;
	$eet=(int)$Endime;
  foreach($res as $r){
	$strtime=(int)$r->Startime;
	$entime=(int)$r->Endtime;

	if($stt > $strtime&&$stt < $entime){
		echo '<script>alert("Event time sss alredy booked")</script>';
		$flag=1;
	}
	elseif($eet > $strtime&& $eet < $entime){
		echo '<script>alert("Event Time  alredy booked")</script>';
		$flag=1;
	}
}
	if($flag==0)
	{
		$bookingid=mt_rand(100000000, 999999999);
$sql="insert into tblbooking(BookingID,ServiceID,UserID,BookingFrom,EventType,Numberofguest,Message,Startime,Endtime)values(:bookingid,:bid,:uid,:bookingfrom,:eventtype,:nop,:message,:Startime,:Endtime)";
$query=$dbh->prepare($sql);
$query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':bookingfrom',$bookingfrom,PDO::PARAM_STR);
$query->bindParam(':eventtype',$eventtype,PDO::PARAM_STR);
$query->bindParam(':nop',$nop,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':Startime',$Startime,PDO::PARAM_STR);
$query->bindParam(':Endtime',$Endtime,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your Booking Request Has Been Send. We Will Contact You Soon")</script>';
echo "<script>window.location.href ='services.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}


 }
 else
 {
 $bookingid=mt_rand(100000000, 999999999);
$sql="insert into tblbooking(BookingID,ServiceID,UserID,BookingFrom,EventType,Numberofguest,Message,Startime,Endtime)values(:bookingid,:bid,:uid,:bookingfrom,:eventtype,:nop,:message,:Startime,:Endtime)";
$query=$dbh->prepare($sql);
$query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);
$query->bindParam(':bid',$bid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':bookingfrom',$bookingfrom,PDO::PARAM_STR);
$query->bindParam(':eventtype',$eventtype,PDO::PARAM_STR);
$query->bindParam(':nop',$nop,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':Startime',$Startime,PDO::PARAM_STR);
$query->bindParam(':Endtime',$Endtime,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your Booking Request Has Been Send. We Will Contact You Soon")</script>';
echo "<script>window.location.href ='services.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

}
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Auditorium Booking System</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script type="text/javascript">
	function getaudi(a){
		var b=parseInt(a);
		b=(b/200)*100;
		const ab=document.getElementById("adisel");
		var q1="<option value=\"it hall\">IT Seminar Hall </opton><option value=\" hall\">IT Bot Lab</opton>";
		var q2="<option>Shanon Hall</option><option>civil-Mech Auditorium </option>";
		var q3="<option>SRL Auditorium</option>"
		if(b<=99){
			ab.innerHTML=q1;
		}
		else if(b>=100 && b<=200)
		{
			ab.innerHTML=q2;
		}
		else
		{
			ab.innerHTML=q3;
		}
	}
</script>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

<link href="css/font-awesome.css" rel="stylesheet"> 

<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 


</head>
<body>
	<div class="banner jarallax">
		<div class="agileinfo-dot">
			<?php include_once('includes/header.php');?>
			<div class="wthree-heading">
				<h2>Book Services</h2>
			</div>
		</div>
	</div>

	<div class="contact">
		<div class="container">
			<div class="agile-contact-form">
				
				<div class="col-md-6 contact-form-right">
					<div class="contact-form-top">
						<h3>Book Services </h3>
					</div>
					<div class="agileinfo-contact-form-grid">
						<form method="post">
							 <div class="form-group row">
                                    <label class="col-form-label col-md-4">Date</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control" style="font-size: 20px" required="true" name="bookingfrom">
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-form-label col-md-4">Co-ordinator Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" style="font-size: 20px" required="true" name="nop">
                                    </div>
                                </div>
								
								<div class="form-group row">
                                    <label class="col-form-label col-md-4">Type of Event:</label>
                                    <div class="col-md-10">
                                       <select type="text" class="form-control" name="eventtype" required="true" >
							 	<option value="">Choose Event Type</option>
							 	<?php 

								$sql2 = "SELECT * from   tbleventtype ";
								$query2 = $dbh -> prepare($sql2);
								$query2->execute();
								$result2=$query2->fetchAll(PDO::FETCH_OBJ);

								foreach($result2 as $row)
								{          
   									 ?>  
									<option value="<?php echo htmlentities($row->EventType);?>"><?php echo htmlentities($row->EventType);?></option>
 								<?php } ?>
							 </select>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-form-label col-md-4">Number of Guest:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" style="font-size: 20px" required="true" name="nop">
                                    </div>
                                </div>
  
		

		<div>
			<br>
			<label for="lastname" class="formbold-form-label"> Start time: </label><br>
			<input
			  type="time"
			  name="Startime"
			  id="time"
			  
			  class="formbold-form-input"
			/>
		  </div>

		  <div>
			<br>
			<label for="lastname" class="formbold-form-label"> End time: </label><br>
			<input
			  type="time"
			  name="Endtime"
			  id="time"
			  
			  class="formbold-form-input"
			/>
		  </div><br>
		  <div class="formbold-mb-3">
			
			<label for="address" class="formbold-form-label"> Number seats Required for participants: </label><br>
	
			<input
			  type="number"
			  name="seats"
			  id="seat"
			  placeholder="example (100)"
			  class="formbold-form-input formbold-mb-3"
			  onchange="getaudi(seats.value)"
			/>
		  </div><br>

		  <div class="formbold-mb-3">
			
			<label for="address" class="formbold-form-label"> Number seats Required on stage: </label><br>
	
			<input
			  type="number"
			  name="seatss"
			  id="seatsss"
			  placeholder="example (5)"
			  class="formbold-form-input formbold-mb-3"
			/>
		  </div><br>
		  <div class="formbold-mb-3">
			
			<label for="address" class="formbold-form-label">Select adithorium </label><br>
	        <select class="formbold-mb-3" id="adisel"></select>
		  </div><br>


		  <div class="formbold-mb-3">
			
			<label for="address" class="formbold-form-label"> Audio System </label><br>
	
			<input type="radio" id="wiredd" name="wiredd" value="Wired Mic">
  				<label for="wiredd">Wired Mic</label><br>
		  
		  	<input type="radio" id="wirell" name="wirell" value="Wireless Mic">
  			    <label for="wirell">Wireless Mic</label><br>
		  </div><br>

		  <div class="formbold-mb-3">
			
			<label for="address" class="formbold-form-label"> LCD Projector needed ? </label><br>
	
			<input type="radio" id="yyy" name="yes" value="Yes">
  				<label for="yyy">Yes</label><br>
		 
		  <input type="radio" id="nnn" name="No" value="No">
  			    <label for="nnn">No</label><br>
		  </div><br>
                               
                                
                                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4">Message(if any)</label>
                                    <div class="col-md-10">
                                        <textarea  class="form-control"  required="true" name="message" style="font-size: 20px"></textarea> 
                                    </div>
                                </div>
                                                
                                              <br>
                                                <div class="tp">
                                                    
                                                     <button type="submit" class="btn btn-primary" name="submit">Book</button>
                                                </div>
                                            </form>

					</div>
				</div>
				
				<div class="clearfix"> </div>
			</div>
			
		
		</div>
	</div>
	<!-- //contact -->
	<?php include_once('includes/footer.php');?>
	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/modernizr.custom.js"></script>

</body>	
</html><?php }  ?>