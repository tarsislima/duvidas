<?php 
class HospedeDAO{


	//crate - insert
	public function create(Hospede $hospede){
		try {

			$sql = "INSERT INTO hospede (nome, cpfhospede, telefone, sexo, datanascimento) VALUES (:nome, :cpfhospede, :telefone, :sexo, :dataNascimento)";

			$p_sql = Conexao::getConexao()->prepare($sql);

			$p_sql->bindValue(":nome", $hospede->getNome());
			$p_sql->bindValue(":cpfhospede", $hospede->getCpfhospede());
			$p_sql->bindValue(":telefone", $hospede->getTelefone());
			$p_sql->bindValue(":sexo", $hospede->getSexo());
			$p_sql->bindValue("dataNascimento", $hospede->getDatanascimento());

			return $p_sql->execute();

		} catch (Exception $e) {
			print "Erro ao inserir hospede " . $e;	
		}

	} 


	//read - unit
	public function readUnit($cpfhospede){
		try {

			$sql = "SELECT * FROM hospede WHERE cpfhospede = :cpfhospede";

			$p_sql = Conexao::getConexao()->prepare($sql);
			$p_sql->bindValue(":cpfhospede", $cpfhospede);		
			
			$p_sql->execute();

			$result = $p_sql->fetch();

			return $result;


		} catch (Exception $e) {
			print "Erro ao buscar único hospede";
		}

	}


	//read - all
	public function read(){
		try {

			$sql = "SELECT * FROM hospede";

			$result = Conexao::getConexao()->query($sql);

			$lista = $result->fetchAll(PDO::FETCH_ASSOC);

			$f_lista = array();

			foreach ($lista as $l) {
				$s_lista[] = $this->listaHospede($l);
			}

			return $s_lista;
			
			
		} catch (Exception $e) {

			print "Erro ao buscar hospedes";
			
		}
	}
 
	//update
	public function update(Hospede $hospede){
		try {
			$sql = "UPDATE hospede set nome=:nome, telefone=:telefone, sexo=:sexo, datanascimento = :datanascimento WHERE cpf = :cpf";

			$p_sql = Conexao::getConexao()->prepare($sql);

            $p_sql->bindValue(":nome", $hospede->getNome());
            $p_sql->bindValue(":telefone", $hospede->getTelefone());
            $p_sql->bindValue(":sexo", $hospede->getSexo());
            $p_sql->bindValue(":dataNascimento", $hospede->getDatanascimento());

            return $p_sql->excecute();
			
		} catch (Exception $e) {
			
		}

	}

	//delete
	public function delete(Hospede $hospede){
		try {

			$sql = "DELETE FROM hospede WHERE cpfhospede = :cpfhospede";

			$p_sql = Conexao::getConexao()->prepare($sql);
			
			$p_sql->bindValue(":cpfhospede", $hospede->getCpfhospede());

			return $p_sql->execute();


			
		} catch (Exception $e) {
			
		}

	}


	public function listaHospede($row){

		$hospede = new Hospede();

		$hospede->setNome($row['nome']);
		$hospede->setCpfhospede($row['cpfhospede']);
		$hospede->setTelefone($row['telefone']);
		$hospede->setSexo($row['sexo']);
		$hospede->setDatanascimento($row['datanascimento']);

		return $hospede;
	}



} ?>
