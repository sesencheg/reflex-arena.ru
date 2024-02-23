<?php
require 'Reflex.php';
$reflex = new ReflexController;

if (isset($_GET["sid"])){
	$player = $reflex->getPlayerById($_GET["sid"]);
	$playerDuels = $reflex->getPlayerDuels($player["id"], 999);
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
				<div class="box center" id="recent_games">
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
