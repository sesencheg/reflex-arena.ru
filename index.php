<?php
	require 'Reflex.php';
	$reflex = new ReflexController;
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
			<div id="top">
				<div class="box" id="recent_games">
					<div class="box-title">					
	  					<h2>Last Scanned Matches</h2>
		 				<div id="search">
		  					<form action="/players.php" method="get">
		  						<input type="text" name="n" placeholder="Search player...">
		  						<input type="submit" value="go" style="display:none">
		  					</form>
		  				</div>
		  			</div>
					<div>	  
						<table cellspacing="0" border="0" >
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Winner</th>
								<th scope="col">Score</th>
								<th scope="col">Loser</th>
								<th scope="col">Map</th>
							</tr>
							<?
								$duels = $reflex->getMainDuels();
								foreach ($duels as $key => $duel) {
									?>
										<tr>
											<td><?=date("d.m.Y", strtotime($duel["date"]));?></td>
											<td class="player">
												<a href="player.php?sid=<?=$duel["players"][0]["steamId"]; ?>"> <?=$duel["players"][0]["name"]; ?></a><br><?=$duel["players"][0]["mmrNew"]; ?>
											</td>
											<td>
												<b><?=$duel["players"][0]["score"]; ?> </b>:<b> <?=$duel["players"][1]["score"]; ?></b>
											</td>
											<td class="player">
												<a href="player.php?sid=<?=$duel["players"][1]["steamId"]; ?>"><?=$duel["players"][1]["name"]; ?></a><br><?=$duel["players"][1]["mmrNew"]; ?>
											</td>
											<td class="player" style="text-align: center">
												<a href="match.php?guid=<?=$duel["gameGuid"]; ?>"><img src="images/levelshots/<?=$duel["map"];?>.jpg" style="height:42px;width:56px;border-width:0px;"><br><?=$duel["map_title"]?></a>
											</td>							
										</tr>
										<?
								}
							?>		
						</table>
					</div>
				</div>
  			</div>
  			<div class="index-content">
	  			<div class="left">
					<div class="box">
						<div class="box-title">
							<h2>Top 10 Duel Players</h2>
			  				<a href="/players.php">All players</a>
			  			</div>				
						<div>				  			
							<table cellspacing="0" border="0">
								<tbody>
									<tr>
										<th scope="col">Rank</th>
										<th scope="col">Nickname</th>
										<th scope="col">MMR</th>
									</tr>
									<?			
										$topPlayers = $reflex->getTopPlayers();
										foreach ($topPlayers as $key => $player) {
											?>
											<tr>
												<td><?=$key+1; ?></td>
												<td class="player"><a href="player.php?sid=<?=$player["steamId"]; ?>"><?=$player["name"]; ?></a></td>
												<td>
													<?
														if ($player["mmr"] < 900){
															echo "<img style='vertical-align: middle;' src='/images/rank1.png'>";
														}
														else if ($player["mmr"] >= 900 && $player["mmr"] < 1400){
															echo "<img style='vertical-align: middle;'  src='/images/rank2.png'>";
														}
														else if ($player["mmr"] >= 1400 && $player["mmr"] < 1700){
															echo "<img style='vertical-align: middle;'  src='/images/rank3.png'>";
														}
														else if ($player["mmr"] >= 1700 && $player["mmr"] < 2000){
															echo "<img style='vertical-align: middle;'  src='/images/rank4.png'>";
														}
														else if ($player["mmr"] >= 2000 && $player["mmr"] < 2200){
															echo "<img style='vertical-align: middle;'  src='/images/rank5.png'>";
														}
														else if ($player["mmr"] >= 2200 && $player["mmr"] < 2500){
															echo "<img style='vertical-align: middle;'  src='/images/rank6.png'>";
														}
														else if ($player["mmr"] >= 2500){
															echo "<img style='vertical-align: middle;'  src='/images/rank7.png'>";
														}								
													?>												
													<?=(int)$player["mmr"]; ?>
												</td>						
											</tr>
											<?
										}
									?>			
								</tbody>
							</table>							
						</div>
					</div>			
				</div>
	  			<div class="right">
					<div class="box" id="most-played">
						<div class="box-title">
		  					<h2>Most Popular Duel Maps</h2>
		  				</div>
		  				<div class="graph-box">
		  					<div id="mapgraph" class="graph"></div>
		  				</div>
					</div>   
		  		</div>
	  		</div>	  		
			<script type="text/javascript">
				$(document).ready(function () {
					var mapData = [
						<?
							$maps = $reflex->getPopularMaps();
							foreach ($maps as $key => $map) {
								echo "{label: \"$map[map_title]\", data: $map[cnt]},";
							}
						?>
					];
					$.plot( $('#mapgraph') , mapData, {
						series: {
							pie: {
								show: true,
								width: 1000,
								label:{
									show: true
								}
							}
						},
						legend: {
							show: false
						},	
						grid: {
							hoverable: true,
							clickable: false
						}
					});
					$("#mapgraph").mouseout($.hideCursorMessage);
					$("#mapgraph").bind("plothover", showCursorMessage);
				});
			</script>
		</div>
	 </div>
	<? include("inc/footer.php"); ?>
</body>
</html>

