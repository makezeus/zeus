<div class="panel-heading">
  <? $this->load->view('components/breadcrumb'); ?>

  <h4 class="hidden-xs">
    <?= $pageData['title'] ?>
  </h4>

  <div style="display: flex; justify-content: space-between">
    <div class="form-group" style="position: relative;">
      <i class="ri-search-line" style="position: absolute;bottom: 6px;left: 6px;"></i>
      <input style="padding-left: 32px" type="text" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>"
        name="termo" oninput="_onInputChange(event)" class="form-control"
        placeholder="<?= $pageData['searchPlaceholder'] ?>">
    </div>
    <a class="btn btn-primary" href="<?php echo base_url() . $this->uri->segment(1) ?>/adicionar"><i class="fas fa-plus"
        style="font-size: 0.75rem;"></i> Adicionar </a>
  </div>
</div>