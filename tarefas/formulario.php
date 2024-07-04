<h1>Gerenciador de Tarefa</h1>
<form method="POST">
  <fieldset>
    <legend>Nova Tarefa</legend>
    <label>
      Tarefa:
      <input type="hidden" name="id" value="<?php echo  $tarefa['id'];  ?>" />

      <?php if ($tem_erros && array_key_exists('nome', $erros_validacao)) : ?>
        <span style="color: red;"><?php echo $erros_validacao['nome']; ?></span>
      <?php endif;  ?>
      <input type="text" name="nome" value="<?php echo  $tarefa['nome'];  ?>" />
    </label>
    <label>
      Descrição (Opcional):
      <textarea name="descricao">
				<?php echo $tarefa['descricao'];  ?>
</textarea>
    </label>
    <label>
      Prazo (Opcional):
      <?php if ($tem_erros && array_key_exists('prazo', $erros_validacao)) : ?>
        <span style="color: red;"><?php echo $erros_validacao['prazo']; ?></span>
      <?php endif;  ?>

      <input type="text" name="prazo" placeholder="dd/mm/yyyy" value="<?php
                                                                      echo ($tarefa['prazo']);
                                                                      ?>" />
    </label>
    <fieldset>
      <legend>Prioridade:</legend>
      <label>
        <input type="radio" name="prioridade" value="1" <?php echo ($tarefa['prioridade']  ==  1)
                                                          ?  'checked'
                                                          :  '';
                                                        ?> /> Baixa
      </label>
      <label>
        <input type="radio" name="prioridade" value="2" <?php echo ($tarefa['prioridade']  ==  2)
                                                          ?  'checked'
                                                          :  '';
                                                        ?> /> Média
      </label>
      <label>
        <input type="radio" name="prioridade" value="3" <?php echo ($tarefa['prioridade']  ==  3)
                                                          ?  'checked'
                                                          :  '';
                                                        ?> /> Alta
      </label>
    </fieldset>
    <label>
      Tarefa concluída:
      <input type="checkbox" name="concluida" value="1" <?php echo ($tarefa['concluida']  ==  1)
                                                          ?  'checked'
                                                          :  '';
                                                        ?> />
    </label>
    

  </fieldset>
  <!-- Botão de envio -->
  <div style="display: flex; align-items: center; justify-content: space-between; margin: 0 20px;">
    <?php if ($tarefa['id'] > 0) : ?>
      <input type="submit" value="Atualizar" />
    <?php else : ?>
      <input type="submit" value="Cadastrar" />
    <?php endif; ?>

    <?php if ($tarefa['id'] > 0) : ?>
      <a class="a_btn" href="tarefas.php">Cancelar</a>
    <?php endif; ?>
  </div>
</form>


<?php if (!$tarefa['id'] > 0) : ?>
  <a class="orange" href="remover_concluidas.php">
    Remover Concluidas
  </a>
<?php endif; ?>