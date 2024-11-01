<?php 

require("conecta.mysql.php"); 

$data                   = [];

$inputTipoContato       = $_POST['inputTipoContato'];
$inputNome              = $_POST['inputNome'];
$inputTelefone          = $_POST['inputTelefone'];
$inputEmail             = $_POST['inputEmail'];
$inputUF                = $_POST['inputUF'];
$inputCidade            = $_POST['inputCidade'];
$inputEndereco          = $_POST['inputEndereco'];
$inputCEP               = $_POST['inputCEP'];
$inputPR                = $_POST['inputPR'];
$selectTipoDenuncia     = $_POST['selectTipoDenuncia'];
$textareaDescricao      = $_POST['textareaDescricao'];

// Gerando um número de protocolo único:
$Protocolo              = strtoupper(uniqid());

try{

    $qInsert                = " INSERT INTO `DENUNCIA`  
                                (`PROTOCOLO`,
                                `DENUNCIANTE_TIPO`,
                                `DENUNCIANTE_NOME`,
                                `DENUNCIANTE_TELEFONE`,
                                `DENUNCIANTE_EMAIL`,
                                `UF`,
                                `CIDADE`,
                                `ENDERECO`,
                                `CEP`,
                                `REFERENCIA`,
                                `TIPO`,
                                `DESCRICAO`) 
                                VALUES
                                ('".$Protocolo."',
                                '".$inputTipoContato."',
                                '".$inputNome."',
                                '".$inputTelefone."',
                                '".$inputEmail."',
                                '".$inputUF."',
                                '".$inputCidade."',
                                '".$inputEndereco."',
                                '".$inputCEP."',
                                '".$inputPR."',
                                '".$selectTipoDenuncia."',
                                '".$textareaDescricao."');";

    $data['message']    =   $qInsert;
    $data['success']    = false;
    
    $pdo->query($qInsert);

    $data['success']    = true;
    $data['message']    = 'Denúncia cadastrada sob o protocolo <b>'.$Protocolo.'</b>! Obrigado!';
     

 } catch (\PDOException $e) {
        $data['success']    = false;
        $data['message']    = "Insert failed: " . $e->getMessage();
 }


echo json_encode($data);

?>