<?php
	// Start the session
	session_start();
	function array_positions_organizer($disarrange_array,$order){
		$group_arrays = [];
		for ($i = 0;$i<count($disarrange_array);$i++){
			if (isset($group_arrays[$disarrange_array[$i]])){
				array_push($group_arrays[$disarrange_array[$i]], $i);
			}else{
				$group_arrays[$disarrange_array[$i]] = [$i];
			}
		}
		if ($order == "asc"){
			ksort($group_arrays);
		}elseif ($order == "desc"){
			krsort($group_arrays);
		}
		$list_positions = [];
		foreach($group_arrays as $value){
			$list_positions = array_merge($list_positions,$value);
		}
		return $list_positions;
	}
	function change_arrays_vowels($array1,$array2){
		$array1_changed = $array1;
		$array2_changed = $array2;
		if (($array1!=[])&&($array2!=[])){
			setlocale(LC_ALL, 'en_GB');
			$array1_vowels_positions = [];
			$array2_vowels_positions = [];
			$array1_vowels_positions = [];
			$array2_vowels_positions = [];
			$lower_vowels = ["a","i","u","e","o"];
			$upper_vowels = ["A","I","U","E","O"];
			$accented_lower_vowels = ["á","à","ã","â","ä","ǎ","í","ì","î","ï","ǐ","ú","ù","û","ü","ǔ","é","è","ê","ë","ě","ó","ò","õ","ô","ö","ǒ"];
			$accented_upper_vowels = ["Á","À","Ã","Â","Ä","Ǎ","Í","Ì","Î","Ï","Ǐ","Ú","Ù","Û","Ü","Ǔ","É","È","Ê","Ë","Ě","Ó","Ò","Õ","Ô","Ö","Ǒ"];
			for ($i = 0;$i<count($array1);$i++){
				$array1_vowels_positions[$i] = [];
				$array1_vowels_positions[$i] = [];
				foreach ($lower_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array1[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array1_vowels_positions[$i][$pos] = "lower_vowels";
					}
				}
				foreach ($upper_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array1[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array1_vowels_positions[$i][$pos] = "upper_vowels";
					}
				}
				foreach ($accented_lower_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array1[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array1_vowels_positions[$i][$pos] = "accented_lower_vowels";
					}
				}
				foreach ($accented_upper_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array1[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array1_vowels_positions[$i][$pos] = "accented_upper_vowels";
					}
				}
				ksort($array1_vowels_positions[$i]);
				$temporary_array = [];
				foreach($array1_vowels_positions[$i] as $position => $type){
					array_push($temporary_array, [$position,$type]);
				}
				$array1_vowels_positions[$i] = $temporary_array;
			}
			for ($i = 0;$i<count($array2);$i++){
				$array2_vowels_positions[$i] = [];
				$array2_vowels_positions[$i] = [];
				foreach ($lower_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array2[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array2_vowels_positions[$i][$pos] = "lower_vowels";
					}
				}
				foreach ($upper_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array2[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array2_vowels_positions[$i][$pos] = "upper_vowels";
					}
				}
				foreach ($accented_lower_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array2[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array2_vowels_positions[$i][$pos] = "accented_lower_vowels";
					}
				}
				foreach ($accented_upper_vowels as $vowel){
					$offset = 0;
					while (($pos = strpos($array2[$i], $vowel, $offset)) !== FALSE) {
						$offset = $pos + 1;
						$array2_vowels_positions[$i][$pos] = "accented_upper_vowels";
					}
				}
				ksort($array2_vowels_positions[$i]);
				$temporary_array = [];
				foreach($array2_vowels_positions[$i] as $position => $type){
					array_push($temporary_array, [$position,$type]);
				}
				$array2_vowels_positions[$i] = $temporary_array;
			}
			$array1_changed = $array1;
			$array2_changed = $array2;
			if (count($array1)<count($array2)){
				for ($i = 0;$i<count($array1);$i++){
					$position_change1 = 0;
					$position_change2 = 0;
					if (count($array1_vowels_positions[$i])<count($array2_vowels_positions[$i])){
						for($x = 0;$x<count($array1_vowels_positions[$i]);$x++){
							if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}
							if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}
						}
					}else{
						for($x = 0;$x<count($array2_vowels_positions[$i]);$x++){
							if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}
							if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}
						}
					}
				}
			}else{
				for ($i = 0;$i<count($array2);$i++){
					$position_change1 = 0;
					$position_change2 = 0;
					if (count($array1_vowels_positions[$i])<count($array2_vowels_positions[$i])){
						for($x = 0;$x<count($array1_vowels_positions[$i]);$x++){
							if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}
							if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}
						}
					}else{
						for($x = 0;$x<count($array2_vowels_positions[$i]);$x++){
							if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,1);
									$position_change1++;
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}elseif ($array1_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array2[$i][$array2_vowels_positions[$i][$x][0]]);
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
									$position_change1--;
								}elseif($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}else{
									$letter = $array2[$i][$array2_vowels_positions[$i][$x][0]].$array2[$i][($array2_vowels_positions[$i][$x][0])+1];
									$position = ($array1_vowels_positions[$i][$x][0])+$position_change1;
									$array1_changed[$i] = substr_replace($array1_changed[$i],$letter,$position,2);
								}
							}
							if ($array2_vowels_positions[$i][$x][1] == "lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,1);
									$position_change2++;
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = strtolower($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $accented_lower_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_upper_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}elseif ($array2_vowels_positions[$i][$x][1] == "accented_upper_vowels"){
								if ($array1_vowels_positions[$i][$x][1] == "lower_vowels"){
									$letter = strtoupper($array1[$i][$array1_vowels_positions[$i][$x][0]]);
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "upper_vowels"){
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
									$position_change2--;
								}elseif($array1_vowels_positions[$i][$x][1] == "accented_lower_vowels"){
									$letter = $accented_upper_vowels[array_search($array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1], $accented_lower_vowels)];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}else{
									$letter = $array1[$i][$array1_vowels_positions[$i][$x][0]].$array1[$i][($array1_vowels_positions[$i][$x][0])+1];
									$position = ($array2_vowels_positions[$i][$x][0])+$position_change2;
									$array2_changed[$i] = substr_replace($array2_changed[$i],$letter,$position,2);
								}
							}
						}
					}
				}
			}
		}
		return (array($array1_changed, $array2_changed));
	}
?>
<html>
	<head>
		<title>CEP</title>
		<style>
			table{
				width:80%;
				top:0;
				bottom: 0;
				left: 0;
				right: 0;
				
				margin: auto;
			}
			th, td {
				width:25%;
			}
			table, th, td {
				border: 1px solid black;
				text-align:center;
			}
		</style>
	</head>
	<body>
		<form action="" style="margin-left:45%;margin-top:5%;" id="cep" method="POST">
			CEP: <input type="text" name="cep" pattern="[0-9]{8}" id="cep">
		</form>
		<form action="" style="margin-left:10%;margin-top:-2%;" method="POST">
			<input type="submit" name="destroy" id="destroy" value="limpar registro">
		</form>
		<form action="" style="margin-left:77.2%;margin-top:-2%;" method="POST">
			<input type="submit" name="change_vowels" id="change_vowels" value="Trocar vogais entre bairro e localidade">
		</form>
		<?php
			if (!isset($_SESSION["ceps"])) {
				$_SESSION["ceps"] = array("logradouro"=>[], "bairro"=>[], "localidade"=>[], "complemento"=>[]);
			}
			
			if (isset($_POST['cep'])) {
				$cep = $_POST['cep'];
				$homepage = @file_get_contents('http://viacep.com.br/ws/'.$cep.'/json/');
				if ($homepage != false){
					$caracteres = ['"','{','}'];
					$alterado = str_replace($caracteres, '', $homepage);
					$teste = explode(',', $alterado);
					if (trim($teste[0]) != "erro: true"){
						for ($i = 0;$i<count($teste);$i++){
							$valores[$i] = explode(':', $teste[$i]);
							$valores[$i][0] = trim($valores[$i][0]);
							if ($valores[$i][0] == "logradouro" || $valores[$i][0] == "complemento" || $valores[$i][0] == "bairro" || $valores[$i][0] == "localidade" ){
								array_push($_SESSION["ceps"][$valores[$i][0]], trim($valores[$i][1]));
							}
						}
					}else{
						echo '<script>alert("Não foi possivel encontrar o CEP : '.$cep.'\nPor favor verifique se o CEP está correto.")</script>';
					}
				}else{
					echo '<script>alert("Não foi possivel completar a busca pelo CEP : '.$cep.'\nCEP informado não está na fomatação correta.\nPor favor insira um CEP com 8 números.\nExemplo de CEP : 01001000 ")</script>';
				}
			}
			echo '<table>';
				echo '<tr>';
					
					echo '<th>';
						echo '<form action="" method="POST">';
							if (isset($_POST['field'])) {
								if (($_POST['order'] == "asc") && ($_POST['field'] == "logradouro")) {
									echo '<input type="hidden" name="order" value="desc">';
								}else{
									echo '<input type="hidden" name="order" value="asc">';
								}
							}else{
								echo '<input type="hidden" name="order" value="asc">';
							}
							echo '<input type="submit" name="field" value="logradouro">';
						echo '</form>';
					echo '</th>';
					echo '<th>';
						echo '<form action="" method="POST">';
							if (isset($_POST['field'])) {
								if (($_POST['order'] == "asc") && ($_POST['field'] == "complemento")) {
									echo '<input type="hidden" name="order" value="desc">';
								}else{
									echo '<input type="hidden" name="order" value="asc">';
								}
							}else{
								echo '<input type="hidden" name="order" value="asc">';
							}
							echo '<input type="submit" name="field"  value="complemento">';
						echo '</form>';
					echo '</th>';
					echo '<th>';
						echo '<form action="" method="POST">';
							if (isset($_POST['field'])) {
								if (($_POST['order'] == "asc") && ($_POST['field'] == "bairro")) {
									echo '<input type="hidden" name="order" value="desc">';
								}else{
									echo '<input type="hidden" name="order" value="asc">';
								}
							}else{
								echo '<input type="hidden" name="order" value="asc">';
							}
							echo '<input type="submit" name="field"  value="bairro">';
						echo '</form>';
					echo '</th>';
					echo '<th>';
						echo '<form action="" method="POST">';
							if (isset($_POST['field'])) {
								if (($_POST['order'] == "asc") && ($_POST['field'] == "localidade")) {
									echo '<input type="hidden" name="order" value="desc">';
								}else{
									echo '<input type="hidden" name="order" value="asc">';
								}
							}else{
								echo '<input type="hidden" name="order" value="asc">';
							}
							echo '<input type="submit" name="field"  value="localidade">';
						echo '</form>';
					echo '</th>';

				echo '</tr>';
			if (isset($_POST['destroy'])) {
				session_unset();
				session_destroy();
			}else{
				if (isset($_POST['field'])) {
					$list_order = array_positions_organizer($_SESSION["ceps"][$_POST['field']],$_POST['order']);
				}
				if (isset($list_order)){
					foreach($list_order as $position){
						echo '<tr>';
							echo '<td name="html">'.$_SESSION["ceps"]["logradouro"][$position].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["complemento"][$position].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["bairro"][$position].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["localidade"][$position].'</td>';
						echo '</tr>';
					}
				}elseif(isset($_POST['change_vowels'])){
					$changed_arrays = change_arrays_vowels($_SESSION["ceps"]["bairro"],$_SESSION["ceps"]["localidade"]);
					$bairro_mudado = $changed_arrays[0];
					$localidade_mudado = $changed_arrays[1];
					for ($i = 0;$i<count($_SESSION["ceps"]["logradouro"]);$i++){
						echo '<tr>';
							echo '<td name="html">'.$_SESSION["ceps"]["logradouro"][$i].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["complemento"][$i].'</td>';
							echo '<td name="html">'.$bairro_mudado[$i].'</td>';
							echo '<td name="html">'.$localidade_mudado[$i].'</td>';
						echo '</tr>';
					}
				}else{
					for ($i = 0;$i<count($_SESSION["ceps"]["logradouro"]);$i++){
						echo '<tr>';
							echo '<td name="html">'.$_SESSION["ceps"]["logradouro"][$i].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["complemento"][$i].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["bairro"][$i].'</td>';
							echo '<td name="html">'.$_SESSION["ceps"]["localidade"][$i].'</td>';
						echo '</tr>';
					}
				}
			}
			echo '</table>';
		?>
		
	</body>
</html>
