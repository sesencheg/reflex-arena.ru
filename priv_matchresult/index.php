<?
	require_once('../Reflex.php');
	require '../Rating.php';	
	//$filename = 'log.txt';
	//$json = json_decode($_REQUEST["jsonResult"], true);
	//file_put_contents($filename, var_export($json, true), FILE_APPEND);	
	if(!empty($_REQUEST["jsonResult"])){		
		$reflex = new ReflexController;
		$json = json_decode($_REQUEST["jsonResult"], true);
		if($json["game"]["mode"] == "1v1"){
			$matchGuid = str_replace("{", "", $json["game"]["gameGuid"]);
			$matchGuid = str_replace("}", "", $matchGuid);
			if(empty($reflex->getMatchByGuid($matchGuid))){
				$match_id = $reflex->addMatch($matchGuid, $json["config"]["sv_hostname"], $json["game"]);
				$mmrArray = array();
				foreach ($json["players"] as $player) {
					$db_player = $reflex->getPlayerbySteamId($player["steamId"]);
					if(!empty($db_player)){
						$player_id = $db_player["id"];
						$mmr = $db_player["mmr"];
					}
					else{
						$player_id = $reflex->addPlayer($player);
						$mmr = 2000;
					}		
					if(!empty($player["stats"])){
						$stats_id = $reflex->addPlayerStats($match_id, $player_id, $player);
					}	
					if(!empty($player["weaponStats"])){
						foreach ($player["weaponStats"] as $key => $weaponStats) {
							$reflex->addPlayerWeaponStats($match_id, $player_id, $weaponStats);
						}
					}

					$mmrArray[] = array(
						"steamId" => $player["steamId"],
						"stats_id" => $stats_id,
						"score" => $player["score"],
						"mmr" => $mmr
					);
				}	
    			$rating = new Rating($mmrArray[0]["mmr"], $mmrArray[1]["mmr"], ($mmrArray[0]["score"] > $mmrArray[1]["score"]) ? Rating::WIN : Rating::LOST, ($mmrArray[0]["score"] > $mmrArray[1]["score"]) ? Rating::LOST : Rating::WIN);
    			$ratingResults = $rating->getNewRatings();	    			
    			$reflex->updateRating($mmrArray[0]["steamId"], $mmrArray[0]["stats_id"], (int)round($ratingResults["a"]));
    			$reflex->updateRating($mmrArray[1]["steamId"], $mmrArray[1]["stats_id"], (int)round($ratingResults["b"]));
			}	
		}
	}
?>