<?php
	session_start();
	
	
	if (isset($_SESSION['user_id'])) {
		include '../inc/dbh.inc.php';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<title>CoSpace</title>

	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' type='text/css' href='../CSS/innergeneral.css'>

</head>
<body>
	<div class="header">
		<div class="profileimg">
			<?php
			$id = $_SESSION['user_id'];
			$sql = "SELECT profileimg FROM user WHERE user_id='$id'";
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {

				while ($row = mysqli_fetch_assoc($result)) {
					$profileimg = $row['profileimg'];
					$destination = $id.".".$profileimg;
		 			
		 			if ($profileimg == 'new') {

		 				echo "<div id='profileimg'>";
						echo "<img height='75px' src='../innerpages/userimg/default.png'>";
						echo "</div>";
					}
					else {
						
						echo "<div id='profileimg'>";
						echo "<img height='75px' src='../innerpages/userimg/".$destination."'>";
						echo "</div>";
					}
				}
				
			}
		?>
		</div>
		<div class="mywrapper">
			<div class="mymenu">
				<ul>
					<li>
						<a href="../innerpages/message.php">My Messages</a>
					</li>
					<li>
						<a href="#">My Projects</a>
					</li>
					<li>
						<a href="#">My Posts</a>
					</li>
					<li>
						<a href="#">My files</a>
					</li>
					<li>
						<a href="#">My Evaluations</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="logout">
			<form action='../inc/logout.inc.php' method='POST' id='logout'>
				<button type='submit' name ='submit'>Logout</button>
			</form>
		</div>
		<nav>
		
			<select class="headernav" onchange="location.href=this.options[this.selectedIndex].value;" placeholder="">
				<option>
					<?php 
						$url=$_SERVER['REQUEST_URI'];
						$exp= explode("/", $url);
						$end = end($exp);
						$current = explode(".", $end);
						echo ucfirst($current[0]);
					 ?>
				</option>
					<?php
						$sites = array("Home", "Projects", "Knowledgebase", "Discussionboard", "Learningspace", "Gallery");
						for($i = 0; $i < count($sites); $i++)
						{
							$site = $sites[$i];
							$cur = ucfirst($current[0]);

							if ($site != $cur) 
							{
					?>
				<option value="<?php echo $site.'.php';?>">
					<a href="<?php echo $site.'.php';?>"> 
						<?php echo $site;
						 ?></a>
				</option>
					<?php 
							}
						}
					 ?>
				
			</select>
			
		</nav>
	</div>
	

<?php
} else {
	header("Location: ../index.php?error=plsLogin");
}
?>