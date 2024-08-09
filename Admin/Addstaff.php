<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("./include/header.php");
include("./include/navbar.php");
include("./Database/connect.php");

// Fetch statuses
$adminStatusQuery = "SELECT `statusID`, `statusName` FROM `adminstatus`";
$adminStatusResult = mysqli_query($conn, $adminStatusQuery);

// Prepare response arrays
$adminStatus = [];

// Populate statuses
while ($row = mysqli_fetch_assoc($adminStatusResult)) {
    $adminStatus[] = $row;
}

mysqli_close($conn);
?>

<div class="container">
    <div class="input-group mb-3" id="search_model">
        <a href="#AddModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i><span>Add Staff</span></a>
    </div>
    <section class="user-details" style="max-height: 800px; overflow-y: auto;">
        <div class="attendance-user">
            <div class="text-center">
                <h2 class="static-header" style="background-color:#2D1D4C; color:white;">User Details</h2>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="background-color:#2D1D4C; color:white;">ID</th>
                        <th style="background-color:#2D1D4C; color:white;">First Name</th>
                        <th style="background-color:#2D1D4C; color:white;">Email</th>
                        <th style="background-color:#2D1D4C; color:white;">Role name</th>
                        <th style="background-color:#2D1D4C; color:white;">Status</th>
                        <th style="background-color:#2D1D4C; color:white;">Action</th>
                    </tr>
                </thead>
                <tbody id="user_data">
                    <!-- Data to be populated from the database using AJAX -->
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Delete Modal -->
<div id="deleteUserModel" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Delete Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete these Records?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>
                <input type="hidden" id="delete_id">
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-success w-20" data-dismiss="modal" value="Close">
                <input type="submit" class="btn btn-outline-danger" onclick="deleteUser()" value="Delete">
            </div>
        </div>
    </div>
</div>


<div id="ViewModal" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">View Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" id="view_Name" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" id="view_Email" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <input type="text" id="view_RoleID" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <input type="text" id="view_Status" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-danger w-20" data-dismiss="modal" value="Close">
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Update User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" id="edit_Name" class="form-control">
                    <input type="hidden" id="edit_userId" name="userId" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" id="edit_Email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <select class="form-control" id="edit_RoleID">
                        <option value="1">Admin</option>
                        <option value="2">Supervisor</option>
                        <option value="4">Employee</option>
                        <option value="3">user</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" id="edit_status">
                        <?php foreach ($adminStatus as $status) { ?>
                            <option value="<?php echo $status['statusID']; ?>"><?php echo $status['statusName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-outline-danger w-20" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-success" onclick="updateUser()" value="Save">
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="AddModal" class="modal fade" style="z-index:1100">
    <div class="modal-dialog">
        <div class="modal-content" id="cont">
            <div class="modal-header">
                <h4 class="modal-title">Add Staff</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>First Name:</label>
                    <input type="text" id="Name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" id="Email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Role:</label>
                    <select class="form-control" id="RoleID">
                        <option value="" selected>Select RoleName</option>
                        <option value="1">Admin</option>
                        <option value="2">Supervisor</option>
                        <option value="4">Employee</option>
                        <option value="3">user</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select class="form-control" id="status">
                        <option value="" selected>Select Status</option>
                        <?php foreach ($adminStatus as $status) { ?>
                            <option value="<?php echo $status['statusID']; ?>"><?php echo $status['statusName']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-danger w-20" data-dismiss="modal" value="Close">
                <input type="button" class="btn btn-outline-success" onclick="addStaff()" value="Save">
            </div>
        </div>
    </div>
</div>

<style>
    #cont {
        width: 400px;
    }
</style>

<?php
include("./include/footer.php");
?>



<script>
    // Fetch and display users in the table
function loadUsers() {
    $.ajax({
        url: 'fetch_users.php',
        method: 'GET',
        success: function(response) {
            $('#user_data').html(response);
        }
    });
}
  

function addStaff() {
        var Name = $('#Name').val();
        var Email = $('#Email').val();
        var Position = $('#RoleID').val();
        var status = $('#status').val();

        $.ajax({
            type: 'post',
            data: {
                Name: Name,
                Email: Email,
                Position: Position,
                status: status,
            },
            url: "./AddstaffData.php",
            success: function (data) {
                var response = JSON.parse(data);
                Swal.fire({
                    title: response.success ? 'Success' : 'Error',
                    text: response.message,
                    icon: response.success ? 'success' : 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'swal-custom-container',
                    },
                });
                if (response.success) {
                    location.reload();
                    $('#AddModal').modal('hide');
                    clearFields();
                    UserList(); 
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });

        function clearFields() {
            $('#Name').val('');
            $('#Email').val('');
            $('#RoleID').val('');
            $('#status').val('');
        }
    }


// Fetch user details for viewing
function viewUser(id) {
    $.ajax({
        url: 'get_user.php',
        method: 'GET',
        data: { id: id }, 
        success: function(response) {
            const user = JSON.parse(response);
            $('#view_Name').val(user.Username);
            $('#view_Email').val(user.Email);
            $('#view_RoleID').val(user.RoleName);
            $('#view_Status').val(user.statusName);
            $('#ViewModal').modal('show');
        }
    });
}

function editUser(id) {
    $.ajax({
        url: 'get_user.php',
        method: 'GET',
        data: { id },
        success: function(response) {
            const user = JSON.parse(response);
            $('#edit_userId').val(user.AdminUserID); 
            $('#edit_Name').val(user.Username);
            $('#edit_Email').val(user.Email);
            $('#edit_RoleID').val(user.RoleID);
            $('#edit_status').val(user.statusID);
            $('#editModal').modal('show');
        }
    });
}


// function here us to update systema admins
function updateUser() {
    const id = $('#edit_userId').val();  
    const name = $('#edit_Name').val();
    const email = $('#edit_Email').val();
    const roleID = $('#edit_RoleID').val();
    const statusID = $('#edit_status').val();

    if (!id) {
        Swal.fire('Error', 'Missing user ID', 'error');
        return;
    }

    $.ajax({
        url: 'update_user.php',
        method: 'POST',
        data: { id, name, email, roleID, statusID },
        success: function(response) {
            try {
                const result = JSON.parse(response);
                if (result.error) {
                    Swal.fire('Error', result.error, 'error');
                } else {
                    Swal.fire('Success', result, 'success');
                    $('#editModal').modal('hide');
                    loadUsers();  
                }
            } catch (e) {
                // If response is plain text
                Swal.fire('Success', response, 'success');
                $('#editModal').modal('hide');
                loadUsers();
            }
        },
        error: function() {
            Swal.fire('Error', 'Failed to update user', 'error');
        }
    });
}






// Delete user
function deleteUser() {
    const id = $('#delete_id').val();

    $.ajax({
        url: './DeleteUserData.php',
        method: 'POST',
        data: { id: id }, 
        success: function(response) {
            Swal.fire('Deleted', 'User has been deleted', 'success');
            $('#deleteUserModel').modal('hide');
            loadUsers();
        },
        error: function() {
            Swal.fire('Error', 'Failed to delete user', 'error');
        }
    });
}

// Load users on page load
$(document).ready(function() {
    loadUsers();
});

</script>