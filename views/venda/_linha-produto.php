<?php
    $hasProd = isset($prodVenda) && !is_null($prodVenda) ? true : false;

    $opcoesSelectProdutos = '';
    foreach ($produtos as $produto) {
        $pSelected = $hasProd && $prodVenda->produto_id == $produto->id ? 'selected' : '';
        $opcoesSelectProdutos .= '<option value="' . $produto->id . '" ' . $pSelected . '>' . $produto->nome . '</option>';
    }
?>

<tr id="produtos-<?=$iProd?>" class="linha-produto">
    <td>
        <select class="form-control produto" id="produtos_produto-<?=$iProd?>" name="produtos[<?=$iProd?>][produto_id]" required>
            <option value="" <?=!$hasProd ? 'selected' : ''?>>Selecione...</option>
            <?=$opcoesSelectProdutos?>
        </select>
    </td>
    <td>
        <input type="number" class="form-control quantidade mascara-num_int" id="produtos_quantidade-<?=$iProd?>"
               name="produtos[<?=$iProd?>][quantidade]" value="<?=($hasProd ? $prodVenda->quantidade : '')?>" min="1"
               step="1" autocomplete="off" required>
    </td>
    <td>
        <input type="text" class="form-control valor_unitario mascara-valor" id="produtos_valor_unitario-<?=$iProd?>"
               name="produtos[<?=$iProd?>][valor_unitario]" value="<?=($hasProd ? formatarValorBr($prodVenda->valor_unitario) : '')?>"
               autocomplete="off" required>
    </td>
    <td>
        <input type="text" class="form-control valor_total mascara-valor" id="produtos_valor_total-<?=$iProd?>" required readonly
               name="produtos[<?=$iProd?>][valor_total]" value="<?=($hasProd ? formatarValorBr($prodVenda->valor_total) : '')?>">
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-xs btn-danger btnRemoverProduto">
            <i class="fa fa-times"></i>
        </button>
    </td>
</tr>
