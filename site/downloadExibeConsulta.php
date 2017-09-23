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
		#versao do encoding xml
		$dom = new DOMDocument("1.0", "ISO-8859-1");

		#retirar os espacos em branco
		$dom->preserveWhiteSpace = false;

		#gerar o codigo
		$dom->formatOutput = true;
		
		#n? principal
		$root = $dom->createElement("objetos");
		
		$i=0;
		while($linha=$consulta->fetch()){
			#n? filho (objeto)
			$objeto = $dom->createElement("objeto");
			foreach($linha as $j=>$v){
				if(!is_numeric($j)){
					#setanto o atributo de objeto
					$atributo = $dom->createElement($j,$v);
					
					#adiciona o atributo no objeto
					$objeto->appendChild($atributo);	
				
				}
				
			}
			#adiciona o n? objeto em objetos(root)
			$root->appendChild($objeto);
			$dom->appendChild($root);
			$i++;
			if($i==10){
				break;
			}
		}
		$dom->save("Dados.xml");
		header('Content-disposition: attachment; filename="Dados.xml"');
		header('Content-type: "text/xml"; charset="utf8"');
		readfile('Dados.xml');
	}
	
	

?>