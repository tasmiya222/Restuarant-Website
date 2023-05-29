<?php

include('header.php');

//define null variable
$msg="";
$category_name="";
$id ="";

 //getting value 
 if(isset($_GET['id']) && $_GET['id']>0)
{
        $id = get_safe_value($con,$_GET['id']);
        $row = mysqli_fetch_assoc(mysqli_query($con,"select * from category where id = '$id'"));
        $category_name = $row['category'];

}
//adding category in databse
if(isset($_POST['submit']))
{
    $category_name = get_safe_value($con,$_POST['category_name']);
    $added_on = date('Y-m-d : h:i:s');
     //Checking if there is any duplicat category
      if($id == '')
      {
      $Query = "select * from category where category='$category_name'";
  }
  else
  {
    $Query = "select * from category where category='$category_name' and id!= '$id'";
  }
   
    if(mysqli_num_rows(mysqli_query($con, $Query)))
    {
        $msg = "Category Aready Exist";
    }
    //update and insert 
    else
    {
        if($id == '')
        {
             mysqli_query($con,"insert into category(category,Status,added_on) values('$category_name',1,'$added_on')");
             redirect('category.php');      
        }
        else
        {
            mysqli_query($con,"update category set category='$category_name' where id='$id'");
            redirect('category.php');
        }
    
     }

}
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
                                            <h3 style="text-align: left;" class="text-center title-2">Add Category</h3>
                                        </div>
                                        <hr>
                                        <form action="" method="post" novalidate="novalidate">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                                <input type="text" class="form-control" name="category_name" required value="<?php echo $category_name;?>">
                                             
                                            </div>
                                           <div style="color: red;  font-size: 15px;"><?php echo $msg; ?></div>
                                            
                                                </div>
                                            
                                            <div>
                                                <button id="payment-button" type="submit"  name="submit" class="btn btn-lg btn-info btn-block">
                                                    
                                                 Submit
                                                </button>
                                               
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
<?php

include('script.php');

?>