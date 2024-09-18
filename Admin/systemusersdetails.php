<?php
include('include/header.php');
include('include/navbar.php');

?>







<div class="container">

<div class="input-group mb-3" id="search_model">
    <input type="text" id="search_field" class="form-control" placeholder="Search for..." id="searchText"
                name="valueToSearch" style="margin-right: 10px;">
                <a href="#AddModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Add Staff</span></a>
</div>
<section class="user-details" style="max-height: 800px; overflow-y: auto;" >
    <div class="attendance-user">
        <div class="text-center">
            <h2 class="static-header" style="background-color:#2D1D4C; color:white;">Administrators Details</h2>
        </div>
        <table class="table table-bordered table-striped ">
            <thead>
                <tr>
                    <th style="background-color:#2D1D4C; color:white;">ID</th>
                    <th style="background-color:#2D1D4C; color:white;">First Name</th>
                    <th style="background-color:#2D1D4C; color:white;">Email</th>
                    <th style="background-color:#2D1D4C; color:white;">Position name</th>
                    <th style="background-color:#2D1D4C; color:white;">Phone Number</th>
                    <th style="background-color:#2D1D4C; color:white;">Status</th>
                    <th style="background-color:#2D1D4C; color:white;">Action</th>
                </tr>
            </thead>
            <tbody id="user_data">
               
            </tbody>
        </table>
    </div>
</section>
</div>
<!-- Delete Modal -->
 <div id="deleteUserModel" class="modal fade" style="z-index:1100" >
        <div class="modal-dialog" >
            <div class="modal-content" id="cont">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete these Records?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <input type="hidden" id="delete_id">
                <div class="modal-footer">
                    <input type="button"  class="btn btn-outline-success w-20" data-dismiss="modal" value="close">
                    <input type="submit" class="btn btn-outline-danger" onclick="deleteuser()" value="Delete">
                </div>
            </div>
        </div>
    </div>


<!-- view Modal -->
<div id="ViewModal" class="modal fade" style="z-index:1100">
    <div class="modal-dialog" >
    <div class="modal-content" id="cont">
        <div class="modal-header">
                <h4 class="modal-title">View detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
        </div>

        <div class="modal-body">
           <div class="form-group">
            <label >First Name:</label>
            <input type="text" id="Name"  class="form-control" readonly>
            <input type="text" id="userId"  hidden readonly class="form-control">
           </div>
           
       
           <div class="form-group">
            <label >New Email:</label>
            <input type="email" id="Email"  class="form-control" readonly>
           </div>
        
           <div class="form-group">
            <label >Position :</label>
            <input type="text" id="PositionID"  class="form-control" readonly>
            </div>

            <div class="form-group">
            <label >Status ID:</label>
            <input type="text" id="Status"  class="form-control" readonly>
            </div>

            <div class="form-group">
            <label > Phone Number:</label>
            <input type="tel" id="PhoneNumber"  class="form-control" readonly>
            </div>

            <div class="modal-footer">
                <input type="button"  class="btn btn-outline-danger w-20" data-dismiss="modal" value="close">
            </div>
      </div>
    </div>
    </div>
</div>





<!-- Edit Modal -->
<div id="editModal" class="modal fade" style="z-index:1100">
<div class="modal-dialog " >
    <div class="modal-content" id="cont">
       <div class="modal-header">
                <h4 class="modal-title">Update user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
        </div>

        <div class="modal-body">

            <div class="form-group">
            <label >First Name:</label>
            <input type="text" id="Name"  class="form-control">
            <input type="text" id="userId"  hidden  class="form-control">
           </div>
           
            <div class="form-group">
            <label >Email:</label>
            <input type="email" id="Email"  class="form-control">
           </div>
        
           <div class="form-group">
            <label >Position ID:</label>
            
            <div class="form-group">
            <label >Phone Number:</label>
            <input type="tel" id="PhoneNumber"  class="form-control">
            </div>

             <select class="form-control" id="PositionID">
                    <option value="" selected>Select Position</option>
                    <?php foreach ($Positions as $id => $pos) { ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $Selectedposition) echo "selected"; ?>>
                        <?php echo $pos; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
            <label >Status:</label>
            <select class="form-control" id="status">
                    <option value="" selected>Select status</option>
                    <?php foreach ($Statuses as $id => $stat) { ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $SelectedStatus) echo "selected"; ?>>
                        <?php echo $stat; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-footer">
                    <input type="button"  class="btn btn-outline-danger w-20" data-dismiss="modal" value="close">
                    <input type="submit" class="btn btn-outline-success" onclick="edituser()" value="Save">
            </div>
      </div>
    </div>
    </div>
</div>


<!-- Add Modal -->
<div id="AddModal" class="modal fade" style="z-index:1100">
    <div class="modal-dialog" id="cont">
    <div class="modal-content" id="cont">
        <div class="modal-header">
                <h4 class="modal-title">Add stuff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
            </div>
        <div class="modal-body ">
            <div class="form-group">
                <label >First Name:</label>
                <input type="text" id="Name"  class="form-control" >
            </div>
           
       
           <div class="form-group">
            <label >Email:</label>
            <input type="email" id="Email"  class="form-control" >
           </div>
        
            <div class="form-group">
            <label >Phone Number:</label>
            <input type="tel" id="PhoneNumber"  class="form-control" >
            </div>

            <div class="form-group">
            <label >Position ID:</label>
            <select class="form-control" id="PositionID">
                    <option value="" selected>Select Position</option>
                    <?php foreach ($Positions as $id => $pos) { ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $Selectedposition) echo "selected"; ?>>
                        <?php echo $pos; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
            <label >Status:</label>
            <select class="form-control" id="status">
                    <option value="" selected>Select status</option>
                    <?php foreach ($Statuses as $id => $stat) { ?>
                    <option value="<?php echo $id; ?>" <?php if ($id == $SelectedStatus) echo "selected"; ?>>
                        <?php echo $stat; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="modal-footer">
                    <input type="button"  class="btn btn-danger w-20" data-dismiss="modal" value="close">
                    <input type="submit" class="btn btn-outline-success" onclick="addStaff()" value="Save">
            </div>
      </div>
      </div>
    </div>
</div>
</div>
  <!-- chat icon -->
<a href="#" class="float">
    <img src="./images/chat.png" class="my-float" ></i>
</a>


<style>
    #cont{
        width: 400px;
    }
</style>


<?php
include('include/footer.php');
include('include/script.php');
?>
