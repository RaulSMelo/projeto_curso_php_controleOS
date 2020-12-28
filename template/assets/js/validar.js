function validarTela(tela){
    
    var ret = true;
    switch(tela){
        case 1: //setor
            
            if($('#id_alterar').val() != ''){
                if($('#nome_alterar').val().trim() == ''){
                   $('#val-nome-alterar').show().html('Preencha o campo nome do setor');
                   ret = false;
                   $('#divAlterarNomeSetor').addClass("has-error");
                }else{
                    $('#val-nome-alterar').hide();
                    $('#divAlterarNomeSetor').removeClass("has-error");
                }
            }else{
                if($('#setor').val().trim() == ''){
                    $('#val-nome').show().html('Preencher o campo NOME');
                    ret = false;
                    $('#divNome').addClass("has-error");
                }else{
                    $('#val-nome').hide();
                    $('#divNome').removeClass("has-error");
                }
            }
            
            break;
    
        case 2: // equipamento
            if($('#tipo').val().trim() == ''){
                $('#val-tipo').show().html('Selecione o campo Tipo de equipamento');
                ret = false;
                $('#divNomeTipo').addClass('has-error');      
            }else{
                $('#val-tipo').hide();
                $('#divNomeTipo').removeClass("has-error");
            }
            if($('#modelo').val().trim() == ''){
                $('#val-modelo').show().html('Selecione o campo Tipo de modelo');
                ret = false;
                $('#divNomeModelo').addClass('has-error');      
            }else{
                $('#val-modelo').hide();
                $('#divNomeModelo').removeClass("has-error");
            }
            if($('#ident').val().trim() == ''){
                $('#val-ident').show().html('Preencha o campo identificação do equipamento');
                ret = false;
                $('#divIdentEquip').addClass('has-error');      
            }else{
                $('#val-ident').hide();
                $('#divIdentEquip').removeClass("has-error");
            }
            if($('#desc').val().trim() == ''){
                $('#val-desc').show().html('Preencha o campo descrição do equipamento');
                ret = false;
                $('#divDescEquip').addClass('has-error');      
            }else{
                $('#val-desc').hide();
                $('#divDescEquip').removeClass("has-error");
            }
        
            break;
        
        case 3: /*TIPO DE EQUIPAMENTO*/
            if($('#id_alterar_tipo_equipamento').val() != ''){
                if($('#nome_alterar_tipo_equipamento').val().trim() == ''){
                   $('#val-nome-alterar').show().html('Preencha o campo nome do tipo do equipamento');
                   ret = false;
                   $('#divAlterarNomeTipoEquipamento').addClass("has-error");
                }else{
                    $('#val-nome-alterar').hide();
                    $('#divAlterarNomeTipoEquipamento').removeClass("has-error");
                }
                    
            }else{
                if($('#nome_tipo_equipamento').val().trim() == ''){
                    $('#val-nome-tipo-equipamento').show().html('Preencher o campo nome do tipo de equipamento');
                    ret = false;
                    $('#divNomeTipoEquipamento').addClass("has-error");
                }else{
                    $('#val-nome-tipo-equipamento').hide();
                    $('#divNomeTipoEquipamento').removeClass("has-error");
                }
                
            }
            
            break;
        case 4: /*MODELO*/
            
            if($('#id_alterar_modelo_equipamento').val() != ''){
                if($('#alterar_nome_modelo_equipamento').val().trim() == ''){
                    $('#val-nome-alterar-modelo').show().html('Preencha o campo nome do modelo');
                    ret = false;
                    $('#divAlterarModelo').addClass("has-error");
                }else{
                    $('#val-nome-alterar-modelo').hide();
                    $('#divAlterarModelo').removeClass("has-error");
                }
            }else{
                if($('#modelo').val().trim() == ''){
                    $('#val-nome-modelo').show().html('Preencha o campo nome do modelo');
                    ret = false;
                    $('#divNomeModeloEquipamento').addClass("has-error");
                }else{
                    $('#val-nome-modelo').hide();
                    $('#divNomeModeloEquipamento').removeClass('has-error');
                }
                
            }
                
            break;
            
        case 5: /*ALOCAR*/
            if($('#equip').val().trim() == ''){
                $('#val-nome-equipamento').show().html('Selecione o equipamento');
                ret = false;
                $('#divNomeEquipamento').addClass("has-error");
            }else{
                $('#val-nome-equipamento').hide();
                $('#divNomeEquipamento').removeClass("has-error");
            }
            if($('#setor').val().trim() == ''){
                $('#val-nome-setor').show().html('Selecione o setor');
                ret = false;
                $('#divNomeSetor').addClass("has-error");
            }else{
                $('#val-nome-setor').hide();
                $('#divNomeSetor').removeClass("has-error");
            }

            break;
        case 6:
            if($('#setor').val() == 0){
                $('#val-nome-setor-remover').show().html('Selecione um setor');
                ret = false;
                $('#divNomeSetorRemover').addClass("has-error");
            }else{
                $('#val-nome-setor-remover').hide();
                $('#divNomeSetorRemover').removeClass("has-error");
            }
            
            break;
        case 7: /*USUÁRIO*/

            if($('#nome').val().trim() == '' && $('#nome').is(':visible')){
                $('#val-nome-usuario').show().html('Preencha o campo nome');
                ret = false;
                $('#divNomeUsuario').addClass('has-error');
            }else{
                $('#val-nome-usuario').hide();
                $('#divNomeUsuario').removeClass('has-error');
            }
            
            if($('#sobrenome').val().trim() == '' && $('#sobrenome').is(':visible')){
                $('#val-sobrenome-usuario').show().html('Preencha o campo sobrenome');
                ret = false;
                $('#divSobrenomeUsuario').addClass('has-error');
            }else{
                $('#val-sobrenome-usuario').hide();
                $('#divSobrenomeUsuario').removeClass('has-error');
            }
            
            if($('#setor').val() == 0 && $('#setor').is(':visible')){
                $('#val-setor-usuario').show().html('Selecione o setor');
                ret = false;
                $('#divSetorUsuario').addClass('has-error');
                
            }else{
                $('#val-setor-usuario').hide();
                $('#divSetorUsuario').removeClass('has-error');
            }
            
            if($('#email').val().trim() == '' && $('#email').is(':visible')){
                $('#val-email-usuario').show().html('Preencha o campo email');
                ret = false;
                $('#divEmailUsuario').addClass('has-error');
            }else{
                
                if($('.email-existente').is(':visible')){
                    $('#divEmailUsuario').addClass('has-error');
                    ret = false;
                }else{
                    $('#mensagem-erro').removeClass('email-existente').hide();
                    $('#val-email-usuario').hide();
                    $('#divEmailUsuario').removeClass('has-error');
                }
            }
            
            if($('#tel').val().trim() == '' && $('#tel').is(':visible')){
                $('#val-telefone-usuario').show().html('Preencha o campo telefone')
                ret = false;
                $('#divTelefoneUsuario').addClass('has-error');
            }else{
                $('#val-telefone-usuario').hide();
                $('#divTelefoneUsuario').removeClass('has-error');
            }
            
            if($('#end').val().trim() == '' && $('#end').is(':visible')){
                $('#val-endereco-usuario').show().html('Preencha o campo endereço');
                ret = false;
                $('#divEnderecoUsuario').addClass('has-error');
            }else{
                $('#val-endereco-usuario').hide();
                $('#divEnderecoUsuario').removeClass('has-error');
            }
            
            break;
        case 8:
            if($('#usuario-consultar').val().trim() == ''){
                $('#val-usuario-consultar').show().html('Digite o nome do usuário');
                ret = false;
                $('#divUsuarioConsultar').addClass('has-error');
            }else{
                $('#val-usuario-consultar').hide();
                $('#divUsuarioConsultar').removeClass('has-error');
            }
            
            break;
        case 9:
            if($('#nome').val().trim() == ''){
                $('#val-nome-func').show().html('Preencha o campo nome');
                ret = false;
                $('#divNomeFunc').addClass('has-error');
            }else{
                $('#val-nome-func').hide();
                $('#divNomeFunc').removeClass('has-error');
            }
            
            if($('#email').val().trim() == ''){
                $('#val-email-func').show().html('Preencha o campo email');
                ret = false;
                $('#divEmailfunc').addClass('has-error');
            }else{
                $('#val-email-func').hide();
                $('#divEmailfunc').removeClass('has-error');
            }
            
            if($('#tel').val().trim() == ''){
               $('#val-tel-func').show().html('Preencha o campo telefone');
               ret = false;
               $('#divTelFunc').addClass('has-error');
            }else{
               $('#val-tel-func').hide();
               $('#divTelFunc').removeClass('has-error');
            }
            if($('#end').val().trim() == ''){
               $('#val-end-func').show().html('Preencher o campo endereço');
               ret = false;
               $('#divEndFunc').addClass('has-error');
            }else{
                $('#val-end-func').hide();
                $('#divEndFunc').removeClass('has-error');
            }
            break;
        case 10:
            if($('#equip').val() == 0){
                $('#val-equipamento').show().html('Selecione o equipamento');
                ret = false;
                $('#divEquipamento').addClass('has-error');
            }else{
                $('#val-equipamento').hide();
                $('#divEquipamento').removeClass('has-error');
            }
            
            if($('#desc_problema').val().trim() == ''){
                $('#val-desc-problema').show().html('Descreva o problema do equipamento')
                ret = false;
                $('#divDescProblema').addClass('has-error');
            }else{
                $('#val-desc-problema').hide();
                $('#divDescProblema').removeClass('has-error');
            }
            
            break;
        case 11:
            if($('#senha').val().trim() == ''){
                $('#val-senha-atual-func').show().html('Informe sua senha atual');
                ret = false;
                $('#divSenhaAtual-func').addClass('has-error');
            }else{
                $('#val-senha-atual-func').hide();
                $('#divSenhaAtual-func').removeClass('has-error');
            }
            if($('#novaSenha').val().trim() == ''){
                $('#val-nova-senha-func').show().html('Informe sua nova senha');
                ret = false;
                $('#divNovaSenha-func').addClass('has-error');
            }else{
                $('#val-nova-senha-func').hide();
                $('#divNovaSenha-func').removeClass('has-error');
            }
            if($('#repSenha').val().trim() == ''){
                $('#val-rep-senha-funf').show().html('Confirme sua nova senha');
                ret = false;
                $('#divRepSenha-func').addClass('has-error');
            }else{
                $('#val-rep-senha-funf').hide();
                $('#divRepSenha-func').removeClass('has-error');
            }

            break;
        case 12:
            if($('#laudo').val().trim() == ''){
                $('#val-laudo-tec').show().html('Preencha o campo laudo');
                ret = false;
                $('#divLaudo-tec').addClass('has-error');
            }else{
                $('#val-laudo-tec').hide();
                $('#divLaudo-tec').removeClass('has-error');
            }
            
            break;
        case 13:
            if($('#nome').val().trim() == ''){
                $('#val-nome-tec').show().html('Preencher o campo nome');
                ret = false;
                $('#divNomeTec').addClass('has-error');
            }else{
                $('#val-nome-tec').hide();
                $('#divNomeTec').removeClass('has-error');
            }
            
            if($('#email').val().trim() == ''){
                $('#val-email-tec').show().html('Preencher o campo email');
                ret = false;
                $('#divEmailTec').addClass('has-error');
            }else{
                $('#val-email-tec').hide();
                $('#divEmailTec').removeClass('has-error');
            }
            
            if($('#tel').val().trim() == ''){
                $('#val-tel-tec').show().html('Preencher o campo telefone');
                ret = false;
                $('#divTelTec').addClass('has-error');
            }else{
                $('#val-tel-tec').hide();
                $('#divTelTec').removeClass('has-error');
            }
            
            if($('#end').val().trim() == ''){
                $('#val-end-tec').show().html('Preencher o campo endereço');
                ret = false;
                $('#divEndTec').addClass('has-error');
            }else{
                $('#val-end-tec').hide();
                $('#divEndTec').removeClass('has-error');
            }
            
            break;
        case 14:
            if($('#senha').val().trim() == ''){
                $('#val-senha-atual-tec').show().html('Informe sua senha atual');
                ret = false;
                $('#divSenhaAtual-tec').addClass('has-error');
            }else{
                $('#val-senha-atual-tec').hide();
                $('#divSenhaAtual-tec').removeClass('has-error');
            }
            if($('#novaSenha').val().trim() == ''){
                $('#val-nova-senha-tec').show().html('Informe sua nova senha');
                ret = false;
                $('#divNovaSenha-tec').addClass('has-error');
            }else{
                $('#val-nova-senha-tec').hide();
                $('#divNovaSenha-tec').removeClass('has-error');
            }
            if($('#repSenha').val().trim() == ''){
                $('#val-rep-senha-tec').show().html('Confirme sua nova senha');
                ret = false;
                $('#divRepSenha-tec').addClass('has-error');
            }else{
                $('#val-rep-senha-tec').hide();
                $('#divRepSenha-tec').removeClass('has-error');
            }
            break;
        case 15:
            
            if($('#nome-alterar-usuario').val().trim() == '' && $('#nome-alterar-usuario').is(':visible')){
                $('#val-nome-alterar').show().html('Preencha o campo nome');
                ret = false;
                $('#divNomeUsuario_alterar').addClass('has-error');
            }else{
                $('#val-nome-alterar').hide();
                $('#divNomeUsuario_alterar').removeClass('has-error');
            }
            
            if($('#sobrenome-alterar-usuario').val().trim() == '' && $('#sobrenome-alterar-usuario').is(':visible')){
                $('#val-sobrenome-alterar').show().html('Preencha o campo sobrenome');
                ret = false;
                $('#divSobrenomeUsuario_alterar').addClass('has-error');
            }else{
                $('#val-sobrenome-alterar').hide();
                $('#divSobrenomeUsuario_alterar').removeClass('has-error');
            }
            
            if($('#setor-alterar-usuario').val() == 0 && $('#setor-alterar-usuario').is(':visible')){
                $('#val-setor-alterar ').show().html('Selecione o setor');
                ret = false;
                $('#divSetorUsuario_alterar').addClass('has-error');
                
            }else{
                $('#val-setor-alterar').hide();
                $('#divSetorUsuario_alterar').removeClass('has-error');
            }
            
            if($('#email-alterar-usuario').val().trim() == '' && $('#email-alterar-usuario').is(':visible')){
                $('#val-email-alterar').show().html('Preencha o campo email');
                ret = false;
                $('#divEmailUsuario_alterar').addClass('has-error');
            }else{
                
                if($('.email-existente').is(':visible')){
                    $('#divEmailUsuario_alterar').addClass('has-error');
                    ret = false;
                }else{
                    $('#mensagem-erro').removeClass('email-existente').hide();
                    $('#val-email-alterar').hide();
                    $('#divEmailUsuario_alterar').removeClass('has-error');
                }
            }
            
            if($('#tel-alterar-usuario').val().trim() == '' && $('#tel-alterar-usuario').is(':visible')){
                $('#val-tel-alterar').show().html('Preencha o campo telefone')
                ret = false;
                $('#divTelefoneUsuario_alterar').addClass('has-error');
            }else{
                $('#val-tel-alterar').hide();
                $('#divTelefoneUsuario_alterar').removeClass('has-error');
            }
            
            if($('#end-alterar-usuario').val().trim() == '' && $('#end-alterar-usuario').is(':visible')){
                $('#val-end-alterar').show().html('Preencha o campo endereço');
                ret = false;
                $('#divEnderecoUsuario_alterar').addClass('has-error');
            }else{
                $('#val-end-alterar').hide();
                $('#divEnderecoUsuario_alterar').removeClass('has-error');
            }
            
            break;

    }  
    
    return ret;
}

