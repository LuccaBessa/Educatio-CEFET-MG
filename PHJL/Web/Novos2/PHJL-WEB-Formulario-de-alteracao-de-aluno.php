<!DOCTYPE html>

<?php

	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//CPF inserido na pagina "PHJL-WEB-Entrada-Formulario-de-alteracao.html"
	define ("CPF", $_POST["valorCPF"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM alunos WHERE idCPF = " .CPF;
	$result = mysqli_query($conn,$sql);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM turmas";
	$resultTurma = mysqli_query($conn,$sql);
	

	//verifica se o ID inserido existe. Se nao, retorna para a pagina anterior
	if(!mysqli_num_rows($result) > 0){
	   //Id nao encontrado
	   header('location:PHJL-WEB-Pesquisa-alterar-aluno.php');
	}
	
	$linha = mysqli_fetch_array($result);
	
	//verifica se o ativo do aluno é N, se sim volta para a pagina anterior
	if($linha[15] == 'N'){
		header('location:PHJL-WEB-Pesquisa-alterar-aluno.php');
	}
	
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Alteração de aluno </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<style type="text/css">

			.text-center{
			   font-family: 'Abel', sans-serif;
			   color: #d8ac29;
			}

			.fonteTexto{
			   font-family: 'Inconsolata', monospace;
			   font-size: 16px;
			}

			.btn-info {
			  background-color: #162e87;
			  border-color: #162e87;
			  color: #FFFFFF;
			  opacity: 1;
			  filter: alpha(opacity=100);
			}

			.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
			  background-color: #11277a;
			  color: #FFFFFF;
			  border-color: #11277a;
			}

		</style>
	</head>
	
	<body>

    <!-- Essa classe é necessária para que quando o menu fique responsivo ele não sobreponha o formulário -->
    <div class="wrapper">     

        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">ALTERAÇÃO DE ALUNO</h2>

                        <form class = "contact-form" method = "POST" action = "PHJL-WEB-Insercao-de-alteracao-no-BD.php?idcpf=<?php echo CPF; ?>" id="formulario" enctype="multipart/form-data" >
                            <div class="row">
                                <label class="fonteTexto">Nome:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-circle-10"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nome" required="required" name = "entradaNome" id = "entradaNomeID"
									value = "<?php 
										echo "$linha[2]";  
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Sexo:</label>
                            </div>
                                <div class="input-group">
                                    <input class="form-check-input"  type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Feminino" 
										<?php 
											if($linha[3] == "Feminino"){ 
												echo "checked"; 
											} 
										?> 
									>Feminino<br>     
									<input class="form-check-input" type = "radio" name = "entradaSexo" id = "entradaSexoID" value = "Masculino" 
										<?php 
											if($linha[3] == "Masculino"){ 
												echo "checked"; 
											} 
										?> 
									>
									Masculino
                                </div>

                            <div class="row">
                                <label class="fonteTexto">Data de Nascimento:</label>
                                <div class='input-group'>                                         
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    <input type='date' class="form-control" name = "entradaNascimento" id = "entradaNascimentoID"
									value = "<?php 
										//Formata a data do padrão d/m/Y para o padrão Y-d-m
										echo date_format(date_create_from_format("d/m/Y", $linha[4]), "Y-m-d");
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">CPF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-badge"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="000.000.000-00" required="required" name = "entradaCPF" id = "entradaCPFID" onkeypress = "colocaPonto(0)"
									value = "<?php
										echo "$linha[0]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Logradouro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-map-big"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Logradouro" required="required" name = "entradaLogradouro" id = "entradaLogradouroID"
									value = "<?php
										echo "$linha[5]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Número:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-check-2"></i>
                                    </span>
                                    <input type="number" class="form-control" placeholder="0" required="required" name = "entradaNumero" id = "entradaNumeroID"
									value = "<?php
										echo "$linha[6]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Complemento:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-shop"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Complemento" required="required" name = "entradaComplemento" id = "entradaComplementoID"
									value = "<?php
										echo "$linha[7]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Bairro:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Bairro" required="required" name = "entradaBairro" id = "entradaBairroID"
									value = "<?php
										echo "$linha[8]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Cidade:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-globe"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Cidade" required="required" name = "entradaCidade" id = "entradaCidadeID"
									value = "<?php
										echo "$linha[9]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">CEP:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-compass-05"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="00000-000" required="required" name = "entradaCEP" id = "entradaCEPID" onkeypress = "colocaPonto(1)"
									value = "<?php
										echo "$linha[10]";
									?>">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Adicionar UF:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-world-2"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="UF" required="required" name = "entradaUF" id = "entradaUFID"
									value = "<?php
										echo "$linha[11]";
									?>">
                                </div>
                            </div>    

                            <div class="row">
                                <label class="fonteTexto">E-mail:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-email-85"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="email" required="required" name = "entradaEmail" id = "entradaEmailID"
									value = "<?php
										echo "$linha[12]";
									?>">
                                </div>
                            </div>     

                            <div class="row">
                                <label class="fonteTexto">Insira uma foto:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <input type="file" class="form-control" id='entradaFotoID' name = "entradaFoto">
                                </div>
                            </div>

                            <div class="row">
                                <label class="fonteTexto">Turma</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-image"></i>
                                    </span>
                                    <select class="form-control" name="entradaTurma" class="form-control">
                                        <?php
											while($linhaTurma = mysqli_fetch_array($resultTurma)){
												if($linhaTurma[3] == 'S'){
													//Verifica qual é a turma atual do aluno
													if($linhaTurma[0] == $linha[1]){
														echo "<option value='$linhaTurma[0]' selected>$linhaTurma[2]</option>";
													}else{
														echo "<option value='$linhaTurma[0]'>$linhaTurma[2]</option>";
													}
												}
											}
										?>
                                    </select>
                                </div>
                            </div> 

                            <div class="row">	
                                <div class="col-md-4 ml-auto mr-auto">
									<button type="submit" class="btn btn-info btn-round" onclick = "filtraDados()">Adicionar Aluno</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>  
    </div> 


	<footer>
		<div id="rodape">
			<div class="container">
				<div class="row centralizado">
					<div class="col-md-4">
						<img src="Rodape-Web/prom.jpg" class="img-circle"><br>
						<h6><strong>Desenvolvedores</strong></h6>

						<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
						<a href="#">Clique aqui</a> para saber mais.</p>  
					</div>
					<div class="col-md-4">
			    		<img src="Rodape-Web/cefetop.png" class="img-circle"><br>
			    		<h6><strong>Instituição</strong></h6>
				    	<p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 -Nova                   Suíssa - Belo Horizonte - Brasil.</p>
        			</div>
        			<div class="col-md-4">
           				<img src="Rodape-Web/bootstrap.png" class="img-circle"><br>
           				<h6>Recursos Utilizados</h6>
           				<p>
				    	<a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
					   	<a href="http://getbootstrap.com/">Bootstrap</a><br>
					   	</p>
        			</div>
				</div>
			</div>
		</div>

	</footer>

	</body>
	
</html>