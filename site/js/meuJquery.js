$(document).ready(function(){
    
    //Nao deixar submeter sem marcar nenhuma etapa de execução orçamentaria e escolher um topDez igual ao filtro
    $('#botaoConsulta').click(function() {
        var checado = 0;
        var filtro = 1;
        
        //For each jquery
        $.each($(".filtroExec") , function (index, value){
            if(this.value != 0){
                var equivalente = verificaFiltro(this.name);
                                    //o zero na frente é pra transformar o objeto jquery em um DOM, que nem no js vanilla
                if(equivalente == $("#selectTopDez")[0].value){
                   filtro = 0; 
                }
            }
          });
       
        if( $("#listarValorPago").is(':checked') || $("#listarValorEmpenhado").is(':checked') || $("#listarValorLiquido").is(':checked') || $("#listarDeAnosAnteriores").is(':checked') ) {
          checado = 1;
        }
        
        if(checado && filtro) {
          $("#consulta").submit();
        }
        
        else if(checado){
           swal ( "Oops" ,  "Não é possível escolher um top dez e um filtro de mesmo valor" ,  "error" ); 
        }
  
        else{
            swal ( "Oops" ,  "Selecione pelo menos um tipo de execução orçamentária" ,  "error" );
        }
    });
    
    //Gerar o top Dez
    $(".topDezCheck").click(function() {
        //Sem o indice zero será retornado um objeto jquery e nao um HMTL DOM como é feito através de getElementById
        var selectTopDez = $("#selectTopDez")[0];
        if($(this).is(':checked')){
            
            $("#fieldTopDez").css("display", "initial"); 
            var opt = document.createElement("option");
            
            opt.innerHTML = nomeTopDez(this.name);
            
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