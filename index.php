<!DOCTYPE html>
<html>
	<head>
		<title>ANONYMOUS POST SYSTEM</title>
		<meta charset="utf-8" />
		<!-- Tocas UI：CSS 與元件 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.css">
		<!-- Tocas JS：模塊與 JavaScript 函式 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.2/tocas.js"></script>
	</head>
	<body>
		<?php
			error_reporting(0);
			if ($_GET["err"]=="ul"){
				echo "<div class=\"ts inverted negative segment\">Upload failed, please retry later.</div>";
			}else if ($_GET["err"]=="ftp"){
				echo "<div class=\"ts inverted negative segment\">Your upload file isn't a image, please select a image file.</div>";
			}else if ($_GET["err"]=="gerr"){
				echo "Graph returned an error: ".$_GET["detail"].", please contact website administrator.";
			}else if ($_GET["err"]=="serr"){
				echo "Facebook SDK returned an error: ".$_GET["detail"].", please contact website administrator.";
			}else if ($_GET["success"]=="yes"){
				echo "<div class=\"ts inverted positive segment\">Great! Success, the post id is ".$_GET["detail"]."</div>";
			}
		?>
			
		<form action="post.php" method="POST" enctype="multipart/form-data">
			<!--<input name="content" type="text"></input>-->
			<div class="ts input massive">
				<textarea name="content" placeholder="Input Content Here!"></textarea>
			</div>
			<br>
			If you want to upload a image, please upload it.<input class="ts button" type="file" name="file" id="file" /><br />
			<br>
			<button class="ts button" name="submit">POST!</button>
			
			<!--<button>POST!</button>-->
		</form>
	</body>
</html>