
<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<?php 
	$quiz = $conn->query("SELECT * FROM quiz_list where id =".$_GET['id']." order by RAND()")->fetch_array();
	?>
	<title><?php echo $quiz['title'] ?> | Answer Sheet</title>
</head>
<body>
	<style>
		li.answer{
			cursor: pointer;
		}
		li.answer:hover{
			background: #00c4ff3d;
		}
		li.answer input:checked{
			background: #00c4ff3d;
		}
	</style>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary"><?php echo $quiz['title'] ?> | <?php echo $quiz['qpoints'] .' Points Each Question' ?></div>
		<br>
		<div class="card">
			<div class="card-body">
				<form action="" id="answer-sheet">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
					<input type="hidden" name="quiz_id" value="<?php echo $quiz['id'] ?>">
					<input type="hidden" name="qpoints" value="<?php echo $quiz['qpoints'] ?>">
					<?php
					$question = $conn->query("SELECT * FROM questions where qid = '".$quiz['id']."' order by order_by asc ");
					$i = 1 ;
					while($row =$question->fetch_assoc()){
						$opt = $conn->query("SELECT * FROM question_opt where question_id = '".$row['id']."' order by RAND() ");
					?>

				<ul class="q-items list-group mt-4 mb-4">
					<li class="q-field list-group-item">
						<strong><?php echo ($i++). '. '; ?> <?php echo $row['question'] ?></strong>
						<input type="hidden" name="question_id[<?php echo $row['id'] ?>]" value="<?php echo $row['id'] ?>">
						<br>
						<ul class='list-group mt-4 mb-4'>
						<?php while($orow = $opt->fetch_assoc()){ ?>

							<li class="answer list-group-item">
								<label><input type="radio" name="option_id[<?php echo $row['id'] ?>]" value="<?php echo $orow['id'] ?>"> <?php echo $orow['option_txt'] ?></label>
							</li>
						<?php } ?>

						</ul>

					</li>
				</ul>

				<?php } ?>
				<button class="btn btn-block btn-primary">Submit</button>
				</form>
			</div>	
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('.answer').each(function(){
		$(this).click(function(){
			$(this).find('input[type="radio"]').prop('checked',true)
			$(this).css('background','#00c4ff3d')
			$(this).siblings('li').css('background','white')
		})


		})
		$('#answer-sheet').submit(function(e){
			e.preventDefault()
			$('#answer-sheet [type="submit"]').attr('disabled',true)
			$('#answer-sheet [type="submit"]').html('Saving...')
			$.ajax({
				url:'submit_answer.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
					if(resp.status == 1){
						alert('You completed the quiz your score is '+resp.score)
						location.replace('view_answer.php?id=<?php echo $_GET['id'] ?>')
					}
					}
				}
			})
		})
		
	})
</script>
</html>