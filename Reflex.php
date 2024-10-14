<?php
	
	class ReflexController{
		protected $db;

		function __construct() {
			$this->db = mysqli_connect("localhost", "user", "password", "db");
			mysqli_set_charset($this->db, "utf8");
		}

		function getMatchByGuid($guid){			
			$guid = mysqli_real_escape_string($this->db, $guid);
			$match = mysqli_query($this->db, "SELECT * FROM duels WHERE gameGuid='".$guid."'");
			return mysqli_fetch_array($match);
		}		

		function addMatch($matchGuid, $sv_hostname, $game){
			$matchGuid = mysqli_real_escape_string($this->db, $matchGuid);
			$sv_hostname = mysqli_real_escape_string($this->db, $sv_hostname);
			$matchGuid = mysqli_real_escape_string($this->db, $matchGuid);
			$mode = mysqli_real_escape_string($this->db, $game["mode"]);
			$map = mysqli_real_escape_string($this->db, $game["map"]);
			$map_title = mysqli_real_escape_string($this->db, $game["title"]);
			$query = "INSERT INTO duels (gameGuid, sv_hostname, mode, map, map_title, date) VALUES ('".$matchGuid."', '".$sv_hostname."', '".$mode."', '".$map."', '".$map_title."', '".date('Y-m-d H:i:s')."')";			
			mysqli_query($this->db, $query);	
			return mysqli_insert_id($this->db);
		}

		function getPlayerbySteamId($steamId){
			$steamId = mysqli_real_escape_string($this->db, $steamId);
			$player = mysqli_query($this->db, "SELECT * FROM players WHERE steamId='".$steamId."'");
			return mysqli_fetch_assoc($player);
		}

		function addPlayer($player){
			$name = mysqli_real_escape_string($this->db, $player["name"]);
			$country = mysqli_real_escape_string($this->db, $player["country"]);
			$steamId = mysqli_real_escape_string($this->db, $player["steamId"]);			
			$query = "INSERT INTO players (name, country, steamId, mmr, mmrBest) VALUES ('".$name."', '".$country."', '".$steamId."', 2000, 2000)";		
			mysqli_query($this->db, $query);	
			return mysqli_insert_id($this->db);
		}

		function addPlayerStats($duel_id, $player_id, $player){
			$duel_id = mysqli_real_escape_string($this->db, $duel_id);
			$player_id = mysqli_real_escape_string($this->db, $player_id);
			$score = mysqli_real_escape_string($this->db, $player["score"]);
			$forfeit = mysqli_real_escape_string($this->db, $player["forfeit"]);
			$disconnected = mysqli_real_escape_string($this->db, $player["disconnected"]);
			$state = mysqli_real_escape_string($this->db, $player["state"]);
			$team = mysqli_real_escape_string($this->db, $player["team"]);
			$takenRA = mysqli_real_escape_string($this->db, $player["stats"]["takenRA"]);
			$takenYA = mysqli_real_escape_string($this->db, $player["stats"]["takenYA"]);
			$takenGA = mysqli_real_escape_string($this->db, $player["stats"]["takenGA"]);
			$takenMega = mysqli_real_escape_string($this->db, $player["stats"]["takenMega"]);
			$flagsCaptured = mysqli_real_escape_string($this->db, $player["stats"]["flagsCaptured"]);
			$flagsPickedUp = mysqli_real_escape_string($this->db, $player["stats"]["flagsPickedUp"]);
			$flagsReturned = mysqli_real_escape_string($this->db, $player["stats"]["flagsReturned"]);
			$totalDeaths = mysqli_real_escape_string($this->db, $player["stats"]["totalDeaths"]);
			$secondsHeldQuad = mysqli_real_escape_string($this->db, $player["stats"]["secondsHeldQuad"]);
			$secondsHeldResist = mysqli_real_escape_string($this->db, $player["stats"]["secondsHeldResist"]);
			$totalHealthPickedUp = mysqli_real_escape_string($this->db, $player["stats"]["totalHealthPickedUp"]);
			$totalDamageReceived = mysqli_real_escape_string($this->db, $player["stats"]["totalDamageReceived"]);
			$distanceTravelled = mysqli_real_escape_string($this->db, $player["stats"]["distanceTravelled"]);

			$query = "INSERT INTO match_stats (duel_id, player_id, score, forfeit, disconnected, state, team, takenRA, takenYA, takenGA, takenMega, flagsCaptured, flagsPickedUp, flagsReturned, totalDeaths, secondsHeldQuad, secondsHeldResist, totalHealthPickedUp, totalDamageReceived, distanceTravelled) VALUES ('".$duel_id."', '".$player_id."', '".$score."', '".$forfeit."', '".$disconnected."', '".$state."', '".$team."', '".$takenRA."', '".$takenYA."', '".$takenGA."', '".$takenMega."', '".$flagsCaptured."', '".$flagsPickedUp."', '".$flagsReturned."', '".$totalDeaths."', '".$secondsHeldQuad."', '".$secondsHeldResist."', '".$totalHealthPickedUp."', '".$totalDamageReceived."', '".$distanceTravelled."')";		
			mysqli_query($this->db, $query);	
			return mysqli_insert_id($this->db);			
		}

		function addPlayerWeaponStats($duel_id, $player_id, $weaponStats){
			$duel_id = mysqli_real_escape_string($this->db, $duel_id);
			$player_id = mysqli_real_escape_string($this->db, $player_id);
			$weaponName = mysqli_real_escape_string($this->db, $weaponStats["weaponName"]);
			$pickedUp = mysqli_real_escape_string($this->db, $weaponStats["pickedUp"]);
			$kills = mysqli_real_escape_string($this->db, $weaponStats["kills"]);
			$shotsFired = mysqli_real_escape_string($this->db, $weaponStats["shotsFired"]);
			$shotsHit = mysqli_real_escape_string($this->db, $weaponStats["shotsHit"]);
			$damageDone = mysqli_real_escape_string($this->db, $weaponStats["damageDone"]);
			$secondsHeld = mysqli_real_escape_string($this->db, $weaponStats["secondsHeld"]);
			$query = "INSERT INTO match_weaponstats (duel_id, player_id, weaponName, pickedUp, kills, shotsFired, shotsHit, damageDone, secondsHeld) VALUES ('".$duel_id."', '".$player_id."', '".$weaponName."', '".$pickedUp."', '".$kills."', '".$shotsFired."', '".$shotsHit."', '".$damageDone."', '".$secondsHeld."')";					
			mysqli_query($this->db, $query);	
			return mysqli_insert_id($this->db);		
		}

		function getPlayersCount(){
			$players = mysqli_query($this->db, "SELECT * FROM players");
			return mysqli_num_rows($players);
		}

		function getDuelsCount(){
			$duels = mysqli_query($this->db, "SELECT * FROM duels");
			return mysqli_num_rows($duels);
		}

		function getMainDuels(){
			$result = array();
			$duels = mysqli_query($this->db, "SELECT * FROM duels ORDER by id DESC limit 10");
			while($duel = mysqli_fetch_assoc($duels)){	
				$stats = mysqli_query($this->db, "SELECT match_stats.*, players.*  FROM match_stats LEFT JOIN players ON match_stats.player_id = players.id WHERE match_stats.duel_id = '".$duel["id"]."' ORDER by match_stats.score DESC");
				$players_result = array();				
				while($stat = mysqli_fetch_assoc($stats)){	
					$players_result[] = $stat;
				}
				$duel["players"] = $players_result;
				$result[] = $duel;
			}
			return $result;
			
		}

		function getTopPlayers(){		
			$result = array();	
			$players = mysqli_query($this->db, "SELECT * FROM players ORDER by mmr DESC limit 10");
			while($player = mysqli_fetch_assoc($players)){
				$result[] = $player;
			}

			return $result;
		}

		function getPopularMaps(){
			$result = array();	
			$maps = mysqli_query($this->db, "SELECT COUNT(*) as cnt, map_title FROM duels GROUP BY map ORDER by cnt desc LIMIT 7");
			while($map = mysqli_fetch_assoc($maps)){
				$result[] = $map;
			}

			return $result;
		}

		function getMatchById($guid){
			$result = array();
			$guid = mysqli_real_escape_string($this->db, $guid);
			$duels = mysqli_query($this->db, "SELECT * FROM duels WHERE gameGuid = '".$guid."'");
			if($duel = mysqli_fetch_assoc($duels)){
				$stats = mysqli_query($this->db, "SELECT match_stats.*, players.*   FROM match_stats LEFT JOIN players ON match_stats.player_id = players.id WHERE match_stats.duel_id = '".$duel["id"]."' ORDER by match_stats.score DESC");
				$players_result = array();				
				while($stat = mysqli_fetch_assoc($stats)){	
					$weapons = array();
					$playerWeaponStats = mysqli_query($this->db, "SELECT * FROM match_weaponstats WHERE duel_id = '".$duel["id"]."' AND player_id = '".$stat["player_id"]."'");
					while($playerWeaponStat = mysqli_fetch_assoc($playerWeaponStats)){
						$weapons[] = $playerWeaponStat;
					}
					$stat["weapons"] = $weapons;
					$players_result[] = $stat;
				}
				$duel["players"] = $players_result;
				$result = $duel;
			}
			return $result;			
		}		

		function getPlayerById($steamId){
			$result = array();
			$steamId = mysqli_real_escape_string($this->db, $steamId);
			$players = mysqli_query($this->db, "SELECT * FROM players WHERE steamId = '".$steamId."'");
			if($player = mysqli_fetch_assoc($players)){
				$duels = mysqli_query($this->db, "SELECT count(*) as cnt, SUM(score) as kills, SUM(totalDeaths) as deaths, SUM(totalDamageReceived) as totalDamageReceived FROM match_stats WHERE player_id = '".$player["id"]."'");
				if($stats = mysqli_fetch_assoc($duels)){
					$player["duels"] = $stats["cnt"];
					$player["kills"] = $stats["kills"];
					$player["deaths"] = $stats["deaths"];					
					$player["totalDamageReceived"] = $stats["totalDamageReceived"];					
				}
				$allDamage = 0;
				$weaponStats = mysqli_query($this->db, "SELECT weaponName, SUM(kills) as kills, SUM(shotsFired) as shotsFired, SUM(shotsHit) as shotsHit, SUM(damageDone) as damageDone FROM match_weaponstats WHERE player_id = '".$player["id"]."' GROUP by weaponName");
				while($weaponStat = mysqli_fetch_assoc($weaponStats)){
					$player["weapons"][$weaponStat["weaponName"]] = $weaponStat;
					$allDamage += $weaponStat["damageDone"];
				}
				$player["allDamage"] = $allDamage;

				$win = 0;
				$loss = 0;
				$duels = mysqli_query($this->db, "SELECT duel_id FROM match_stats WHERE player_id = '".$player["id"]."'");
				$maps = array();
				while($match = mysqli_fetch_assoc($duels)){					
					$wM = mysqli_query($this->db, "SELECT match_stats.player_id, duels.map_title FROM match_stats, duels WHERE duels.id = match_stats.duel_id AND  match_stats.duel_id = '".$match["duel_id"]."' ORDER by match_stats.score DESC LIMIT 1");
					if($m = mysqli_fetch_assoc($wM)){								
						if($m["player_id"] == $player["id"]){
							if(empty($maps[$m["map_title"]]["win"])){
								$maps[$m["map_title"]]["win"] = 0;
							}
							$maps[$m["map_title"]]["win"]++;
							$win++;
						}
						else{
							if(empty($maps[$m["map_title"]]["loss"])){
								$maps[$m["map_title"]]["loss"] = 0;
							}
							$maps[$m["map_title"]]["loss"]++;
							$loss++;
						}
					}
				}
				$player["maps"] = $maps;
				$player["win"] = $win;
				$player["loss"] = $loss;

				$mapStats = array();
				$maps = mysqli_query($this->db, "SELECT count(*) as cnt, duels.map_title FROM match_stats, duels WHERE match_stats.duel_id = duels.id AND match_stats.player_id = '".$player["id"]."' GROUP by map_title ORDER by cnt DESC");
				while($map = mysqli_fetch_assoc($maps)){
					$mapStats[] = $map;
				}

				$player["mapStats"] = $mapStats;

				$result = $player;
			}
			return $result;
		}

		function getPlayerDuels($player_id, $limit = 10){
			$result = array();
			$player_id = mysqli_real_escape_string($this->db, $player_id);			
			$duels = mysqli_query($this->db, "SELECT match_stats.duel_id, duels.map_title, duels.map, duels.date, duels.gameGuid FROM match_stats, duels WHERE match_stats.duel_id = duels.id AND match_stats.player_id = '".$player_id."' ORDER by match_stats.duel_id desc LIMIT ".$limit);
			while($match = mysqli_fetch_assoc($duels)){	
				$matchArr = array();
				$matchArr["gameGuid"] = $match["gameGuid"];
				$matchArr["map"] = $match["map"];
				$matchArr["map_title"] = $match["map_title"];
				$matchArr["date"] = date("d.m.Y", strtotime($match["date"]));

				$matchPlayers = array();
				$wM = mysqli_query($this->db, "SELECT match_stats.player_id, match_stats.score, match_stats.mmrNew, players.name, players.steamId FROM match_stats, players WHERE match_stats.player_id = players.id AND  match_stats.duel_id = '".$match["duel_id"]."' ORDER by match_stats.score DESC");
				while($m = mysqli_fetch_assoc($wM)){								
					$matchArr["players"][] = $m;
				}

				$result[] = $matchArr;
			}
			return $result;
		}

		function updateRating($steamId, $stats_id, $newMMR){
			$steamId = mysqli_real_escape_string($this->db, $steamId);
			$stats_id = mysqli_real_escape_string($this->db, $stats_id);
			$newMMR = mysqli_real_escape_string($this->db, $newMMR);

			$player = $this->getPlayerbySteamId($steamId);
			$updateStats = mysqli_query($this->db, "UPDATE match_stats SET mmrNew='".$player["mmr"]."' WHERE id=".$stats_id);
			$mmrBest = $player["mmrBest"];
			if($newMMR > $mmrBest){
				$mmrBest = $newMMR;
			}
			$updatePlayer = mysqli_query($this->db, "UPDATE players SET mmr='".$newMMR."', mmrBest='".$mmrBest."' WHERE id=".$player["id"]);
		}

		function getPlayers($name = "", $page = 1){
			$name = mysqli_real_escape_string($this->db, $name);
			$page = mysqli_real_escape_string($this->db, $page);
			$page = $page - 1;
			$pt = ($page*100)+1;														
			if (!$page){
				$pt = 0;
			}			
			$result = array();
			if(empty($name)){
				$players = mysqli_query($this->db, "SELECT * FROM players ORDER by mmr DESC limit 100 OFFSET ".$pt);
			}
			else{
				$players = mysqli_query($this->db, "SELECT * FROM players WHERE name LIKE '%".$name."%' ORDER by mmr DESC limit 100 OFFSET ".$pt);
			}
			while($player = mysqli_fetch_assoc($players)){
				$result[] = $player;
			}
			return $result;
		}

	}
?>
