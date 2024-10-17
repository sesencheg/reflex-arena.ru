<?php
require 'Reflex.php';
$reflex = new ReflexController;
if (isset($_GET["guid"])){
	$match = $reflex->getMatchById($_GET["guid"]);
	$meta = '<title>'.$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")".'</title>
			<meta property="og:title" content="'.$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")".'" />
			<meta property="og:url" content="http://reflex-arena.ru/'.$_SERVER["REQUEST_URI"].'" />
			<meta property="og:image" content="images/levelshots/'.$match["map"].'.jpg" />
			<meta property="og:description" content="'.$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")".'" />			
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="Reflex Arena, FPS, '.$match["players"][0]["name"].", ".$match["players"][1]["name"].", ".$match["map_title"].'" />
			<meta name="description" content="Reflex Arena Duel Statistics '.$match["players"][0]["name"]." vs ".$match["players"][1]["name"]." (".$match["map_title"].")".'" />';
	?>
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" >
	<? include("inc/header.php"); ?>
	<div id="content">
		<div class="inner" style="min-height: 680px; padding-top: 20px; background: url('images/levelshots/<?=$match["map"]; ?>_big.jpg'); background-size: cover;">
			<div id="player">
				<div class="left-sixth" style="text-align:center;">
					<h2><a style="color: #fff" href="player.php?sid=<?=$match["players"][0]["steamId"]; ?>"><?=$match["players"][0]["name"]; ?></a></h2>
					<div id="avatar">
						<img style="vertical-align: middle;" src="/images/rank<?=$match["players"][0]["mmr_rank"];?>.png">		 		 
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
						<td style="text-align: center;"><?=$match["players"][0]["weapons"][0]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][0]['kills'];?></td>
						<td style="text-align: center;"><span class="icon gauntlet"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][0]['kills'];?></td>
						<td style="text-align: center;"><?=$match["players"][1]["weapons"][0]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][0]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][0]['shotsFired'];?></td>
					</tr>
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][1]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][1]['shotsFired'];?></td>
						<td style="text-align: center;"><?=$match["players"][0]["weapons"][1]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][1]['kills'];?></td>
						<td style="text-align: center;"><span class="icon mg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][1]['kills'];?></td>
						<td style="text-align: center;"><?=$match["players"][1]["weapons"][1]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][1]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][1]['shotsFired'];?></td>
					</tr>
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][2]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][2]['shotsFired'];?></td>
						<td style="text-align: center;"><?=$match["players"][0]["weapons"][2]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][2]['kills'];?></td>
						<td style="text-align: center;"><span class="icon sg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][2]['kills'];?></td>
						<td style="text-align: center;"><?=$match["players"][1]["weapons"][2]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][2]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][2]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][3]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][3]['shotsFired'];?></td>
						<td style="text-align: center;"><?=$match["players"][0]["weapons"][3]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][3]['kills'];?></td>
						<td style="text-align: center;"><span class="icon gl"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][3]['kills'];?></td>
						<td style="text-align: center;"><?=$match["players"][1]["weapons"][3]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][3]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][3]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][4]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][4]['shotsFired'];?></td>
						<td style="text-align: center;"><?=$match["players"][0]["weapons"][4]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][4]['kills'];?></td>
						<td style="text-align: center;"><span class="icon pg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][4]['kills'];?></td>
						<td style="text-align: center;"><?=$match["players"][1]["weapons"][4]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][4]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][4]['shotsFired'];?></td>
					</tr>						
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][5]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][5]['shotsFired'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][0]["weapons"][5]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][5]['kills'];?></td>
						<td style="text-align: center;"><span class="icon rl"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][5]['kills'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][1]["weapons"][5]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][5]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][5]['shotsFired'];?></td>
					</tr>																											
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][6]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][6]['shotsFired'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][0]["weapons"][6]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][6]['kills'];?></td>
						<td style="text-align: center;"><span class="icon lg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][6]['kills'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][1]["weapons"][6]['accuracy'];?></td>	
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][1]["weapons"][6]['shotsHit'];?>/<?php echo $match["players"][1]["weapons"][6]['shotsFired'];?></td>
					</tr>	
					<tr>
						<td style="text-align: center; color: #22d6d9"><?php echo $match["players"][0]["weapons"][7]['shotsHit'];?>/<?php echo $match["players"][0]["weapons"][7]['shotsFired'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][0]["weapons"][7]['accuracy'];?></td>						
						<td style="text-align: right;"><?php echo $match["players"][0]["weapons"][7]['kills'];?></td>
						<td style="text-align: center;"><span class="icon rg"></span></td>
						<td style="text-align: left;"><?php echo $match["players"][1]["weapons"][7]['kills'];?></td>
						<td style="text-align: center;"><?php echo $match["players"][1]["weapons"][7]['accuracy'];?></td>	
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
						<img style="vertical-align: middle;" src="/images/rank<?=$match["players"][1]["mmr_rank"];?>.png">		 		
						<br>			  		
						<img id="ctl00_ContentPlaceHolder1_imgModel" src="images/model.png" style="border-width:0px; transform: scale(-1, 1)">
					</div>		   		
				</div> 
			</div>
		</div>
	</div>
	<? include("inc/footer.php"); ?>
</body>
</html>
<?
}
?>

