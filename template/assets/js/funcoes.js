
function carregarModalExcluir(id, nome) {
    $('#id_excluir').val(id);
    $('#nome_excluir').html(nome);
}

function carregarModalAlterarSetor(id, nome, tela) {
    $('#id_alterar').val(id);
    $('#nome_alterar').val(nome);
    validarTela(tela);
}

function carregarModalAlterarTipoEquipamento(id, nome, tela) {
    $('#id_alterar_tipo_equipamento').val(id);
    $('#nome_alterar_tipo_equipamento').val(nome);
    validarTela(tela);
}

function carregarModalAlterarModeloEquipamento(id, nome, tela) {
    $('#id_alterar_modelo_equipamento').val(id);
    $('#alterar_nome_modelo_equipamento').val(nome);
    validarTela(tela);
}

function carregarModalExcluirEquipAlocados(setor, id, tipo, modelo, descricao) {
    $('#nome_setor').show().html(setor);
    $('#id_alocar').val(id);
    $('#tipo_equipamento').val(tipo);
    $('#modelo_equipamento').val(modelo);
    $('#descricao_equipamento').val(descricao);
}

function carregarModalEquip(id, tipo, modelo, identificacao, descricao) {
    $('#id_equipamento').val(id);
    $('#tipo_equipamento').val(tipo);
    $('#modelo_equipamento').val(modelo);
    $('#identificacao_equipamento').val(identificacao);
    $('#descricao_equipamento').val(descricao);
}

function carregarModalEquipAlocados(id, data, setor) {
    $('#id_equipamento_alocado').val(id);
    $('#data-alocacao').html(converterData(data));
    $('#setor-alocado').html(setor);
}


function carregarModalExcluirUsuario(id_usuario, id_tipo, nome, nomeTipo, setor, idTipo) {
    $('#id_usuario').val(id_usuario);
    $('#id_tipo').val(id_tipo);
    $('#nome_usuario').val(nome);
    $('#tipo_usuario').val(nomeTipo);
    (idTipo == 3) ? $('#divModalSetorUsuario').hide() : $('#setor_usuario').val(setor);
}

function converterData(data) {
    ymd = data.split('-');
    return ymd[2] + "/" + ymd[1] + "/" + ymd[0];
}

function exibirCamposPorTipoUsuario() {


    var Tipo = $('#tipo').val();

    switch (Tipo) {
        case '1': /*ADMINISTRADOR*/

            $('#divNomeUsuario').show();
            $('#divSobrenomeUsuario').show();
            $('#divEmailUsuario').show();
            $('#divSetorUsuario').hide();
            $('#divTelefoneUsuario').hide();
            $('#divEnderecoUsuario').hide();
            $('#btn_gravar_usuario').show();
            removerMansagemErro();

            break;
        case '2': /*FUNCIONÁRIO*/

            $('#divNomeUsuario').show();
            $('#divSobrenomeUsuario').show();
            $('#divEmailUsuario').show();
            $('#divSetorUsuario').show();
            $('#divTelefoneUsuario').show();
            $('#divEnderecoUsuario').show();
            $('#btn_gravar_usuario').show();
            removerMansagemErro();

            break;
        case '3': /*TÉCNICO*/

            $('#divNomeUsuario').show();
            $('#divSobrenomeUsuario').show();
            $('#divEmailUsuario').show();
            $('#divSetorUsuario').hide();
            $('#divTelefoneUsuario').show();
            $('#divEnderecoUsuario').show();
            $('#btn_gravar_usuario').show();
            removerMansagemErro();

            break;

        default: /*NÃO EXIBI OS CAMPOS E O BOTÃO*/
            $('#divNomeUsuario').hide();
            $('#divSobrenomeUsuario').hide();
            $('#divEmailUsuario').hide();
            $('#divSetorUsuario').hide();
            $('#divTelefoneUsuario').hide();
            $('#divEnderecoUsuario').hide();
            $('#btn_gravar_usuario').hide();

    }

}

function removerMansagemErro() {
    /*CAMPO NOME*/
    $('#val-nome-usuario').hide();
    $('#divNomeUsuario').removeClass('has-error');

    /*CAMPO SOBRENOME*/
    $('#val-sobrenome-usuario').hide();
    $('#divSobrenomeUsuario').removeClass('has-error');

    /*CAMPO SETOR*/
    $('#val-setor-usuario').hide();
    $('#divSetorUsuario').removeClass('has-error');

    /*CAMPO EMAIL*/
    $('#val-email-usuario').hide();
    $('#divEmailUsuario').removeClass('has-error');
    $('#mensagem-erro').removeClass('email-existente').hide();

    /*CAMPO TELEFONE*/
    $('#val-telefone-usuario').hide();
    $('#divTelefoneUsuario').removeClass('has-error');

    /*CAMPO ENDEREÇO*/
    $('#val-endereco-usuario').hide();
    $('#divEnderecoUsuario').removeClass('has-error');
}

function validarEmail() {

    var campo_email = ( $('#email').is(':visible')) ? $('#email')  : $('#email-alterar-usuario');
    var idUser = ( $('#id_usuario').val() == undefined ) ? '' : $('#id_usuario').val() ;
    var email = campo_email.val();
    
        $.post('../../template/assets/ajax/validar_email.php', {email: email, id_usuario: idUser}, function (ret) {

            if (ret == 1) {
                
                campo_email.val('');
                
                $('#val-email-usuario').hide();
                $('#val-email-alterar').hide();
                $('#divEmailUsuario_alterar').addClass('has-error');
                $('#divEmailUsuario').addClass('has-error');
                $('#mensagem-erro').show().addClass('email-existente').html(`<div>Email <strong>${email}</strong>  já existe. Inserir outro.</div>`);
                
            } else if (ret == 0) {
                
                campo_email.val(email);
                
                $('#val-email-usuario').hide();
                $('#val-email-alterar').hide();
                $('#divEmailUsuario_alterar').removeClass('has-error');
                $('#divEmailUsuario').removeClass('has-error');
                $('#mensagem-erro').removeClass('email-existente').hide();
            }
        });
}

function carregar_modal_alterar_usuario(id, nome, sobrenome, tipo, email, tel, end, setor) {
    

    if (tipo == '1') {


        $('#divNomeUsuario_alterar').show();
        $('#divSetorUsuario_alterar').show();
        $('#divEmailUsuario_alterar').show();
        $('#divSetorUsuario_alterar').hide();
        $('#divTelefoneUsuario_alterar').hide();
        $('#divEnderecoUsuario_alterar').hide();

        limparCamposModalAlterarUsuario();

        $('#id_usuario').val(id);
        $('#id_tipo').val(tipo);
        $('#nome-alterar-usuario').val(nome);
        $('#sobrenome-alterar-usuario').val(sobrenome);
        $('#email-alterar-usuario').val(email);

        validarTela(15);

    } else if (tipo == '2') {

        $('#divNomeUsuario_alterar').show();
        $('#divSetorUsuario_alterar').show();
        $('#divSetorUsuario_alterar').show();
        $('#divEmailUsuario_alterar').show();
        $('#divTelefoneUsuario_alterar').show();
        $('#divEmailUsuario_alterar').show();

        limparCamposModalAlterarUsuario();

        $('#id_usuario').val(id);
        $('#id_tipo').val(tipo);
        $('#nome-alterar-usuario').val(nome);
        $('#sobrenome-alterar-usuario').val(sobrenome);
        $('#setor-alterar-usuario').val(setor);
        $('#email-alterar-usuario').val(email);
        $('#tel-alterar-usuario').val(tel);
        $('#end-alterar-usuario').val(end);

        validarTela(15);

    } else if (tipo == '3') {

        $('#divNomeUsuario_alterar').show();
        $('#divSetorUsuario_alterar').show();
        $('#divEmailUsuario_alterar').show();
        $('#divSetorUsuario_alterar').hide();
        $('#divTelefoneUsuario_alterar').show();
        $('#divEmailUsuario_alterar').show();

        limparCamposModalAlterarUsuario();

        $('#id_usuario').val(id);
        $('#id_tipo').val(tipo);
        $('#nome-alterar-usuario').val(nome);
        $('#sobrenome-alterar-usuario').val(sobrenome);
        $('#email-alterar-usuario').val(email);
        $('#tel-alterar-usuario').val(tel);
        $('#end-alterar-usuario').val(end);

        validarTela(15);
    }

        
}

function limparCamposModalAlterarUsuario() {

    $('#id_usuario').val('');
    $('#id_tipo').val('');
    $('#nome-alterar-usuario').val('');
    $('#sobrenome-alterar-usuario').val('');
    $('#setor-alterar-usuario').val('');
    $('#email-alterar-usuario').val('');
    $('#tel-alterar-usuario').val('');
    $('#end-alterar-usuario').val('');

}

function carregarModalExcluirUsuario(id, tipo, nome){
    
    
    var dados = id + " " + tipo;
    $('#id_excluir').val(dados);
    $('#nome_excluir').html(nome);
     
}

function carregarModalChamados(data_atendimento,tecnico,situcao_chamado,laudo){
    $('#data_atendimento').val(data_atendimento);
    $('#tec').val(tecnico);
    $('#situacao_chamado').val(situcao_chamado);
    $('#laudo').val(laudo);

    if(laudo == ''){
        $('#divLaudo').hide();
    }else{
       $('#divLaudo').show(); 
    }
  
}
    