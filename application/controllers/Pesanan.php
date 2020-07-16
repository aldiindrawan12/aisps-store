<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('checkout_model');
		$this->load->model('pesanan_model');
	}
	public function index()
	{
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["pesanan"] = $this->pesanan_model->getpesanan($data["pengguna"]["id_pengguna"]);
        $data["status"] = $_SESSION["status"];
        $this->load->view("header",$data);
        $this->load->view("pesanan/pesanan",$data);
        $this->load->view("footer");
    }

    public function get_pesanan(){
        $id_pesanan = $this->input->get('id');
        $data = $this->pesanan_model->getpesananbyid($id_pesanan);
        echo json_encode($data);
    }

    // public function pesanan_lunas($id_pesanan){
    //     $this->pesanan_model->pesanan_lunas($id_pesanan);
    //     redirect(base_url("index.php/pesanan"));
    // }

    public function pesanan_dikirim($id_pesanan){
        $resi = $this->input->post("no_resi");
        $this->pesanan_model->pesanan_dikirim($id_pesanan,$resi);
        redirect(base_url("index.php/pesanan/pesanan_pengguna"));
    }

    public function pesanan_cancel($id_pesanan){
        $this->pesanan_model->pesanan_cancel($id_pesanan);
        redirect(base_url("index.php/pesanan"));
    }

    public function pesanan_pengguna(){
        $data["username"] = $username = $_SESSION["pelanggan_user"];
        $data["pengguna"] = $this->pesanan_model->getpengguna($username);
        $data["pesanan"] = $this->pesanan_model->getallpesanan();
        $data["status"] = $_SESSION["status"];
        $this->load->view("header",$data);
        $this->load->view("pesanan/pesanan_pengguna",$data);
        $this->load->view("footer");
    }

    public function status($status){
        $status = str_replace('%20', ' ', $status);
        $data["pesanan_status"] = $this->pesanan_model->getpesananstatus($status);
        $data["status"] = $_SESSION["status"];
        $this->load->view("pesanan/hasil_status",$data);
    }

    public function uploadbukti(){
        $config['upload_path'] = './assets/img-bukti/'; //letak folder file yang akan diupload
        $config['allowed_types'] = 'gif|jpg|png|img|jpeg'; //jenis file yang dapat diterima

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti')) {
            $this->upload->data();
            $gambar =  $this->upload->data('file_name');
        }
        $this->pesanan_model->uploadbukti($this->input->post('id-pesanan'),$gambar);
        redirect(base_url("index.php/pesanan"));
    }

    public function cetak_laporan($id_pesanan){
        date_default_timezone_set('Asia/Bangkok'); //set timezone waktu
        $data = $this->pesanan_model->getpesananbyid($id_pesanan);        

        require './assets/fpdf/fpdf.php';
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',20);
        $pdf->Image('./assets/img/as.png',10,10,-400);
        $pdf->Cell(75,20,'AISPS STORE',0,1,'R');
        $pdf->Cell(190,20,$data["status"],0,1,'R');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(190,20,'Laporan Pesanan Pelanggan',0,1,'R');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(190,0,date("d-M-Y H:i:s"),0,1,'R');
        $pdf->Cell(10,20,'',0,1);
        
        $pdf->SetFont('Arial',"B",10);
        $pdf->Cell(100,6,'No Pesanan : ');
        $pdf->Cell(50,6,'#'.$data["id_pesanan"]);
        $pdf->Ln();
        $pdf->Cell(100,6,'Tanggal Pemesanan : ');
        $pdf->Cell(50,6,$data["tanggal_pesanan"]);
        $pdf->Ln();
        $pdf->Cell(100,6,'Kepada : ');
        $pdf->Cell(50,6,$data["nama_pemesan"]);
        $pdf->Ln();
        $pdf->Cell(100,6,'Alamat Pengiriman : ');
        $pdf->Cell(50,6,$data["alamat"]);
        $pdf->Ln();
        $pdf->Cell(100,6,'No Telpon : ');
        $pdf->Cell(50,6,$data["no"]);
        $pdf->Cell(10,20,'',0,1);
        $pdf->Cell(100,6,'No Resi : ');
        $pdf->Cell(50,6,$data["no_resi"]);

        $pdf->Cell(10,20,'',0,1);
        $pdf->Cell(100,6,'Detail Pesanan');
        $decode = json_decode($data["pesanan"],true);
        $pdf->Ln();
        $pdf->Cell(80,6,'Nama Produk',1,0);
        $pdf->Cell(25,6,'Qty',1,0);
        $pdf->Cell(45,6,'Harga',1,0);
        $pdf->Cell(45,6,'Jumlah',1,1);
        $total = 0;
        foreach($decode as $value){
            $pdf->Cell(80,6,$value["nama_produk"],1,0);
            $pdf->Cell(25,6,$value["jumlah"],1,0);
            $pdf->Cell(45,6,'Harga',1,0);
            $pdf->Cell(45,6,'Rp.'.$value["total"],1,1);
            $total = $total + $value["total"];
        }
        $pdf->Cell(150,6,'Total',1,0);
        $pdf->Cell(45,6,'Rp.'.$total,1,1);
        
        $pdf->Cell(10,20,'',0,1);
        $pdf->Cell(100,6,'Catatan Pembeli : ');
        $pdf->Cell(50,6,$data["pesan_pelanggan"]);

        $pdf->Output();
    }

    public function laporan_penjualan(){
        $data = $this->pesanan_model->getallpesanan();
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Penjualan AISPS STORE");
        $excel->getActiveSheet()->mergeCells('A1:D1');
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
        

        // Set width kolom    
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
        $excel->getActiveSheet()->getStyle('3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        //set header table
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "#ID Pesanan");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Tanggal Pesanan");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Total");
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_row);

        //set isi table
        $total = 0;
        $i=3;
        $n = 0;
        foreach($data as $value) {
            $total += $value["total"];
            $i += 1;
            $n += 1;
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$i, $n);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$i, "#".$value["id_pesanan"]);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$i, $value["tanggal_pesanan"]);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$i, "Rp.".number_format($value["total"],2,',','.'));
            
            $excel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($style_row);
        }

        $excel->setActiveSheetIndex(0)->setCellValue('A'.($i+1), "Total Pendapatan");   
        $excel->setActiveSheetIndex(0)->setCellValue('D'.($i+1), "Rp.".number_format($total,2,',','.'));   
        $excel->getActiveSheet()->mergeCells('A'.($i+1).':C'.($i+1));
        $excel->getActiveSheet()->getStyle('A'.($i+1))->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B'.($i+1))->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C'.($i+1))->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('D'.($i+1))->applyFromArray($style_row);

        // Proses file excel    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
        header('Content-Disposition: attachment; filename="Data Penjualan AISPS '.date("d-m-Y").'.xlsx"');
        header('Cache-Control: max-age=0');    
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');    
        $write->save('php://output');
    }
}
