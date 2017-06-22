<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.js"></script>
	</head>
	<body>
		<div class="ts fluid basic big menu" style="margin-bottom: 0">
			<div class="ts thinner text container">
				<a href="#!" class="item">Facebook Anonymous POST</a>
			</div>
		</div>
		<div class="ts very padded horizontally fitted fluid jumbotron">
			<div class="ts thinner text container">
				<h1 class="ts header">
					Anonymous POST!
					<div class="sub header">Type anything you want to POST. But the premise is it has follow the terms.</div>
				</h1>
			</div>
		</div>
		<div class="ts thinner text container">
			<br>
			<?php
			error_reporting(0);
			if ($_GET["err"]=="ul"){
				echo "<div class=\"ts inverted negative segment\">Upload failed, please retry later.</div>";
			}else if ($_GET["err"]=="ftp"){
				echo "<div class=\"ts inverted negative segment\">Your upload file isn't a image, please select a image file.</div>";
			}else if ($_GET["err"]=="gerr"){
				echo "<div class=\"ts inverted negative segment\">Graph returned an error: ".$_GET["detail"].", please contact website administrator.</div>";
			}else if ($_GET["err"]=="serr"){
				echo "<div class=\"ts inverted negative segment\">Facebook SDK returned an error: ".$_GET["detail"].", please contact website administrator.</div>";
			}else if ($_GET["success"]=="yes"){
				echo "<div class=\"ts inverted positive segment\">Great! Success, the post id is ".$_GET["detail"]."</div>";
			}
			?>
			<form action="post.php" method="POST" enctype="multipart/form-data">
			<div class="ts relaxed form">
				<div class="field">
					<textarea name="content" rows="6" placeholder="Type any content here."></textarea>
				</div>
				
				<div class="ts segment">
					<details class="ts accordion">
						<summary>
							<i class="dropdown icon"></i> If you want to upload image
						</summary>
						<div class="content">
							<input class="ts button" type="file" name="img" id="img">
						</div>
					</details>
				</div>
				
				<div class="field">
					<textarea rows="10" readonly>TERMS!
{Term Here}
					</textarea>
				</div>
				<button class="ts fluid primary button">Next!</button>
				<div class="ts center aligned mini basic fitted message">If you click next, that mean you accept our 《Terms》 and <a target="_blank" href="https://www.facebook.com/communitystandards">《Facebook Community Standards》</a></div>
			</div>
			</form>
		</div>
	</body>
</html>
