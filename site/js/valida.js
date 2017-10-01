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
   
    var fieldSelect = document.getElementById("fieldTopDez");
    fieldSelect.style.display = "initial";
    
    var selectTopDez = document.getElementById("selectTopDez");
    var acrescenta = 1;
    
    
   
        if(typeof selectTopDez[0] == "undefined"){
            var opt = document.createElement('option');
            opt.value = campo;
            opt.innerHTML = campo;
            selectTopDez.appendChild(opt);
            acrescenta = 0;
        }
      
    else{   
        var tamanhoSelect = selectTopDez.length;
        for(i=0;i<tamanhoSelect;i++){
            if(campo === selectTopDez[i].value){
                acrescenta = 0;
            }
        }
    }
    
    
    if(acrescenta === 1){
        var opt = document.createElement('option');
        opt.value = campo;
        opt.innerHTML = campo;
        selectTopDez.appendChild(opt);
    }
     
    
}
