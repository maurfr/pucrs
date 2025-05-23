<?php 

require("conecta.mysql.php"); 

$data                   = [];

$inputProtocolo         = $_POST['inputProtocolo'];



try{

    $qStatus            = " SELECT S.DESCRICAO FROM `DENUNCIA_STATUS` DS INNER JOIN `STATUS` S ON S.ID = DS.STATUS WHERE DS.PROTOCOLO = '".$inputProtocolo."' ORDER BY DS.DATA DESC;";

    $Status             = $pdo->query($qStatus)->fetch();

    $data['success']    = true;
    $data['message']    = "Status do protocolo ".$inputProtocolo.': "'.$Status['DESCRICAO'].'"';
     

 } catch (\PDOException $e) {
        $data['success']    = false;
        $data['message']    = "Falha ao consultar protocolo: ".$e->getMessage();
 }


echo json_encode($data);

?>