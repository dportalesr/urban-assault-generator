; Player Host Station
begin_robo
  owner         = 1
  vehicle       = 56
  pos_x         = <?= $res_host_x ?>
  pos_y         = <?= -10 * (20 + rand(0, 25)) ?>
  pos_z         = <?= $res_host_y ?>
  energy        = <?= $energy ?>
  reload_const  = <?= $reload_const ?>
end

; Enemy Host Stations
