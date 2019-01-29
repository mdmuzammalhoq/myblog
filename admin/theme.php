<?php include 'inc/admin-header.php'; ?>
<?php include 'inc/admin-sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Themes</h2>
               <div class="block copyblock"> 
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $theme = $_POST['theme'];
            $theme = mysqli_real_escape_string($db->link, $theme);
          
                $query ="UPDATE tbl_theme 

                        SET 

                        theme = '$theme'

                        WHERE id='1' ";
                $updated_row = $db->update($query);
                if($updated_row){
                    echo "<span class='success'>Theme updated Successfully !</span>";
                }else{
                    echo "<span class='error'>Theme NOT updated !</span>";
                }
            
        }
?>
<?php 
    $query = "select * from tbl_theme where id = '1' ";
    $theme = $db->select($query);
        while($result = $theme -> fetch_assoc()){

?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="radio" <?php if($result['theme'] == 'default'){echo "checked"; } ?> name="theme" value="default" />Default
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="radio" <?php if($result['theme'] == 'green'){echo "checked"; } ?> name="theme" value="green" />Green
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="radio" <?php if($result['theme'] == 'yellow'){echo "checked"; } ?>  name="theme" value="yellow" />Yellow
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input type="radio" <?php if($result['theme'] == 'purple'){echo "checked"; } ?>  name="theme" value="purple" />Purple
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                    </form>
               <?php  } ?>
                </div>
            </div>
        </div>
<?php include 'inc/admin-footer.php'; ?>