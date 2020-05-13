<?php 

class Laporan_pengembalian extends CI_Controller{
	public function __construct(){
		Parent::__construct();
		$this->load->model('Model_pengembalian', 'pengembalian');
		$this->load->library('pdf');
	}

	public function index(){
		$data['pengembalian'] = $this->pengembalian->getAllPengembalian();
		$this->load->view('templates/header');
		$this->load->view('laporan/pengembalian', $data);
		$this->load->view('templates/footer');
	}

	  public function export(){    
	  // Load plugin PHPExcel nya    
	  include APPPATH.'third_party/PHPExcel/PHPExcel.php';        
	  // Panggil class PHPExcel nya    
	  $excel = new PHPExcel();

	  // Settingan awal fil excel 
	  $excel->getProperties()->setCreator('My Notes Code')
	                   ->setLastModifiedBy('My Notes Code')                 
	                   ->setTitle("Data pengembalian")                 
	                   ->setSubject("pengembalian")                 
	                   ->setDescription("Laporan Semua Data Pengembalian")
	                   ->setKeywords("Data pengembalian");

	   // Buat sebuah variabel untuk menampung pengaturan style dari header tabel    
	   $style_col = array(      'font' => array('bold' => true), // Set font nya jadi bold      
	   'alignment' => array(        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)        
	   'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)      
	   ),      
	   'borders' => array(
	           'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis        
	           'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis        
	           'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis        
	           'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		      )    
		 		);

	    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel    
	    $style_row = array(      'alignment' => array(        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)      
	    ),      
	    'borders' => array(
	            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	   	        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis        
	   	        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis        
	   	        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis      
	   	    )
	  		);

	    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA pengembalian"); // Set kolom A1 dengan tulisan "DATA SISWA"    
	    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1    
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1    
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1    
	    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

	    // Buat header tabel nya pada baris ke 3    
	    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"    
	    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Nama Anggota"); // Set kolom B3 dengan tulisan "nama anggota"    
	    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Judul Buku"); // Set kolom C3 dengan tulisan "judul buku"    
	    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Tanggal Pinjam"); // Set kolom D3 dengan tulisan "tgl pinjam"    
	    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Tanggal Pengembalian"); // Set kolom D3 dengan tulisan "tgl pinjam"    
	    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Nama Petugas"); // Set kolom E3 dengan tulisan "nama petugas"

	     // Apply style header yang telah kita buat tadi ke masing-masing kolom header    
	    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);    
	    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);    
	    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);    
	    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);    
	    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);    
	    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);

	    $pengembalian = $this->pengembalian->getAllpengembalian();
	    $no = 1; // Untuk penomoran tabel, di awal set dengan 1    
	    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4    
	    foreach($pengembalian as $data){ // Lakukan looping pada variabel data      
		    $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		    $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_anggota);
		    $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->judul);
		    $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->tgl_pinjam);
		    $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tgl_pengembalian);
		    $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->nama_petugas);  
		    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		    $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		    $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		    $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		    $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		    $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		    $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		    $no++; // Tambah 1 setiap kali looping
		    $numrow++; // Tambah 1 setiap kali looping
		  }

		  // Set width kolom    
		  $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A    
		  $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B    
		  $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C    
		  $excel->getActiveSheet()->getColumnDimension('D')->setWidth(18); // Set width kolom D    
		  $excel->getActiveSheet()->getColumnDimension('E')->setWidth(18); // Set width kolom D    
		  $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E        

		  // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)    
		  $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		  // Set orientasi kertas jadi LANDSCAPE    
		  $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);    
		  // Set judul file excel nya    
		  $excel->getActiveSheet(0)->setTitle("Laporan Data pengembalian");    $excel->setActiveSheetIndex(0);    
		  // Proses file excel    
		  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    header('Content-Disposition: attachment; filename="Data pengembalian.xlsx"'); 
		  // Set nama file excel nya    
		  header('Cache-Control: max-age=0');    
		  $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');    
		  $write->save('php://output');

	  }

	  public function pdf(){
	  	 $pdf = new FPDF('p','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'DATA PENGEMBALIAN',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(8,6,'No',1,0);
        $pdf->Cell(30,6,'Nama Anggota',1,0);
        $pdf->Cell(25,6,'Judul Buku',1,0);
        $pdf->Cell(35,6,'Tanggal Pinjam',1,0);
        $pdf->Cell(40,6,'Tanggal Pengembalian',1,0);
        $pdf->Cell(30,6,'Nama Petugas',1,1);
        $pdf->SetFont('Arial','',10);
        $i = 1;
        $pengembalian = $this->pengembalian->getAllPengembalian();
        foreach ($pengembalian as $row){
        	 	$pdf->Cell(8,6,$i,1,0);
            $pdf->Cell(30,6,$row->nama_anggota,1,0);
            $pdf->Cell(25,6,$row->judul,1,0);
            $pdf->Cell(35,6,$row->tgl_pinjam,1,0);
            $pdf->Cell(40,6,$row->tgl_pengembalian,1,0);
            $pdf->Cell(30,6,$row->nama_petugas,1,1); 
            $i++;
        }
        $pdf->Output();
	  }
}