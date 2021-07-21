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

    /*
     * Produtos da venda
     * @var Collection VendaProduto
     * */
    public $produtosVenda;

    /**
     * Método responsável por cadastrar um novo registro no banco
     *
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
     *
     * @return boolean
     */
    public function update() {
        $db = new Database($this->nomeTabela);

        return $db->update('id = ' . $this->id, [
            'observacoes' => $this->observacoes,
            'valor_total_compra' => $this->valor_total_compra,
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
     * @param integer $id
     * @param bool $with_relationship
     * @return Produto
     */
    public function find($id, $with_relationship = false) {
        $registro = (new Database($this->nomeTabela))->select('id = '.$id)
            ->fetchObject(self::class);

        // Se for para retornar os produtos da venda
        if ($with_relationship) {
            $registro->produtosVenda = (new VendaProduto)->get('venda_id='.$id);
        }

        return $registro;
    }

    /**
     * Formatar e preencher os dados para salvar/atualizar no banco
     *
     * @param array $data
     * @return $this
     */
    public function fillAndSave(array $data) {
        // Veriricar se é cadastro ou edição
        $cadastrando = array_key_exists('cadastrando', $data) && $data['cadastrando'];

        // Formatar os dados do formulário para salvar
        $data = $this->formatDataForm($data);

        // Preencher os dados do formulário no objeto
        $this->fill($data);

        // Se for um novo cadastro
        if ($cadastrando) {
            // Salvar no banco
            $this->create();

            // Percorrer os produts
            foreach ($data['produtos'] as $key => $value) {
                // Setar o id da venda
                $value['venda_id'] = $this->id;

                // Cadastrar o produto da venda
                $vendaProduto = new VendaProduto;
                $vendaProduto->fill($value)->create();
            }

        } else { // Se estiver editando

            // Atualizar no banco
            $this->update();

            // Guardar o id dos produtos de venda vinculados do banco para verificar por remoções
            $ids_antes = [];
            foreach ($this->produtosVenda as $p) {
                $ids_antes[] = $p->id;
            }

            // Irá armazenar os ids que existem após a atualização do form para verificar por remoções
            $ids_agora = [];

            // Percorrer os produtos para verificar por novos adicionados e por atualização
            foreach ($data['produtos'] as $key => $value) {
                // Setar o id da venda
                $value['venda_id'] = $this->id;

                if (!in_array($key, $ids_antes)) { // novo produto adicionado nessa alteração
                    // Cadastrar o produto da venda
                    (new VendaProduto)->fill($value)->create();
                } else {
                    // O produto já estava na lista, buscar no banco e atualizar os dados
                    (new VendaProduto)->find($key)->fill($value)->update();
                }

                // Armazenar o id
                $ids_agora[] = $key;
            }

            // Produtos removidos: diferença dos ids dos produtos de antes da alteração para os de depois da comparação
            $aux_removidos = array_diff($ids_antes, $ids_agora);
            if (count($aux_removidos)) {
                // Buscar no banco e remover
                foreach ($aux_removidos as $removido) {
                    (new VendaProduto)->find($removido)->delete();
                }
            }
        }

        return $this;
    }

    /**
     * Preencher os atributos do objeto pelos dados do array para salvar/atualizar no banco
     *
     * @param array $data
     * @return $this
     */
    public function fill(array $data) {
        $this->dh_cadastro = $data['dh_cadastro'];
        $this->observacoes = $data['observacoes'];
        $this->valor_total_compra = $data['valor_total_compra'];
        $this->valor_total_imposto = $data['valor_total_imposto'];

        return $this;
    }

    /**
     * Formatar os dados do formulário para salvar a venda e os produtos.
     *
     * @param array $data
     * @return array
     */
    public function formatDataForm(array $data) {

        // Fazer a soma do total de imposto da venda
        $valor_total_imposto = 0;

        // Percorrer os produtos do formulário para ajustar os dados para salvar
        foreach ($data['produtos'] as $key => $value) {
            $data['produtos'][$key]['valor_unitario'] = formatarFloatBD($value['valor_unitario']);
            $data['produtos'][$key]['valor_total'] = formatarFloatBD($value['valor_total']);

            // Buscar o produto para calcular o imposto de acordo com o percentual do seu tipo
            $prod = (new Produto())->find( $value['produto_id'] );

            // Guardar o percentual de imposto aplicado
            $data['produtos'][$key]['percentual_imposto'] = $prod->tipoProduto->percentual_imposto;

            // Calcular o valor total de imposto de acordo com o valor total desse produdo
            $data['produtos'][$key]['valor_total_imposto'] = calcularPercentualSobreValor(
                $data['produtos'][$key]['valor_total'], $data['produtos'][$key]['percentual_imposto']
            );

            // Somar o valor desse produto ao total
            $valor_total_imposto += $data['produtos'][$key]['valor_total_imposto'];
        }

        // Formatar os dados da venda do form para salvar no banco
        $data['dh_cadastro'] = formatarDataHoraBD($data['dh_cadastro']);
        $data['valor_total_compra'] = formatarFloatBD($data['valor_total_compra']);
        $data["valor_total_imposto"] = $valor_total_imposto;

        return $data;
    }
}