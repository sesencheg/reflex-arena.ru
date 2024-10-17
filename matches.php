<?php
	require 'Reflex.php';
	$reflex = new ReflexController;
	if (isset($_GET["sid"])){
		$player = $reflex->getPlayerById($_GET["sid"]);
		if(!$player){
			header('Location: /');
		}  
		$playerDuels = $reflex->getPlayerDuels($player["id"], 999);
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
					<div id="stats">MMR: <strong><span><? echo (int)$player["mmr"]; ?></span></strong> Kills: <strong><span><? echo $player["kills"]; ?></span></strong> Deaths: <strong><span><? echo $player["deaths"]; ?></span></strong> Duels Tracked: <strong><span><? echo $player["duels"]; ?></span></strong><strong><span><a style="color:#a54e4e;" href="https://steamcommunity.com/profiles/<? echo $player["steamId"]; ?>/">Steam profile</a></span></strong></div>
					<div class="line"></div>
				</div>
				<div class="box center" id="recent_games">
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
												<td class="player"><a href="player.php?sid=<?=$duel["players"][0]["steamId"]?>"><?=$duel["players"][0]["name"]?></a><br><?=$duel["players"][0]["mmrNew"]?></td>
												<td>
													<span class="score"><?=$duel["players"][0]["score"]?></span> : <span class="score"><?=$duel["players"][1]["score"]?></span>
												</td>									
												<td class="player"><a href="player.php?sid=<?=$duel["players"][1]["steamId"]?>"><?=$duel["players"][1]["name"]?></a><br><?=$duel["players"][1]["mmrNew"]?></td>
												<td class="player"><a href="match.php?guid=<?=$duel["gameGuid"];?>"><img src="images/levelshots/<?=$duel["map"];?>.jpg" title="<?=$duel["map_title"];?>" style="height:42px;width:56px;border-width:0px;"><br><?=$duel["map_title"];?></a></td>																			
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