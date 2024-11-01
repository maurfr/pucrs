<?php require("conecta.mysql.php"); ?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>PUCRS - Desenvolvimento Full Stack</title>

        <!-- CSS - Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- CSS - Personalização -->
        <link rel="stylesheet" href="./style.css">

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
    </head>

    <body>
        <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="card px-1 py-4">
        <div class="card-body">

            <form id="formDenuncia" method='post'>
                <h6 class="card-title mb-3">DENÚNCIA DE FATOS QUE IMPACTEM NA MOBILIDADE URBANA</h6>
                <div class="d-flex flex-row">
                    <label class="radio mr-1"> 
                        <input type="radio" name="inputTipoContato" value="A" checked><span>Anônimo</span>
                    </label> 
                    <label class="radio"> 
                        <input type="radio" name="inputTipoContato" value="I"> 
                        <span>Identificado</span> 
                    </label> 
                </div>
                            
                <div class="form-row d-none">
                    <div class="form-group col-md-12">
                        <label for="inputNome" class="col-form-label-sm p-0 m-0">Nome</label>
                        <input type="text" class="form-control" name="inputNome" id="inputNome">
                    </div>
                </div>
                
                <div class='form-row d-none'>
                    <div class="form-group col-md-6">
                        <label for="inputTelefone" class="col-form-label-sm p-0 m-0">Telefone</label>
                        <input type="text" class="form-control" name="inputTelefone" id="inputTelefone" placeholder="(99) 99999-9999">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="col-form-label-sm p-0 m-0">E-mail</label>
                        <input type="text" class="form-control" name="inputEmail" id="inputEmail">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUF" class="col-form-label-sm p-0 m-0">Estado</label>
                        <select id="inputUF" name="inputUF" class="form-control" required>
                            <option selected>Selecione...</option>
                            <?php
                            $rsUF = $pdo->query("SELECT ID, NOME, UF FROM ESTADO ORDER BY NOME ASC");
                            foreach ($rsUF as $row) {
                                echo "<option value='".$row['ID']."'>".$row['NOME']." (".$row['UF'].")</option>";
                            }
                            ?>
                        </select>
                    </div>    
                    <div class="form-group col-md-6">
                        <label for="inputCidade" class="col-form-label-sm p-0 m-0">Cidade</label>
                        <select id="inputCidade" name="inputCidade" class="form-control" required>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputEndereco" class="col-form-label-sm p-0 m-0">Endereço</label>
                        <input type="text" class="form-control" id="inputEndereco" name="inputEndereco" required>
                    </div>
                </div>        
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCEP" class="col-form-label-sm p-0 m-0">CEP</label>
                        <input type="text" class="form-control" id="inputCEP" name="inputCEP">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="inputPR" class="col-form-label-sm p-0 m-0">Ponto de referência</label>
                        <input type="text" class="form-control" id="inputPR" name="inputPR" required>
                    </div>
                </div> 
                
                <div class="form-group">
                    <label for="selectTipoDenuncia" class="col-form-label-sm p-0 m-0">Tipo de denúncia</label>
                    <select id="selectTipoDenuncia" name="selectTipoDenuncia" class="form-control" required>
                        <option selected>Selecione...</option>
                        <?php
                        $unbufferedResult = $pdo->query("SELECT ID, DESCRICAO FROM TIPO");
                        foreach ($unbufferedResult as $row) {
                            echo "<option value='".$row['ID']."'>".$row['DESCRICAO']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                        <label for="textareaDescricao" class="col-form-label-sm p-0 m-0">Descrição da denúncia</label>
                        <textarea class="form-control" id="textareaDescricao" name="textareaDescricao" rows="3" required></textarea>
                </div>
                
                <button class="btn btn-primary btn-block confirm-button">Enviar</button>

            </form>
        </div>
        </div>
        </div>

        
    <script type="text/javascript">

		$( document ).ready(function() {
        
            $(':radio[name="inputTipoContato"]').change(function() {
                if($(this).filter(':checked').val() == 'I') {
                    $("#inputNome").parent().parent().removeClass("d-none");
                    $("#inputTelefone").parent().parent().removeClass("d-none");
                } else {
                    $("#inputNome").parent().parent().addClass("d-none");
                    $("#inputTelefone").parent().parent().addClass("d-none");
                }
            });

            $('#inputUF').change(function(){

                var uf = $('#inputUF').val();
                
                $("#inputCidade").children().remove();
                $.ajax({
                    method: "POST",
                    url: "ajax.cidade.php",
                    data: { uf: $('#inputUF').val() },
                    dataType: "html"
                    }).done(function( result ) {
                            // alert(result);
                            $("#inputCidade").append(result);
                    });

            });

            $("form").submit(function (event) {

                var formDados = {
                    inputTipoContato: $('input[name=inputTipoContato]:checked').val(),
                    inputNome: $("#inputNome").val(),
                    inputTelefone: $("#inputTelefone").val(),
                    inputEmail: $("#inputEmail").val(),
                    inputUF: $("#inputUF").val(),
                    inputCidade: $("#inputCidade").val(),
                    inputEndereco: $("#inputEndereco").val(),
                    inputCEP: $("#inputCEP").val(),
                    inputPR: $("#inputPR").val(),
                    selectTipoDenuncia: $("#selectTipoDenuncia").val(),
                    textareaDescricao: $("#textareaDescricao").val()
                };

                $.ajax({
                    method: "POST",
                    url: "ajax.add.php",
                    data: formDados,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    
                    console.log(data);

                    if (!data.success) {
                        
                        alert("Erro. Tente novamente mais tarde.\n\n"+ data.message);

                    } else {
                        $("form").html(
                        '<div class="alert alert-success">' + data.message + "</div>"
                        );
                    }

                });

                event.preventDefault();
            });


        })

    </script>

  </body>
</html>