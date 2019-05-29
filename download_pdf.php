<?php
$cedula = trim($_POST["cedula"]);

$raiz = "files/";
$caracter_split = "_";

$lista_pdfs_existentes = array();
$lista_actual_pdfs = glob($raiz.'*');

 
foreach($lista_actual_pdfs as $nombre_pdf){
    $temp = explode($caracter_split, $nombre_pdf);
    if ($temp[0] == ($raiz.$cedula)){
    array_push($lista_pdfs_existentes, $nombre_pdf);
    }
}


$zipname = 'certificaciones.zip'; 
$zip = new ZipArchive; 
$zip->open($zipname, ZipArchive::CREATE); 

foreach ($lista_pdfs_existentes as $file) {
    $temp = explode($caracter_split, $file);
    $zip->addFile($file, $temp[1]); 
} 

$zip->close();
header("Content-type: application/octet-stream");
header("Content-disposition: attachment; filename=prueba.zip");

readfile($zipname);

unlink($zipname);

?>