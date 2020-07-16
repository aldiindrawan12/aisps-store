<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model('laporan_model');
        $this->load->model('pesanan_model');
    }

    public function index(){
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["status"] = $_SESSION["status"];
        $data["halaman"] = "laporan";
        $data["produk"] = $this->laporan_model->getallproduk();
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["terjual"] = $this->laporan_model->getlaporan();
        $this->load->view('header',$data);
        $this->load->view('laporan/laporan',$data);
        $this->load->view('footer');
    }

    public function laporan_produk_terjual(){
        $produk = $this->laporan_model->getallproduk();
        $laporan = $this->laporan_model->getlaporan();
        date_default_timezone_set('Asia/Bangkok'); //set timezone waktu
        include './assets/spreedsheet/PHPExcel.php'; //memanggil plugin

        $excel = new PHPExcel();

        //style row
        $style_row = array(      
            'alignment' => array(        
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)      
            ),      
            'borders' => array(        
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),        
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )    
        );

        //set judul tabe;
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Penjualan Produk AISPS STORE");
        $excel->getActiveSheet()->mergeCells('A1:E1');
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        

        // Set width kolom    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(45);
        $excel->getActiveSheet()->getStyle('3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        //set header table
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "#ID Produk");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Produk");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Stok Produk");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Produk Terjual");
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_row);

        //set isi table
        $i=3;
        $n = 0;
        foreach($produk as $value) {
            $i += 1;
            $n += 1;
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $n);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$i, "#".$value["id_produk"]);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$i, $value["nama_produk"]);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$i, $value["stok_produk"]);
            foreach($laporan as $value2) {
                if($value["id_produk"] == $value2["id_produk"]){
                    $excel->setActiveSheetIndex(0)->setCellValue('E'.$i, $value2["terjual"]);
                }
            }
            $excel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$i)->applyFromArray($style_row);
        }

        // Proses file excel    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
        header('Content-Disposition: attachment; filename="Data Penjualan Produk AISPS '.date("d-m-Y").'.xlsx"');
        header('Cache-Control: max-age=0');    
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');    
        $write->save('php://output');
    }
    
}