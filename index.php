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

// TODO
// - Crear array con factions presentes para no hacer verificaciones "Si faction está presente" después de seleccionar raza con rand
// - Crear funcion rx y ry para obtener valor random de posició dentro del mapa
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
  public $total_hosts = array();
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

    $this->render('set');
    $this->render('beam_gate');
  }

  function render($view, $view_vars = array()){
    extract($view_vars,EXTR_SKIP);
    include("template/{$view}.php");
  }

  function reset_map($reset_value = 0){
    $this->map = array_fill(0, $this->sz_x, array_fill(0, $this->sz_y, $reset_value));
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
