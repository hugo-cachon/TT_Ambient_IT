<?php

// Le tableau $sessions contient les tableaux associatifs $currentFormation
function bubble_Sort($sessions)
{

	do
	{
		$swapped = false;
		for( $i = 0, $c = count( $sessions ) - 1; $i < $c; $i++ )
		{
            // Comparaison des dates et tri en fonction  
            if( $sessions[$i]["startDate"] > $sessions[$i + 1]["startDate"] )
			{
                list( $sessions[$i + 1], $sessions[$i] ) =
						array( $sessions[$i], $sessions[$i + 1] );
				$swapped = true;
			}
		}
	}
	while( $swapped );
return $sessions;
}

//var_dump(bubble_Sort($sessions));
?>