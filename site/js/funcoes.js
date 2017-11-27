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

function nomeTopDez(nome){
    var opt;
    switch(nome){
        case "listarFuncao":
            opt = 'Função';
            break;

        case 'listarSubFuncao':
            opt = 'SubFunção';
            break;

        case 'listarAcao':
            opt = 'Ação';
            break;

        case 'listarOrgao':
            opt = 'Orgão';
            break;

        case 'listarCategoria':
            opt = 'Categoria';
            break;

        case 'listarGrupo':
            opt = 'Grupo';
            break;

        case 'listarUnidadeOrcamentaria':
            opt = 'Unidade Orçamentária';
            break;

        case 'listarUnidadeGestora':
            opt = 'Unidade Gestora';
            break;

        case 'listarModalidade':
            opt = 'Modalidade';
            break;

        case 'listarElemento':
            opt = 'Elemento';
            break;

        case 'listarItem':
            opt = 'Item';
            break;

        case 'listarCredor':
            opt = 'Credor';
            break;

        case 'listarLicitacao':
            opt = 'Licitação';
            break;

        case 'listarFonteRecursos':
            opt = 'Fonte de Recursos';
            break;

    }
    return opt;
}