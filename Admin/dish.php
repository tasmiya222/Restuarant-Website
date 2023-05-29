<?php

include('header.php');
//  fetching the   id and type from url
if(isset($_GET['type']) && $_GET['type']!== '' && isset($_GET['id']) && $_GET['id']>0)
{
    $type = get_safe_value($_GET['type']);
    $id = get_safe_value($_GET['id']);
    
    // deleteing query
    if($type == 'delete')
    {
        mysqli_query($con,"delete from dish where id = '$id'");
        redirect('dish.php');
    }
    // Active and Deactive Query
    if($type == 'active' || $type == 'deactive'){
        $status = 1;
        if($type == 'deactive')
        {
            $status = 0;

        }
        mysqli_query($con," update dish set status = '$status'  where id='$id'");
        redirect('dish.php');
    }
}
$Query="select dish.*, category.category from dish, category where dish.category_id = category.id order by dish.id desc";

$runQuery=mysqli_query($con, $Query);
?>

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                                        <h2 class="card-title" style="text-decoration: underline overline;">Dish Master</h2>
                    <a style="margin: 5px; font-size: 20px; color:gray;  "  href="add_dish.php">Add Dish</a>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th width="5%">S.No #</th>
                                    <th width="15%">Category</th>
                                    <th width="20%">Dish</th>
                                    <!-- <th width="15%">Image</th> -->
                                    <th width="15%">Added On</th>
                                    <th width="35%">Actions</th>
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
                            <td><?php echo $row['dish']?></td>
                            <!-- <td><a target="_blank
                                " href="?php echo //SITE_IMAGE_PATH.$row['image']?>">
                                <img  style="height: 70px; width:70px" src="<//?php echo //SITE_IMAGE_PATH.$row['image']?>"/>
                               </a>
                            </td> -->
                            <td>
                                <?php
                                $dateStr=strtotime($row['added_on']);
                                echo date ('d-m-Y',$dateStr);
                              ?>
                            <td>
                                <a style="font-size: 20px" href="add_dish.php?id=<?php echo $row['id']?>"><label class="badge badge-success hand-cursor">Edit</label></a>
                                &nbsp;
                                <?php
                                //Active & Deactive
                                if($row['status'] == 1)
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