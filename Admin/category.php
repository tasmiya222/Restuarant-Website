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
        mysqli_query($con,"delete from category where id = '$id'");
        redirect('category.php');
    }
    // Active and Deactive Query
    if($type == 'active' || $type == 'deactive'){
        $status = 1;
        if($type == 'deactive')
        {
            $status = 0;

        }
        mysqli_query($con," update category set Status = '$status'  where id='$id'");
        redirect('category.php');
    }
}
$Query = "select * from category order by id";
$runQuery = mysqli_query($con, $Query);

?>


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <h2 class="card-title" style="text-decoration: underline overline;">Category Master</h2>
                    <a style="margin: 5px; font-size: 20px; color:gray;  "  href="add_category.php">Add Category</a>


                    <div style="margin: 10px" class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                  <th width="10%">S.No #</th>
                                  <th width="25%">Category</th>
                                  <th width="20%">Actions</th>
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
                                    <td><?php echo $row['category']?></td>
                                    <td>
                                        <a style="font-size: 20px" href="add_category.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand-cursor">Edit</label></a>
                                        &nbsp;
                                        <?php
                                //Active & Deactive
                                        if($row['Status'] == 1)
                                        {
                                            ?>
                                            <a style="font-size: 20px" href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-info hand-cursor">Active</label></a>

                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a style="font-size: 20px" href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-primary hand-cursor">DeActive</label></a>

                                            <?php
                                        }

                                        ?>

                                        &nbsp;
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
