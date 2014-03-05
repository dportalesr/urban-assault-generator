<?php
/***************************
* Urban Assault Level Generator – Script to generate levels for Microsoft's Urban Assault Game
* Copyright © 2014 Daniel Portales Rosado
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

class Urbanassault {
  var $fh;
  var $debug = true;
  var $slots = array(
    1 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,50,51,59,67,70,71,72,74,75,76,77,78,80,81,82,95,96,97,98,99,100,130,131,132,133,134,135,136,137,138,139,150,151,153,154,155,157,159,160,161,162,163,164,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,198,232,233,234,235,236),
    2 => array(0,1,2,5,6,7,8,9,11,12,13,16,17,18,19,20,21,22,23,24,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,65,66,67,68,69,70,71,72,75,76,77,78,80,81,82,83,87,89,90,92,93,94,95,97,99,100,120,121,122,123,124,125,126,127,128,129,130,131,133,150,151,152,153,155,158,159,160,161,162,163,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
    3 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,67,69,70,71,72,74,75,76,77,78,80,81,82,100,130,131,132,133,134,135,136,137,138,139,150,151,152,153,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
    4 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,59,60,66,67,69,70,71,72,74,75,76,77,78,80,81,82,130,131,132,133,134,135,136,137,138,139,140,141,150,151,153,155,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189),
    5 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,57,58,59,62,63,65,66,67,68,69,70,71,72,75,76,78,79,82,84,87,92,93,94,95,97,98,99,105,106,107,108,109,113,114,120,121,122,123,124,125,126,127,128,129,130,131,133,134,135,150,151,152,153,155,157,158,159,161,160,162,163,166,167,168,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,190,191,198,199,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225),
    6 => array(0,1,2,5,6,7,8,9,10,11,12,13,16,17,18,19,20,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,40,41,44,59,66,67,68,70,71,72,74,75,76,77,78,79,80,81,82,95,96,97,98,99,130,131,132,133,134,135,136,137,138,139,140,141,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,188,189,228,229,230,231,232,233,234,235,248)
  );

  var $vehicles = array(
    'res' => array(1,2,3,4,5,6,7,  9,10,11,12,  14,15,16,  133,134),
    'sul' => array(71,72,73,74),
    'myk' => array(63,64,65,66,67,68,69,70),
    'tae' => array(8,  32,33,34,35,36,37,38,  131),
    'bla' => array(),
    'gho' => array(22,23,24,25,26,27,28,29,30,31,  130)
  );

  var $buildings = array(
    'res' => array(),
    'sul' => array(),
    'myk' => array(10,13,33,34,72),
    'tae' => array(17,20,21,31,53,73),
    'bla' => array(63,1,18,3,30,52,8,12,60,22,71,53,17,31,20,21,73,10,13,33,34,72),
    'gho' => array(30,52,8,12,60,22,71),
  );

  var $skies = array('1998_01', '1998_02', '1998_03', '1998_05', '1998_06', 'Am_1', 'Am_2', 'Am_3', 'Arz1', 'Asky2', 'Braun1', 'Ct6', 'H', 'H7', 'Haamitt1', 'Haamitt4', 'Mod2', 'Mod4', 'Mod5', 'Mod7', 'Mod8', 'Mod9', 'Moda', 'Modb', 'Nacht1', 'Nacht2', 'Newtry5', 'Nosky', 'Nt1', 'Nt2', 'Nt3', 'Nt5', 'Nt6', 'Nt7', 'Nt8', 'Nt9', 'Nta', 'S3_1', 'S3_4', 'Smod1', 'Smod2', 'Smod3', 'Smod4', 'Smod5', 'Smod6', 'Smod7', 'Smod8', 'Sterne', 'wow1', 'wow5', 'wow7', 'wow8', 'wow9', 'wowa', 'wowb', 'wowc', 'wowd', 'wowe', 'wowf', 'wowh', 'wowi', 'wowj', 'x1', 'x2', 'x4', 'x5', 'x7', 'x8', 'x9', 'xa', 'xb', 'xc');
  var $size_x = 0, $size_y = 0;
  
  var $factions = array(2 => 'sul','myk','tae','bla','gho');

  var $num_hosts;
  var $host_x;
  var $host_y;

  function __construct(){
    $this->fh = fopen('level.ldf', 'w');
    $this->num_hosts = array_fill_keys($this->factions, 0);
    $this->host_x = array_fill_keys($this->factions, array());
    $this->host_y = array_fill_keys($this->factions, array());
  }
  
  function fid($faction){ return array_search($faction, $this->factions); }
  function x($x){ return (($x + 0.5) * 1200) + 1; /* + 1 to avoid bugs on sector edge */ }
  function y($y){ return (($y + 0.5) * -1200) + 1; /* + 1 to avoid bugs on sector edge */ }
  function rx(){ return rand(1, $this->size_x - 1); }
  function ry(){ return rand(1, $this->size_y - 1); }
  function present_factions(){ return array_keys(array_filter($this->num_hosts)); }
  function pick($arr){ return $arr[array_rand($arr)]; }

  function make_level($mode){
    if($this->debug){
      echo '<pre>';
    } else {
      ob_start();
    }

    do {
      // Calculate map size (min 3, max 32 by side)
      $this->size_x = rand(0, 29) + 3;
      $this->size_y = rand(0, 29) + 3;
    } while($this->size_x * $this->size_y < 64); // Make sure map size is not too small (64 u2 at least)

    $this->set = rand(1, 6); // Map type
?>
begin_level
  set     = <?=$this->set ?>
  sky     = objects/<?=$this->pick($this->skies) ?>.base
  slot0   = palette/standard.pal
  slot1   = palette/red.pal
  slot2   = palette/blau.pal
  slot3   = palette/gruen.pal
  slot4   = palette/inverse.pal
  slot5   = palette/invdark.pal
  slot6   = palette/sw.pal
  slot7   = palette/invtuerk.pal
end

; Mission Briefing Map
begin_mbmap
  name = MB_15.IFF
end

; Mission Debriefing Map
begin_dbmap
  name = DB_15.IFF
end

; Beam Gates
begin_gate
  sec_x         = <?=$this->rx()?> 
  sec_y         = <?=$this->ry()?> 
  closed_bp     = 5
  opened_bp     = 6
  target_level  = 1 ;TODO: Hacer lista de los Target Levels para escoger.. 
<?php
    for($c = 0; $c < 6; $c++){
      if(rand(0, 1)){
?>
  keysec_x      = <?=$this->rx() ?> 
  keysec_y      = <?=$this->ry() ?> 
<?php
      }
    }
?>
  mb_status     = unknown 
end

; Player Host Station
<?php
    $resistance_x = $this->x($this->host_x['res'][0] = $this->rx());
    $resistance_y = $this->y($this->host_y['res'][0] = $this->ry());
    $energy       = (6 + rand(0, 6)) * 100000; // x 100,000 / 4 = [1200 - 3000]
    $reload_const = ((($energy - 550000)/4) + 550000) /4; // Drak constant = 550,000
?>
begin_robo
  owner         = 1 
  vehicle       = 56 
  pos_x         = <?=$resistance_x ?> 
  pos_y         = <?= -10 * (20 + rand(0, 25)) ?> 
  pos_z         = <?=$resistance_y ?> 
  energy        = <?=$energy ?> 
  reload_const  = <?=$reload_const ?> 
end 

; Enemy Host Stations
<?php
    $num_hosts_ideal = $this->size_x * $this->size_y * 3/144; // Calculates ideal HostStation number for map

    $this->add_host_station(); // At least one enemy HostStation

    // Keep trying to add HostStations until there are more than 5 Stations or number of tries have been more than ideal number of Stations
    for($c = 0; $c < $num_hosts_ideal && array_sum($this->num_hosts) < 6; $c++){
      if(rand(0,1)) # 50 - 50 chance
        $this->add_host_station();
    }

    ///// Stoudson Bomb
    for ($c = 0; $c < 2; $c++){ // 2 bombs max
      if(rand(0,1)){
?>
; Stoudson Bomb
begin_item
  sec_x         = <?=$this->rx() ?> 
  sec_y         = <?=$this->ry() ?> 
  inactive_bp   = <?=$this->set == 6 ? 68 : 35 ?> 
  active_bp     = <?=$this->set == 6 ? 69 : 36 ?> 
  trigger_bp    = <?=$this->set == 6 ? 70 : 36 ?> 
  type          = 1 
  countdown     = <?=(rand(0, 2500) + 20) * 1000 ?> ;20 seconds - 42 minutes 
<?php
        for ($c2 = 0; $c2 < 10; $c2++){
          if (rand(0,1)){
?>
  keysec_x      = <?=$this->rx()?> 
  keysec_y      = <?=$this->ry()?> 
<?php
          }
        }
?>
end 

<?php
      }
    }
?>
;Predefined Squads
<?php
    ///// Predefined Squads

    // 3 squads per faction max
    $total_hosts = array_sum($this->num_hosts);

    for ($c = 0; $c <  3 * $total_hosts; $c++){
      if (rand(0, 1)){
        $this->add_squad(); //Squad creation
      }
    }
?>
; Prototype Modifications
include data:scripts/startup2.scr

<?php
    ///// Prototype Enabling
    foreach ($this->present_factions() as $faction) {
      $fid = $this->fid($faction);
?>
begin_enable <?=$fid?> 
<?php
      // Enable vehicles
      foreach ($this->vehicles[$fid] as $vehicle) {
?>
  vehicle   = <?=$vehicle?> 
<?php
      }

      // Enable buildings
      foreach ($this->buildings[$fid] as $building) {
?>
  building  = <?=$building?> 
<?php
      }
?>
end ; end of enable

<?php
    }
        
    ///// Tech
    ///// Map Dumps
?>
begin_maps
<?php
    $this->build_maps();
?>
end ; end of maps
<?php   
    
    ///// Output
    fwrite($this->fh, ob_get_contents()); // From buffer to file
    fclose($this->fh);
    
    if(!$this->debug){ ob_end_clean(); }
  }

  //---------------------------------------------

  function add_host_station(){
    $host_vehicles = array('sul' => 61, 'myk' => 58, 'tae' => 60, 'bla' => 62);
    $station_added = false;

    do {
      $faction = $this->pick($this->factions); // Select random faction
      
      if($this->num_hosts[$faction] < 2) { // 2 Stations max per faction
        $new_station_position = $this->distribute_host($faction); // Search optimal position for HostStation
        
        if($new_station_position === false){
          return;
        
        } else {
          list($x, $y) = $new_station_position; // Search optimal position for HostStation
          $this->host_x[$faction][] = $x;
          $this->host_y[$faction][] = $y;

          $this->num_hosts[$faction]++;
          $station_added = true;

          $energy = (80 + rand(0, 60)) * 10000; // HostStation energy (min 2000, max 3500)
          $reload_const = (($energy - 500000)/ 3) + 500000; // Drak constant = 500,000

          if($faction == 'gho')
            $host_vehicle = rand(0, 1) ? 59 : 57; // Variable
          else
            $host_vehicle = $host_vehicles[$faction];
?>
begin_robo
  owner         = <?=$this->fid($faction) ?> 
  vehicle       = <?=$host_vehicle ?> 
  pos_x         = <?=((12 * $x) + 6) * 100 ?> 
  pos_y         = <?=(20 + rand(0, 25)) * -10 ?> 
  pos_z         = <?=((12 * $y) + 6) * -100 ?> 
  energy        = <?=$energy ?> 
  reload_const  = <?=$reload_const ?> 
  con_budget    = <?=rand(0, 50) + 50    ?> 
  con_delay     = <?=rand(0, 75) * 1000  ?> 
  def_budget    = <?=rand(0, 40) + 60    ?> 
  def_delay     = <?=rand(0, 75) * 1000  ?> 
  rec_budget    = <?=rand(0, 50) + 50    ?> 
  rec_delay     = <?=rand(0, 75) * 1000  ?> 
  rob_budget    = <?=rand(0, 50) + 50    ?> 
  rob_delay     = <?=rand(0, 75) * 1000  ?> 
  pow_budget    = <?=rand(0, 60) + 40    ?> 
  pow_delay     = <?=rand(0, 75) * 1000  ?> 
  rad_budget    = <?=rand(0, 20) + 10    ?> 
  rad_delay     = <?=rand(0, 75) * 1000  ?> 
  saf_budget    = <?=rand(0, 50) + 50    ?> 
  saf_delay     = <?=rand(0, 75) * 1000  ?> 
  cpl_budget    = <?=rand(0, 70) + 30    ?> 
  cpl_delay     = <?=rand(0, 75) * 1000  ?> 
end 

<?php
        }
      }
    } while (!$station_added); // Intentar crear de nuevo una HostStation
  }

  //------------------------------------------

  function distribute_host($new_station_faction){
    $tries = 0;

    do {
      $test_x = $this->rx();
      $test_y = $this->ry();
      $invalid_position = false;
      $present_factions = $this->present_factions() + ['res'];

      foreach($present_factions as $faction){
        // if($faction != $new_station_faction){ // Verify just against Enemy
          if($faction == 'res')
            $faction_num_hosts = 1;
          else
            $faction_num_hosts = $this->num_hosts[$faction];

          for($c = 0; $c < $faction_num_hosts; $c++){
            if(sqrt(pow($this->host_x[$faction][$c] - $test_x, 2) + pow($this->host_y[$faction][$c] - $test_y, 2)) < 4){ // Too close
              $invalid_position = true;
              break;
            }
          }
          
          if($invalid_position) break;
        // }
      }
    } while($invalid_position && $tries++ && $tries < 256);

    return $invalid_position ? false : array($test_x, $test_y);
  }

  //--------------------------------

  function add_squad(){
    $faction = $this->pick($this->present_factions());

    switch ($faction){
      case 'res':
        do {
          $vehicle = $this->pick($this->vehicles[$faction]);
          $squad_size = ($vehicle == 9) ? 1 : rand(0,10) + 1; # Si es un Scout sólo se asigna 1 unidad
        } while($vehicle == 13);
      break;
      
      case 'sul':
        $vehicle = rand(0,3) + 71;
        $squad_size = ($vehicle == 74) ? 1 : rand(0,9) + 1;
      break;

      case 'myk':
        $vehicle = rand(0,7) + 63;
        $squad_size = ($vehicle == 67) ? 1 : rand(0,9) + 1;
      break;

      case 'tae':
        $vehicle = rand(0,6)?rand(0,6) + 32:(rand(0,3)?8:131);
        $squad_size = ($vehicle == 35) ? 1 : rand(0,9) + 1;
      break;

      case 'bla':
        $vehicle = rand(0,1)?rand(0,15) + 1:(rand(0,1)?rand(0,9) + 22:(rand(0,5)?rand(0,11) + 63:rand(0,1) + 130));
        $squad_size = (array_search($vehicle,array(9,74,67,35,29))!== false) ? 1 : rand(0,10) + 1; # Si es cualquiera de los scouts..
      break;

      case 'gho':
        $vehicle = rand(0,7)?rand(0,10) + 22:130;
        $squad_size = ($vehicle == 29) ? 1 : rand(0,10) + 1;
      break;

    }
    
    // Don't locate squads on same sector as enemy Host Stations
    do {
      $invalid_position = false;
      $pos_x = $this->rx();
      $pos_y = $this->ry();

      foreach ($this->present_factions() as $target_faction) {
        if($faction != $target_faction){ // Just for enemies
          for ($c = 0; $c < $this->num_hosts[$faction]; $c++) {
            $host_pos_x = $this->host_x[$faction][$c];
            $host_pos_y = $this->host_y[$faction][$c];

            if($host_pos_x == $pos_x && $host_pos_y == $pos_y){
              $invalid_position = true;
              break;
            }
          }
        }

        if($invalid_position) break;
      }

    }while($invalid_position);

    $mb_status = '';

    if(rand(0, 2))
      $mb_status = 'mb_status = unknown';
?>
begin_squad
  owner     = <?=$fid ?> 
  vehicle   = <?=$vehicle ?> 
  num       = <?=$squad_size ?> 
  pos_x     = <?=$this->x($pos_x) ?> 
  pos_y     = <?=$this->y($pos_y) ?> 
  <?=$mb_status ?> 
end 

<?php
  }

  //------------------------------------------ 

  function build_maps(){

    ///////////////////// typ

    # definition
    echo "\t".'typ_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";

    # 1era fila
    echo "\t\t".'f8 ';
    for($c = 0; $c < $this->size_x - 2; $c++)
      echo 'fc ';
    echo 'f9'."\n";

    # body
    for($c = 0; $c < $this->size_y - 2; $c++){
      echo "\t\tff";
      for($c2 = 0; $c2 < $this->size_x - 2; $c2++)
        printf(" %02x", $this->pick($this->slots[$this->set]));
      echo " fd\n";
    }

    # ultima fila
    echo "\t\t".'fb';
    for ($c = 0; $c < $this->size_x-2; $c++)
      echo ' fe';
    echo ' fa'."\n";
    
    ///////////////////// own

    # definition
    echo "\t".'own_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";

    # inicializado en 0
    $map = array_fill(0, $this->size_x - 1, array_fill(0, $this->size_y - 1, 0));
    $ideal_territory = ($this->size_x - 2) * ($this->size_y - 2) * 3 / 2 * array_sum($this->num_hosts); // i (n?mero ideal de sectores para cada raza) = ?ea total de sectores / n?mero total de HostStations + 30%

    # Mapear colores
    $this->make_territory('res');
    $this->make_territory('sul');
    $this->make_territory('myk');
    $this->make_territory('tae');
    $this->make_territory('bla');
    $this->make_territory('gho');

    # Imprimir mapa
    for($c = 0; $c < $this->size_y; $c++){
      echo "\t\t";

      for($c2 = 0; $c2 < $this->size_x; $c2++){
        printf("%02d ", $map[$c2][$c]);
      }

      echo "\n";
    }
    
    ///////////////////// hgt 

    echo "\t".'hgt_map ='."\n\t".$this->size_x.' '.$this->size_y."\n";
    $x = $y = 1;
    $base_height = 50 + (rand(0, 50) - 25);

    for ($c = 1; $c < $this->size_y - 1; $c++){
      for ($c2 = 1; $c2 < $this->size_x - 1; $c2++){
        $map[$c2][$c] = $base_height;
        $this->calculate_adjacent_height($base_height, $c2, $c);

        if ($map[$c2 - 1][$c] != 0 && $map[$c2 - 1][$c] != 1)
          $height = $map[$c2-1][$c] + rand(0, 5) - 2;
      }
    }

    ////// Igualar bordes horizontales
    for ($c = 0; $c < $this->size_x; $c++){
      $map[$c][0] = $map[$c][1];
      $map[$c][$this->size_y - 1] = $map[$c][$this->size_y - 2];
    }

    ////// Igualar bordes verticales
    for ($c = 0; $c < $this->size_y; $c++){
      $map[0][$c] = $map[1][$c];
      $map[$this->size_x - 1][$c] = $map[$this->size_x - 2][$c];
    }

    for ($c = 0; $c < $this->size_y; $c++){
      echo "\t\t";
      for ($c2 = 0; $c2 < $this->size_x; $c2++)
        printf("%02x ", $map[$c2][$c]);
      echo "\n";
    }

    ///////////////////// blg
    
    echo "\t".'blg_map ='."\n";
    echo "\t".$this->size_x.' '.$this->size_y."\n";

    // Giving PowerStation to EnemyStations
    for ($c = 0; $c < $this->size_y; $c++){
      for ($c2 = 0; $c2 < $this->size_x; $c2++){
        for($c3 = 0; $c3 < 3; $c3++){
          if ($c2 == $this->host_x['sul'][$c3] && $c == $this->host_y['sul'][$c3])
            $blg[$c2][$c] = 10;
          if ($c2 == $this->host_x['myk'][$c3] && $c == $this->host_y['myk'][$c3])
            $blg[$c2][$c] = 10;
          if ($c2 == $this->host_x['tae'][$c3] && $c == $this->host_y['tae'][$c3])
            $blg[$c2][$c] = 17;
          if ($c2 == $this->host_x['bla'][$c3] && $c == $this->host_y['bla'][$c3])
            $blg[$c2][$c] = 14;
          if ($c2 == $this->host_x['gho'][$c3] && $c == $this->host_y['gho'][$c3])
            $blg[$c2][$c] = 12;
        }
      }
    }

    for ($c = 0; $c < $this->size_y; $c++){
      echo "\t\t";
      for($c2 = 0; $c2 < $this->size_x; $c2++)
        printf("%02x ", $blg[$c2][$c]);
      echo "\n";
    }
  }

  //---------------------------------

  function make_territory($faction){ //nr = n?mero identificador de raza, cr = cantidad de HostStations de esa raza
    $faction_num_hosts = $this->num_hosts[$faction];
    if(!$faction_num_hosts) return;

    $fid = $this->fid($faction);
    
    do {
      # Coordenadas de la HostStation
      $x = $this->host_x[$faction][$faction_num_hosts - 1];
      $y = $this->host_y[$faction][$faction_num_hosts - 1];
      
      $this->adjacent_territory($fid, $x, $y); 

      for($c = 0; $c < $ideal_territory; $c++){
        if (rand(0, 1)){
          # Elige nuevo pivote
          $x = $x + (rand(0, 3) - 1);
          $y = $y + (rand(0, 3) - 1);
          $this->adjacent_territory($fid, $x, $y);
        }
      }

      $faction_num_hosts--;
    } while($faction_num_hosts > 0);
  }

  //////////////////////// Funci? que asinga el valor alrededor del punto inicial
  
  function adjacent_territory($fid, $x, $y){
    $map[$x - 1][$y - 1]  = $fid;
    $map[$x - 1][$y]      = $fid;
    $map[$x][$y - 1]      = $fid;
    $map[$x + 1][$y + 1]  = $fid;
    $map[$x + 1][$y]      = $fid;
    $map[$x][$y + 1]      = $fid;
    $map[$x + 1][$y - 1]  = $fid;
    $map[$x - 1][$y + 1]  = $fid;
  }

  /////////////////////////////////////

  function calculate_adjacent_height($height, $x2, $y2){
    $map[$x2 - 1][$y2]      = $height + (rand(0, 6) - 3);
    $map[$x2][$y2 - 1]      = $height + (rand(0, 6) - 3);
    $map[$x2 + 1][$y2 + 1]  = $height + (rand(0, 6) - 3);
    $map[$x2 + 1][$y2]      = $height + (rand(0, 6) - 3);
    $map[$x2][$y2 + 1]      = $height + (rand(0, 6) - 3);
    $map[$x2 + 1][$y2 - 1]  = $height + (rand(0, 6) - 3);
    $map[$x2 - 1][$y2 + 1]  = $height + (rand(0, 6) - 3);
  }

  ///////////////////////////////////////////////////////////////

  function cmpg(){
  /*
    char *nam;
    for(cg=1;cg<76;cg++){
      if((cg>9&&cg<13)||(cg>19&&cg<24)||(cg>24&&cg<27)||(cg>29&&cg<35)||(cg>39&&cg<45)||(cg>49&&cg<55)||(cg>59&&cg<65)||(cg>69&&cg<76)||(cg==15)||(cg==66)){
        itoa(cg,nam,10);
        lvlname=strcat(strcat(strcat("l",nam),nam),".ldf");
      }
      if(cg>0&&cg<6){
        itoa(cg,nam,10);
        lvlname=strcat(strcat(strcat(strcat("l0",nam),"0"),nam),".ldf");
      }
      qk();
    }
  */
  }
}

$ua = new Urbanassault(); 
$ua->make_level('single');
?>