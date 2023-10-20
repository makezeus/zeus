<div>
    <div class="panel-heading">
        <? $this->load->view('components/breadcrumb'); ?>

        <h4 class="hidden-xs">Clientes</h4>

        <div style="display: flex; justify-content: space-between">
            <div class="form-group">
                <input type="text" value="<? echo $termo ?>" name="termo" oninput="onInputChange(event)"
                    class="form-control" placeholder="Buscar Cliente">
            </div>
            <a class="btn btn-primary" href="<?php echo base_url() ?>clientes/adicionar"><i class="fas fa-plus"
                    style="font-size: 0.75rem;"></i> Adicionar cliente</a>
        </div>
    </div>
    <div class="panel-body">
        <div id="table-container">
            <?= $table ?>
        </div>
    </div>
</div>

<?php if (count($results) >= 10) {
    echo $this->pagination->create_links();
}
; ?>