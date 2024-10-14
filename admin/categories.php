<?php
include('header.php');
require('dbconnect.php');
?>
        
        
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> Categories</h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New Category
                            </div>
                            <?php
                            if(isset($_POST['addcategory']))
                            {
                                $name =trim($_POST['name']);
                                $description =trim($_POST['description']);

                                $errors=array();

                                if(is_numeric($name)){
                                 $errors['name']= "Name Must Be String" ; 
                                }
                               elseif(empty($name)){
                                    $errors['name']= "<div style='color:red'>Enter Name Of Category</div>" ; 
                                       }
                                     

                                else{
                                    $sql="INSERT INTO categories(name, description) VALUES(? , ?)";
                                    $stm = $con->prepare($sql);
                                    $stm->execute(array($name , $description));
                                    if($stm->rowCount())
                                    {
                                        echo "<div class='alert alert-success'>Row Inserted</div>";
                                    }
                                    
                                    else
                                    {
                                        echo "<div class='alert alert-danger'>Row Not Inserted</div>";
                                    }
                                }
                            
                            }
                            ?>
                            <div class="panel-body">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <form role="form" method="post">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " name="name"
                                                    class="form-control" require/>
                                            <i style= "color:red;">
                                               <?php if(isset($errors['name'])) echo $errors['name']
                                               ?>
                                            </i>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>

                                                <textarea placeholder="Please Enter Description" name="description" class="form-control"
                                                    cols="30" rows="3"></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="addcategory">Add Category</button>
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
                                <i class="fa fa-tasks"></i> Categories
                            </div>
                            <?php
                            if(isset($_GET['action'],$_GET['id']))
                            {
                                $id= $_GET['id'];

                                switch($_GET['action'])
                                {
                                    case "delete":

                                        $stm = $con->prepare("delete from categories where id=:catid");
                                        $stm->execute(array("catid"=>$id));
                                        if($stm->rowCount()==1){
                                           echo "<div class= 'alert alert-success'> One Row Dleted </div> ";
                                        }
                                        break;

                                        default:
                                        echo "ERROR";
                                }
                            }
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                         $sql="select*from categories";
                                         $stm = $con->prepare($sql);
                                         $stm->execute();
                                        if($stm->rowCount()) {
                                           foreach($stm->fetchAll() as $row)  {
                                            $id= $row['id']; 
                                            $name= $row['name'];
                                            $description= $row['description'];
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $id ?></td>
                                                <td><?php  echo $name?></td>
                                                <td><?php echo $description?></td>
                                                <td>
                                                    <a href="editcategory.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                                    <a href="?action=delete&id=<?php echo $id?>" class='btn btn-danger' id="delete" onClick="return confirm('Are You Sure !!');"  >Delete</a>
                                                </td>
                                            </tr>
                                           <?php
                                             }
                                            }
                                           ?>
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

    <!-- /. WRAPPER  -->
    <?php
include('footer.php');
?>

<!-- <script>
   $('#delete').click(function(){
    return confirm ('Are You Sure !!');
   });
</script> -->