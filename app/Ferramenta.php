<?php

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 **/

class Ferramenta {
	
	private $excel;
	
	function __construct(){
		 $this->excel = new PHPExcel();
	}
	
	public function getExcel($ligacoes){
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->setActiveSheetIndex(0)
			->setCellValue('A1', "Ramal          " )
			->setCellValue('B1', "Data Ligacao   " )
			->setCellValue("C1", "Nome do Arquivo" )
			->setCellValue("D1", "Numero         " )
			->setCellValue("E1", "Duracao        " );
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
 		if (!empty($ligacoes)){
			$count = 2;
			foreach($ligacoes as $ligacao){
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(0,$count,$ligacao->getRamal());
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(1,$count,$ligacao->getData());
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(2,$count,$ligacao->getArquivo());
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(3,$count,$ligacao->getNumero());
				$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4,$count,$ligacao->getDuracao());
				$count++;
			}
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="dados.xls"');
		header('Cache-Control: max-age=0');
		// Se for o IE9, isso talvez seja necessario
		header('Cache-Control: max-age=1');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}
	
}
