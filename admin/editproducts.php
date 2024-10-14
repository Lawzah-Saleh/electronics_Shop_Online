<?php
include('header.php');
require('dbconnect.php');
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-items"></i>Products</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Edit Porduct
                    </div>
                  
                    <div class="panel-body">
                        <div class="row">

                        <?php 
                        if(isset($_GET['action'],$_GET['id'])&& $_GET['action']=='edit')
                        {
                            $id = $_GET['id'];
                            $stm = $con->prepare("select * from products where id=:prodid");
                            $stm->execute(array("prodid"=>$id));
                            if($stm->rowCount())
                             {
                                foreach ($stm->fetchAll() as $row) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $description = $row['description'];
                                    $image = $row['image'];
                                    $price = $row['price'];
                                    $cat_id = $row['cat_id'];

                                    if(isset($_POST['submitProduct'])) 
                                    { 
                                       $name =trim($_POST['name']);
                                       $description =trim($_POST['description']);
                                       $image = $_FILES['file'];
                                       $price =$_POST['price'];
                                       $cat_id =$_POST['cat_id'];
                                       $image_name= $image['name'];
                                       $image_type= $image['type'];
                                       $image_tmp= $image['tmp_name'];
                                       $errors=array();
                                       $extensions=array('jpg','gif','png');
                                       $file_explode=explode('.',$image_name);
                                       $file_extension=strtolower(end($file_explode));
                                        if(!in_array($file_extension,$extensions))
                                        {
                                          $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                                        }
                                        if(is_numeric($name)){
                                            $errors['name'] = "Name Must Be String" ;
                                        }
                                        if(empty($errors)){
                                            if (move_uploaded_file($image_tmp, "upload/".$image_name)) {
                                                $sql="update products set name=?, description=? , image=? , price=?, cat_id=? where id =?" ;
                                                $stm = $con->prepare($sql);
                                                $stm->execute(array($name , $description ,$image_name ,$price,$cat_id ,$id)); 
                                                if ($stm->rowCount()) {
                                                    echo "<div class='alert alert-success'>Row Updated</div>" ;
                                                } else {
                                                    echo "<div class='alert alert-danger'>Row Not Updated</div>" ;
                                                }
                                            }
                                            else 
                                            {
                                                echo "<div class='alert alert-danger'>Not upload file</div>";
                                            }
                                        
                                        }
            
                                  
                                    }            
                        ?>
                            <div class="col-md-12">
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id"  value ="<?php echo $id ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name "
                                            class="form-control" value="<?php echo $name ?>"/>
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"><?php echo $description ?></textarea>
                                    </div>
                                    <div class="form-group">
                                    <label>images</label>
                                    <img src="<?php echo $value['image'] ;?>" height="80px" width="200px" > <br/>
                                        <input type="file" class="form-control" name="file">
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" placeholder="Please Enter Product Price "
                                            class="form-control" value="<?php echo $price ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="cat_id">
                                            <?php    
                                        $sql="select * from categories " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();
                                        foreach ($stm->fetchAll() as $row) {
                                            ?>
                                            <option value=<?php echo $row['id'] ?>><?php echo  $row['name'] ?></option>
                                            <?php
                                        } ?>
                                        </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Edit
                                            Product</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>
<?php } } } ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />

        
        <!-- /. PAGE INNER  -->
    </div> 
    <!-- /. PAGE WRAPPER  -->
</div>
</div>
<?php include 'footer.php'; ?>
