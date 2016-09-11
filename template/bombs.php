
; Stoudson Bomb
<?php foreach($this->bombs as $bomb): ?>

begin_item
  sec_x         = <?=$bomb['x'] ?>;
  sec_y         = <?=$bomb['y'] ?>;
  inactive_bp   = <?=$this->set == 6 ? 68 : 35 ?>;
  active_bp     = <?=$this->set == 6 ? 69 : 36 ?>;
  trigger_bp    = <?=$this->set == 6 ? 70 : 36 ?>;
  type          = 1
  countdown     = <?=$bomb['timeout'] ?> ; <?= number_format($bomb['timeout']/60000, 1) ?> minutes
<?php foreach($bomb['keys'] as $bomb_key): ?>
  keysec_x      = <?=$bomb_key['x']?>;
  keysec_y      = <?=$bomb_key['y']?>;
<?php endforeach; ?>
end
<?php endforeach; ?>
