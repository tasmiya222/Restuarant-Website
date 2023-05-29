<?php

include('header.php');

//  fetching the   id and type from url
if(isset($_GET['type']) && $_GET['type']!== '' && isset($_GET['id']) && $_GET['id']>0)
{
    $type = get_safe_value($con,$_GET['type']);
    $id = get_safe_value($con,$_GET['id']);
    
    // deleteing query
    if($type == 'delete')
    {
        mysqli_query($con,"delete from contact_us where id = '$id'");
        redirect('contact-us.php');
    }
   
}
$Query = "select * from contact_us order by id";
$runQuery = mysqli_query($con, $Query);

?>


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <h2 class="card-title" style="text-decoration: underline overline;">Contact Master</h2>
                    

                    <div style="margin: 10px" class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                  <th width="10%">S.No #</th>
                                  <th width="15%">Name</th>
                                  <th width="15%">Email</th>
                                  <th width="15%">Phone</th>
                                  <th width="15%">Date</th>
                                  <th width="30%">Message</th>
                                  <th width="10%">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                           <?php 
                           if(mysqli_num_rows($runQuery)>0){
                            $i= 1;
                            while($row=mysqli_fetch_assoc($runQuery))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['email']?></td>
                                    <td><?php echo $row['number']?></td>
                                    <td><?php echo $row['added_on']?></td>
                                    <td><?php echo $row['message']?></td>
                                    
                                    <td>
                                        <a style="font-size: 20px" href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger">Delete</label></a>
                                    </td>

                                </tr>
                                <?php
                                $i++; 
                            } }
                            else{ 
                                ?>
                                <td colspan="5">No data Found</td>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
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
