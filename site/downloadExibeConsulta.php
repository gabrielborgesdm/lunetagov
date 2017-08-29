<?php
	include("conexao.php");
	$seleciona = $_POST["seleciona"];
	$metodo = $_POST["download"];
	
	$consulta = $conn->prepare($seleciona);
	$consulta->execute();
	
	#------------------------------------------------CSV
	if($metodo == "csv"){
		
		$fp = fopen("Dados.csv","w");
		$i=0;
		
		//Recuperar Cabecalho
		while($linha=$consulta->fetch()){
			if($i==0){
				$cont=0;
				$cabecalho = array();
				
				foreach($linha as $j=>$v){
					if(!is_numeric($j)){
						$cabecalho[$cont] = $j;
						$cont++;
					}
				}
				
				fputcsv($fp,$cabecalho,",");
			}
			$conteudo = array();
			$cont = 0;
			foreach($linha as $j=>$v){
				if(!is_numeric($j)){
					$conteudo[$cont] = $v;
				}
				$cont++;
			}
			fputcsv($fp,$conteudo,",");
			$i++;
		}
		
		
		fclose($fp);
		
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename="Dados.csv"');
		header('Content-Type: application/octet-stream');
		readfile("Dados.csv");
		
		
	}
	#------------------------------------------------JSON
	else if($metodo == "json"){
		
		$json = array();
		
		while($linha=$consulta->fetch()){
			
			foreach($linha as $j=>$v){
				
				if(is_numeric($j)){
					
					unset($linha[$j]);
					
				}
				
			}
			
			array_push($json,$linha);
			
		}
		
		$json = json_encode($json	);
		
		header('Content-Disposition: attachment; filename=Dados.json');
		
		header('Content-Type: application/json; charset=utf8');
		
		echo $json;
		
	}
	
	#------------------------------------------------XML
	else if($metodo == "xml"){
		
		$fp = fopen("Dados.xml","w");
		fclose($fp);
		
		$xmlWriter = new XMLWriter();
		$xmlWriter->openMemory();
		$xmlWriter->startDocument('1.0', 'UTF-8');
		$xmlWriter->startElement('objetos');
		
		$i=0;
		while($linha=$consulta->fetch()){
			$xmlWriter->startElement('objeto');
			foreach($linha as $j=>$v){
				if(!is_numeric($j)){
					$xmlWriter->writeElement($j, $v);
				}
				
			}
			$xmlWriter->endElement();
			$i++;
			
			if (0 == $i%1000) {
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