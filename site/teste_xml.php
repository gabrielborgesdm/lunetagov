<?php
$xmlWriter = new XMLWriter();
$xmlWriter->openMemory();
$xmlWriter->startDocument('1.0', 'UTF-8');
$xmlWriter->startElement('objetos');
for ($i=0; $i<=1; ++$i) {
    $xmlWriter->startElement('objeto');
    $xmlWriter->writeElement('nome', 'jao');
    $xmlWriter->writeElement('idade', '12');
    $xmlWriter->endElement();
    // Flush XML in memory to file every 1000 iterations
    if (0 == $i%1000) {
        file_put_contents('example.xml', $xmlWriter->flush(true), FILE_APPEND);
    }
}
$xmlWriter->endElement();
// Final flush to make sure we haven't missed anything
file_put_contents('example.xml', $xmlWriter->flush(true), FILE_APPEND);
?>