<?php
require 'Reflex.php';
$reflex = new ReflexController;
if (isset($_GET["guid"])){
	$match = $reflex->getMatchById($_GET["guid"]);

	//print_r($match);
?>
<html xmlns="http://www.w3.org/1999/xhtml" >
	<head>		
		<title><?=$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")";?></title>
		<meta property="og:title" content="<?=$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")";?>" />
		<meta property="og:url" content="http://reflex-arena.ru/<?=$_SERVER["REQUEST_URI"];?>" />
		<meta property="og:image" content="images/levelshots/<?=$match["map"]; ?>.jpg" />
		<meta property="og:description" content="<?=$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")";?>" />			
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Reflex Arena, FPS <?=$match["players"][0]["name"].", ".$match["players"][1]["name"].", ".$match["map_title"];?>" />
		<meta name="description" content="Reflex Arena Duel Statistics <?=$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")";?>" />			
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
        <div class="inner" style="min-height: 680px; padding-top: 20px; background: url('images/levelshots/<?=$match["map"]; ?>_big.jpg'); background-size: cover;">
        	<div id="player">
				<div class="left-sixth" style="text-align:center;">
					<h2><a style="color: #fff" href="player.php?sid=<?=$match["players"][0]["steamId"]; ?>"><?=$match["players"][0]["name"]; ?></a></h2>
            		<div id="avatar">
							<?
										if ($match["players"][0]["mmr"] < 900){
											echo "<img style='vertical-align: middle;' src='/images/rank1.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 900 && $match["players"][0]["mmr"] < 1400){
											echo "<img style='vertical-align: middle;'  src='/images/rank2.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 1400 && $match["players"][0]["mmr"] < 1700){
											echo "<img style='vertical-align: middle;'  src='/images/rank3.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 1700 && $match["players"][0]["mmr"] < 2000){
											echo "<img style='vertical-align: middle;'  src='/images/rank4.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 2000 && $match["players"][0]["mmr"] < 2200){
											echo "<img style='vertical-align: middle;'  src='/images/rank5.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 2200 && $match["players"][0]["mmr"] < 2500){
											echo "<img style='vertical-align: middle;'  src='/images/rank6.png'>";
										}
										else if ($match["players"][0]["mmr"] >= 2500){
											echo "<img style='vertical-align: middle;'  src='/images/rank7.png'>";
										}								
									?>   
						<br>            		
                		<img id="ctl00_ContentPlaceHolder1_imgModel" src="images/model.png" style="border-width:0px;">
            		</div>         		
        		</div>
				<div class="left-twothird" style="text-align: center; width: 67%; background: #333; opacity: 0.7; filter: alpha(Opacity=70);">				
				<table class="statik">
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right; font-size: 42px; font-weight: bold;"><?php echo $match["players"][0]["score"];?></td>						
						<td></td>
						<td colspan="2" style="text-align: left; font-size: 42px; font-weight: bold;"><?php echo $match["players"][1]["score"];?></td>						
						<td></td>
					</tr>
					<tr>
						<td style="text-align: center; color: #22d6d9">hits/shots</td>
						<td style="text-align: center;">accuracy</td>						
						<td style="text-align: right;">frags</td>
						<td style="text-align: center;"></td>
						<td style="text-align: left;">frags</td>
						<td style="text-align: center;">accuracy</td>	
						<td style="text-align: center; color: #22d6d9">hits/shots</td>
					</tr>						
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][0]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][0]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][0]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][0]['shotsHit']*100)/($match["players"][0]["weapons"][0]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][0]['kills'];?></td>
						<td style="text-align: center;"><span class="icon gauntlet"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][0]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][0]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][0]['shotsHit']*100)/($match["players"][1]["weapons"][0]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][0]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][0]['shotsFired'];?></td>
					</tr>
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][1]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][1]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][1]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][1]['shotsHit']*100)/($match["players"][0]["weapons"][1]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][1]['kills'];?></td>
						<td style="text-align: center;"><span class="icon mg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][1]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][1]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][1]['shotsHit']*100)/($match["players"][1]["weapons"][1]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][1]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][1]['shotsFired'];?></td>
					</tr>
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][2]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][2]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][2]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][2]['shotsHit']*100)/($match["players"][0]["weapons"][2]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][2]['kills'];?></td>
						<td style="text-align: center;"><span class="icon sg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][2]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][2]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][2]['shotsHit']*100)/($match["players"][1]["weapons"][2]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][2]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][2]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][3]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][3]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][3]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][3]['shotsHit']*100)/($match["players"][0]["weapons"][3]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][3]['kills'];?></td>
						<td style="text-align: center;"><span class="icon gl"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][3]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][3]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][3]['shotsHit']*100)/($match["players"][1]["weapons"][3]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][3]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][3]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][4]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][4]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][4]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][4]['shotsHit']*100)/($match["players"][0]["weapons"][4]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][4]['kills'];?></td>
						<td style="text-align: center;"><span class="icon pg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][4]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][4]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][4]['shotsHit']*100)/($match["players"][1]["weapons"][4]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][4]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][4]['shotsFired'];?></td>
					</tr>						
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][5]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][5]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][5]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][5]['shotsHit']*100)/($match["players"][0]["weapons"][5]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][5]['kills'];?></td>
						<td style="text-align: center;"><span class="icon rl"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][5]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][5]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][5]['shotsHit']*100)/($match["players"][1]["weapons"][5]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][5]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][5]['shotsFired'];?></td>
					</tr>																											
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][6]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][6]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][6]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][6]['shotsHit']*100)/($match["players"][0]["weapons"][6]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][6]['kills'];?></td>
						<td style="text-align: center;"><span class="icon lg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][6]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][6]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][6]['shotsHit']*100)/($match["players"][1]["weapons"][6]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][6]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][6]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][7]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][7]['shotsFired'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][0]["weapons"][7]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][0]["weapons"][7]['shotsHit']*100)/($match["players"][0]["weapons"][7]['shotsFired']),2). "%";	
								}
							?>
						</td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][7]['kills'];?></td>
						<td style="text-align: center;"><span class="icon rg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][7]['kills'];?></td>
						<td style="text-align: center;">
							<?
								if($match["players"][1]["weapons"][7]['shotsFired'] == 0){
									echo "0 %";
								}
								else{
									echo round(($match["players"][1]["weapons"][7]['shotsHit']*100)/($match["players"][1]["weapons"][7]['shotsFired']),2). "%";	
								}
							?>
						</td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][7]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][7]['shotsFired'];?></td>
					</tr>										
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right;"><?php echo $match["players"][1]["totalDamageReceived"];?></td>						
						<td style="text-align: center;"><img src="images/medals/carnage.png" width="28px"></td>
						<td colspan="2" style="text-align: left;"><?php echo $match["players"][0]["totalDamageReceived"];?></td>						
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right;"><? echo (int)$match["players"][0]["mmrNew"];?></td>						
						<td style="text-align: center;">MMR</td>
						<td colspan="2" style="text-align: left;"><? echo (int)$match["players"][1]["mmrNew"];?></td>						
						<td></td>
					</tr>											
				</table>					

        		</div>     
				<div class="right-sixth" style="text-align:center;">
					<h2><a style="color: #fff" href="player.php?sid=<? echo $match["players"][1]["steamId"]; ?>"><? echo $match["players"][1]["name"];?></a></h2>
            		<div id="avatar">
							<?
										if ($match["players"][1]["mmr"] < 900){
											echo "<img style='vertical-align: middle;' src='/images/rank1.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 900 && $match["players"][1]["mmr"] < 1400){
											echo "<img style='vertical-align: middle;'  src='/images/rank2.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 1400 && $match["players"][1]["mmr"] < 1700){
											echo "<img style='vertical-align: middle;'  src='/images/rank3.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 1700 && $match["players"][1]["mmr"] < 2000){
											echo "<img style='vertical-align: middle;'  src='/images/rank4.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 2000 && $match["players"][1]["mmr"] < 2200){
											echo "<img style='vertical-align: middle;'  src='/images/rank5.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 2200 && $match["players"][1]["mmr"] < 2500){
											echo "<img style='vertical-align: middle;'  src='/images/rank6.png'>";
										}
										else if ($match["players"][1]["mmr"] >= 2500){
											echo "<img style='vertical-align: middle;'  src='/images/rank7.png'>";
										}								
									?>   
						<br>              		
                		<img id="ctl00_ContentPlaceHolder1_imgModel" src="images/model.png" style="border-width:0px; transform: scale(-1, 1)">
            		</div>           		
        		</div> 
			</div>
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
<?
}
?>

