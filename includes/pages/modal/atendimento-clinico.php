<!-- Botão para abrir o modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novoAtendimentoModal">
    <?php _e('Novo Atendimento', 'pronto-psi'); ?>
</button>

<!-- Modal de Novo Atendimento -->
<div class="modal fade" id="novoAtendimentoModal" tabindex="-1" role="dialog" aria-labelledby="novoAtendimentoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoAtendimentoModalLabel"><?php _e('Novo Atendimento Clínico', 'pronto-psi'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- O formulário será gerado por meio de uma função no outro arquivo -->
                <?php render_novo_atendimento_form($paciente_id); ?>
            </div>
        </div>
    </div>
</div>
