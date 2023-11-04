<div>
  <div style="position: fixed; top: 45px; left:45px">
    <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="">
  </div>
  <div class="center-flex">
    <div class="panel-body" style="padding: 16px; width: 390px">
      <div class="text-center" style="margin-bottom: 48px;">
        <?= $formTitle ?>
        <?= $formSubtitle ?>
      </div>
      <? $this->load->view($content) ?>
    </div>
  </div>
</div>