function verificaFiltro(nome){
    var equivalente="";
    
    switch(nome){
        case "funcao": 
            equivalente = "listarFuncao";
        break;

        case "subfuncao": 
            equivalente = "listarSubFuncao";
        break;

        case "acao": 
            equivalente = "listarAcao";
        break;

        case "categoria": 
            equivalente = "listarCategoria";
        break;

        case "unidadeorcamentaria": 
            equivalente = "listarUnidadeOrcamentaria";
        break;

        case "modalidade": 
            equivalente = "listarModalidade";
        break;

        case "item": 
            equivalente = "listarItem";
        break;

        case "licitacao": 
            equivalente = "listarLicitacao";
        break;

        case "subfuncao": 
            equivalente = "listarSubFuncao";
        break;

        case "orgao": 
            equivalente = "listarOrgao";
        break;

        case "grupo": 
            equivalente = "listarGrupo";
        break;

        case "unidadegestora": 
            equivalente = "listarUnidadeGestora";
        break;

        case "elemento": 
            equivalente = "listarElemento";
        break;

        case "credor": 
            equivalente = "listarCredor";
        break;

        case "fonterecursos": 
            equivalente = "listarFonteRecursos";
        break;

    }
    return equivalente;
}