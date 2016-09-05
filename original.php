<?php

    ///// Stoudson Bomb
    for ($sb = 0; $sb < 2; $sb++){ // 2 bombs max
      if(rand(0,1)){
?>
; Stoudson Bomb
begin_item
  sec_x         = <?=$this->random_x() ?>
  sec_y         = <?=$this->random_y() ?>
  inactive_bp   = <?=$this->set == 6 ? 68 : 35 ?>
  active_bp     = <?=$this->set == 6 ? 69 : 36 ?>
  trigger_bp    = <?=$this->set == 6 ? 70 : 36 ?>
  type          = 1
  countdown     = <?=(rand(0, 2500) + 20) * 1000 ?> ;20 seconds - 42 minutes
<?php
        for ($ks = 0; $ks < 10; $ks++){
          if (rand(0,1)){
?>
  keysec_x      = <?=$this->random_x()?>
  keysec_y      = <?=$this->random_y()?>
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
    $total_hosts = array_sum($this->total_hosts);

    for ($sq = 0; $sq <  3 * $total_hosts; $sq++){
      if (rand(0, 1)){
        $this->add_squad(); //Squad creation
      }
    }
?>
; Prototype Modifications
include data:scripts/startup<?=$this->id == 1 ? '' : 2 ?>.scr

<?php
    ///// Prototype Enabling
    $present_factions = array_merge(array('res'),$this->present_factions());
    foreach ($present_factions as $faction) {
      $fid = $this->fid($faction);
?>
begin_enable <?=$fid?>
<?php
      // Enable vehicles
      foreach ($this->vehicles[$faction] as $vehicle) {
?>
  vehicle   = <?=$vehicle?>
<?php
      }

      // Enable buildings
      foreach ($this->buildings[$faction] as $building) {
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
  typ_map =
    <?=$this->sz_x.' '.$this->sz_y ?>
<?php
    ///// TYP
    # top
    echo "\n    f8 ";
    for($px = 0; $px < $this->sz_x - 2; $px++){ echo 'fc '; }
    echo 'f9';

    # body
    for($py = 0; $py < $this->sz_y - 2; $py++){
      echo "\n    ff ";
      for($px = 0; $px < $this->sz_x - 2; $px++){ printf("%02x ", sample($this->set_list[$this->set])); }
      echo 'fd';
    }

    # bottom
    echo "\n    fb ";
    for ($px = 0; $px < $this->sz_x - 2; $px++){ echo 'fe '; }
    echo 'fa';

?>

  own_map =
    <?=$this->sz_x.' '.$this->sz_y ?>
<?php
    ///// OWN
    # Initialized in 7 = Neutral
    $this->reset_map();
    # Ideal number of sectors per race = playable area / number of stations + 60%
    $this->ideal_territory = ($this->sz_x - 2) * ($this->sz_y - 2) / array_sum($this->total_hosts) * 1.6;

    # Mapear
    $present_factions = array_merge(array('res'), $this->present_factions());

    foreach($present_factions as $faction){
      $this->make_territoryyy($faction);
    }

    # Outside sectors to 0
    for ($px = 0; $px < $this->sz_x; $px++){
      $this->map[$px][$this->sz_y - 1] = $this->map[$px][0] = 0;
    }

    for ($py = 0; $py < $this->sz_y; $py++){
      $this->map[$this->sz_x - 1][$py] = $this->map[0][$py] = 0;
    }

    # Imprimir mapa
    for($py = 0; $py < $this->sz_y; $py++){
      echo "\n    ";
      for($px = 0; $px < $this->sz_x; $px++){ printf("%02d ", $this->map[$px][$py]); }
    }
?>

  hgt_map =
    <?=$this->sz_x.' '.$this->sz_y ?>
<?php
    ///// HGT
    $height = 25 + rand(0, 50); # base height

    $this->reset_map($height);

    for ($py = 1; $py < $this->sz_y - 1; $py++){
      for ($px = 1; $px < $this->sz_x - 1; $px++){
        $this->map[$px][$py] = $height;
        $this->set_adjacent_height($height, $px, $py);

        # New base height
        $height += rand(0, 4) - 2;
      }
    }

    ////// Even top and bottom outside sectors
    for ($px = 0; $px < $this->sz_x; $px++){
      $this->map[$px][0] = $this->map[$px][1];
      $this->map[$px][$this->sz_y - 1] = $this->map[$px][$this->sz_y - 2];
    }

    ////// Even left and right outside sectors
    for ($py = 0; $py < $this->sz_y; $py++){
      $this->map[0][$py] = $this->map[1][$py];
      $this->map[$this->sz_x - 1][$py] = $this->map[$this->sz_x - 2][$py];
    }

    for ($py = 0; $py < $this->sz_y; $py++){
      echo "\n    ";
      for ($px = 0; $px < $this->sz_x; $px++)
        printf("%02x ", $this->map[$px][$py]);
    }
?>

  blg_map =
    <?=$this->sz_x.' '.$this->sz_y ?>
<?php
    $this->reset_map();

    // Giving PowerStation to EnemyStations
    $present_factions = $this->present_factions();
    foreach ($present_factions as $faction) {
      $faction_hosts = $this->total_hosts[$faction];

      for ($i = 0; $i < $faction_hosts; $i++) {
        $x = $this->host_x[$faction][$i];
        $y = $this->host_y[$faction][$i];

        switch ($faction) {
          case 'sul':
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

        $this->map[$x][$y] = $blg;

      }
    }

    for ($py = 0; $py < $this->sz_y; $py++){
      echo "\n    ";
      for($px = 0; $px < $this->sz_x; $px++)
        printf("%02x ", $this->map[$px][$py]);
    }
?>
end ; end of maps
<?php

  }








  //---------------------------------------------



  //------------------------------------------



  //--------------------------------

  function add_squad(){
    $faction = sample($this->present_factions());
    $vehicle = sample($this->vehicles[$faction]);

    if(in_array($vehicle, array(9,74,67,35,29))) # If it's a scout
      $squad_size = 1;
    else
      $squad_size = rand(1,12);

    // Don't locate squads on same sector as enemy Host Stations
    do {
      $invalid_position = false;
      $pos_x = $this->random_x();
      $pos_y = $this->random_y();

      foreach ($this->present_factions() as $target_faction) {
        if($faction != $target_faction){ // Just for enemies
          for ($c = 0; $c < $this->total_hosts[$faction]; $c++) {
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
      $mb_status = "  mb_status = unknown\r\n";
?>
begin_squad
  owner     = <?=$this->fid($faction) ?>
  vehicle   = <?=$vehicle ?>
  num       = <?=$squad_size ?>
  pos_x     = <?=$this->x($pos_x) ?>
  pos_z     = <?=$this->y($pos_y) ?>
<?=$mb_status ?>
end

<?php
  }

  //---------------------------------

  function make_territoryyy($faction){
    $faction_hosts = $this->total_hosts[$faction];
    $fid = $this->fid($faction);

    for($fh = 0; $fh < $faction_hosts; $fh++){
      # Stations coordinates
      $x = $this->host_x[$faction][$fh];
      $y = $this->host_y[$faction][$fh];

      $this->set_territory_around($fid, $x, $y);

      for($i = 0; $i < $this->ideal_territory; $i++){
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

  # Sets the values around the pivot
