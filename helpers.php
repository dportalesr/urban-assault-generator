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

function set_new_height($height){
  $height += rand(0, 4) - 2;
  if($height < 0) $height = 0;
  if($height > 255) $height = 255;

  return $height;
}
