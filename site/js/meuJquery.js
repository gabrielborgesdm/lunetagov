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
    
    /*TOOLTIP https://osvaldas.info/elegant-css-and-jquery-tooltip-responsive-mobile-friendly*/
    $( function()
    {
        var targets = $( '[rel~=tooltip]' ),
            target  = false,
            tooltip = false,
            title   = false;

        targets.bind( 'mouseenter', function()
        {
            target  = $( this );
            tip     = target.attr( 'title' );
            tooltip = $( '<div id="tooltip"></div>' );

            if( !tip || tip == '' )
                return false;

            target.removeAttr( 'title' );
            tooltip.css( 'opacity', 0 )
                   .html( tip )
                   .appendTo( 'body' );

            var init_tooltip = function()
            {
                if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                    tooltip.css( 'max-width', $( window ).width() / 2 );
                else
                    tooltip.css( 'max-width', 340 );

                var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                    pos_top  = target.offset().top - tooltip.outerHeight() - 20;

                if( pos_left < 0 )
                {
                    pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                    tooltip.addClass( 'left' );
                }
                else
                    tooltip.removeClass( 'left' );

                if( pos_left + tooltip.outerWidth() > $( window ).width() )
                {
                    pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                    tooltip.addClass( 'right' );
                }
                else
                    tooltip.removeClass( 'right' );

                if( pos_top < 0 )
                {
                    var pos_top  = target.offset().top + target.outerHeight();
                    tooltip.addClass( 'top' );
                }
                else
                    tooltip.removeClass( 'top' );

                tooltip.css( { left: pos_left, top: pos_top } )
                       .animate( { top: '+=10', opacity: 1 }, 50 );
            };

            init_tooltip();
            $( window ).resize( init_tooltip );

            var remove_tooltip = function()
            {
                tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
                {
                    $( this ).remove();
                });

                target.attr( 'title', tip );
            };

            target.bind( 'mouseleave', remove_tooltip );
            tooltip.bind( 'click', remove_tooltip );
        });
    });
    

});