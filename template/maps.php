begin_maps
<?php foreach($this->maps as $map_type => $map): ?>
  <?= $map_type ?>_map =
    <?=$this->sz_x.' '.$this->sz_y ?>
<?php foreach($map as $row => $row_values): ?>

    <?php foreach($row_values as $col => $item): ?>
<? printf("%02x ", $item) ?>
<?php endforeach; ?>
<?php endforeach; ?>

<?php endforeach; ?>

end
