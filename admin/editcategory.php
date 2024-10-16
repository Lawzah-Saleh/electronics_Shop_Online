﻿<?php
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
                                <i class="fa fa-plus-circle"></i> Edit Category
                            </div>
                           
                            
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                    if(isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                    {
                                        $id=$_GET['id'];
                                    "select*from categories where id=:catid";
                                     $stm = $con->prepare( "select*from categories where id=:catid");
                                     $stm->execute(array("catid"=>$id));
                                    if($stm->rowCount()) {
                                      
                                       foreach($stm->fetchAll() as $row)  {
                                        $id= $row['id']; 
                                        $name= $row['name'];
                                        $description= $row['description'];

                                           
                                      if(isset($_POST['addcategory']))
                                        {
                                            $id=$_POST['id'];
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
                                         $sql="update categories set name=? , description=? where id=?";
                                         $stm = $con->prepare($sql);
                                         $stm->execute(array($name , $description, $id));
                                          if($stm->rowCount())
                                          {
                                        echo "<script> 
                                        alert ('One Row updated');
                                        window.open('categories.php','_self');
                                        </script>" ;
                                         }
                                    
                                           else
                                          {
                                             echo "<div class='alert alert-danger'>Row Not updated</div>";
                                          }
                                          }
                            
                                       }
                            
                                    ?>
                                    <div class="col-md-12">
                                        <form role="form" method="post">
                                            <input type="hidden" name= "id" value="<?php echo $id?>">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " 
                                                    class="form-control" value="<?php echo $name?>" name="name" />
                                            <i style= "color:red;">
                                               <?php if(isset($errors['name'])) echo $errors['name'] ?>
                                               <?php if(isset($errors['namburname'])) echo $errors['namburname'] ?>
                                            </i>
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>

                                                <textarea placeholder="Please Enter Description" name="description" class="form-control"
                                                    cols="30" rows="3"><?php echo $description?></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="addcategory">Edit Category</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>

                                    <?php }}}?>
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

    <!-- /. WRAPPER  -->
    <?php
include('footer.php');
?>

