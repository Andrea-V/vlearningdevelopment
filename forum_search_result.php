<!doctype html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<meta charset="utf-8">
	<title>Search</title>
	<?php
		require_once('init.php');
		$connection=db_connect();
	?>
	</head>
<body>
	<header>
	<?php require_once('navbar.php'); ?>
	</header>
	
	<main>
		<article>
			<h1>Search result:</h1>
			<?php
				$title=mysqli_real_escape_string($connection,$_GET['title']);
				$where="WHERE title LIKE '%$title%' ";
				
				if(isset($_GET['user_src']))
					$where.="AND username='$_GET[userlist]' ";
				
				$query="SELECT threads.id,title,username,creation FROM threads JOIN students ON threads.fk_author=students.id ".$where." ORDER BY creation DESC";
				$result=mysqli_query($connection,$query) or die('Error in mySQL query'.mysql_error());
				
				if(mysqli_num_rows($result)==0)
						echo "<i>Sorry, there are no threads matching your search.</i><br />";
				else{
					?>
					<section>
						<table border=1>
						<?php
							while($row=mysqli_fetch_array($result))
								print_forum_post($row['username'],$row['creation'],"<a href='thread.php?id=$row[id]'><b>$row[title]</b></a>");
				}
			?>
						</table>
					</section>
		</article>
		
		<aside>
			Click <a href="forum.php">here</a> to go back to the main forum.
		</aside>
	</main>
	
	<footer>
	</footer>
    </body>
</html>