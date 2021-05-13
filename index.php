<?php
include "includes/config.php";

//session_destroy(); LOGOUT

if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}

?>

<html>
<head>
	<title>Grafi</title>
	<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/macy@2.5.1/dist/macy.min.js"></script>

</head>

<body>
	<div id="container">
			<div id="imagesBox" class="gallery">
				<?php
				$query = "SELECT i.id, i.title, i.text, i.image, i.type FROM Images as i JOIN Users as u ON i.id_user = u.id WHERE username = '" . $_SESSION['userLoggedIn'] . "' ORDER BY i.id DESC;";
				$images = mysqli_query($con, $query);
				//$id_image = $_GET['id_image'];

				while ($row = mysqli_fetch_array($images)) {

					echo "<div id='imageDiv'>";
						//echo "<p id='imageTitle'>" . $row['title'] . "</p>";
						echo "<a href='single.php?id=".$row['id']."'>";
							echo "<img id='image' src='data:" . $row['type'] . ";base64, " . $row['image'] . "' class='img-fluid' alt='Responsive image'>";
							echo "<div id='hide'>";
								echo "<p clsss='hiddenText'>".$row['title']."</p>";
								//echo "<p clsss='hiddenText'>".$row['text']."</p>";
							echo "</div>";
						echo "</a>";
						//echo "</br>";

						/*if($row['text'] != NULL){
						echo "<p>" . $row['text'] . "</p>";
						}

						echo "<a id='zmien' href='zmien.php?id_image=" . $row['id'] . "'>edytuj</a>";
						echo "    ";
						echo "<a id='usun' href='usun.php?id_image=" . $row['id'] . "'>usuń</a>";

						echo "</br></br>"; */
					echo "</div>";
				}
				?>
			</div>

			<div id="nav">
				<div id="navText">
					<p id="headText"><a id="userHref" href="user.php"><?php echo $_SESSION['userLoggedIn'] ?></a></p>
					<p class="menu"><a class="menuText" href="index.php">MOJE OBRAZKI</a></p>
					<p class="menu"><a class="menuText" href="hiddengallery.php">UKRYTA GALERIA</a></p>
					<p class="menu"><a class="menuText" href="obserwowane.php">OBSERWOWANE</a></p>
					<p class="menu"><a class="menuText" href="obserwuj.php">OBSERWUJ</a></p>
					<p class="menu"><a class="menuText" href="addImage.php">DODAJ OBRAZEK</a></p>
					<p class="menu"><a class="menuText" href="ustawienia.php">USTAWIENIA </a></p>
					<p id="wyloguj"><a id="wylogujText" href="register.php">Wyloguj</a></p>
				</div>
			</div>
	</div>

	<script>
		//var masonry = new Macy({
  		//	container: 'div.gallery',
		//	columns: 4,
		//});
        var masonry = new Macy({
            container: '#imagesBox',
            trueOrder: false,
            waitForImages: true,
            useOwnImageLoader: false,
            debug: true,
            mobileFirst: true,
            columns: 4,  
			breakAt: {
				400: 2,
				700: 3,
				1100: 4,
			},  
			margin: {
				x: 10,
				y: 10,
			}    
        });
    
	</script>
</body>
</html>