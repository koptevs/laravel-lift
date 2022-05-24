<?php
function get_lift_data_by_id($id) {
	global $lifti;
	return $lifti[$id];
}
function left_padding() {
	global $pdf;
	global $left_padding;
	global $is_filled;
	$pdf->setFillColor( 255, 128, 255 );
	if ( isset( $left_padding ) ) {
	    dd(1);
		$pdf->cell( $left_padding, 5, "", 0, 0, 'L', $is_filled );
	}
	$pdf->setFillColor( 128, 255, 128 );
}

function stringToArray( $s ) {
	$r = array();
	for ( $i = 0; $i < strlen( $s ); $i ++ ) {
		$r[ $i ] = $s[ $i ];
	}

	return $r;
}

function numbered_string_to_array( $mystr ) {

	$string_without_newlines = preg_replace( '~[\r\n]+~', '', $mystr );
	$array_of_characters     = mb_str_split( $string_without_newlines );
	$arr_len                 = count( $array_of_characters );
	$result                  = [];

	for ( $i = 0; $i < $arr_len; $i ++ ) {
		if ( is_numeric( $array_of_characters[ $i ] ) && $array_of_characters[ $i + 1 ] === '.' && is_numeric( $array_of_characters[ $i + 2 ] ) ) {
			$temp_array[]  = $array_of_characters[ $i ];
			$temp_array[]  = $array_of_characters[ $i + 1 ];
			$temp_array[]  = $array_of_characters[ $i + 2 ];
			$current_array = implode( $temp_array );
			if ( ! isset( $result[ $current_array ] ) ) {
				$result[ $current_array ] = [];
			}
			$temp_array = [];
			$i ++;
			$i ++;
//    continue;

		} else {
			$result[ $current_array ][] = $array_of_characters[ $i ];
		}
	}
	foreach ( $result as $res_index => $res_value ) {
		$result[ $res_index ] = trim( implode( $res_value ) );
	}

	ksort($result, SORT_NUMERIC);
	return $result;
}

function getPositionForCheckbox($pdf) {
	global $checkboxes;
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$checkboxes[] = ["x" => $x, "y" => $y];
}
function getPositionForEmptyCheckbox($pdf) {
	global $empty_checkboxes;
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$empty_checkboxes[] = ["x" => $x, "y" => $y];
}

