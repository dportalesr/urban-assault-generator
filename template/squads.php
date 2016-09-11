
;Predefined Squad
<?php foreach($this->squads as $squad): ?>

begin_squad
  owner     = <?=fid($squad['faction']) ?>;
  vehicle   = <?=$squad['vehicle'] ?>;
  num       = <?=$squad['num'] ?>;
  pos_x     = <?=$squad['x'] ?>;
  pos_z     = <?=$squad['y'] ?>;
  <?=empty($squad_coors['mb_status']) ? '' : $squad_coors['mb_status'] ?>;
end
<?php endforeach; ?>

