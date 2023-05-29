<?php
include('header.php');
//defining the null Varaible 
$msg="";
$dish="";
$category_id="";
$dish_details="";
$id="";
$category_id ="";
$image="";
$image_error="";
$image_status='required';
// getting value
if(isset($_GET['id']) && $_GET['id']>0)
{
    $id = get_safe_value($_GET['id']);
    $row = mysqli_fetch_assoc(mysqli_query($con, "select * from dish where id = '$id'"));
    $dish = $row['dish'];
    $dish_details= $row['dish_details'];
    $category_id = $row['category_id'];
    $image_status='';


}
//deleting the remove attribute and price
if(isset($_GET['dish_details_id']) && $_GET['dish_details_id']>0)
{
    $dish_details_id = get_safe_value($_GET['dish_details_id']);
    $id = get_safe_value($_GET['id']);
    mysqli_query($con,"delete from dish_details where id= '$dish_details_id'");
    redirect('manage_dish.php?id='.$id);
}
// adding dish into database
if(isset($_POST['submit']))
{
    $category_id = get_safe_value($_POST['category_id']);
    $dish = get_safe_value($_POST['dish']);
    $dish_details = get_safe_value($_POST['dish_details']);
    $added_on = date('Y-m-d : h:i:s');

     //Checking if there is any duplicat dish
    if($id =='')
    {
        $Query = "select * from dish where dish = '$dish'";
    }
    else
    {
        $Query="select * from dish where dish='$dish' and id!= '$id'";
    }

    if(mysqli_num_rows(mysqli_query($con,$Query)))
    {
        $msg = "Dish is Already Exist";
    }
// update and insert in database
    else
    {
        //$type = $_FILES['image']['type'];
        if($id == '')
        {

            if ($_FILES['image']['type'] != 'image/jpg' &&  $_FILES['image']['type'] != 'image/jpeg' &&  $_FILES['image']['type'] != 'image/png')
            {
                $image_error= "Invaild Image Format";
            }
            else
            {
                $image = rand('111111111','999999999').'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],SERVER_IMAGE_PATH.$image);
                mysqli_query($con,"insert into dish(category_id,dish,dish_details,image,status,added_on) value('$category_id','$dish','$dish_details','$image','1','$added_on')");
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
        }

        else
        {

            $image_condition = '';
            if($_FILES['image']['name'] != '')
            {
                if($type != 'image/jpg' &&  $type != 'image/jpeg' && $type != 'image/png')
                {
                    $image_error= "Invaild Image Format";
                }
                else
                {


                    $image = rand('111111111','999999999').'_'.$_FILES['image']['name'] ;
                    move_uploaded_file($_FILES['image']['tmp_name'],SERVER_IMAGE_PATH.$image);
                    $image_condition = ", image='$image'";
                    $oldImageRow = mysqli_fetch_assoc(mysqli_query($con,"select image from dish where id='$id'"));
                    $oldImage= $oldImageRow['image'];
                    unlink(SERVER_IMAGE_PATH.$oldImage);

                }

            }
            if($image_error == '')
            {
                $sql="update dish set category_id='$category_id', dish='$dish', dish_details='$dish_details' $image_condition where id = '$id'";
                mysqli_query($con, $sql);
                $attributeArr = $_POST['attribute'];
                $priceArr = $_POST['price'];
                $DishDetailsIdArr = $_POST['dish_details_id'];
                foreach ($attributeArr as $key=>$val) 
				{
                    $attribute = $val;
                    $price = $priceArr[$key];
                    if(isset($DishDetailsIdArr[$key]))
                    {
                     $did=$DishDetailsIdArr[$key];
                     mysqli_query($con,"update dish_details set attribute='$attribute' , price='$price' where  id='$id'");

					  redirect('dish.php');
                 }
                 else
                 {
                  mysqli_query($con,"insert into dish_details(dish_id,attribute,price,statud,added_on) values('$did','$attribute','$price','1','$added_on')");  
				   redirect('dish.php');
              }

                 
           
          

     
  }
}


}
	}
}

echo "insert into dish_details(dish_id,attribute,price,statud,added_on) values('$did','$attribute','$price','1','$added_on'";
?>


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">

                        <div class="card-body">
                            <div class="card-title">
                                <h3 style="text-align: left;"  class="text-center title-2">Add Dish</h3>
                            </div>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="dish" required value="<?php echo $dish?>">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Dish Details</label>
                                    <textarea class="form-control" name="dish_details"><?php echo $dish_details ?></textarea>
                                    <!-- <input type="text" class="form-control" name="category_name" required value="<?php echo $category_name;?>"> -->
                                    
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input type="file" class="form-control" name="image" >
                                    <!-- <div style="color: red; text-align: center; font-size: 15px;"> <?php echo $image_error; ?></div> -->
                                </div>
                                
                                <div class="form-group" id="dish_box1">
                                   <label for="cc-payment" class="control-label mb-1">Dish Attribute & Price</label>

                                   <?php 
                                   if($id == ''){ ?>
                                      <div class="row" style="margin-top:8px">
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="attribute[]" placeholder="Attribute" required >

                                        </div>
                                        <div class="col-5">
                                          <input type="text" class="form-control" name="price[]" placeholder="Price" required >

                                      </div>
                                  </div>

                              <?php }  else{
                              $sql= "select * from dish_details where dish_id='$id'";
                              $dish_res= mysqli_query($con,$sql);
                               while ($dish_row=mysqli_fetch_assoc($dish_res)) {

                             
                            ?>
                                 <div class="row" style="margin-top:8px">
                                    <div class="col-5">
                                        <input type="text" class="form-control" value="<?php echo $dish_row['attribute']?>" name="attribute[]" placeholder="Attribute" required >

                                    </div>
                                    <div class="col-5">
                                      <input type="text" class="form-control"  value="<?php echo $dish_row['price']?>" name="price[]" placeholder="Price" required >

                                  </div>
                              </div>



                          <?php } }?>
                      </div>                             


                      <button id="payment-button" type="submit"   onclick="add_more()" name="submit" class="btn btn-warning">

                       Add More
                   </button>

                   <button id="payment-button" type="button" class="btn btn-info">

                       Submit
                   </button>
                   <div style="color: red;  font-size: 15px;"><?php echo $msg; ?></div> 


               </div>
           </form>
       </div>
   </div>
</div>
<input type="text"  id="add_more1" value="1" hidden >
</div>
</div>
</div>
</div>

</div>

<script type="text/javascript">

    function add_more()
    {
     var add_more = jQuery('#add_more1').val();
     add_more++;
     jQuery('#add_more1').val(add_more);                 
     var html = '<div class="row" id="box'+add_more+'" style="margin-top:8px"><div class="col-5"><input type="text" class="form-control" name="attribute[]" placeholder="Attribute" required ></div><div class="col-5"><input type="text" class="form-control" name="price[]" placeholder="Price"  required></div><div class="col-2"> <button id="payment-button" type="submit"   onclick="remove_more('+add_more+')" name="submit" class="btn btn-danger">Remove</button></div></div>';
     jQuery('#dish_box1').append(html);
 }
 function remove_more(id)
 {
    jQuery('#box'+id).remove();
}
</script>


<?php

include('script.php');

?>