<?php

include('header.php');

//define null variable
$msg="";
$category_id="";
$dish="";
$dish_details="";
$added_on="";
$id ="";
$image_error="";
$image_status='required';
 //getting value 
if(isset($_GET['id']) && $_GET['id']>0)
{
    $id = get_safe_value($con,$_GET['id']);
    $row = mysqli_fetch_assoc(mysqli_query($con,"select * from dish where id = '$id'"));
    $category_id = $row['category_id'];
    $dish = $row['dish'];
    $dish_details = $row['dish_details'];
    $image_status='';
}
//DELETING attitrbute& price
if(isset($_GET['dish_details_id']) && $_GET['dish_details_id']>0)
{
    $dish_details_id = get_safe_value($con,$_GET['dish_details_id']);
    $id = get_safe_value($con,$_GET['id']);
    mysqli_query($con,"delete from dish_details where id= '$dish_details_id'");
    redirect('add_dish.php?id='.$id);
}
//adding category in databse
if(isset($_POST['submit']))
{
    $category_id = get_safe_value($con,$_POST['category_id']);
    $dish = get_safe_value($con,$_POST['dish']);
    $dish_details = get_safe_value($con,$_POST['dish_detail']);
    $added_on = date('Y-m-d : h:i:s');
     //Checking if there is any duplicat category
    if($id == '')
    {
      $Query = "select * from dish where dish='$dish'";
    }
  else
   {
       $Query = "select * from dish where dish='$dish' and id!= '$id'";
   }

      if(mysqli_num_rows(mysqli_query($con, $Query)))
        {

          $msg = "Dish Aready Exist";

        }
        
//update and insert 
      if($msg == '')
      {
                  mysqli_query($con,"insert into dish(category_id,dish,dish_details,status,added_on) values('$category_id','$dish','$dish_details','1','$added_on')");

                         
                       $did = mysqli_insert_id($con);
                       //inserting atrt
                       $attributeArr = $_POST['attribute'];
                       $priceArr = $_POST['price'];
                       foreach ($attributeArr as $key=>$val) {
                       $attribute = $val;
                       $price = $priceArr[$key];
                       mysqli_query($con,"insert into dish_details(dish_id,attribute,price,statud,added_on) values('$did','$attribute','$price','1','$added_on')");

                       }
                redirect('dish.php');
                     }
                     else
                     {

                     
                    mysqli_query($con,"update dish set category_id='$category_id',dish='$dish', dish_details='$dish_details'  where id='$id'");

                                    $attributeArr = $_POST['attribute'];
                                    $priceArr = $_POST['price'];
                                    $dishDetailsIDArr=$_POST['dish_details_id'];

                                    foreach ($attributeArr as $key=>$val) {
                                     $attribute = $val;
                                     $price = $priceArr[$key];

                                     if(isset($dishDetailsIDArr[$key]))
                                     {
                                        $did=$dishDetailsIDArr[$key];
                                        mysqli_query($con,"update dish_details set attribute='$attribute' , price='$price' where id='$did'");

   
                                     }
                                     else
                                     {
                                         mysqli_query($con,"insert into dish_details(dish_id,attribute,price,statud,added_on) values('$id','$attribute','$price','1','$added_on')");
                                     }
                                    

                                 } 
                                }
                                redirect('dish.php');
                                
       
                            

                       
                                }   
               ?>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title">
                                <h3 style="text-align: left;" class="text-center title-2">Add Dish</h3>
                            </div>
                            <hr>
                            <form  method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                <select name="category_id"  class="form-control " value="<?php echo $category_id?>">
                                    <option value="">Select Category</option>
                                        <?php
                                                 $res= mysqli_query($con,"select * from category where Status='1'  order by category asc");
                                                  while ($row_category=mysqli_fetch_assoc($res))
                                                  {
                                                     if($row_category['id'] == $category_id)
                                                     {
                                            
                                                         echo "<option selected value='".$row_category['id']."'>".$row_category['category']."</option>";
                                                         
                                                      }
                                                   else
                                                    {
                                            
                                                        echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";


                                                    }
                                                }

                                            ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Dish Name</label>
                                <input type="text" class="form-control" name="dish" placeholder="Dish" required value="<?php echo $dish ?>" >

                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Dish Description</label>
                                <input type="text" class="form-control" name="dish_detail" required placeholder="Dish Description"  value="<?php echo $dish_details ?>" >

                            </div>
                            <!-- <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Dish Image</label>
                                <input type="file" class="form-control" name="image" <?php echo $image_status; ?> >
                                <div style="color: red;  font-size: 15px;"><?php echo $image_error; ?></div>
                            </div> -->
                            <div class="form-group" id="dish_box1">
                                    <label for="cc-payment" class="control-label mb-1">Dish Details</label>
                                 <?php if($id== ''){
                                    ?>
                                 <div class="row" style="margin-top: 8px;">
                                    <div class="col-lg-5">
                                         <input type="text" class="form-control" name="attribute[]"  placeholder="Attribute">
                                    </div>
                                    <div class="col-lg-5">
                                         <input type="text" class="form-control" name="price[]"   placeholder="Price">
                                    </div>
                                </div>
                                <?php
                                } else
                                   {  
                                    $dish_details_res=mysqli_query($con,"select * from dish_details where dish_id='$id'");
                                    $ii=1;
                                    while($dish_details_row=mysqli_fetch_assoc($dish_details_res))
                                    {
 
                                    ?>
                                      <div class="row" style="margin-top: 8px;">
                                    <div class="col-lg-5">
                                         <input type="text" class="form-control" name="attribute[]"  placeholder="Attribute" value="<?php echo $dish_details_row['attribute'] ?>">
                                    </div>
                                    <div class="col-lg-5">
                                         <input type="text" class="form-control" name="price[]"   placeholder="Price" value="<?php echo $dish_details_row['price'] ?>">
                                    </div>
                                
                                   <?php if($ii != 1){

                                     ?>
                                     <div class="col-lg-2"><button type="button" id="payment-button" class="btn btn-danger" onclick="remove_more_new(<?php echo $dish_details_row['id'] ?>)">Remove</button>
                                     </div>
                                     <?php
                                   } ?>
                                    </div>


                                    <?php 
                                    $ii++;

                                } } ?>
                             </div>
                              
                             
                             <button type="button" id="payment-button" class="btn btn-warning" onclick="add_more()">Add More</button>
                            <input type="Submit"  id="payment-button" name="submit" value="Submit" class="btn btn-info">
                            <div style="color: red;  font-size: 15px;"><?php echo $msg; ?></div>
                            </div>
                           <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
 </div>
 </div>
</div>
<input type="hidden" id="add_more" value="1"  />
<!-- Javascrpit Part -->
  <script type="text/javascript">
      
      function add_more()
      {
           var add_more = jQuery('#add_more').val();
           add_more++;
           jQuery('#add_more').val(add_more);
           var html = '<div class="row" style="margin-top:8px" id="box'+add_more+'"><div class="col-lg-5"><input type="text" class="form-control" name="attribute[]" required placeholder="Attribute"></div><div class="col-lg-5"><input type="text" class="form-control" name="price[]" required  placeholder="Price"></div><div class="col-lg-1"><button type="button" id="payment-button" class="btn btn-danger" onclick="remove_more('+add_more+')">Remove</button></div></div>';
               jQuery('#dish_box1').append(html);
      }
       
       function  remove_more(id) 
       {
          jQuery('#box'+id).remove();    
       }

       function remove_more_new(id)
       {
          var result = confirm('Are You Sure?');
          if(result == true)
          {
            var cur_path= window.location.href;
            window.location.href=cur_path+"&dish_details_id="+id;
          }
       }
  </script>

<?php
include('script.php');
?>