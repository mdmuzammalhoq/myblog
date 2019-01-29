<?php include 'inc/admin-header.php'; ?>
<?php include 'inc/admin-sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
    <?php 
    	if(isset($_GET['deluser'])){
    		$delid = $_GET['deluser'];
    		$delquery = "delete from tbl_user where id='$delid'";
    		$deldata = $db->delete($delquery);
    		 if($deldata){
                    echo "<span class='sucess'>User Deleted Successfully !</span>";
                }else{
                    echo "<span class='error'>User NOT Deleted !</span>";
                }

    	}
    ?>    
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>username</th>
					<th>Email</th>
					<th>Detail</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from tbl_user order by id desc";
				$alluser = $db->select($query);
				if($alluser){
					$i = 0; 
					while($result= $alluser-> fetch_assoc()){
						$i++;
				
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['username']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['detail'], 30); ?>
						
					</td>
					<td>

					<?php 
						if($result['role'] == '0'){
							echo "Admin";
						}elseif($result['role'] == '1'){
							echo "Author";
						}elseif($result['role'] == '2'){
							echo "Editor";
						}
					 ?>
						
					</td>

					<td><a href="viewuser.php?userid=<?php echo $result['id'];?>">View</a> 

					<?php if(Session::get('userRole') == '0'){ ?>
					|| <a onclick ="
					return confirm('Are You Sure To DELETE !!!'); " href="?deluser=<?php echo $result['id'];?>">Delete</a></td>
					<?php } ?>
				</tr>
		<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
    
<?php include 'inc/admin-footer.php'; ?>


    