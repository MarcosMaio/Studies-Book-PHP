<table>
  <tr>
    <th>Tarefa</th>
    <th>Descricao</th>
    <th>Prazo</th>
    <th>Prioridade</th>
    <th>Concluída</th>
    <th>Opções</th>
  </tr>

  <?php if (!empty($tarefas)) : ?>
    <?php foreach ($tarefas as $tarefa) : ?>
      <tr>
        <td>
          <a href="tarefa.php?id=<?php echo htmlspecialchars($tarefa['id']); ?>">
            <?php echo htmlspecialchars($tarefa['nome']); ?>
          </a>
        </td>
        <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
        <td><?php echo ($tarefa['prazo']); ?></td>
        <td><?php echo  traduz_prioridade($tarefa['prioridade']);  ?></td>
        <td><?php echo traduz_concluida($tarefa['concluida']); ?></td>
        <td>
          <div style="display: flex; gap: 20px;">
            <a class="yellow" href="editar.php?id=<?php echo  $tarefa['id'];  ?>">
              Editar
            </a>

            <a class="purple" href="duplicar.php?id=<?php echo  $tarefa['id'];  ?>">
              Duplicar
            </a>

            <a class="red" href="remover.php?id=<?php echo  $tarefa['id'];  ?>">
              Remover
            </a>
          </div>
        </td>

      </tr>
    <?php endforeach;  ?>
  <?php else : ?>
    <tr>
      <td colspan="5">Nenhuma tarefa encontrada.</td>
    </tr>
  <?php endif; ?>

</table>