<style>#logout_btn{display:block;}</style>
<div class="row">
  <div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <?php foreach ($MODULES as $key=>$module) {
        $m = $module['name'];?>
        <li role="presentation" class="<?php if ($key==0) echo 'active';?>"><a href="#<?php echo $m; ?>" aria-controls="<?php echo $m; ?>" role="tab" data-toggle="tab"><?php echo $module['label']; ?></a></li>
      <?php } ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <?php foreach ($MODULES as $key=>$module) {
        $m = $module['name'];?>
        <div role="tabpanel" class="<?php if ($key==0) echo 'active';?> tab-pane" id="<?php echo $m; ?>">
          <?php include ("modules/".$m."/main.php"); ?>
        </div>
      <?php } ?>
    </div>
  </div>

</div>
