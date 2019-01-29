<?php include 'inc/admin-header.php'; ?>
<?php include 'inc/admin-sidebar.php'; ?>

<?php if(!Session::get('userRole') == '0'){ 
    echo "<script>window.location = 'index.php'; </script>";
}
    ?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $fm->validation($_POST['username']);
            $password = $fm->validation(md5($_POST['password']));
            $role     = $fm->validation($_POST['role']);
            $email     = $fm->validation($_POST['email']);

            $username = mysqli_real_escape_string($db->link, $username);
            $password = mysqli_real_escape_string($db->link, $password);
            $role = mysqli_real_escape_string($db->link, $role);
            $email = mysqli_real_escape_string($db->link, $email);
            if(empty($username) || empty($password) || empty($role) || empty($email)){
                echo "<span class='error'>Field Must not be empty !</span>";
                }else{

                $mailquery = "select * from tbl_user where email = '$email' limit 1";
                $mailcheck = $db->select($mailquery);
                if($mailcheck != false ){
                    echo "<span class='error'>Email Already Exist !</span>";
                }else{
                $query ="INSERT INTO tbl_user(username, password, role, email) VALUES('$username', '$password', '$role', '$email') ";
                $catinsert = $db->insert($query);
                if($catinsert){
                    echo "<span class='success'>User Created Successfully !</span>";
                }else{
                    echo "<span class='error'>User NOT Created !</span>";
                }
            }
        }
    }
?>
         <form action="" method="post">
            <table class="form">                    
                <tr>
                    <td><label for=""> Username</label></td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label for=""> Password</label></td>
                    <td>
                        <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label for=""> Email</label></td>
                    <td>
                        <input type="text" name="email" placeholder="Enter valid Email Address..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label for=""> User Role</label></td>
                    <td>
                       <select name="role" id="select">
                           <option value="">Slect User Role</option>
                           <option value="0">Admin</option>
                           <option value="1">Author</option>
                           <option value="2">Editor</option>

                       </select>
                    </td>
                </tr>
                <tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/admin-footer.php'; ?>