<?php 

require("conecta.mysql.php"); 
  
$idUF = $_POST['uf'];
 
$rsUF = $pdo->query("SELECT * FROM CIDADE WHERE UF = '$idUF' ORDER BY NOME");

foreach ($rsUF as $row) {
    echo "<option value='".$row['ID']."'>".$row['NOME']."</option>";
}

?>