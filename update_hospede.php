<?php 

include_once "../conexao/Conexao.php";
include_once "../model/Hospede.php";
include_once "../dao/HospedeDAO.php";

//instancia classes
$hospede = new Hospede();
$hospededao = new HospedeDAO();
 
?>


<?php 
if (!isset($_GET['cpf'])) {
	die("já era");
}else{

	$cpfhospede = $_GET['cpf'];
	
	foreach ($hospededao->readUnit($_GET['cpf']) as $hospede){

		
 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Hospedes</title>
</head>
<body>

	<h1>Atualizar Hóspedes </h1>

	<form  action="../controller/HospedeController.php" method="POST">
		<div class="row" >
			<label>Nome</label>
			<input type="text" name="nome" value="<?php echo $hospede->nome ?> ">

			<label>Telefone</label>
			<input type="text" name="telefone" value="<?php echo $hospede['telefone'] ?>">

			<label>Sexo</label>
			<input type="text" name="sexo" value="<?php echo $hospede->getSexo() ?>">

			<label>Data Nascimento</label>
			<input type="date" name="dataNascimento" value="<?php echo $hospede->getDatanascimento() ?>">


			<input type="hidden" name="cpfhospede" value="<?= $hospede->getCpfhospede() ?>" />
			<button type="submit" name="editarHospede">Atualizar Hóspede</button>

		</div>	
	</form>

</body>
</html>



<?php 
	}
}

?>