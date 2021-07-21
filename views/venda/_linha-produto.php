<?php
    $prodVenda = isset($prodVenda) && !is_null($prodVenda) ? $prodVenda : null;

    $opcoesSelectProdutos = '';
    foreach ($produtos as $produto) {
        $pSelected = $prodVenda && $prodVenda->produto_id == $iProd ? 'selected' : '';
        $opcoesSelectProdutos .= '<option value="' . $produto->id . '" ' . $pSelected . '>' . $produto->nome . '</option>';
    }
?>

<tr id="produtos-<?=$iProd?>" class="linha-produto">
    <td>
        <select class="form-control produto" id="produtos_produto-<?=$iProd?>" name="produtos[<?=$iProd?>][produto_id]" required>
            <option value="" <?=!$prodVenda ? 'selected' : ''?>>Selecione...</option>
            <?=$opcoesSelectProdutos?>
        </select>
    </td>
    <td>
        <input type="number" class="form-control quantidade mascara-num_int" id="produtos_quantidade-<?=$iProd?>"
               name="produtos[<?=$iProd?>][quantidade]" value="" min="1" step="1" required>
    </td>
    <td>
        <input type="text" class="form-control valor_unitario mascara-valor" id="produtos_valor_unitario-<?=$iProd?>"
               name="produtos[<?=$iProd?>][valor_unitario]" value="" required>
    </td>
    <td>
        <input type="text" class="form-control valor_total mascara-valor" id="produtos_valor_total-<?=$iProd?>"
               name="produtos[<?=$iProd?>][valor_total]" value="" required readonly>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-xs btn-danger btnRemoverProduto">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
