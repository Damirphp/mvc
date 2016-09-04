<sidebar class="col-sm-4 text-center"><!-- SIDEBAR -->
  	<div class="well">
        <p><a href="#"><?php echo $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'] ?></a></p>
        <img src="<?php Url::img('images.png') ?>" class="img-circle" height="65" width="65" alt="Avatar">
    </div>
    <div class="well">
        <p><a href="#">Interests</a></p>
        <p>
          	<span class="label label-default">News</span>
          	<span class="label label-primary">W3Schools</span>
          	<span class="label label-success">Labels</span>
          	<span class="label label-info">Football</span>
          	<span class="label label-warning">Gaming</span>
         	<span class="label label-danger">Friends</span>
        </p>
    </div>
</sidebar><!-- END SIDEBAR -->

<main class="col-md-8"><!-- MAIN -->

	<div class="row"><!-- POST -->
		
		<div class="col-md-2">
			<img src="<?php Url::img('images.png') ?>" class="img-rounded" height="65" width="65" alt="Avatar">
		</div>

		<div class="col-md-10">
			<form action="<?php Url::link('home/insertPost') ?>" method="POST">
				<div class="form-group">
					<textarea class="form-control" name="post" rows="5" placeholder="What's on your mind?"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Post</button>
			</form>
		</div>

	</div><hr><!-- END POST -->

	<div class="row"><!-- OTHER POST -->
		<h3>What other people say...</h3>
		<br>
		<?php foreach ($data['posts'] as $post) { ?>
			<article class="panel panel-default">
			
					<div class="panel-body">
						<div class="row">
							<div class="col-md-2">
								<img src="<?php Url::img('images.png') ?>" class="img-rounded" height="65" width="65" alt="Avatar">
							</div>
							<div class="col-md-10">
								<p><?php echo $post['content'] ?></p>
							</div>
						</div>
					</div>
				
			</article>
		<?php } ?>
	</div><!-- END OTHER POST -->

</main><!-- END MAIN -->