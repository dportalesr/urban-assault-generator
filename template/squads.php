
;Predefined Squad
<?php foreach($this->squads as $squad): ?>

begin_squad
  owner     = <?=fid($squad['faction']) ?>;
  vehicle   = <?=$squad['vehicle'] ?>;
  num       = <?=$squad['num'] ?>;
  pos_x     = <?=get_position($squad['x']) ?>;
  pos_z     = <?=get_position($squad['y'],true) ?>;
  <?=empty($squad_coors['mb_status']) ? '' : $squad_coors['mb_status'] ?>;
end
<?php endforeach; ?>

