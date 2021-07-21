<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Produto {

    /**
     * Nome da tabela no banco
     * @var string
     */
    private $nomeTabela = 'produtos';

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
     * Id do Tipo de Produto
     * @var integer
     */
    public $tipo_id;

    /**
     * Tipo de Produto
     * @var TipoProduto
     */
    public $tipoProduto;

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
            'tipo_id' => $this->tipo_id,
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
            'tipo_id' => $this->tipo_id,
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
        return (new Database($this->nomeTabela))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Método responsável por buscar um registro com base em seu ID
     * @param integer $id
     * @return Produto
     */
    public function find($id) {
        $registro = (new Database($this->nomeTabela))->select('id = '.$id)
            ->fetchObject(self::class);
        $registro->tipoProduto = $this->getTipoProduto($registro->tipo_id);
        return $registro;
    }

    public function getTipoProduto($id){
        return (new TipoProduto)->find($id);
    }

    public function getComTipo($where = null, $order = null, $limit = null) {
        $registros = $this->get($where = null, $order = null, $limit = null);
        foreach ($registros as $registro) {
            $registro->tipoProduto = $this->getTipoProduto($registro->tipo_id);
        }
        return $registros;
    }

    /**
     * Preencher os atributos do objeto para salvar/atualizar no banco
     * @param $data
     * @return $this
     */
    public function fill($data) {
        $this->nome = $data['nome'];
        $this->descricao = $data['descricao'];
        $this->tipo_id = $data['tipo_id'];
        $this->ativo = $data['ativo'];
        return $this;
    }
}