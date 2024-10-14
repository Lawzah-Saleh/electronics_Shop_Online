<?php
include('header.php');
require('dbconnect.php');
?>
        
<!-- HERE are how change whta ia display in the website about us  -->       
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> About us </h2>


                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <?php
                                   
                                     $stm = $con->prepare( "select * from about where id =1");
                                     $stm->execute();
                                    if($stm->rowCount()) {
                                      
                                       foreach($stm->fetchAll() as $row)  {
                                        $id= $row['id']; 
                                        $story= $row['story'];

                                           $errors=array();
                                           if(is_numeric($story)){
                                            $errors['story']= "Name Must Be String" ; 
                                           }
                                          elseif(empty($story)){
                                               $errors['story']= "<div style='color:red'>write some thing </div>" ; 
                                                  }
                                                
           
                                        if(isset($_POST['edit']))
                                        {
                                            $id=$_POST['id'];
                                           $story =trim($_POST['story']);

                                         $sql="update about set story=? where id=1";
                                         $stm = $con->prepare($sql);
                                         $stm->execute(array($story));
                                          if($stm->rowCount())
                                          {
                                        echo "<script> 
                                        alert ('One Row updated');
                                        window.open('about.php','_self');
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
                                                <label>about us </label>

                                                <textarea placeholder="Please Write Anything " name="story" class="form-control"
                                                    cols="30" rows="4"><?php echo $story?></textarea>
                                            </div>
                                            <i style= "color:red;">
                                               <?php if(isset($errors['story'])) echo $errors['story'] ?>
                                               <?php if(isset($errors['story'])) echo $errors['story'] ?>
                                            </i>
                       

                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>

                                    <?php }?>
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
