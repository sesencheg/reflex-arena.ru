<?php
	require 'Reflex.php';
	$reflex = new ReflexController;

	if(empty($_GET["p"])){
		$_GET["p"] = 1;
	}
	if(!empty($_GET["n"])){
		$players = $reflex->getPlayers($_GET["n"], $_GET["p"]);
	}
	else{
		$players = $reflex->getPlayers('', $_GET["p"]);	
	}
	$meta = '<title>Reflex Arena Duel Statistics</title>
			<meta property="og:title" content="Reflex Arena Duel Statistics" />
			<meta property="og:url" content="http://reflex-arena.ru/'.$_SERVER["REQUEST_URI"].'" />
			<meta property="og:image" content="images/levelshots/Ruin.jpg" />
			<meta property="og:description" content="Reflex Arena Duel Statistics" />			
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="Reflex Arena, FPS" />
			<meta name="description" content="Reflex Arena Duel Statistics" />';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<? include("inc/header.php"); ?>
	<div id="content">
		<div class="inner">
			<div id="player">
				<div class="box">
					<div class="box-title">
						<h2>Players</h2>
		  				<div id="search">
		  					<form action="/players.php" method="get">
		  						<input type="text" name="n" placeholder="Search">
		  						<input type="submit" value="go" style="display:none">
		  					</form>
		  				</div>
		  			</div>	
					<div>
						<table cellspacing="0" border="0">
							<tbody>
								<tr>
									<th scope="col">Nickname</th>
									<th scope="col">MMR</th>
								</tr>
								<?	
								foreach ($players as $player) {
									?>
									<tr>
										<td class="player"><a href="player.php?sid=<? echo $player["steamId"]; ?>"><? echo $player["name"]; ?></a></td>
										<td>
											<img style="vertical-align: middle;" src="/images/rank<?=$player["mmr_rank"];?>.png">	
											<? echo $player["mmr"]; ?>
										</td>						
									</tr>
									<?
								}	
								?>			
							</tbody>
						</table>
					</div>			
				</div>		
				<?
				if (!$_GET['n']){
					?>
						<div id="pagination">
						<?
							$all = mysqli_query($link, "SELECT * FROM ratings");
							$vsego = mysqli_num_rows($all);
							$pages = round($vsego/100);				
						?>
							<ul>
							<?
								for ($i = 1; $i <= $pages; $i++) {
									echo "<li><a href='?p=$i'>$i</a></li>";
								}											
							?>
							</ul>			
		  				</div>
		  			<? 
				} 
		  		?>
			</div>
		</div>
	</div>
<? include("inc/footer.php"); ?>
</body>
</html>

