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

const DEBUG = false;

class Level {
  public $id;
  public $fh; # file handler
  public $set; # map palette
  public $sz_x = 0; # horizontal map size
  public $sz_y = 0; # vertical map size
  public $map = array();
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
    $this->render('set');

    # BEAM-GATE
    $this->render('beam_gate');

    # PLAYER STATION
    $this->hosts['res'] = array(
      array(
        'x' => $this->random_x(),
        'y' => $this->random_y()
      )
    );
    $res_host_x = get_position($this->hosts['res'][0]['x']);
    $res_host_y = get_position($this->hosts['res'][0]['y'], true);
    # divided by 4 = [1500 - 3000]
    $energy = (6 + rand(0, 6)) * 100000;
    # Drak constant = 550,000
    $reload_const = floor(((($energy - 550000)/4) + 550000) /4);
    # Calculates optimal station number for map
    $optimal_total_hosts = $this->sz_x * $this->sz_y * 3/144;

    $this->render('player_station');

    # ENEMY STATIONS
    # At least one enemy HostStation
    $this->add_host_station();

    # Keep trying to add stations until there are more than 5
    # or number of tries have been more than ideal number of stations
    for($hs = 0; $hs < $optimal_total_hosts && $this->total_hosts() < 6; $hs++){
      if(rand(0,2)) # 66% chance
        $this->add_host_station();
    }
  }


  function render($view, $view_vars = array()){
    extract($view_vars,EXTR_SKIP);
    include("template/{$view}.php");
  }


  function random_x($as_position = false){
    $coor = rand(1, $this->sz_x - 2);
    return $as_position ? get_position($coor) : $coor;
  }


  function random_y($as_position = false){
    $coor = rand(1, $this->sz_y - 2);
    return $as_position ? get_position($coor, true) : $coor;
  }


  function total_hosts($for_faction = false){
    if($for_faction) return sizeof($this->hosts[$for_faction]);

    $total_hosts = 0;
    foreach (array_slice($this->hosts, 1) as $faction) {
      $total_hosts+= sizeof($faction);
    }

    return $total_hosts;
  }


  function reset_map($reset_value = 0){
    $this->map = array_fill(0, $this->sz_x, array_fill(0, $this->sz_y, $reset_value));
  }


  function add_host_station(){
    $station_added = false;

    do {
      $faction = sample(FACTIONS); # Select random faction

      if($this->total_hosts($faction) < 2) { # 2 stations per faction max
        # Search optimal position for HostStation
        $new_station_position = $this->distribute_host($faction);
        if($new_station_position === false) continue;

        $this->hosts[$faction][] = $new_station_position;
        $station_added = true;

        # HostStation energy (min 2000, max 3500)
        $energy = (80 + rand(0, 60)) * 10000;
        # Drak constant = 500,000
        $reload_const = floor((($energy - 500000)/ 3) + 500000);

        if($faction == 'gho'){
          # 59: Tarantul I; 57: Scorpio
          $host_vehicle = rand(0, 2) ? 57 : 59;
        } else
          $host_vehicle = HOST_VEHICLES[$faction];

        $this->render('enemy_station');
      }

      # If no enemy hosts have been added yet, try again
    } while ($this->total_hosts() == 1 && !$station_added);
  }

  function distribute_host($new_station_faction){
    $tries = 0;

    do {
      $invalid_position = false;
      $test_coors = array(
        'x' => $this->random_x(),
        'y' => $this->random_y()
      );

      foreach($this->hosts as $faction){
        foreach($faction as $host_position){
          $minimal_distance = 4 * 1200; # 4 sectors away
          if(distance_between($host_position,$test_coors) > $minimal_distance){
            $invalid_position = true;
            break 2;
          }
        }
      }
    } while($invalid_position && $tries++ && $tries < 100);

    return $invalid_position ? false : $test_coors;
  }


  function set_territory_around($faction_id, $x, $y){
    $this->set_sector($faction_id, $x - 1, $y - 1);
    $this->set_sector($faction_id, $x - 1, $y);
    $this->set_sector($faction_id, $x - 1, $y + 1);

    $this->set_sector($faction_id, $x, $y - 1);
    $this->set_sector($faction_id, $x, $y);
    $this->set_sector($faction_id, $x, $y + 1);

    $this->set_sector($faction_id, $x + 1, $y - 1);
    $this->set_sector($faction_id, $x + 1, $y);
    $this->set_sector($faction_id, $x + 1, $y + 1);
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


  function set_sector($value, $x, $y) {
    # Outside the boundaries
    if($x < 0 || $y < 0 || $x > ($this->sz_x - 1) || $y > ($this->sz_y - 1)) return;

    $this->map[$x][$y] = $value;
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
