$(document).ready(function(){
    
    //Nao deixar submeter sem marcar nenhuma etapa de execução orçamentaria
    $('#botaoConsulta').click(function() {
      if( $("#listarValorPago").is(':checked') || $("#listarValorEmpenhado").is(':checked') || $("#listarValorLiquido").is(':checked') || $("#listarDeAnosAnteriores").is(':checked') ) {
          $("#consulta").submit();
      }
      else{
          swal ( "Oops" ,  "Selecione pelo menos um tipo de execução orçamentária" ,  "error" );
      }
    });
    
    $(".topDezCheck").click(function() {
        //Sem o indice zero será retornado um objeto jquery e nao um HMTL DOM como é feito através de getElementById
        var selectTopDez = $("#selectTopDez")[0];
        if($(this).is(':checked')){
            
            $("#fieldTopDez").css("display", "initial"); 
            var opt = document.createElement("option");
            
            switch(this.name){
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
            opt.value = this.name;
            $("#selectTopDez").append(opt);
            
        }
        else{
            //percorre o select para remover a opção desmarcada
            
            for(i=0;i<selectTopDez.length;i++){
               
                if((typeof(selectTopDez[i]) !== "undefined") && (selectTopDez[i].value === this.name)){
                    
                    selectTopDez[i].remove();
                }
            }
        //Se todas opcoes forem desmarcadas oculta o o fieldset top10
            if(selectTopDez.length === 1){
               $("#fieldTopDez").css("display", "none");
            }  
        }
    });
});