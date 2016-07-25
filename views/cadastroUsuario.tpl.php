
<div id="tudo">
<form id="contactform" class="rounded" method="post" action="index.php">
<input type="hidden" name="opt" value="usuario">
<h2>Cadastro de usuario</h3>
 
<div class="field">
    <label for="name">Nome:</label>
    <input type="text" class="input" name="nome" id="name" />
    <p class="hint">Digite o seu nome.</p>
</div>
<p></p>

<div class="field">
  <label for="name">Ramal:</label>
  <select class="input" name="ramal" >
 <?php foreach ($dados[0] as $ramal) { ?>
    <option value="<?php echo $ramal->getRamal()?>"><?php echo $ramal->getRamal()?></option>
<?php } ?> 
  </select>
</div>
 
<input type="submit" name="Submit"  class="button" value="Salvar" />
</form>
<pre></pre>
<table style="width:600px">
	<tr>
		<th>Ação</th>
		<th>Nome</th>
		<th>Ramal</th>
	</tr>
 <?php foreach ($dados[1] as $usuario) { ?>
	<tr>
		<td><a href="?opt=usuario&delete=<?php echo $usuario->getId()?>">Deletar</a></td>
		<td><?php echo $usuario->getNome()?> </td>
		<td><?php echo $usuario->getRamal()?></td>
	</tr>
<?php } ?> 
</table>

</div>