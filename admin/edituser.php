<?php
include('header.php');
require('dbconnect.php');
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-items"></i>Users</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Edit user
                    </div>
                  
                    <div class="panel-body">
                        <div class="row">

                        <?php 
                        if(isset($_GET['action'],$_GET['id'])&& $_GET['action']=='edit')
                        {
                            $id = $_GET['id'];
                            $stm = $con->prepare("select * from users where id=:userid");
                            $stm->execute(array("userid"=>$id));
                            if($stm->rowCount())
                             {
                                foreach ($stm->fetchAll() as $row) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $email = $row['email'];
                                    $image = $row['image'];
                                    $password = $row['password'];
                                    $phone = $row['phone'];
                                    $role_id = $row['role_id'];

                                    if(isset($_POST['submituser'])) 
                                    { 
                                       $name =trim($_POST['name']);
                                       $email =trim($_POST['email']);
                                       $image = $_FILES['file'];
                                       $password =$_POST['password'];
                                       $phone =$_POST['phone'];
                                       $role_id =$_POST['role_id'];
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
                                                $sql="update users set name=?, email=? , image=? ,password=?, phone=?, role_id=? where id =?" ;
                                                $stm = $con->prepare($sql);
                                                $stm->execute(array($name , $email ,$image_name ,$password ,$phone ,$role_id ,$id)); 
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
                                        <label>email</label>
                                        <textarea placeholder="Please Enter email" name="email"
                                            class="form-control" cols="30" rows="3"><?php echo $email ?></textarea>
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
                                        <label>password</label>
                                        <textarea placeholder="Please Enter password" name="password"
                                            class="form-control" cols="30" rows="3"><?php echo $password ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>phone number</label>
                                        <input type="text" name="phone" placeholder="Please Enter Product phone "
                                            class="form-control" value="<?php echo $phone ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>user Type</label>
                                        <select class="form-control" name="role_id">
                                            <?php    
                                        $sql="select * from roles " ;
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
                                        <button type="submit" name="submituser" class="btn btn-primary">Edit
                                            User</button>
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
