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
?>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>
		<title>Reflex Arena Duel Statistics</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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

          
          
	<div id="player">
		<div class="box">
			<h2>
          		Players
          		<div id="search">
          			<form action="/players.php" method="get">
          			<input type="text" name="n" placeholder="Search">
          			<input type="submit" value="go" style="display:none">
          			</form>
          		</div>
        	</h2>
	        <div id="ctl00_ContentPlaceHolder1_UpdatePanel2">	
				<div>
					<table cellspacing="0" border="0" id="ctl00_ContentPlaceHolder1_gridTop100" style="border-collapse:collapse;">
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
									<? echo $player["mmr"]; ?></td>						
								</tr>
								<?

							}		

						?>			
						</tbody>
					</table>
				</div>
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
		  <? } ?>
	</div>


          
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

