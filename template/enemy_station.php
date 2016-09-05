begin_robo
  owner         = <?= $this->fid($faction) ?>;
  vehicle       = <?= $host_vehicle ?>;
  pos_x         = <?= $this->get_position($new_station_position['x']) ?>;
  pos_y         = <?= (20 + rand(0, 25)) * -10 ?>;
  pos_z         = <?= $this->get_position($new_station_position['y'], true) ?>;
  energy        = <?= $energy ?>;
  reload_const  = <?= $reload_const ?>;
  con_budget    = <?= rand(0, 50) + 50    ?>;
  con_delay     = <?= rand(0, 75) * 1000  ?>;
  def_budget    = <?= rand(0, 40) + 60    ?>;
  def_delay     = <?= rand(0, 75) * 1000  ?>;
  rec_budget    = <?= rand(0, 50) + 50    ?>;
  rec_delay     = <?= rand(0, 75) * 1000  ?>;
  rob_budget    = <?= rand(0, 50) + 50    ?>;
  rob_delay     = <?= rand(0, 75) * 1000  ?>;
  pow_budget    = <?= rand(0, 60) + 40    ?>;
  pow_delay     = <?= rand(0, 75) * 1000  ?>;
  rad_budget    = <?= rand(0, 20) + 10    ?>;
  rad_delay     = <?= rand(0, 75) * 1000  ?>;
  saf_budget    = <?= rand(0, 50) + 50    ?>;
  saf_delay     = <?= rand(0, 75) * 1000  ?>;
  cpl_budget    = <?= rand(0, 70) + 30    ?>;
  cpl_delay     = <?= rand(0, 75) * 1000  ?>;
end
