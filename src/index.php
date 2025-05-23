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

        <img src="./logo.svg" class="mx-auto d-block pt-5">
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card-group">
                <div class="card mx-1 my-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Denuncie</h5>
                        <p class="card-text">Registre aqui sua denúncia sobre eventos que estejam comprometendo a mobilidade urbana.</p>
                        <a href="./cadastro.php" class="btn btn-primary">Denunciar agora!</a>
                    </div>
                </div>
                <div class="card mx-1 my-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Consulte</h5>
                        <p class="card-text">Informe o protocolo e verique aqui o status atual da sua denúncia.</p>
                        <form id="formDenuncia" method='post'>
                            <p><input type="text" class="form-control" id="inputProtocolo" name="inputProtocolo"></p>
                            <p><button class="btn btn-primary confirm-button">Consultar</button></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--
<div class="row w-100">
  <div class="col-2">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Denuncie</h5>
            <p class="card-text">Registre aqui sua denúncia sobre eventos que estejam comprometendo a mobilidade urbana.</p>
            <a href="#" class="btn btn-primary">Denunciar agora!</a>
        </div>
    </div>
  </div>
  <div class="col-1">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title">Consulte</h5>
            <p class="card-text">Verique aqui o status atual da sua denúncia.</p>
            <a href="#" class="btn btn-primary">Verificar status</a>
          </div>
    </div>
  </div>
</div>


<div class="container-fluid col-sm-12 col-md-8 col-lg-8 col-xl-8 px-4 py-4 mt-4 mb-5" style="background-color: red;">
    <div class="card-group">
        <div class="card mx-1 my-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Denuncie</h5>
                <p class="card-text">egistre aqui sua denúncia sobre eventos que estejam comprometendo a mobilidade urbana.</p>
                <a href="#" class="btn btn-primary">Denunciar agora!</a>
            </div>
        </div>
        
        <div class="card mx-1 my-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Consulte</h5>
                <p class="card-text">Verique aqui o status atual da sua denúncia.</p>
                <a href="#" class="btn btn-primary">Consultar</a>
            </div>
        </div>
    </div>
</div>

            <div class="row w-100 align-items-center" style="height: calc(100dvh - 6vw);">
                <div class="col text-center">
                    <button type="button" style='font-size: calc(1em + 2vw); margin: 1vw;' class="w-50 btn btn-primary btn-lg"  id="buttonExpedicao">Expedição</button>
                    <button type="button" style='font-size: calc(1em + 2vw); margin: 1vw;' class="w-50 btn btn-primary btn-lg"  id="buttonBalanco">Balanço</button>
                    <button type="button" style='font-size: calc(1em + 2vw); margin: 1vw;' class="w-50 btn btn-primary btn-lg"  id="buttonArmazenagem">Armazenagem</button>
                    <button type="button" style='font-size: calc(1em + 2vw); margin: 1vw;' class="w-50 btn btn-primary btn-lg"  id="buttonResina" disabled>Resina</button>
                    <button type="button" style='font-size: calc(1em + 2vw); margin: 1vw;' class="w-50 btn btn-dark btn-lg" id="buttonSair">Sair</button>
                </div>
            </div>
-->

        <!--
        <div class="card px-5 py-4">
        <img src="./logo.svg" class='card-img-top'>

          
            

    
    
        </div>
        </div>


<div class="container mt-5 mb-5 d-flex justify-content-center">
<div class="card-group">
<div class="card">
<div class="card-body">
            <h5 class="card-title">Denuncie</h5>
            <p class="card-text">Registre aqui sua denúncia sobre eventos que estejam comprometendo a mobilidade urbana.</p>
            <a href="#" class="btn btn-primary">Denunciar agora!</a>
          </div>
</div>
<div class="card mx-3 my-4">
          <div class="card-body">
            <h5 class="card-title">Consulte</h5>
            <p class="card-text">Verique aqui o status atual da sua denúncia.</p>
            <a href="#" class="btn btn-primary">Verificar status</a>
          </div>
</div>
</div>
</div>

-->
        
    <script type="text/javascript">

		$( document ).ready(function() {
        
            $("form").submit(function (event) {

                var formDados = {
                    inputProtocolo: $("#inputProtocolo").val()
                };

                $.ajax({
                    method: "POST",
                    url: "./ajax.get.php",
                    data: formDados,
                    dataType: "json",
                    encode: true,
                    beforeSend: function(data) {
                        console.log('Consultando protocolo '+this.data);
                    },
                    success: function (data) {

                            console.log('Consulta finalizada.');
                    
                            if (!data.success) {
                        
                                alert("Erro. Tente novamente mais tarde.\n\n"+ data.message);

                            } else {
                                alert(data.message);
                            }

                    },
                    error: function(err){
                        console.log("Error!" + err); //just use the err here
                        console.log(err);
                    }
                });

                event.preventDefault();
            });


        })

    </script>

  </body>
</html>