
begin_robo
  owner         = <?= fid($faction) ?>;
  vehicle       = <?= $host_vehicle ?>;
  pos_x         = <?= get_position($new_station_position['x']) ?>;
  pos_y         = <?= mt_rand(20, 45) * -10 ?>;
  pos_z         = <?= get_position($new_station_position['y'], true) ?>;
  energy        = <?= $energy ?>;
  reload_const  = <?= $reload_const ?>;
<?= !mt_rand(0,1) ? "  mb_status\t= unknown;\n":'' ?>
  con_budget    = <?= mt_rand(80, 90) ?>;
  con_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  def_budget    = <?= mt_rand(70, 100) ?>;
  def_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  rec_budget    = <?= mt_rand(50, 80) ?>;
  rec_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  rob_budget    = <?= mt_rand(50, 90) ?>;
  rob_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  pow_budget    = <?= mt_rand(40, 70) ?>;
  pow_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  rad_budget    = <?= mt_rand(0, 10) ?>;
  rad_delay     = <?= mt_rand(10*60, 30*60) * 1000 ?>;
  saf_budget    = <?= mt_rand(50, 100) ?>;
  saf_delay     = <?= mt_rand(0, 300) * 1000 ?>;
  cpl_budget    = <?= mt_rand(30, 50) ?>;
  cpl_delay     = <?= mt_rand(0, 300) * 1000 ?>;
end
