<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class VendaProduto {

    /**
     * Nome da tabela no banco
     * @var string
     */
    private $nomeTabela = 'vendas_produtos';

    /**
     * Identificador único
     * @var integer
     */
    public $id;

    /**
     * ID da Venda
     * @var integer
     */
    public $venda_id;

    /**
     * ID do Produto
     * @var integer
     */
    public $produto_id;

    /**
     * Quantidade
     * @var integer
     */
    public $quantidade;

    /**
     * Valor unitário
     * @var float
     */
    public $valor_unitario;

    /**
     * Valor total
     * @var float
     */
    public $valor_total;

    /**
     * Percentual de imposto pago
     * @var float
     */
    public $percentual_imposto;

    /**
     * Valor total de imposto
     * @var float
     */
    public $valor_total_imposto;


    /**
     * Método responsável por cadastrar um novo registro no banco
     *
     * @return boolean
     */
    public function create() {
        $db = new Database($this->nomeTabela);

        //INSERIR REGISTRO NO BANCO
        $this->id = $db->insert([
            'venda_id' => $this->venda_id,
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor_unitario' => $this->valor_unitario,
            'valor_total' => $this->valor_total,
            'percentual_imposto' => $this->percentual_imposto,
            'valor_total_imposto' => $this->valor_total_imposto
        ]);

        //RETORNAR SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar um registro no banco
     *
     * @return boolean
     */
    public function update() {
        $db = new Database($this->nomeTabela);

        return $db->update('id = ' . $this->id, [
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'valor_unitario' => $this->valor_unitario,
            'valor_total' => $this->valor_total,
            'percentual_imposto' => $this->percentual_imposto,
            'valor_total_imposto' => $this->valor_total_imposto
        ]);
    }

    /**
     * Método responsável por excluir um registro do banco
     *
     * @return boolean
     */
    public function delete() {
        return (new Database($this->nomeTabela))->delete('id = ' . $this->id);
    }

    /**
     * Método responsável por obter os registros do banco de dados
     *
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
     *
     * @param  integer $id
     * @return TipoProduto
     */
    public function find($id) {
        return (new Database($this->nomeTabela))->select('id = '.$id)
            ->fetchObject(self::class);
    }

    /**
     * Preencher os atributos do objeto para salvar/atualizar no banco
     *
     * @param $data
     * @return $this
     */
    public function fill($data) {
        if (array_key_exists('venda_id', $data)) {
            $this->venda_id = $data['venda_id'];
        }
        $this->produto_id = $data['produto_id'];
        $this->quantidade = $data['quantidade'];
        $this->valor_unitario = $data['valor_unitario'];
        $this->valor_total = $data['valor_total'];
        $this->percentual_imposto = $data['percentual_imposto'];
        $this->valor_total_imposto = $data['valor_total_imposto'];

        return $this;
    }
}