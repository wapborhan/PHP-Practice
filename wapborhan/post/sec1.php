
		<div class="container">
			<div class="row">
				<div class="dd">
					<div class="widget">
						<div class="widget-title">
							<h3 class="title">Test1
							</h3>
						</div>
						<div class="blog-postd">
						<div class="row">
							<div class="col-lg-6">
							<?php 
                            $cat_nama = "Test1";
							$limitd = 1;
							$post_view_query = "SELECT * FROM posts WHERE category = '$cat_nama' AND status = 'Active' ORDER BY id desc LIMIT {$offset}, {$limitd}";
							$post_view_query_result = mysqli_query($conn, $post_view_query);
					

							while ($post_view_row = mysqli_fetch_assoc($post_view_query_result)) {
							$post_id = $post_view_row['id'];
							$post_date = $post_view_row['datetime'];
							$post_title = $post_view_row['title'];
							$post_category = $post_view_row['category'];
							$post_author = $post_view_row['author'];
							$post_image = $post_view_row['image'];
							$post_post = $post_view_row['post'];
						?>
						<div class="widget-desz">
							<div class="blog-post hentry index-post">
								<div class="post-image-wrap">
									<a class="post-image-link" href="article/<?php echo $post_id; ?>">
										<img alt="<?php echo $post_title; ?>" class="post-thumb" src="upload/<?php echo $post_image; ?>">
									</a>
								</div>
								<div class="post-info">
									<h2 class="post-title">
										<a href="article/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
									</h2>
									<div class="post-meta">
										<span class="post-author"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php echo $post_author; ?>
										</span>
										<span class="post-date published" datetime="<?php echo $post_date; ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $post_date; ?>
										</span>
									</div>
									<div class="post-over">
										<?php
											if (strlen($post_post) > 150) {
												$post_post = substr($post_post, 0, 150) . "...";
											}
											$post_text = convert_html_to_text($post_post);
											echo $post_text;
										?>
									</div>
								</div>
							</div>
						</div>
						<?php
							}if(mysqli_num_rows($post_view_query_result) == 0){
						?>
						<div class="blog-post hentry index-post">No post found.</div>
						<?php }  ?>
							</div> <!-- Col End -->
							<div class="col-lg-6">
								<?php 
									$limitk = 3;
									$post_view_query = "SELECT * FROM posts WHERE category = '$cat_nama' AND status = 'Active' ORDER BY id desc LIMIT {$offset}, {$limitk}";
									$post_view_query_result = mysqli_query($conn, $post_view_query);
							

									while ($post_view_row = mysqli_fetch_assoc($post_view_query_result)) {
									$post_id = $post_view_row['id'];
									$post_date = $post_view_row['datetime'];
									$post_title = $post_view_row['title'];
									$post_category = $post_view_row['category'];
									$post_author = $post_view_row['author'];
									$post_image = $post_view_row['image'];
									$post_post = $post_view_row['post'];
								?>
								<div class="widget-desk">
									<div class="blog-post hentry index-post">
									
								<div class="post-info">
									<h2 class="post-title">
										<?php 
											if (strlen($post_title) > 25) {
												$post_title = substr($post_title, 0, 50) . "...";
											}
											$post_text = convert_html_to_text($post_title);
											echo "<a href='article/$post_id'>$post_text</a>";
										?>
										
									</h2>
									<div class="post-meta">
										<span class="post-author"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php echo $post_author; ?>
										</span>
										<span class="post-date published" datetime="<?php echo $post_date; ?>"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $post_date; ?>
										</span>
									</div>
									<div class="post-over">
									</div>
								</div>
							</div>
						</div>

								<?php }  ?>
							</div> <!-- Col End -->
						</div> <!-- Row End -->
						</div>
					</div> <!-- Widget END -->
				</div> <!-- Widget END -->

			</div>

		</div>
		
