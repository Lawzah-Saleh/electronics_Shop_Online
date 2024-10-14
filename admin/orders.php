<?php
include('header.php');
require('dbconnect.php');
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-items"></i>order</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-task"></i> orders
                    </div>
                    <?php 
                    if(isset($_GET['action'],$_GET['id'])){
                        $id = $_GET['id'];
                        if($_GET['action']=="delete"){
                            $stm = $con->prepare("delete from orders where id=:prodid");
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
                                        <th>Image</th>
                                        <th>quantity</th>
                                        <th>price</th>
                                        <th>total_Price</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="select * from cart " ;
                                        $stm = $con->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                            foreach ($stm->fetchAll() as $row) {
                                               
                                                ?>
                                    <tr class="odd gradeX">
                                    <td><?php echo $row['id'];  ?></td>
                                    <td><?php echo $row['name'];  ?></td>
                                    <td><img src="upload/<?php echo $row['image'] ?>" width="40px"></td>
                                    <td><?php echo   $row['quantity']; ?></td>
                                    <td><?php echo $row['price']."$";  ?></td>
                                    <td>$<?php echo $row = number_format($row['price'] * $row['quantity']); ?></td>

                                    <td>
                                        <a href="editproducts.php?action=edit&id=<?php echo $id ?>" class='btn btn-success'>Edit</a>
                                        <a href="?action=delete&id=<?php echo $id ?>" class='btn btn-danger' id="delete">Delete</a>
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

<script>
    $('#delete').click(function () {
        return confirm('Are You Sure !!');
    });
</script>