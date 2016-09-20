; Beam Gates
<?php foreach ($this->gates as $gate): ?>

begin_gate
  sec_x         = <?= $gate['x'] ?>;
  sec_y         = <?= $gate['y'] ?>;
  closed_bp     = 5
  opened_bp     = 6
<?php foreach ($gate['targets'] as $target_level): ?>
  target_level  = <?= $target_level ?>;
<?php endforeach; ?>
<?php
  # up to 6 beam-gate key sectors
  for($ii = 0; $ii < 6; $ii++):
    if(rand(0, 1)):
?>
  keysec_x      = <?= $this->random_x() ?>;
  keysec_y      = <?= $this->random_y() ?>;
<?php
    endif;
  endfor;
?>
  mb_status     = unknown
end
<?php endforeach; ?>
