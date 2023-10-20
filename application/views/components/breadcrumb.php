<?php if ($this->uri->segment(1) !== 'dashboard') : ?>
  <div id="breadcrumb" class="hidden-xs">
    <a href="<?php echo base_url() ?>zeus" title="Dashboard" style="padding-left: 0; color:black">
      <i class="fas fa-home"></i> Dashboard 
    </a>
    <i style="color: #9CA3AF; font-size: 0.75rem;" class="fas fa-chevron-right"></i>
    <?php if ($this->uri->segment(1) != null) : ?>
      <a href="<?php echo base_url() . '' . $this->uri->segment(1) ?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>">
        <?php echo ucfirst($this->uri->segment(1)); ?>
      </a>
      <?php if ($this->uri->segment(2) != null) : ?>
        <i class="fas fa-chevron-right" style="color: #9CA3AF; font-size: 0.75rem;"></i>
        <a href="<?php echo base_url() . '' . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>">
          <?php echo ucfirst($this->uri->segment(2)); ?>
        </a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
<?php endif; ?>