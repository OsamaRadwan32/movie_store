<?php 

	function similarity_distance($matrix, $user_1, $user_2) {

		$similar = array();
		$sum = 0;
		// print_r($matrix);
		
		foreach ($matrix[$user_1] as $key => $value) {
			if (array_key_exists($key, $matrix[$user_2])) {
				$similar[$key] = 1;
			}
		}

		if ($similar == 0) {
			return 0;
		}

		foreach ($matrix[$user_1] as $key => $value) {
			if (array_key_exists($key, $matrix[$user_2])) {
				$sum = $sum + pow($matrix[$user_2][$key], 2);
			}
		}

		// print_r($sum);
		return 1 / (1 + sqrt($sum));
	} 

	function getRecommendation($matrix, $user) {

		$total = array();
		$simsums = array();
		$ranks = array();

		foreach ($matrix as $otheruser => $value) {

			if ($otheruser != $user) {

				$sim = similarity_distance($matrix, $user, $otheruser);

				foreach ($matrix[$otheruser] as $key => $value) {
					if (!array_key_exists($key, $matrix[$user])) {
						

						if (!array_key_exists($key, $total)) {
							$total[$key] = 0;
						}

						$total[$key] += $matrix[$otheruser][$key]*$sim;

						if (!array_key_exists($key, $simsums)) {
							$simsums[$key] = 0;
						}

						$simsums[$key] += $sim;

					}
				}
			}
		}

		foreach ($total as $key => $value) {
			$ranks[$key] = $value / $simsums[$key];
		}

		array_multisort($ranks, SORT_DESC);
		
		// print_r($simsums);
		// print_r($total);

		return $ranks;
	}
 ?>