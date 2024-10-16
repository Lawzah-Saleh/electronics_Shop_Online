﻿<?php
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
                        <i class="fa fa-plus-circle"></i> Add New Porduct
                    </div>
                    <?php if(isset($_POST['submitProduct'])) 
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
                           $extensions=array('jpg','gif','png' ,'jpeg');
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
                                    $sql="INSERT INTO products(name,description,image,price,cat_id) VALUES (?,?,?,?,?) " ;
                                    $stm = $con->prepare($sql);
                                    $stm->execute(array($name , $description ,$image_name ,$price ,$cat_id ));
                                    if ($stm->rowCount()) {
                                        echo "<div class='alert alert-success'>Row Inserted</div>" ;
                                    } else {
                                        echo "<div class='alert alert-danger'>Row Not Inserted</div>" ;
                                    }
                                }
                                else 
                                {
                                    echo "<div class='alert alert-danger'>Not upload file</div>";
                                }
                            
                            }

                      
                        }
                        ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form role="form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name "
                                            class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file">
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" name="price" placeholder="Please Enter Product Price "
                                            class="form-control" />
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
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Add
                                            Product</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                            </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-task"></i> Products
                    </div>
                    <?php 
                    if(isset($_GET['action'],$_GET['id'])){
                        $id = $_GET['id'];
                        if($_GET['action']=="delete"){
                            $stm = $con->prepare("delete from products where id=:prodid");
                            $stm->execute(array("prodid"=>$id));
                            if($stm->rowCount()==1){
                                echo "<div class='alert alert-success'>Row Deleted</div>" ;
                            }
                        }
                    }
                    
                    
                    ?>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Type</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="select * from products " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                            foreach ($stm->fetchAll() as $row) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                                $description = $row['description'];
                                                $image = $row['image'];
                                                $price = $row['price'];
                                                $cat_id = $row['cat_id'];
                                                ?>
                                    <tr class="odd gradeX">
                                    <td><?php echo $row['id'];  ?></td>
                                    <td><?php echo $row['name'];  ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><img src="upload/<?php echo $row['image'] ?>" width="40px"></td>
                                    <td><?php echo $row['price']."$";  ?></td>
                                    <td><?php 
                                            $sql="select * from categories where id=:cat_id" ;
                                            $stm = $con->prepare($sql);
                                            $stm->execute(array("cat_id"=>$row['cat_id']));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>
                                    </td>
                                    <td>
                                        <a href="editproducts.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                        <a href="?action=delete&id=<?php echo $id?>" class='btn btn-danger' id="delete" onClick="return confirm('Are You Sure !!');"  >Delete</a>
                                    </td>
                                    </tr>
                                    <?php
                                            }}  ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->

            </div>
            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>
<?php include 'footer.php'; ?>

<!-- <script>
    $('#delete').click(function () {
        return confirm('Are You Sure !!');
    });
</script> -->