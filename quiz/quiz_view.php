<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<title>Quiz List</title>

	<?php 
	$qry = $conn->query("SELECT * FROM quiz_list where id = ".$_GET['id'])->fetch_array();

	?>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary"><?php echo $qry['title'] ?></div>
		<button class="btn btn-primary bt-sm" id="new_question"><i class="fa fa-plus"></i>	Add Question</button>
		<button class="btn btn-primary bt-sm" id="new_student"><i class="fa fa-plus"></i>	Add Student</button>
		<br>
		<br>
		<div class="card col-md-6 mr-4" style="float:left">
			<div class="card-header">
				Questions
			</div>
			<div class="card-body">
				<ul class="list-group">
				<?php
					$qry = $conn->query("SELECT * FROM questions where qid = ".$_GET['id']." order by order_by asc");
					while($row=$qry->fetch_array()){
						?>
						<li class="list-group-item"><?php echo $row['question'] ?><br>
							<center>
								 <button class="btn btn-sm btn-outline-primary edit_question" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i></button>
								<button class="btn btn-sm btn-outline-danger remove_question" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i></button>
							</center>
						</li>
				<?php
					}
				?>
				</ul>
		</div>
	</div>
	<div class="card col-md-5" style="float:left">
			<div class="card-header">
				Students
			</div>
			<div class="card-body">
				<ul class="list-group">
				<?php
					$qry = $conn->query("SELECT u.*,q.id as qid FROM users u left join quiz_student_list q on u.id = q.user_id where q.quiz_id = ".$_GET['id']." order by u.name asc");
					while($row=$qry->fetch_array()){
						?>
						<li class="list-group-item"><?php echo ucwords($row['name']) ?>
								<button class="btn btn-sm btn-outline-danger remove_student pull-right" data-id="<?php echo $row['id']?>" data-qid='<?php echo $row['qid'] ?>' type="button"><i class="fa fa-trash"></i></button>
						</li>
				<?php
					}
				?>
				</ul>
		</div>
	</div>
	<div class="modal fade" id="manage_question" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New Question</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='question-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>Question</label>
									<input type="hidden" name="qid" value="<?php echo $_GET['id'] ?>" />
									<input type="hidden" name="id" />
									<textarea rows='3' name="question" required="required" class="form-control" ></textarea>
								</div>
									<label>Options:</label>

								<div class="form-group">
									<textarea rows="2" name ="question_opt[0]" required="" class="form-control" ></textarea>
									<span>
									<label><input type="radio" name="is_right[0]" class="is_right" value="1"> <small>Question Answer</small></label>
									</span>
									<br>
									<textarea rows="2" name ="question_opt[1]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[1]" class="is_right" value="1"> <small>Question Answer</small></label>
									<br>
									<textarea rows="2" name ="question_opt[2]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[2]" class="is_right" value="1"> <small>Question Answer</small></label>
									<br>
									<textarea rows="2" name ="question_opt[3]" required="" class="form-control" ></textarea>
									<label><input type="radio" name="is_right[3]" class="is_right" value="1"> <small>Question Answer</small></label>
								</div>
								
							</div>
							<div class="modal-footer">
								<button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade" id="manage_student" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New Student/s</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='student-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>Student/s</label>
									<br>
									<input type="hidden" name="qid" value="<?php echo $_GET['id'] ?>" />
									<select rows='3' name="user_id[]" required="required" multiple class="form-control select2" style="width: 100% !important">
									<?php 
									$student = $conn->query('SELECT u.*,s.level_section as ls FROM users u left join students s on u.id = s.user_id where u.user_type = 3 ');
									while($row=$student->fetch_assoc()){

									?>	
									<option value="<?php echo $row['id'] ?>"><?php echo ucwords($row['name']).' '.$row['ls'] ?></option>
								<?php } ?>
								</select>

									</select>
								</div>
								
								
							</div>
							<div class="modal-footer">
								<button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
<script>
	$(document).ready(function(){
		$(".select2").select2({
			placeholder:"Select here",
			width:'resolve'
		});
		$('#table').DataTable();
		$('#new_question').click(function(){
			$('#msg').html('')
			$('#manage_question .modal-title').html('Add New Question')
			$('#manage_question #question-frm').get(0).reset()
			$('#manage_question').modal('show')
		})
		$('#new_student').click(function(){
			$('#msg').html('')
			$('#manage_student').modal('show')
		})
		$('.edit_question').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./get_question.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						$('[name="id"]').val(resp.qdata.id)
						$('[name="question"]').val(resp.qdata.question)
						Object.keys(resp.odata).map(k=>{
							var data = resp.odata[k]
							$('[name="question_opt['+k+']"]').val(data.option_txt);
							if(data.is_right == 1)
							$('[name="is_right['+k+']"]').prop('checked',true);
						})
						$('#manage_question .modal-title').html('Edit Question')
						$('#manage_question').modal('show')

					}
				}
			})

		})
		$('.is_right').each(function(){
			$(this).click(function(){
				$('.is_right').prop('checked',false);
				$(this).prop('checked',true);
			})
		})
		$('.remove_question').click(function(){
			var id = $(this).attr('data-id')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_question.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('.remove_student').click(function(){
			var qid = $(this).attr('data-qid')
			var conf = confirm('Are you sure to delete this data.');
			if(conf == true){
				$.ajax({
				url:'./delete_quiz_student.php?qid='+qid,
				error:err=>console.log(err),
				success:function(resp){
					if(resp == true)
						location.reload()
				}
			})
			}
		})
		$('#question-frm').submit(function(e){
			e.preventDefault();
			$('#question-frm [name="submit"]').attr('disabled',true)
			$('#question-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_question.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#quiz-frm [name="submit"]').removeAttr('disabled')
					$('#quiz-frm [name="submit"]').html('Save')
				},
				success:function(resp){
						if(resp == 1){
							alert('Data successfully saved');
							location.reload()
						}
				}
			})
		})
		$('#student-frm').submit(function(e){
			e.preventDefault();
			$('#student-frm [name="submit"]').attr('disabled',true)
			$('#student-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./quiz_student.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#quiz-frm [name="submit"]').removeAttr('disabled')
					$('#quiz-frm [name="submit"]').html('Save')
				},
				success:function(resp){
						if(resp == 1){
							alert('Data successfully saved');
							location.reload()
						}
				}
			})
		})
	})
</script>
</html>