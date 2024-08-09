<?php
include("./Database/connect.php");

$query = "SELECT adminusers.AdminUserID, adminusers.Username, adminusers.Email, roles.RoleName, adminstatus.statusName 
          FROM adminusers 
          JOIN roles ON adminusers.RoleID = roles.RoleID 
          JOIN adminstatus ON adminusers.statusID = adminstatus.statusID";

$result = mysqli_query($conn, $query);

$output = '';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
    <tr>
        <td>' . $row['AdminUserID'] . '</td>
        <td>' . $row['Username'] . '</td>
        <td>' . $row['Email'] . '</td>
        <td>' . $row['RoleName'] . '</td>
        <td>' . $row['statusName'] . '</td>
        <td>
            <button onclick="viewUser(' . $row['AdminUserID'] . ')" class="btn btn-info">View</button>
            <button onclick="editUser(' . $row['AdminUserID'] . ')" class="btn btn-warning">Edit</button>
            <button onclick="$(\'#delete_id\').val(' . $row['AdminUserID'] . '); $(\'#deleteUserModel\').modal(\'show\');" class="btn btn-danger">Delete</button>
        </td>
    </tr>';
}

echo $output;

mysqli_close($conn);
?>
