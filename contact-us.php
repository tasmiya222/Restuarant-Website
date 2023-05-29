<?php
include('header.php');
include('connection.inc.php');
error_reporting(0);

$name = "";
$email = "";
$number = "";
$added_on="";
$msg = "";
if(isset($_POST['submit']))
{
    $name = get_safe_value($con,$_POST['name']);
    $email = get_safe_value($con,$_POST['email']);
    $number = get_safe_value($con,$_POST['number']);
    $message = get_safe_value($con,$_POST['message']);
    $added_on = $added_on = date('Y-m-d h:s');
    //inst data into database 
    $Query = "insert into contact_us(name,email,number,message,added_on)values('$name','$email','$number','$message','$added_on')";
    
    mysqli_query($con,$Query);
   ?>
   <script>
       alert('Thank you for getting in touch! We appreciate you contacting us');    
   </script>
   <?php 
}

?>


    <!-- Slider -->
    <div class="lec_slider lec_slider_inside lec_image_bck lec_fixed lec_wht_txt" data-stellar-background-ratio="0.3" data-image="images/resta/shutterstock_430097278.jpg">
        
        <!-- Firefly -->
        <div class="lec_slider_firefly" data-total="30" data-min="1" data-max="3"></div>

        <!-- Over -->
        <div class="lec_over" data-color="#000" data-opacity="0.8"></div>
        

        <div class="container">


            <!-- Slider Texts -->
            <div class="lec_slide_txt lec_slide_center_middle text-center">
                
                <div class="lec_gold">Contact Us</div>
                <div class="lec_slide_subtitle">Big C <br> Restaurant</div>
            </div>
            <!-- Slider Texts End -->
        
        </div>
        <!-- container end -->


    </div>
    <!-- Slider End -->

    <!-- Content -->
    <section id="lec_content" class="lec_content">



        <!-- section -->
        <section class="lec_section lec_section_no_overlay">
                
                <!-- Over -->
                <div class="lec_over" data-color="#333" data-opacity="0"></div>

                <div class="container text-center">


                    <div class="row">
                        
                        <div class="col-md-9 lec_animation_block lec_map_hidden_top" data-bottom-top="transform:translate3d(0px, 80px, 0px)" data-top-bottom="transform:translate3d(0px, -80px, 0px)">
                           <div class="lec_map_container">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14411.081723712166!2d68.3695625!3d25.4459375!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1650385059749!5m2!1sen!2s" height="680" scrolling="no"></iframe>
                            </div>
                        </div>

                        <div class="col-md-5 lec_animation_block lec_animation_abs_block lec_posr lec_image_bck" data-bottom-top="transform:translate3d(0px, 0px, 0px)" data-top-bottom="transform:translate3d(0px, 80px, 0px)" data-image="images/main_back.jpg">

                            <!-- Over -->
                            <div class="lec_over" data-color="#000" data-opacity="0.05"></div>

                            <div class="lec_parallax_menu lec_image_bck lec_fixed">
                             
                                <h2 class="lec_gold lec_title_counter">Directions</h2>
                                        <h3 class="lec_gold_subtitle">Our Big C Restaurant<br>Location</h3>
                                <p>Near Riyaz PSO Petrol Pump Main Bypass Hyderabad Sindh 71000 </p>
                                <a href="mailto:info@bigcrestaurant.com" class="btn">Contact Big C Restaurant <i class="ti ti-email"></i></a>
                            </div>
                        </div>


                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->         
                
        </section>
        <!-- section end -->


        <!-- section -->
        <section class="lec_section lec_section_no_overlay">
                
                <!-- Over -->
                <div class="lec_over" data-color="#333" data-opacity="0.05"></div>

                <div class="container text-center">

                    <div class="row">
                    <h3 class="lec_gold_subtitle">Contact us through the Online Form </h3>
                    
                    <div class="row">
                        <form action="" method="POST">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <p>Contact Details</p>
                            <input type="text" placeholder="Name" name="name" class="form-control" required >
                            <input type="email" class="form-control" name="email"  placeholder="Email" required >
                            <input type="text" placeholder="Phone"  name="number"  class="form-control" required>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                        <textarea class="form-control" placeholder="Message"  name="message"  rows="6" required></textarea></div>
                        <div class="col-md-4 col-md-offset-4">
                        <input type="submit" value="Contact Us" name="submit" class="btn"/><br>
                        <span class="error"><?php echo $msg ?></span></div>
                </form>
                    </div>
                        <!-- col end -->
                        <div class="col-md-5 lec_animation_block lec_animation_abs_block lec_posr lec_image_bck" data-bottom-top="transform:translate3d(0px, -80px, 0px)" data-top-bottom="transform:translate3d(0px, 0px, 0px)" data-image="images/main_back.jpg">
                            <!-- Over -->
                            <div class="lec_over" data-color="#000" data-opacity="0.05"></div>   
                        </div>
                        <!-- col end -->
                    </div>
                    <!-- row end -->
                </div>
                <!-- container end -->
        </section>
        <!-- section end -->
    </section>
    <!-- Content End -->
    
<?php
include('footer.php'); 
?>