

<?php
require_once 'init.php';
 
// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
// Veja o Exemplo 2 deste link: http://php.net/manual/pt_BR/pdostatement.rowcount.php
$sql_count = "SELECT COUNT(*) AS total FROM users ORDER BY name ASC";
 
// SQL para selecionar os registros
$sql = "SELECT id, name, email, gender, birthdate FROM users ORDER BY name ASC";
 
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>


<!DOCTYPE html>
<head>
<style>



/* CSS reset */
*, *:before, *:after { 
  margin:0;
  padding:0;
  font-family: Arial,sans-serif;
}
 
/* remove a linha dos links */
a{
  text-decoration: none;
}
 
/* esconde as ancoras da tela */
a.links{
  display: none;
}

.content{
  width: 500px;
  min-height: 560px;    
  margin: 0px auto;
  position: relative;   
}
h1{
  font-size: 30px;
  color: #066a75;
  padding: 2px 0 10px 0;
  font-family: Arial,sans-serif;
  font-weight: bold;
  text-align: center;
  padding-bottom: 30px;
}
h1:after{
  content: ' ';
  display: block;
  width: 100%;
  height: 2px;
  margin-top: 10px;
  background: -webkit-linear-gradient(left, rgba(147,184,189,0) 0%,rgba(147,184,189,0.8) 20%,rgba(147,184,189,1) 53%,rgba(147,184,189,0.8) 79%,rgba(147,184,189,0) 100%); 
  background: linear-gradient(left, rgba(147,184,189,0) 0%,rgba(147,184,189,0.8) 20%,rgba(147,184,189,1) 53%,rgba(147,184,189,0.8) 79%,rgba(147,184,189,0) 100%); 
}

p{
  margin-bottom:15px;
}
 
.content p:first-child{
  margin: 0px;
}
 
label{
  color: #405c60;
  position: relative;
}
/* placeholder */
::-webkit-input-placeholder  {
  color: #bebcbc; 
  font-style: italic;
}
 
input:-moz-placeholder,
textarea:-moz-placeholder{
  color: #bebcbc;
  font-style: italic;
}
input {
  outline: none;
}
 
/*estilo dos input,  menos o checkbox */
input:not([type="checkbox"]){
  width: 95%;
  margin-top: 4px;
  padding: 10px;    
  border: 1px solid #b2b2b2;
 
  -webkit-border-radius: 3px;
  border-radius: 3px;
 
  -webkit-box-shadow: 0px 1px 4px 0px rgba(168, 168, 168, 0.6) inset;
  box-shadow: 0px 1px 4px 0px rgba(168, 168, 168, 0.6) inset;
 
  -webkit-transition: all 0.2s linear;
  transition: all 0.2s linear;
}
 
/*estilo do botão submit */
input[type="submit"]{
  width: 100%!important;
  cursor: pointer;  
  background: rgb(61, 157, 179);
  padding: 8px 5px;
  color: #fff;
  font-size: 20px;  
  border: 1px solid #fff;   
  margin-bottom: 10px;  
  text-shadow: 0 1px 1px #333;
 
  -webkit-border-radius: 5px;
  border-radius: 5px;
 
  transition: all 0.2s linear;
}
 
/*estilo do botão submit no hover */
input[type="submit"]:hover{
  background: #4ab3c6;
}
.link{
  position: absolute;
  background: #e1eaeb;
  color: #7f7c7c;
  left: 0px;
  height: 20px;
  width: 440px;
  padding: 17px 30px 20px 30px;
  font-size: 16px;
  text-align: right;
  border-top: 1px solid #dbe5e8;
 
  -webkit-border-radius: 0 0  5px 5px;
  border-radius: 0 0  5px 5px;
}
 
.link a {
  font-weight: bold;
  background: #f7f8f1;
  padding: 6px;
  color: rgb(29, 162, 193);
  margin-left: 10px;
  border: 1px solid #cbd518;
 
  -webkit-border-radius: 4px;
  border-radius: 4px;  
 
  -webkit-transition: all 0.4s linear;
  transition: all 0.4s  linear;
}
 
.link a:hover {
  color: #39bfd7;
  background: #f7f7f7;
  border: 1px solid #4ab3c6;
}
#cadastro, 
#login{
  position: absolute;
  top: 0px;
  width: 88%;   
  padding: 18px 6% 60px 6%;
  margin: 0 0 35px 0;
  background: #f7f7f7;
  border: 1px solid rgba(147, 184, 189,0.8);
   
  -webkit-box-shadow: 5px;
  border-radius: 5px;
   
  -webkit-animation-duration: 0.5s;
  -webkit-animation-timing-function: ease;
  -webkit-animation-fill-mode: both;
 
  animation-duration: 0.5s;
  animation-timing-function: ease;
  animation-fill-mode: both;
}
/* Efeito ao clicar no botão ( Ir para Login ) */
#paracadastro:target ~ .content #cadastro,
#paralogin:target ~ .content #login{
  z-index: 2;
  -webkit-animation-name: fadeInLeft;
  animation-name: fadeInLeft;
 
  -webkit-animation-delay: .1s;
  animation-delay: .1s;
}
 
/* Efeito ao clicar no botão ( Cadastre-se ) */
#registro:target ~ .content #login,
#paralogin:target ~ .content #cadastro{
  -webkit-animation-name: fadeOutLeft;
  animation-name: fadeOutLeft;
}
/*fadeInLeft*/
@-webkit-keyframes fadeInLeft {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-20px);
  }
  100% {
    opacity: 1;
    -webkit-transform: translateX(0);
  }
}
 
@keyframes fadeInLeft {
  0% {
    opacity: 0;
    transform: translateX(-20px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}
 
/*fadeOutLeft*/
@-webkit-keyframes fadeOutLeft {
  0% {
    opacity: 1;
    -webkit-transform: translateX(0);
  }
  100% {
    opacity: 0;
    -webkit-transform: translateX(-20px);
  }
}
 
@keyframes fadeOutLeft {
  0% {
    opacity: 1;
    transform: translateX(0);
  }
  100% {
    opacity: 0;
    transform: translateX(-20px);
  }
}

table#t02 {
 width: 100%;
  background-color:#1affd1;
}
body{
background-image: url("medico.jpg");
  -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}


</style>
  <meta charset="UTF-8" />
  <title>Cadastro e login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  
<table id="t02">
	<tr >
	
		<th> <a href="quemsomos.html"style="text-decoration:none" target="_self">Saúde & Vidas</a></th>
		<th> <a href ="empresa.html" style="text-decoration:none" target="_self">Perguntas frequentes</a></th>
		<th><a href="consulta.html" style="text-decoration:none" target="_self">Redes de atendimento</a></th>
		
    </tr>
</table><br></br><br></br>


  <div class="container" >
    <a class="links" id="paracadastrop.php"></a>
    <a class="links" id="paralogin"></a>
     
    <div class="content">      
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form method="post" action=""> 
          <h1>Login</h1> 
          <p> 
            <label for="nome">Seu nome</label>
            <input id="nome" name="nome" required="required" type="text" placeholder="ex. paulo silva"/>
          </p>
		 
           
          <p> 
            <label for="senha">Sua senha</label>
            <input id="senha" name="senha_login" required="required" type="password" placeholder="ex. geo198@" /> 
          </p>
           
          <p> 
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
            <label for="manterlogado">Manter-me logado</label>
          </p>
           
          <p> 
            <input type="submit" value="Logar" /> 
          </p>
           
          <p class="link">
            Ainda não tem conta?
            <a href="#paracadastrop.php">Cadastre-se</a>
          </p>
        </form>
      </div>
 
      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="POST" action="edit.php"> 
          <h1>Cadastro</h1> 
           
          <p> 
            <label for="nome">Seu nome</label>
            <input id="nome" name="nome" required="required" type="text" placeholder="ex.Paulo henrique" />
          </p>
		   <p> 
            <label for="endereco">Endereço</label>
            <input id="endereco" name="endereco" required="required" type="text" placeholder="ex.Rua;Av; Beco etc"/>
          </p>
           
          <p> 
            <label for="email">Seu e-mail</label>
            <input id="email" name="email" required="required" type="email" placeholder="ex. contato@htmlecsspro.com"/> 
          </p>
		   <p> 
            <label for="cpf">CPF</label>
            <input id="cpf" name="cpf" required="required" type="text" placeholder="ex. 45600786956"/>
          </p>
           
          <p> 
            <label for="telefonecontato">Telefone de contato</label>
            <input id="telefonecontato" name="telefonecontato" required="required" type="text" placeholder="ex. 34789067"/>
          </p>
            <p> 
            <label for="cadastrarsenha">Cadastrar senha</label>
            <input id="cadastrarsenha" name="cadastrarsenha" required="required" type="password" placeholder="ex. 567df99"/>
          </p>
          <p> 
            <input type="submit" value="Cadastrar"/> 
          </p>
           
          <p class="link">  
            Já tem conta?
            <a href="#paralogin"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div>  
</body>
</html>