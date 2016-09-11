<?php
/***************************
* Urban Assault Level Generator – Script to generate levels for Microsoft's Urban Assault Game
* Daniel Portales Rosado 2016
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://www.gnu.org/licenses/>.
***************************/

# TODO
# * Verificar valores closed_bp & opened_bp en beam_gate son válidos para todos los set
# * Crear array con factions presentes para no hacer verificaciones "Si faction está presente" después de seleccionar raza con rand
# * Crear funcion random_x y random_y para obtener valor random de posició dentro del mapa
require('constants.php');
require('helpers.php');

const DEBUG = true;

class Level {
  public $id;
  public $fh; # file handler
  public $set; # map palette
  public $sz_x = 0; # horizontal map size
  public $sz_y = 0; # vertical map size
  public $map = array();
  public $gates = array();
  public $flaks = array();
  public $powers = array();
  public $squads = array();
  public $bombs = array();
  public $excluded = array(); # reusable excluded sector/coordinate markers
  public $hosts;

  function __construct($level_id){
    $this->id = $level_id;
    $this->fh = fopen('./output/L'.sprintf('%02d%02d', $this->id, $this->id).'.ldf', 'w');

    # Calculate map size (min 3, max 32, by side)
    do {
      $this->sz_x = rand(0, 29) + 3;
      $this->sz_y = rand(0, 29) + 3;
    } while($this->sz_x * $this->sz_y < 80); # Make sure map size is not too small (80 u2 at least)

    $this->set = rand(1, 6); // Map type

    $this->generate();

    # Output
    fwrite($this->fh, ob_get_contents()); // From buffer to file
    fclose($this->fh);

    if(!DEBUG){ ob_end_clean(); }
  }


  function generate(){
    if(DEBUG) echo '<pre>'; else ob_start();

    # SET
    include("template/set.php");

    # BEAM-GATE
    foreach (LEVELS[$this->id] as $target_level){
      $gate_coors = $this->random_xy('gates');

      $this->gates[] = array(
        'x' => $gate_coors['x'],
        'y' => $gate_coors['y'],
        'target' => $target_level
      );
    }
    include("template/beam_gates.php");

    # PLAYER STATION
    $this->player_station();

    # Calculates max station number for map
    $max_total_hosts = floor($this->sz_x * $this->sz_y * 2 / 144);
    // echo "\n\n";print_r("\$max_total_hosts: $max_total_hosts [{$this->sz_x}x{$this->sz_y}]");echo "\n\n";

    # ENEMY STATIONS
    # At least one enemy HostStation
    $this->enemy_station();

    # Keep trying to add stations until there are more than 5
    # or number of tries have been more than max number of stations
    for($hs = 0; $hs < $max_total_hosts && $this->total_hosts() < 6; $hs++){
      if(rand(0,1)) # 50% chance
        $this->enemy_station();
    }
    # Used for station distribution, but no more.
    $this->excluded = array();

    # STOUDSON BOMB (2 max)
    for ($sb = 0; $sb < 2; $sb++){
      # 25% chance to appear
      if(!rand(0, 3)){
        if($bomb_coors = $this->random_xy('hosts,gates')){
          $bomb_coors['timeout'] = (rand(0, 2340) + 360) * 1000; # 6 - 45 minutes
          $this->bombs[] = $bomb_coors;

          for ($ks = 0; $ks < 10; $ks++) {
            if (rand(0,1) && $key_coors = $this->random_xy('gates,bombs')) {
              $this->bombs[sizeof($this->bombs) - 1]['keys'][] = $key_coors;
            }
          }
        }
      }
    }
    include("template/bombs.php");

    # PREDEFINED SQUADS
    # 5 per faction max
    $total_hosts = $this->total_hosts() + 1; # Give player some too!

    for ($sq = 0; $sq <  5 * $total_hosts; $sq++){
      if (rand(0, 1)){
        $this->add_squad(); //Squad creation
      }
    }
    include("template/squads.php");

    # PROTOTYPES
    include("template/prototype.php");

    # MAPS
    foreach(array('typ','own','hgt','blg') as $map_type){
      $this->make_map($map_type);
    }
    include("template/maps.php");
  }


  function available_map($without = '', $faction = false){
    $map = ';';

    for($xx = 1;$xx < $this->sz_x - 1;$xx++){
      for($yy = 1;$yy < $this->sz_y - 1;$yy++){
        if($faction && (!empty($this->maps['own'][$yy][$xx])) && $this->maps['own'][$yy][$xx] != fid($faction))
          continue;
        $map.= "$xx,$yy;";
      }
    }

    if($without = array_filter(array_map('trim', explode(',', $without)))){
      foreach ($without as $collection_name) {
        $collection = $this->$collection_name; # gates, hosts, squads
        # Convenience to make other lists compatible with hosts faction grouping
        if($collection_name != 'hosts') {
          $collection = array($collection);
        }

        # $coor_group = coors grouped be faction if 'hosts', or general unique group for the rest
        foreach ($collection as $coor_group) {
          foreach ($coor_group as $coors) {
            $exception_code = "{$coors['x']},{$coors['y']};";
            $map = str_replace(';'.$exception_code, ';', $map);
          }
        }
      }
    }

    return array_filter(explode(';', $map));
  }


  function random_xy($without = '', $faction = false){
    $map = $this->available_map($without, $faction);

    if(empty($map)) return false;

    list($x, $y) = explode(',', sample($map));
    return compact('x','y');
  }


  function random_x($as_position = false){
    $coor = rand(1, $this->sz_x - 2);
    return $as_position ? get_position($coor) : $coor;
  }


  function random_y($as_position = false){
    $coor = rand(1, $this->sz_y - 2);
    return $as_position ? get_position($coor, true) : $coor;
  }


  function present_factions(){
    return array_keys($this->hosts);
  }

  function total_hosts($for_faction = false){
    if($for_faction) return isset($this->hosts[$for_faction]) ? sizeof($this->hosts[$for_faction]) : 0;

    $total_hosts = 0;
    foreach (array_slice($this->hosts, 1) as $faction) {
      $total_hosts+= sizeof($faction);
    }

    return $total_hosts;
  }


  function reset_map($type = 'typ'){
    # Default map values
    switch ($type) {
      case 'own':
        $reset_value = 7;
      break;
      case 'hgt':
        $reset_value = 128;
      break;
    }

    $this->map = array_fill(0, $this->sz_y, array_fill(0, $this->sz_x, $reset_value));
  }

  function player_station(){
    $this->hosts['res'] = array($this->random_xy());
    $res_x = get_position($this->hosts['res'][0]['x']);
    $res_y = get_position($this->hosts['res'][0]['y'], true);
    # divided by 4 = [1500 - 3000]
    $energy = (6 + rand(0, 6)) * 100000;
    # Drak constant = 550,000
    $reload_const = floor(((($energy - 550000)/4) + 550000) /4);

    include("template/player_station.php");
  }

  function enemy_station(){
    do {
      # Select random faction
      $faction = sample(FACTIONS);
      # 2 stations per faction max
      if($this->total_hosts($faction) < 2) {
        # Search optimal position for HostStation
        $new_station_position = $this->distribute_host($faction);
        if($new_station_position === false) continue;

        $this->hosts[$faction][] = $new_station_position;

        # HostStation energy (min 2000, max 3500)
        $energy = (80 + rand(0, 60)) * 10000;
        # Drak constant = 500,000
        $reload_const = floor((($energy - 500000)/ 3) + 500000);

        if($faction == 'gho'){
          # 59: Tarantul I; 57: Scorpio
          $host_vehicle = rand(0, 2) ? 57 : 59;
        } else
          $host_vehicle = HOST_VEHICLES[$faction];

        include("template/enemy_station.php");
      }

      # If no enemy hosts have been added yet, try again
    } while ($this->total_hosts() == 0);
  }

  function distribute_host($new_station_faction){
    $minimal_distance = 3 * 1200; # 4 sectors away

    do {
      $valid_position = true;
      $test_coors = $this->random_xy('hosts,excluded');

      # If no places left to test, return.
      # We don't want to reset `excluded` list here to avoid
      # unnecessary checks for subsequent station distribution tryings.
      if(empty($test_coors)){
        return false;
      }

      foreach($this->hosts as $faction_stations){
        foreach($faction_stations as $station){
          if(distance_between($station,$test_coors) < $minimal_distance){
            $valid_position = false;
            $this->excluded[] = $test_coors;
            break 2;
          }
        }
      }
    } while(!$valid_position);

    # Reset custom coordinate exceptions after adding new station.
    $this->excluded = array();
    return $test_coors;
  }


  function add_squad(){
    $squad_coors = $this->random_xy('hosts,bombs,squads,flaks');
    if(empty($squad_coors)) return;

    $faction = sample($this->present_factions());
    $vehicle = sample(VEHICLES[$faction]);
    $max_units = 16;

    if($faction == 'res') $max_units = 4;

    if(in_array($vehicle, array(9,74,67,35,29))) # If it's a scout
      $squad_size = 1;
    else
      $squad_size = rand(1, $max_units) + 2;

    $squad = array(
      'faction' => $faction,
      'vehicle' => $vehicle,
      'num' => $squad_size,
      'x' => $squad_coors['x'],
      'y' => $squad_coors['y'],
      'mb_status' => rand(0, 3) ? 'mb_status = unknown' : ''
    );

    $this->squads[] = $squad;
  }


  function make_map($type = 'typ'){
    $this->excluded = $this->get_station_sectors();
    $this->reset_map($type);

    switch ($type) {
      case 'typ':
        foreach($this->map as $row => $row_values){
          foreach($row_values as $col => $item){
            $this->map[$row][$col] = $this->set_sector(sample(SET_LIST[$this->set]), $col, $row);
          }
        }

        # Outside values
        # 248 252 249
        # 255 000 253
        # 251 254 250

        for ($col = 0; $col < $this->sz_x; $col++){
          $this->map[0][$col] = 252;
          $this->map[$this->sz_y - 1][$col] = 254;
        }
        for ($row = 0; $row < $this->sz_y; $row++){
          $this->map[$row][0] = 255;
          $this->map[$row][$this->sz_x - 1] = 253;
        }

        # Corners
        $this->map[0][0] = 248;
        $this->map[0][$this->sz_x - 1] = 249;
        $this->map[$this->sz_y - 1][0] = 251;
        $this->map[$this->sz_y - 1][$this->sz_x - 1] = 250;

      break;

      case 'own':
        # Max number of sectors per race = playable area / number of stations + 60%
        $this->max_territory_per_faction = ($this->sz_x - 2) * ($this->sz_y - 2) / $this->total_hosts() * 1.6;

        foreach($this->present_factions() as $faction){
          $this->set_territory($faction);
        }

        # Outside to 0's
        for ($col = 0; $col < $this->sz_x; $col++){
          $this->map[0][$col] = $this->map[$this->sz_y - 1][$col] = 0;
        }
        for ($row = 0; $row < $this->sz_y; $row++){
          $this->map[$row][0] = $this->map[$row][$this->sz_x - 1] = 0;
        }

        # Color squads
        foreach ($this->squads as $squad) {
          $this->map[$squad['y']][$squad['x']] = fid($squad['faction']);
        }
      break;

      case 'hgt':
        $height = 128;
        # Apply as random paths (like own-map) instead of sequencial
        foreach($this->map as $row => $row_values){
          foreach($row_values as $col => $item){
            $this->set_height_around($height, $col, $row);
            $height += rand(0, 4) - 2; # New base height
          }
        }

        # Match outside with the inside's border
        for ($col = 0; $col < $this->sz_x; $col++){
          $this->map[0][$col] = $this->map[1][$col];
          $this->map[$this->sz_y - 1][$col] = $this->map[$this->sz_y - 2][$col];
        }
        for ($row = 0; $row < $this->sz_y; $row++){
          $this->map[$row][0] = $this->map[$row][1];
          $this->map[$row][$this->sz_x - 1] = $this->map[$row][$this->sz_x - 2];
        }
      break;

      case 'blg':
        # Powerstations for enemies
        foreach ($this->hosts as $faction => $stations) {
          foreach ($stations as $station) {
            switch ($faction) {
              case 'sul':
                $blg = 11;
              break;
              case 'myk':
                $blg = 10;
              break;
              case 'tae':
                $blg = 17;
              break;
              case 'bla':
                $blg = 11;
              break;
              case 'gho':
                $blg = 12;
              break;
            }

            $this->map[$station['y']][$station['x']] = $blg;
          }
        }

        $extra_power = ceil($this->sz_x * $this->sz_y / 90);
        for ($ps = 0; $ps < $extra_power; $ps++) {
          if(rand(0,2)){ # 66% chance to appear
            if($power_coors = $this->random_xy('hosts,gates,bombs'))
              $this->map[$power_coors['y']][$power_coors['x']] = 63;
          }
        }
      break;
    }

    $this->maps[$type] = $this->map;
  }


  function set_territory($faction){
    $fid = fid($faction);
    $max_territory = $this->max_territory_per_faction;
    if($faction == 'res') { # Resistance will have less territory
      $max_territory = floor($this->max_territory_per_faction * 0.2);
    }

    foreach($this->hosts[$faction] as $station){
      # Around the station, first
      $this->set_territory_around($fid, $station['x'], $station['y']);

      for($tt = 0, $x = $station['x'], $y = $station['y']; $tt < $max_territory; $tt++){
        if (rand(0, 1)){
          # Elige nuevo pivote
          $x = $x + (rand(0, 2) - 1);
          $y = $y + (rand(0, 2) - 1);

          if($x < 1) $x = 1;
          if($x > $this->sz_x - 1) $x = $this->sz_x - 1;

          if($y < 1) $y = 1;
          if($y > $this->sz_y - 1) $y = $this->sz_y - 1;

          $this->set_territory_around($fid, $x, $y);
        }
      }
    }
  }


  function get_station_sectors(){
    $results = array();

    foreach($this->hosts as $faction => $faction_hosts){
      foreach($faction_hosts as $host){
        $coords = "{$host['x']},{$host['y']}";
        $results[$coords] = $faction;
      }
    }

    return $results;
  }


  function set_territory_around($faction_id, $x, $y){
    $this->set_sector($faction_id, $x - 1, $y - 1, true);
    $this->set_sector($faction_id, $x - 1, $y, true);
    $this->set_sector($faction_id, $x - 1, $y + 1, true);

    $this->set_sector($faction_id, $x, $y - 1, true);
    $this->set_sector($faction_id, $x, $y, true);
    $this->set_sector($faction_id, $x, $y + 1, true);

    $this->set_sector($faction_id, $x + 1, $y - 1, true);
    $this->set_sector($faction_id, $x + 1, $y, true);
    $this->set_sector($faction_id, $x + 1, $y + 1, true);
  }


  function set_height_around($height, $x, $y){
    $this->set_sector(new_height($height), $x - 1, $y - 1);
    $this->set_sector(new_height($height), $x - 1, $y);
    $this->set_sector(new_height($height), $x - 1, $y + 1);

    $this->set_sector(new_height($height), $x, $y - 1);
    $this->set_sector($height, $x, $y);
    $this->set_sector(new_height($height), $x, $y + 1);

    $this->set_sector(new_height($height), $x + 1, $y - 1);
    $this->set_sector(new_height($height), $x + 1, $y);
    $this->set_sector(new_height($height), $x + 1, $y + 1);
  }


  function set_sector($value, $x, $y, $validate = false) {
    # Outside the boundaries
    if($x < 0 || $y < 0 || $x > ($this->sz_x - 1) || $y > ($this->sz_y - 1)) return;

    # Validation
    if($validate){
      $invaded = empty($this->excluded["{$x},{$y}"]) ? false : fid($this->excluded["{$x},{$y}"]);
      if($invaded && $value != $invaded)
        return; # Don't change territory of host station sectors unless is same faction
    }

    $this->map[$y][$x] = $value;
  }
}

class Urbanassault {
  function __construct($mode = 'campaing'){
    if(DEBUG) $mode = 'single';

    if(is_string($mode)){
      if($mode == 'single')
        $levels = array(1);
      elseif ($mode == 'campaing') {
        $levels = LEVELS;
      }
    } elseif (is_array($mode)) {
      $levels = $mode;
    }


    foreach ($levels as $level_id) {
      new Level($level_id);
    }
  }
}

new Urbanassault();
