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
                        <i class="fa fa-plus-circle"></i> Add New user
                    </div>
                    <?php if(isset($_POST['submitProduct'])) 
                        { 
                           $name =trim($_POST['name']);
                           $email =trim($_POST['email']);
                           $password =$_POST['password'];
                           $role_id =$_POST['role_id'];
                           $phone =$_POST['phone'];
                           $image = $_FILES['file'];
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
                                    $sql="INSERT INTO users( name, email ,phone, image, password, role_id) VALUES (?,?,?,?,?,?)" ;
                                    $stm = $con->prepare($sql);
                                    $stm->execute(array($name , $email ,$phone ,$image_name,$password ,$role_id ));
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
                                        <label>email</label>
                                        <textarea placeholder="Please Enter Description" name="email"
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
                                        <label>password</label>
                                        <input type="text" name="password" placeholder="Please Enter Product Price "
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>phone</label>
                                        <input type="text" name="phone" placeholder="Please Enter phone number "
                                            class="form-control" />
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
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Add
                                            user</button>
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
                        <i class="fa fa-task"></i> Users
                    </div>
                    <?php
                            if(isset($_GET['action'],$_GET['id']))
                            {
                                $id= $_GET['id'];

                                switch($_GET['action'])
                                {
                                    case "delete":

                                        $stm = $con->prepare("delete from users where id=:userid");
                                        $stm->execute(array("userid"=>$id));
                                        if($stm->rowCount()==1){
                                           echo "<div class= 'alert alert-success'> One Row Dleted </div> ";
                                        }
                                        break;
                                         
                                        case "active":

                                            $stm = $con->prepare("UPDATE users SET active =1 WHERE  id=:userid");
                                            $stm->execute(array("userid"=>$id));
                                           
                                            
                                               echo "<div class= 'alert alert-success'> One Row update </div> ";
                                            
                                            break;

                                            case "inactive":

                                                $stm = $con->prepare("UPDATE users SET active =0 WHERE  id=:userid");
                                                $stm->execute(array("userid"=>$id));
                                               
                                                
                                                   echo "<div class= 'alert alert-success'> One Row update </div> ";
                                                
                                                break;
                                        default:
                                        echo "ERROR";
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
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Password</th>
                                        <th>Type</th>
                                        <th>Active</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="select * from users " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                            foreach ($stm->fetchAll() as $row) {
                                                $id = $row['id'];
                                                $name = $row['name'];
                                                $email = $row['email'];
                                                $image = $row['image'];
                                                $password = $row['password'];
                                                $role_id = $row['role_id'];
                                                $active = $row['active'];
                                                ?>
                                    <tr class="odd gradeX">
                                    <td><?php echo $row['id'];  ?></td>
                                    <td><?php echo $row['name'];  ?></td>
                                    <td><?php echo  $row['email']; ?></td>
                                    <td><img src="upload/<?php echo $row['image'] ?>" width="40px"></td>
                                    <td><?php echo $row['password'];  ?></td>
                                    <td>
                                        <?php 
                                            $sql="select * from roles where id=:role_id" ;
                                            $stm = $con->prepare($sql);
                                            $stm->execute(array("role_id"=>$row['role_id']));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>
                                    </td>
                                    <td><?php echo $row['active']; ?></td>

                                    <td>
                                        <a href="edituser.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                        <a href="?action=delete&id=<?php echo $id?>" class='btn btn-danger' id="delete" onClick="return confirm('Are You Sure !!');"  >Delete</a>
                                        <a href="?action=active&id=<?php echo $id ?>" class='btn btn-danger' id="active">Active</a>
                                        <a href="?action=inactive&id=<?php echo $id ?>" class='btn btn-danger' id="active">InActive</a>
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