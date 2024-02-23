<?php
	require 'Reflex.php';

	$reflex = new ReflexController;
?>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Reflex Arena Duel Statistics</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Reflex Arena, FPS" />
		<meta name="description" content="Reflex Arena Duel Statistics" />		
		<link rel="stylesheet" type="text/css" href="style.css" media="screen, projection" />
		<script language="javascript" type="text/javascript" src="jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="jquery.flot.min.js"></script>
		<script language="javascript" type="text/javascript" src="jquery.flot.pie.min.js"></script>
		<script language="javascript" type="text/javascript" src="jquery.cursorMessage.js"></script>
		<script language="javascript" type="text/javascript" src="player.js"></script>
		<script language="javascript" type="text/javascript" src="excanvas.min.js"></script>
		<link rel="icon" href="../favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
		<link href='https://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="header">
		<div class="inner">
			<div id="logo">
				<a href="/"></a>
			</div>
			<div id="tracking">
				<strong><span id="ctl00_lblDuelers"><? echo $reflex->getPlayersCount(); ?></span></strong> Players 
				<strong><span id="ctl00_lblDuels"><? echo $reflex->getDuelsCount(); ?></span></strong> Duels 
			</div> 
		  <div class="clear"></div>
		</div>
	  </div>
	  <div id="content">
		<div class="inner">

		  
		  
	<div id="top">
	<div class="box" id="recent_games">
	  <h2>Last Scanned Matches
		 		<div id="search">
		  			<form action="/players.php" method="get">
		  			<input type="text" name="n" placeholder="Search player...">
		  			<input type="submit" value="go" style="display:none">
		  			</form>
		  		</div></h2>
	  <div>	  
	<table cellspacing="0" border="0" id="ctl00_ContentPlaceHolder1_gridLast5" style="border-collapse:collapse;">
		<tr>
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
  <div class="left">
	  <div class="box">
		<h2>
		  Top 10 Duel Players
		  <a href="/players.php" style="float: right; margin-right: 10px; color: #a54e4e">All players</a>
		</h2>
		<div id="ctl00_ContentPlaceHolder1_UpdatePanel2">
	
			  <div>
		<table cellspacing="0" border="0" id="ctl00_ContentPlaceHolder1_gridTop100" style="border-collapse:collapse;">
			<tbody>
			<tr>
				<th scope="col">Rank</th><th scope="col">Nickname</th><th scope="col">MMR</th>
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
			</tbody></table>
	</div>
			
</div>
	</div>
			
</div>

  <div class="right">
	<div class="box" id="most-played">
	  <h2>Most Popular Duel Maps</h2>
	  <div id="mapgraph" class="graph"></div>
	</div>
   
  </div>
<script type="text/javascript">
$(document).ready(function () {var mapData = [
	<?
		$maps = $reflex->getPopularMaps();
		foreach ($maps as $key => $map) {
			echo "{label: \"$map[map_title]\", data: $map[cnt]},";
		}

	?>
	

	]
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

		  
		<div class="clear"></div>
		</div>
	  </div>
	  <div class="clear"></div>
	  <div id="footer">
	  	<p><a href="https://www.donationalerts.com/r/ql_quake_tv" target="_blank">Donate</a></p>
	  </div>
  </form>
	<script language="javascript" type="text/javascript">
		  jQuery.fn.placeholder = function() {
		  var value = this.val();

		  $(this).focus(function() {
			if (this.value == value)
			  this.value = "";
		  });

		  $(this).blur(function() {
			if (this.value == "")
			  this.value = value;
		  });
		};

		$('#ctl00_txtPlayerSearch').placeholder();
	</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter43402834 = new Ya.Metrika({
					id:43402834,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/43402834" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->   
</body>
</html>

