<?php
function fid($faction){
  return $faction == 'res' ? 1 : array_search($faction, FACTIONS);
}

function x($x){
  return (($x + 0.5) * 1200) + 1; /* + 1 to avoid bugs on sector edge */
}

function y($y){
  return (($y + 0.5) * -1200) + 1; /* + 1 to avoid bugs on sector edge */
}

function rx(){
  return rand(1, $this->sz_x - 2);
}

function ry(){
  return rand(1, $this->sz_y - 2);
}

function present_factions(){
  return array_keys(array_filter($this->total_hosts));
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
