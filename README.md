# MonitorAsterisk

<dl>
	<dt>Escutar ligações gravadas pelo Asterisk através de uma pagina em PHP.</dt>
	<dd>É possivel filtar as ligaçoes por ramal, mes e ano e ainda exportar para o Excel</dd>
</dl>

Para que funcina é necessario alimentar um banco de dados Mysql 
com um Script que monitore a pasta /var/spool/asterisk/monitor/.crie um link 
simbolico chamado "audio" dentro da pasta principal da sua pagina para o local onde o
asterisk grava as ligaçoes.
```bash
usuario@servidor:/var/www$ ln -ls /var/spool/asterisk/monitor/ audio
```
Nas configuraçoes do Asterisk  altere a string de salvamento no arquivo de configuração 'extensions.conf'.
A string tem que ter o seguinte formato: 
```
exten => _XX.,1,Set(MONITOR_FILENAME=${STRFTIME(${EPOCH},,%Y-%m-%d_%H.%M.%S)}_${CDR(src)}_${CDR(dst)}_${CDR(billsec)})
exten => _XX.,n,Mixmonitor(${MONITOR_FILENAME}.wav)
exten => _XX.,n,Dial(SIP/${EXTEN}@tronco-que-centraliza-todas-ligacoes,50)
```
Para o banco de dados, crie as tabelas:
```SQL
CREATE TABLE `Ligacoes` (
	`id_ligacao` INT(11) NOT NULL AUTO_INCREMENT,
	`ramal` INT(11) NULL DEFAULT NULL,
	`data_ligacao` DATETIME NULL DEFAULT NULL,
	`arquivo` VARCHAR(254) NULL DEFAULT NULL,
	`numero` VARCHAR(20) NULL DEFAULT NULL,
	`duracao` DOUBLE NULL DEFAULT NULL,
	`bk` BIT(1) NULL DEFAULT NULL,
	PRIMARY KEY (`id_ligacao`)
)
```
```SQL
CREATE TABLE `Usuario` (
	`id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(254) NULL DEFAULT NULL,
	`ramal` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id_usuario`)
)
```
E por fim o script que varre o o diretório /var/spool/asterisk/monitor/ e alimenta a tabela Ligacoes

(fica por sua conta crirar um procedimento de varredura altomatica)


```bash
#!/bin/bash
local="/var/spool/asterisk/monitor"
cd $local
for i in `ls`; do 
    ramal=`cut  -d_ -f 3 <<< $i`
     data=`cut  -d_ -f 1 <<< $i`
     hora=`cut  -d_ -f 2 <<< $i`
   numero=`cut  -d_ -f 4 <<< $i`
    dataL="$data $(sed "s/\./\:/g" <<< $hora)"
  arquivo=$i
    query=`echo  "select ramal from Ligacoes where arquivo = '$arquivo'  " | mysql MLigacao -u root -pmaster`
	if [ ${#query} -lt 4 ];then
		sox $i -n stat 2>/tmp/Mtmp.txt 
		tmp=`cat /tmp/Mtmp.txt | grep Len`
		duracao=`echo $tmp | cut -d: -f2`
    	rm /tmp/Mtmp.txt 
    echo "insert into Ligacoes (ramal,data_ligacao,arquivo,numero,duracao,bk) values ($ramal,'$dataL','$arquivo','$numero',$duracao,0)"  | mysql MLigacao -u root -pmaster
	fi
done
```

#Screenshot

<dl><dt>Usuario:</dt></dl>
![alt text][usuario]
<dl><dt>Filtro1:</dt></dl>
![alt text][filtro1]
<dl><dt>Filtro2:</dt></dl>
![alt text][filtro2]
<dl><dt>Lista de ligações:</dt></dl>
![alt text][ligacoes]
<dl><dt>Exportar para o Excel</dt></dl>
![alt text][excel1]
<dl><dt>Planilha com resultados</dt></dl>
![alt text][excel2]

[usuario]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/usuarios.png "Cadastro Usuarios"
[filtro1]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/filtro1.png "Filtro"
[filtro2]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/filtro2.png "Filtro"
[ligacoes]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/ligacoes.png "Ligações"
[excel1]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/excel1.png "Link exportação"
[excel2]:https://github.com/hudymoreira/MonitorAsterisk/blob/master/files/screenshot/excel2.png "resultado pesquisa"












