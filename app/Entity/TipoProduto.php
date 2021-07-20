<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class TipoProduto {

    /**
     * Nome da tabela no banco
     * @var string
     */
    private $nomeTabela = 'tipos_produtos';

    /**
     * Identificador único
     * @var integer
     */
    public $id;

    /**
     * Nome
     * @var string
     */
    public $nome;

    /**
     * Descrição (pode conter html)
     * @var string
     */
    public $descricao;

    /**
     * Percentual de imposto pago
     * @var float
     */
    public $percentual_imposto;

    /**
     * Define se está ativo
     * @var boolean
     */
    public $ativo;

    /**
     * Data/hora de cadastro
     * @var string
     */
    public $dh_cadastro;

    /**
     * Método responsável por cadastrar um novo registro no banco
     * @return boolean
     */
    public function create() {
        //DEFINIR A DATA
        $this->dh_cadastro = date('Y-m-d H:i:s');

        $db = new Database($this->nomeTabela);

        //INSERIR REGISTRO NO BANCO
        $this->id = $db->insert([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'percentual_imposto' => $this->percentual_imposto,
            'ativo' => $this->ativo,
            'dh_cadastro' => $this->dh_cadastro
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar um registro no banco
     * @return boolean
     */
    public function update() {
        $db = new Database($this->nomeTabela);

        return $db->update('id = ' . $this->id, [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'percentual_imposto' => $this->percentual_imposto,
            'ativo' => $this->ativo,
        ]);
    }

    /**
     * Método responsável por excluir um registro do banco
     * @return boolean
     */
    public function delete() {
        return (new Database($this->nomeTabela))->delete('id = ' . $this->id);
    }

    /**
     * Método responsável por obter os registros do banco de dados
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @return array
     */
    public function get($where = null, $order = null, $limit = null) {
        return (new Database($this->nomeTabela))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Método responsável por buscar um registro com base em seu ID
     * @param  integer $id
     * @return TipoProduto
     */
    public function find($id) {
        return (new Database($this->nomeTabela))->select('id = '.$id)->fetchObject(self::class);
    }

}