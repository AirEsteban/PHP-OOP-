<?php 
$zip = new ZipArchive();
$zipArchive = $zip->open('new_zip.zip', ZipArchive::CREATE);
$arrNombres = array();
if($zipArchive){
    echo("Zip CREADO");
}else{
    echo("FALLO AL CREAR ZIP");
}
echo("<br/>");

$file1 = fopen('file1.txt', 'a');
array_push($arrNombres,'file1.txt');

if(!fwrite($file1, 'file1')){
    echo("no se pudo escribir el file 1");
}else{
    echo("escrito el file 1");
}
echo("<br/>");
fclose($file1);

$zip->addFile('file1.txt');

$file2 = fopen('file2.txt', 'a');
array_push($arrNombres,'file2.txt');

if(!fwrite($file2, 'file2')){
    echo("no se pudo escribir el file 2");
}else{
    echo("escrito el file 2");
}
echo("<br/>");
fclose($file2);
$zip->addFile('file2.txt');

$file3 = fopen('file3.txt', 'a');
array_push($arrNombres,'file3.txt');

if(!fwrite($file3, 'file3')){
    echo("no se pudo escribir el file 3");
}else{
    echo("escrito el file 3");
}
echo("<br/>");
fclose($file3);
$zip->addFile('file3.txt');

$zip->close();
foreach($arrNombres as $nombres_files){
    unlink($nombres_files);
}

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment; filename="new_zip.zip"');
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize("new_zip.zip"));
ob_end_flush();
@readfile("new_zip.zip");

?>