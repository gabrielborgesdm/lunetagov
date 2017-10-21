function validaEtapas(){
    var i = 0;
    var valida = 0;
    var vetorCheckbox = new Array();
    vetorCheckbox[0] = document.getElementById("listarValorPago").checked;
    vetorCheckbox[1] = document.getElementById("listarValorEmpenhado").checked;
    vetorCheckbox[2] = document.getElementById("listarValorLiquido").checked;
    vetorCheckbox[3] = document.getElementById("listarDeAnosAnteriores").checked;

    for(i=0;i<4;i++){
        if(vetorCheckbox[i]){
            valida = 1;
        }
    }

    if(valida === 1){
        document.getElementById("consulta").submit();
    }
    else{
        swal ( "Oops" ,  "Selecione pelo menos um tipo de execução orçamentária" ,  "error" );
    }
}

function topDez(campo){
    //Recebe o fieldset e o select top10
    var fieldSelect = document.getElementById("fieldTopDez");
    var selectTopDez = document.getElementById("selectTopDez");
    
    //Mostra o fieldset caso ele esteja como none
    fieldSelect.style.display = "initial";
    
    
    
    //Variavel que verifica se vai precisar adicionar um option
    var acrescenta = 1;
    
    //Caso a opcao checkbox esteja marcada
    if(campo.checked){
        
        //Se já existir algum option ele verifica se o valor da variavel campo é igual ao campo que já existe
        if(typeof selectTopDez[0] !== "undefined"){   
            var tamanhoSelect = selectTopDez.length;
            for(i=0;i<tamanhoSelect;i++){
                if(campo.value === selectTopDez[i].value){
                    //Se sim ele diz para variavel controladora nao adicionar novamente
                    acrescenta = 0;
                }
            }
        }
        
        if(acrescenta === 1){
            //cria um option
            var opt = document.createElement('option');
            
            //verifica o nome do checkbox pra definir o inner do option
            switch(campo.name){
                case "listarFuncao":
                    
                    opt.innerHTML = 'Função';
                    break;

                case 'listarSubFuncao':
                    opt.innerHTML = 'SubFunção';
                    break;

                case 'listarAcao':
                    opt.innerHTML = 'Ação';
                    break;

                case 'listarOrgao':
                    opt.innerHTML = 'Orgão';
                    break;

                case 'listarCategoria':
                    opt.innerHTML = 'Categoria';
                    break;

                case 'listarGrupo':
                    opt.innerHTML = 'Grupo';
                    break;

                case 'listarUnidadeOrcamentaria':
                    opt.innerHTML = 'Unidade Orçamentária';
                    break;

                case 'listarUnidadeGestora':
                    opt.innerHTML = 'Unidade Gestora';
                    break;

                case 'listarModalidade':
                    opt.innerHTML = 'Modalidade';
                    break;

                case 'listarElemento':
                    opt.innerHTML = 'Elemento';
                    break;

                case 'listarItem':
                    opt.innerHTML = 'Item';
                    break;

                case 'listarCredor':
                    opt.innerHTML = 'Credor';
                    break;

                case 'listarLicitacao':
                    opt.innerHTML = 'Licitação';
                    break;

                case 'listarFonteRecursos':
                    opt.innerHTML = 'Fonte de Recursos';
                    break;
                
            }
            //adiciona o value do option e acrescenta o opt ao select
            opt.value = campo.name;
            selectTopDez.appendChild(opt);
        }
    }
    //Se a opção foi desmarcada
    else{
        var tamanhoSelect = selectTopDez.length;
        
        //percorre o select para remover a opção desmarcada
        for(i=0;i<tamanhoSelect;i++){
            if((typeof(selectTopDez[i]) !== "undefined") && (selectTopDez[i].value === campo.name)){
                selectTopDez[i].remove(selectTopDez[i]);
            }
        }
        
        //Se todas opcoes forem desmarcadas oculta o o fieldset top10
        if(typeof(selectTopDez[0]) === "undefined"){
           document.getElementById("fieldTopDez").style.display = "none";
        }
    }
    
     
    
}
