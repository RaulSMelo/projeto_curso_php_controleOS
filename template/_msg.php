<?php

function textoMsg($ret){
    
    $msg = '';
    
     switch ($ret){
         
          case -11:
            $msg = '<div class="alert alert-info">
                        Não existe nenhum registro para ser exibido
                    </div>';
            break;
          case -10:
            $msg = '<div class="alert alert-danger">
                        O campo  NOVA SENHA  e o campo REPETIR SENHA não conferem
                    </div>';
            break;
          case -9:
            $msg = '<div class="alert alert-danger">
                        A senha deverá conter no mínimo 6 caracteres
                    </div>';
            break;
          case -8:
            $msg = '<div class="alert alert-danger">
                        Senha atual esta errada. Digite novamente
                    </div>';
            break;
          case -7:
            $msg = '<div class="alert alert-danger">
                        Usuário não encontrado
                    </div>';
            break;
          case -6:
            $msg = '<div class="alert alert-danger">
                        Não existe nenhum usuário para essa busca. Tente outra.
                    </div>';
            break;
        
        case -5:
            $msg = '<div class="email-existente">
                        Email já cadastrado. Inserir outro.
                    </div>';
            break;
        case -4:
            $msg = '<div class="alert alert-danger">
                        Não existe nenhum equipamento alocado para esse setor
                    </div>';
            break;
        case -3:
            $msg =  '<div class="alert alert-danger">
                        Selecione um setor
                    </div>';
            break;
        case -2:           
            $msg =  '<div class="alert alert-danger">
                        Não foi possível excluir o registro
                    </div>';    
            break;
        case -1:           
            $msg = '<div class="alert alert-danger">
                        Ocorreu um erro na operação. Tente mais tarde
                    </div>';    
            break;
        case 0:
            $msg =  '<div class="alert alert-warning">
                        Preencher todos os campos obrigatórios
                    </div>';    
            break;
        case 1:
            $msg =  '<div class="alert alert-success">
                        Ação realizada com sucesso
                    </div>';    
            break;
    } 
    
    return $msg;
}

if(isset($ret)){
    echo textoMsg($ret);   
}

function exibirMsg($ret){
    echo textoMsg($ret);
}

