<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Venda {

    /**
     * Nome da tabela no banco
     * @var string
     */
    private $nomeTabela = 'vendas';

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
     * Observações (pode conter html)
     * @var string
     */
    public $observacoes;

    /**
     * Valor total compra
     * @var float
     */
    public $valor_total_compra;

    /**
     * Valor total de imposto
     * @var float
     */
    public $valor_total_imposto;

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
        $db = new Database($this->nomeTabela);

        //INSERIR REGISTRO NO BANCO
        $this->id = $db->insert([
            'observacoes' => $this->observacoes,
            'valor_total_compra' => $this->valor_total_compra,
            'valor_total_imposto' => $this->valor_total_imposto,
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
            'observacoes' => $this->observacoes,
            'valor_total_compra' => $this->valor_total_compra,
            'valor_total_imposto' => $this->valor_total_imposto,
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
        return (new Database($this->nomeTabela))->select('id = '.$id)
            ->fetchObject(self::class);
    }

}