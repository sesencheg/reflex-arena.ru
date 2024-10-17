<?php
	require 'Reflex.php';
	$reflex = new ReflexController;
	if (isset($_GET["sid"])){
		$player = $reflex->getPlayerById($_GET["sid"]);
		if(!$player){
			header('Location: /');
		}
		$playerDuels = $reflex->getPlayerDuels($player["id"], 10);
	}
	else{
		header('Location: /');
	}
	$meta = '<title>'.$player["name"].'</title>
			<meta property="og:title" content="'.$player["name"].'" />
			<meta property="og:url" content="http://reflex-arena.ru/'.$_SERVER["REQUEST_URI"].'" />
			<meta property="og:image" content="images/levelshots/Ruin.jpg" />
			<meta property="og:description" content="Reflex Arena  Duel Statistics '.$player["name"].'" />			
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="Reflex Arena, FPS, '.$player["name"].'" />
			<meta name="description" content="Reflex Arena  Duel Statistics '.$player["name"].'" />';
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<? include("inc/header.php"); ?>			
	<div id="content">
		<div class="inner">
			<div id="player">
				<div id="top">
					<h1><? echo $player["name"]; ?></h1>
					<div id="stats">
						MMR: <strong><span><? echo (int)$player["mmr"]; ?></span></strong> 
						Kills: <strong><span><? echo $player["kills"]; ?></span></strong> 
						Deaths: <strong><span><? echo $player["deaths"]; ?></span></strong> 
						Duels Tracked: <strong><span><? echo $player["duels"]; ?></span></strong>
						<strong><span><a style="color:#a54e4e;" href="https://steamcommunity.com/profiles/<? echo $player["steamId"]; ?>/">Steam profile</a></span></strong>
					</div>
					<div class="line"></div>
				</div>
				<div class="player-stats">
					<div id="avatar">
						<img style="vertical-align: middle;" src="/images/rank<?=$player["mmr_rank"];?>.png">		 		
						<br><img src="images/model.png" style="border-width:0px;">			   		
					</div>
					<div class="box">
						<div class="box-title">
							<h2>Map Ratio</h2>
						</div>
						<div id="mapgraph1" class="graph1" style="padding: 0px; position: relative;"></div>
					</div>
					<div class="box" id="vital_stats">
						<div class="box-title">
							<h2>Vital Stats</h2>
						</div>
						<table cellspacing="0" border="0">
							<tbody>
								<tr>
									<td>Wins</td>
									<td class="value"><span><? echo $player["win"]; ?></span></td>
								</tr>
								<tr>
									<td>Losses</td>
									<td class="value"><span><? echo $player["loss"]; ?></span></td>
								</tr>
								<tr>
									<td>Frags / Deaths</td>
									<td class="value"><span><? echo $player["kills"]; ?></span> / <span><? echo $player["deaths"]; ?></span></td>
								</tr>
								<tr>
									<td>Dmg G / T</td>
									<td class="value"><span><? echo $player["allDamage"]; ?></span>  / <span><? echo $player["totalDamageReceived"]; ?></span></td>
								</tr>
								<tr>
									<td>Arena</td>											
									<td class="value"><span><? echo $player["mapStats"][0]["map_title"]; ?></span></td>
								</tr>
								<tr>
									<td>Best MMR</td>
									<td class="value"><span><? echo $player["mmrBest"]; ?></span></td>
								</tr>																
							</tbody>
						</table>
					</div>							  
				</div>
				<div class="box center" id="weapon_stats">							
					<div class="box-title">
						<h2>Weapon Stats</h2>
					</div>
					<table cellspacing="0" border="0">
						<thead>
							<tr>
								<th></th>
								<th><span class="icon gauntlet"></span></th>
								<th><span class="icon mg"></span></th>
								<th><span class="icon sg"></span></th>
								<th><span class="icon gl"></span></th>
								<th><span class="icon pg"></span></th>
								<th><span class="icon rl"></span></th>
								<th><span class="icon lg"></span></th>
								<th><span class="icon rg"></span></th>									
							</tr>
						</thead>
						<tbody>
							<tr class="frags">
								<td class="title">Frags</td>
								<td><?=$player["weapons"]["Melee"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Burst Gun"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Shotgun"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Grenade Launcher"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Plasma Rifle"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Rocket Launcher"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Ion Cannon"]["kills"]; ?></td>
								<td><?=$player["weapons"]["Bolt Rifle"]["kills"]; ?></td>								
							</tr>
							<tr class="accuracy">
								<td class="title">Accuracy</td>
								<td>N/A</td>
								<td>
									<?=$player["weapons"]["Burst Gun"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Shotgun"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Grenade Launcher"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Plasma Rifle"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Rocket Launcher"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Ion Cannon"]["accuracy"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Bolt Rifle"]["accuracy"];?>									
								</td>
							</tr>
							<tr class="use">
								<td class="title">Efficiency</td>
								<td>
									<?=$player["weapons"]["Melee"]["efficiency"];?>
								</td>
								<td>
									<?=$player["weapons"]["Burst Gun"]["efficiency"];?>
								</td>
								<td>
									<?=$player["weapons"]["Shotgun"]["efficiency"];?>
								</td>
								<td>
									<?=$player["weapons"]["Grenade Launcher"]["efficiency"];?>									
								</td>
								<td>
									<?=$player["weapons"]["Plasma Rifle"]["efficiency"];?>								
								</td>
								<td>
									<?=$player["weapons"]["Rocket Launcher"]["efficiency"];?>
								</td>
								<td>
									<?=$player["weapons"]["Ion Cannon"]["efficiency"];?>
								</td>
								<td>
									<?=$player["weapons"]["Bolt Rifle"]["efficiency"];?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="box center" id="recent_games">
					<div class="box-title">					
						<h2>Last 10 Games</h2>
						<a href="/matches.php?sid=<? echo $_GET["sid"];?>">All matches</a>
					</div>
					<table cellspacing="0" border="0">
						<tbody>
							<tr>
								<th scope="col">Date</th>
								<th scope="col">Winner</th>
								<th scope="col">Score</th>
								<th scope="col">Loser</th>
								<th scope="col">Map</th>
							</tr>
							<?
								foreach ($playerDuels as $duel) {
								?>
									<tr>				
										<td><?=$duel["date"]?></td>
										<td class="player">
											<a href="player.php?sid=<?=$duel["players"][0]["steamId"]?>">
												<?=$duel["players"][0]["name"]?>												
											</a>
											<br><?=$duel["players"][0]["mmrNew"]?>
										</td>
										<td>
											<span class="score"><?=$duel["players"][0]["score"]?></span> : <span class="score"><?=$duel["players"][1]["score"]?></span>
										</td>																		
										<td class="player"><a href="player.php?sid=<?=$duel["players"][1]["steamId"]?>"><?=$duel["players"][1]["name"]?></a><br><?=$duel["players"][1]["mmrNew"]?></td>
										<td class="player">
											<a href="match.php?guid=<?=$duel["gameGuid"];?>">
												<img src="images/levelshots/<?=$duel["map"];?>.jpg" title="<?=$duel["map_title"];?>" style="height:42px;width:56px;border-width:0px;">
												<br><?=$duel["map_title"];?>
											</a>
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
	</div>	
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);
		function drawChart() {
			var data = google.visualization.arrayToDataTable([
		  		['Map','Wins','Losses', { role: 'annotation' } ],
				<?
				foreach ($player["maps"] as $key => $map) {
					if (empty($map["win"])){
						$winmap = 0;
					}
					else{
						$winmap = $map["win"];
					}
					if (empty($map["loss"])){
						$lossmap = 0;
					}
					else{
						$lossmap = $map["loss"];
					}
					echo "['$key', $winmap, $lossmap, ''],";
				}		
				?>
		  	]);
			var options = {
				width: 430,
				height: 300,		
				legend: { position: 'top', maxLines: 3 },
				bar: { groupWidth: '75%' },
				isStacked: true,
			};
			var chart = new google.visualization.BarChart(document.getElementById('mapgraph1'));
			chart.draw(data, options);
	  	}
	</script>
	<? include("inc/footer.php"); ?>
</body>
</html>