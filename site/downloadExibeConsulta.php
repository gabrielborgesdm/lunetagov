<?php
include("conexao.php");

$conn = conexaoDB();
$seleciona = $_POST["seleciona"];
$metodo = $_POST["download"];

$consulta = $conn->prepare($seleciona);
$consulta->execute();

#------------------------------------------------CSV
if ($metodo == "csv") {

    $fp = fopen("Dados.csv", "w");
    $i = 0;

    //Recuperar Cabecalho
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        if ($i == 0) {
            $cont = 0;
            $cabecalho = array();

            foreach ($linha as $j => $v) {               
                $cabecalho[$cont] = $j;
                $cont++;               
            }

            fputcsv($fp, $cabecalho, ";");
        }
        $conteudo = array();
        $cont = 0;
        foreach ($linha as $j => $v) {
            if (!is_numeric($j)) {
                $conteudo[$cont] = $v;
            }
            $cont++;
        }
        fputcsv($fp, $conteudo, ";");
        $i++;
    }


    fclose($fp);

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="Dados.csv"');
    header('Content-Type: application/octet-stream');
    readfile("Dados.csv");
}
#------------------------------------------------JSON
else if ($metodo == "json") {

    $json = array();
    $i = 0;
    header('Content-Disposition: attachment; filename=Dados.json');
    header('Content-Type: application/json; charset=ISO-8859-1');
    
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

        array_push($json, $linha);
        
        if ($i % 1000 == 0) {
            
            $json = json_encode($json);
           
            echo $json;
            
            unset($json);
            $json = array();    
        }
    }

   
}

#------------------------------------------------XML
else if ($metodo == "xml") {

    $fp = fopen("Dados.xml", "w");
    fclose($fp);

    $xmlWriter = new XMLWriter();
    $xmlWriter->openMemory();
    $xmlWriter->startDocument('1.0', 'UTF-8');
    $xmlWriter->startElement('objetos');

    $i = 0;
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $xmlWriter->startElement('objeto');
        foreach ($linha as $j => $v) {
           
            $xmlWriter->writeElement($j, $v);
           
        }
        $xmlWriter->endElement();
        $i++;

        if ($i % 10000 == 0) {
            file_put_contents('Dados.xml', $xmlWriter->flush(true), FILE_APPEND);
        }
    }
    $xmlWriter->endElement();

    // Final flush to make sure we haven't missed anything
    file_put_contents('Dados.xml', $xmlWriter->flush(true), FILE_APPEND);

    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="Dados.xml"');
    header('Content-Type: application/octet-stream');
    readfile("Dados.xml");
}
?>