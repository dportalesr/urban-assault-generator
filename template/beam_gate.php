; Beam Gates
<?php foreach ($this->level_map[$this->id] as $target_level): ?>
begin_gate
  sec_x         = <?= $this->rx() ?>
  sec_y         = <?= $this->ry() ?>
  closed_bp     = 5
  opened_bp     = 6
  target_level  = <?= $target_level ?>
<?php
  # up to 6 beam-gate key sectors
  for($ks = 0; $ks < 6; $ks++):
    if(rand(0, 1)):
?>
  keysec_x      = <?= $this->rx() ?>
  keysec_y      = <?= $this->ry() ?>
<?php
    endif;
  endfor;
?>
  mb_status     = unknown
end
<?php endforeach;
