<?php
function fid($faction){
  return $faction == 'res' ? 1 : array_search($faction, FACTIONS);
}

function get_position($coor, $vertical = false){
  return (($coor + 0.5) * 1200 * ($vertical ? -1 : 1)) + 1; /* + 1 to avoid bugs on sector edge */
}

function distance_between($p1, $p2){
  return sqrt(pow($p1['x'] - $p2['x'], 2) + pow($p1['y'] - $p2['y'], 2));
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
