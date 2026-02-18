<?php include '../../config/constants.php' ?>

<?php
$page = $_GET['page'];
$tutorial_id = $_GET['tutorial_id'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php include '../meta.php' ?>
	<title>User Portal | <?php echo $thename; ?></title>
</head>

<body>

	<div class="page-content-div">
		<div class="content-side-div">
			<div class="div-in">

				<div id="ajax_loader"></div>

				<div id="fetch_tutorial_details">

					<div class="video-div">
						<video class="video-slide" title="" id="videoDisplay" controls="controls" loop="" controlsList="nodownload">
							<source src="" type="video/mp4">
						</video>
					</div>

					<div class="video-details-div">

						<div class="inner-topic-details-div">
							<div class="icons-div">
								<i class="bi-pencil-square"></i>
							</div>
							<div class="text-div">
								Subject
								<h3 id="tutorial_subject">Xxxx Xxxx</h3>
							</div>
						</div>

						<div class="inner-topic-details-div">
							<div class="icons-div">
								<i class="bi-calendar-range"></i>
							</div>

							<div class="text-div">
								Term
								<h3 id="tutorial_term">Xxxx Xxxx</h3>
							</div>
						</div>

						<div class="inner-topic-details-div">
							<div class="icons-div">
								<i class="bi-calendar-week"></i>
							</div>

							<div class="text-div">
								Week
								<h3 id="tutorial_week">Xxxx Xxxx</h3>
							</div>
						</div>

						<div class="inner-topic-details-div">
							<div class="icons-div">
								<i class="bi-camera-reels"></i>
							</div>

							<div class="text-div">
								Duration
								<h3 id="tutorial_duration">00:00:00</h3>
							</div>
						</div>
					</div>

					<div class="detail-div">
						<h2 id="tutorial_topic"></h2>
						<div id="tutorial_summary"></div>
					</div>



					<br clear="all" />

					<div class="comment-back-div">
						<div id="disqus_thread"></div>
						<script>
							(function() { // DON'T EDIT BELOW THIS LINE
								var d = document,
									s = d.createElement('script');
								s.src = 'https://valuehandlers-international-limited.disqus.com/embed.js';
								s.setAttribute('data-timestamp', +new Date());
								(d.head || d.body).appendChild(s);
							})();
						</script>
					</div>
				</div>
				<br clear="all" />
				<br clear="all" />

			</div>
		</div>
	</div>



		<script>
			_getTutorialVideosDetails('<?php echo $page ?>', '<?php echo $tutorial_id ?>');
			//_disabledInspect();
		</script>


</body>


</html>