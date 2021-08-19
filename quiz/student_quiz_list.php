
<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>My Quiz List</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">My Quiz List</div>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="30%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Quiz</th>
							<th>Score</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT * from  quiz_list where id in  (SELECT quiz_id FROM quiz_student_list where user_id ='".$_SESSION['login_id']."' ) order by title asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
							$status = $conn->query("SELECT * from history where quiz_id = '".$row['id']."' and user_id ='".$_SESSION['login_id']."' ");
							$hist = $status->fetch_array();
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['title'] ?></td>
						<td><?php echo $status->num_rows > 0 ? $hist['score'].'/'.$hist['total_score'] : 'N/A' ?></td>
						<td><?php echo $status->num_rows > 0 ? 'Taken' : 'Pending' ?></td>
						<td>
							<center>
							 	<?php if($status->num_rows <= 0): ?>
							 	<a class="btn btn-sm btn-outline-primary" href="./answer_sheet.php?id=<?php echo $row['id']?>"><i class="fa fa-pencil"></i> Take Quiz</a>
								<?php else: ?>
								<a class="btn btn-sm btn-outline-primary" href="./view_answer.php?id=<?php echo $row['id']?>"><i class="fa fa-eye"></i> View</a>
							<?php endif; ?>
							</center>
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
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('#new_faculty').click(function(){
			$('#msg').html('')
			$('#manage_faculty .modal-title').html('Add New Faculty')
			$('#manage_faculty #faculty-frm').get(0).reset()
			$('#manage_faculty').modal('show')
		})
		$('.edit_faculty').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="uid"]').val(resp.uid)
						$('[name="name"]').val(resp.name)
						$('[name="subject"]').val(resp.subject)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('#manage_faculty .modal-title').html('Edit Faculty')
						$('#manage_faculty').modal('show')

					}
				}
			})

		})
		$('.remove_faculty').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_faculty.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#faculty-frm').submit(function(e){
			e.preventDefault();
			$('#faculty-frm [name="submit"]').attr('disabled',true)
			$('#faculty-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_faculty.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#faculty-frm [name="submit"]').removeAttr('disabled')
					$('#faculty-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('Data successfully saved');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})
</script>
</html>