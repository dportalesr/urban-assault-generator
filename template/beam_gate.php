; Beam Gates
<?php foreach ($this->level_map[$this->id] as $target_level): ?>
begin_gate
  sec_x         = <?= $this->random_x() ?>;
  sec_y         = <?= $this->random_y() ?>;
  closed_bp     = 5
  opened_bp     = 6
  target_level  = <?= $target_level ?>;
<?php
  # up to 6 beam-gate key sectors
  for($ii = 0; $ii < 6; $ii++):
    if(rand(0, 1)):
?>;
  keysec_x      = <?= $this->random_x() ?>;
  keysec_y      = <?= $this->random_y() ?>;
<?php
    endif;
  endfor;
?>;
  mb_status     = unknown
end
<?php endforeach; ?>;
