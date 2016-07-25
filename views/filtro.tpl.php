<?php 

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 */
?>
<div id="tudo">
<form id="contactform" class="rounded" method="post" action="index.php">
<input type="hidden" name="opt" value="ligacoes">
<h2>Filtro Ligações</h2>
 
<div class="field">
  <label for="name">Ramal:</label>
  <select class="input" name="ramal" >
  <option value="0">Todos </option>
  <?php foreach ($dados as $usuario) { ?>
  <option value="<?php echo $usuario->getRamal()?>"><?php echo $usuario->getRamal(). " ".$usuario->getNome()  ?></option>
  <?php }?>
  </select>
</div>

<p></p>

<div class="field">
  <label for="name">Mes:</label>
  <select class="input" name="mes" >
  <option value="0">Todos </option>
  <option value="1">Janeiro </option>
  <option value="2">Fevereiro </option>
  <option value="3">Março </option>
  <option value="4">Abril </option>
  <option value="5">Maio </option>
  <option value="6">Junho </option>
  <option value="7">Julho </option>
  <option value="8">Agosto </option>
  <option value="9">Setembro </option>
  <option value="10">Outubro </option>
  <option value="11">Novenbro </option>
  <option value="12">Desembro </option>
  </select>
</div>


<p></p>

<div class="field">
  <label for="name">ano:</label>
  <select class="input" name="ano">
  <option value="2016">2016 </option>
  <option value="2017">2017 </option>
  <option value="2018">2018 </option>
  <option value="2019">2019 </option>
  <option value="2020">2020 </option>
  </select>
</div>
 
<input type="submit" name="Submit"  class="button" value="filtrar" style="width: 60px;"/>
</form>

</table>

</div>