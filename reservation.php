<?php
include('header.php');
include('connection.inc.php');
error_reporting(0);
$name="";
$date="";
$time="";
$number="";
$email="";
$people_size="";
$message="";

if(isset($_POST['submit_reservation']))
{
    $name = get_safe_value($con,$_POST['name']);
    $date = get_safe_value($con,$_POST['date']);
    $time = get_safe_value($con,$_POST['time']);
    $people_size= get_safe_value($con,$_POST['people_size']);
    $number = get_safe_value($con,$_POST['number']);
    $email = get_safe_value($con,$_POST['email']);
    $message= get_safe_value($con,$_POST['message']);

    mysqli_query($con,"insert into reservation(name,email,number,time,date,people_size,message)values('$name','$email','$number','$time','$date','$people_size','$message')");

    
include('smtp/PHPMailerAutoload.php');
 


$html='  
  <h6>Please confrim table reservation within hour.Just Sending Conformination Email back customer or Phone call that customer has provide it given below!!</h6>

<table class="table table-borderless table-data3">
<thead>
    <tr>
      <th width="15%">Date</th>
      <th width="15%">People Size</th>
      <th width="15%">Time</th>
      <th width="15%">Name</th>
      <th width="15%">Phone</th>
      <th width="15%">Email</th>
      <th width="15%">Message</th>

  </tr>
</thead>
<tbody>';
$id = mysqli_insert_id($con);
$Query = "select * from reservation  where id='$id'";
$runQuery= mysqli_query($con,$Query);

while($row=mysqli_fetch_assoc($runQuery))
{
  
  $html.='  <tr>
        
        <td>'. $row['date'].'</td>
        <td>'. $row['people_size'].'</td>
        <td>'.$row['time'].'</td>
        <td>'. $row['name'].'</td>
        <td>'.$row['number'].'</td>
        <td>'.$row['email'].'</td>
        <td>'. $row['message'].'</td>
            </tr>';
}

   
    // Sending ThankYOu Order Invoice Email
    $mail = new PHPMailer();	
    // $mail->SMTPDebug=3;
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.titan.email';                                
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'info@bigcrestaurant.com';              
        $mail->Password   = 'BigC@Info';                                                               
        $mail->Port       = 587;                                  
        $mail->SMTPSecure = 'STARTTLS ';                               
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('info@bigcrestaurant.com');
        $mail->addAddress('reservation@bigcrestaurant.com');                           
        $mail->addReplyTo($email);
        $mail->isHTML(true);                       
        $mail->Subject = 'Table Reservation Email  Please Confrim It';
        $mail->Body=$html;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if(!$mail->Send()){
            echo $mail->ErrorInfo;
        }else{
            echo 'Sent';
        }
        
        redirect('thankyou.php');
    }
    



?>

    <!-- Slider -->
    <div class="lec_slider lec_slider_inside lec_image_bck lec_fixed lec_wht_txt" data-stellar-background-ratio="0.3" data-image="images/resta/shutterstock_430684768.jpg">
        
        <!-- Firefly -->
        <div class="lec_slider_firefly" data-total="30" data-min="1" data-max="3"></div>

        <!-- Over -->
        <div class="lec_over" data-color="#000" data-opacity="0.8"></div>
        

        <div class="container">


            <!-- Slider Texts -->
            <div class="lec_slide_txt lec_slide_center_middle text-center">
                
                <div class="lec_gold">Reservation</div>
                <div class="lec_slide_subtitle">Big C<br>Restaurant</div>
            </div>
            <!-- Slider Texts End -->
        
        </div>
        <!-- container end -->
        

    </div>
    <!-- Slider End -->

    <!-- Content -->
    <section id="lec_content" class="lec_content">


        <!-- section -->
        <section class="lec_section">

                <div class="container text-center">
                    
                    <h3 class="lec_gold_subtitle">Make  Reservation  <br>contact us through the online form </h3>
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <p>Book a table</p>
                            <input type="date" placeholder="Date"  class="form-control" name="date"  required>
                            <input type="time" placeholder="Time" class="form-control"  name="time" required>
                            <input type="text" placeholder="People Size" class="form-control"  name="people_size" required>
                        </div>

                        <div class="col-md-5">
                            <p>Contact Details</p>
                            <input type="text" placeholder="Name" class="form-control" name="name" required>
                            <input type="email" class="form-control" placeholder="Email" name="email"  required>
                            <input type="text" placeholder="Phone" class="form-control" name="number" required>
                        </div>

                        <div class="col-md-10 col-md-offset-1">
                            <textarea class="form-control" placeholder="Message" rows="6" name="message" required></textarea>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <input type="submit" class="btn" value="Make reservation" name="submit_reservation" id="open-popup">
                        </div>
                    </div>
                    </form>

                </div>
                <!-- container end -->
                
        </section>
        <!-- section end -->

    
    </section>
    <!-- Content End -->
        
    

 <?php
 include('footer.php');
 ?>