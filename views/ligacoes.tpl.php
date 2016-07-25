<?php 

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 */
?>

	<div id="tudo">
	<p> <a href="?opt=excel<?php echo "&ramal=" . $dados[1][0] . "&mes=" . $dados[1][1] . "&ano=".$dados[1][2];?>"   >Exporta para o excel</a></p>
		<table style="width:100%">
			<tr>
				<th>Ramal</th>
				<th>Data Ligação</th> 
				<th>Audio</th>
				<th>Numero</th>
				<th>Duração (segundos)</th>
			</tr>
<?php 

foreach ($dados[0] as $ligacao) {

?>
			<tr>
				<td><?php echo $ligacao->getRamal();?></td>
				<td><?php echo $ligacao->getData();?></td> 
				<td>
				<audio controls>
  					<source src="audio/<?php echo $ligacao->getArquivo();?>" type="audio/wav">
					O seu navegador nao suporta esse topo de audio
				</audio>
				</td>
				<td><?php echo $ligacao->getNumero(); ?></td>
				<td><?php echo $ligacao->getDuracao(); ?></td>
			</tr>
<?php } ?>
		</table>
	</div>