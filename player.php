<?php
require 'Reflex.php';
$reflex = new ReflexController;

if (isset($_GET["sid"])){
	$player = $reflex->getPlayerById($_GET["sid"]);
	$playerDuels = $reflex->getPlayerDuels($player["id"], 10);
?>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		
		<title><?php echo "$player[name]"; ?></title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" media="screen, projection" />
	    <script language="javascript" type="text/javascript" src="jquery.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
        	<div id="player">
    			<div id="top">
    				<h1><? echo $player["name"]; ?></h1>
    				<div id="stats">MMR: <strong><span><? echo (int)$player["mmr"]; ?></span></strong> Kills: <strong><span><? echo $player["kills"]; ?></span></strong> Deaths: <strong><span><? echo $player["deaths"]; ?></span></strong> Duels Tracked: <strong><span><? echo $player["duels"]; ?></span></strong><strong><span><a style="color:#a54e4e;" href="https://steamcommunity.com/profiles/<? echo $player["steamId"]; ?>/">Steam profile</a></span></strong></div>
    				<div class="line"></div>
    			</div>
				<div class="left-sixth">
            		<div id="avatar">
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
                		<br><img id="ctl00_ContentPlaceHolder1_imgModel" src="images/model.png" style="border-width:0px;">
               		
            		</div>
        		</div>
				<div class="left-fourtenth">
            		<div class="box" id="vital_stats">
                		<h2>Map Ratio</h2>
                		<div id="mapgraph1" class="graph1" style="padding: 0px; position: relative;"></div>
            		</div>
        		</div>     
				<div class="right-fourtenth">
					<div class="box" id="vital_stats">
						<h2>Vital Stats</h2>
						<table>
							<tbody>
								<tr>
									<td>Wins</td>
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lblDuelWins"><? echo $player["win"]; ?></span></td>
								</tr>
								<tr>
									<td>Losses</td>
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lblVSLosses"><? echo $player["loss"]; ?></span></td>
								</tr>
								<tr>
									<td>Frags / Deaths</td>
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lblFrags"><? echo $player["kills"]; ?></span> / <span id="ctl00_ContentPlaceHolder1_lblDeaths"><? echo $player["deaths"]; ?></span></td>
								</tr>
								<tr>
									<td>Dmg G / T</td>
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lbldmgGiven"><? echo $player["allDamage"]; ?></span>  / <span id="ctl00_ContentPlaceHolder1_lbldmgTaken"><? echo $player["totalDamageReceived"]; ?></span></td>
								</tr>
								<tr>
									<td>Arena</td>											
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lblFaveArena"><? echo $player["mapStats"][0]["map_title"]; ?></span></td>
								</tr>
								<tr>
									<td>Best MMR</td>
									<td class="value"><span id="ctl00_ContentPlaceHolder1_lbldmgGiven"><? echo $player["mmrBest"]; ?></span></td>
								</tr>																
							</tbody>
						</table>
					</div>			
		        </div>  
				<div class="box center" id="weapon_stats">				            
					<h2>Weapon Stats</h2>
						<table>
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
				                	<?
				                		if($player["weapons"]["Burst Gun"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Burst Gun"]["shotsHit"]*100)/$player["weapons"]["Burst Gun"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Shotgun"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Shotgun"]["shotsHit"]*100)/$player["weapons"]["Shotgun"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Grenade Launcher"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Grenade Launcher"]["shotsHit"]*100)/$player["weapons"]["Grenade Launcher"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Plasma Rifle"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Plasma Rifle"]["shotsHit"]*100)/$player["weapons"]["Plasma Rifle"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Rocket Launcher"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Rocket Launcher"]["shotsHit"]*100)/$player["weapons"]["Rocket Launcher"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Ion Cannon"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Ion Cannon"]["shotsHit"]*100)/$player["weapons"]["Ion Cannon"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                <td>
				                	<?
				                		if($player["weapons"]["Bolt Rifle"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Bolt Rifle"]["shotsHit"]*100)/$player["weapons"]["Bolt Rifle"]["shotsFired"],2)." %";
				                		}
				                	?>
				                </td>
				                
				            </tr>
							<tr class="use">
								<td class="title">Efficiency</td>
								<td>
				                	<?
				                		if($player["weapons"]["Melee"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Melee"]["damageDone"]/($player["weapons"]["Melee"]["shotsFired"]*90))*100,2)." %";
				                		}
				                	?>				                	
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Burst Gun"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Burst Gun"]["damageDone"]/($player["weapons"]["Burst Gun"]["shotsFired"]*45))*100,2)." %";
				                		}
				                	?>					                	
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Shotgun"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Shotgun"]["damageDone"]/($player["weapons"]["Shotgun"]["shotsFired"]*5))*100,2)." %";
				                		}
				                	?>					                	
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Grenade Launcher"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Grenade Launcher"]["damageDone"]/($player["weapons"]["Grenade Launcher"]["shotsFired"]*100))*100,2)." %";
				                		}
				                	?>					                	
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Plasma Rifle"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Plasma Rifle"]["damageDone"]/($player["weapons"]["Plasma Rifle"]["shotsFired"]*15))*100,2)." %";
				                		}
				                	?>				                	
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Rocket Launcher"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Rocket Launcher"]["damageDone"]/($player["weapons"]["Rocket Launcher"]["shotsFired"]*100))*100,2)." %";
				                		}
				                	?>
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Ion Cannon"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Ion Cannon"]["damageDone"]/($player["weapons"]["Ion Cannon"]["shotsFired"]*6))*100,2)." %";
				                		}
				                	?>
								</td>
								<td>
				                	<?
				                		if($player["weapons"]["Bolt Rifle"]["shotsFired"] == 0){
				                			echo "0 %";
				                		}
				                		else{
				                			echo round(($player["weapons"]["Bolt Rifle"]["damageDone"]/($player["weapons"]["Bolt Rifle"]["shotsFired"]*80))*100,2)." %";
				                		}
				                	?>
								</td>
								
							</tr>
						</tbody>
					</table>
				</div>

				<div class="box center" id="recent_games">
					<h2>Last 10 Games<a href="/matches.php?sid=<? echo $_GET["sid"];?>" style="float: right; margin-right: 10px; color: #a54e4e">All matches</a></h2>

						<table cellspacing="0" border="0" id="ctl00_ContentPlaceHolder1_gridPlayerGames" style="border-collapse:collapse;">
							<tbody>
								<tr>
									<th scope="col">Date</th><th scope="col">Winner</th><th scope="col">P1 Score</th><th scope="col">P2 Score</th><th scope="col">Loser</th><th scope="col">Map</th>
								</tr>
								<?
									foreach ($playerDuels as $duel) {
										?>
											<tr>				
												<td><?=$duel["date"]?></td>
												<td class="player"><a href="player.php?sid=<?=$duel["players"][0]["steamId"]?>"><?=$duel["players"][0]["name"]?></a><br><?=$duel["players"][0]["mmrNew"]?></td>
												<td><span class="score"><?=$duel["players"][0]["score"]?></span></td>
												<td><span class="score"><?=$duel["players"][1]["score"]?></span></td>										
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
<?
}
?>
