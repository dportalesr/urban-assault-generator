
; Prototype Modifications

include data:scripts/startup2.scr
<?php foreach ($this->present_factions() as $faction): ?>
<?php $fid = fid($faction); ?>

begin_enable <?=$fid?>;
<?php foreach (VEHICLES[$faction] as $vehicle): ?>
  vehicle   = <?=$vehicle?>;
<?php endforeach; ?>
<?php foreach (BUILDINGS[$faction] as $building): ?>
  building  = <?=$building?>;
<?php endforeach; ?>
end
<?php endforeach; ?>
