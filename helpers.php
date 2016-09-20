<?php
function fid($faction){
  return $faction == 'res' ? 1 : array_search($faction, FACTIONS);
}

function get_position($coor, $vertical = false){
  return (($coor + 0.5) * 1200 * ($vertical ? -1 : 1)) + 1; /* + 1 to avoid bugs on sector edge */
}

function distance_between($p1, $p2){
  $dx = get_position($p1['x']) - get_position($p2['x']);
  $dy = get_position($p1['y']) - get_position($p2['y']);
  return sqrt(pow($dx,2) + pow($dy,2));
}

function sample($arr){
  return $arr[array_rand($arr)];
}

function new_height($height){
  if(mt_rand(0,2)){
    $height += rand(-2, 2);
    if($height > 152) $height = 152;
    if($height < 104) $height = 104;
  }

  return $height;
}
