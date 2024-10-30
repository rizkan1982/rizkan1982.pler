<?php

namespace App\Controllers;

use App\Models\M_model;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    
    public function index()
    {
        
        echo view('header');
        echo view('login');
        echo view('menuutama');
        echo view('footer');
  

    }
    public function dashboard()
    {
        if(session()->get('id')>0) {
        echo view('header');
        echo view('menuutama');
        echo view('dashboard');
        echo view('footer');
    }else{
        return redirect()->to('/Home');
    }
    }
    public function l_brg()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$kui['kunci']='c_b';
			echo view('header');
			echo view('menuutama');
			echo view('filter',$kui);
			echo view('footer');
        }else{
            return redirect()->to('/Home');
        }

	}

	public function l_masuk()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$kui['kunci']='view_bm';
			echo view('header');
			echo view('menuutama');
			echo view('filter',$kui);
			echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
	}

	public function l_penjualan()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$kui['kunci']='view_p';
			echo view('header');
			echo view('menuutama');
			echo view('filter',$kui);
			echo view('footer');
        }else{
            return redirect()->to('/Home');
        }
    }
	public function cari_b()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$awal= $this->request->getPost('awal');
			$akhir= $this->request->getPost('akhir');
			$kui['duar']=$model->filter2('barang',$awal,$akhir);
			echo view('c_b',$kui);
        }else{
            return redirect()->to('/Home');
        }
	}

	public function cari_bm()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$awal= $this->request->getPost('awal');
			$akhir= $this->request->getPost('akhir');
			$kui['duar']=$model->filter_ff('brg_masuk',$awal,$akhir);
			echo view('c_bm', $kui);
        }else{
            return redirect()->to('/Home');
        }
	}

	public function cari_p()
	{
        if(session()->get('id')>0) {
			$model=new M_model();
			$awal= $this->request->getPost('awal');
			$akhir= $this->request->getPost('akhir');
			$kui['duar']=$model->filter_ff('brg_keluar',$awal,$akhir);
			echo view('c_p', $kui);
        }else{
            return redirect()->to('/Home');
        }
	}
	public function pdf_b()
	{
        if(session()->get('id')>0) {
		$model = new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$kui['duar']=$model->filter2('barang',$awal,$akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('c_b',$kui));
		$dompdf->setPaper('A4','landscape');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
    }else{
        return redirect()->to('/Home');
    }
	}
	public function pdf_bm()
	{
        if(session()->get('id')>0) {
		$model = new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$kui['duar']=$model->filter_ff('brg_masuk',$awal,$akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('c_b',$kui));
		$dompdf->setPaper('A4','landscape');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
    }else{
        return redirect()->to('/Home');
    }
	}
	public function pdf_p()
	{
        if(session()->get('id')>0) {
		$model = new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$kui['duar']=$model->filter_ff('brg_keluar',$awal,$akhir);
		$dompdf = new\Dompdf\Dompdf();
		$dompdf->loadHtml(view('c_b',$kui));
		$dompdf->setPaper('A4','landscape');
		$dompdf->render();
		$dompdf->stream('my.pdf', array('Attachment'=>0));
    }else{
        return redirect()->to('/Home');
    }
	}
	public function excel_barang()
	{
        if(session()->get('id')>0) {
		$model=new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$data=$model->filter2('barang',$awal,$akhir);
		$spreadsheet=new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Nama Obat')
		->setCellValue('B1', 'Kode Obat')
		->setCellValue('C1', 'Harga')
		->setCellValue('D1', 'Stock')
		->setCellValue('E1', 'Tangga Tersedia');

		$column=2;

		foreach($data as $data){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'. $column, $data->nama_brg)
			->setCellValue('B'. $column, $data->kode_brg)
			->setCellValue('C'. $column, $data->harga)
			->setCellValue('D'. $column, $data->stock)
			->setCellValue('E'. $column, $data->tanggal);
			$column++;
		}

		$writer = new XLsx($spreadsheet);
		$fileName = 'Data Laporan Obat';

      
		header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition:attachment;filename='.$fileName.'.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
    }else{
        return redirect()->to('/Home');
    }

	}
	public function excel_bm()
	{
        if(session()->get('id')>0) {
		$model=new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$data=$model->filter_ff('brg_masuk',$awal,$akhir);
        

		$spreadsheet=new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)

		->setCellValue('A1', 'Nama Obat')
		->setCellValue('B1', 'Jumlah')
		->setCellValue('C1', 'Tanggal');
		

		$column=2;

		foreach($data as $data){
			$spreadsheet->setActiveSheetIndex(0)

			->setCellValue('A'. $column, $data->nama_brg)
			->setCellValue('B'. $column, $data->jumlah)
			->setCellValue('C'. $column, $data->tanggall);
			$column++;
		}

		$writer = new XLsx($spreadsheet);
		$fileName = 'Data Laporan Obat Masuk';


		header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition:attachment;filename='.$fileName.'.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
    }else{
        return redirect()->to('/Home');
    }

	}
	public function excel_p()
	{
        if(session()->get('id')>0) {
		$model=new M_model();
		$awal= $this->request->getPost('awal');
		$akhir= $this->request->getPost('akhir');
		$data=$model->filter_ff('brg_keluar',$awal,$akhir);
        // echo view('excel_print_pg', $data);

		$spreadsheet=new Spreadsheet();

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'Nama Obat')
		->setCellValue('B1', 'Jumlah')
		->setCellValue('C1', 'Tanggal');

		$column=2;

		foreach($data as $data){
			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'. $column, $data->nama_brg)
			->setCellValue('B'. $column, $data->jumlah)
			->setCellValue('C'. $column, $data->tanggall);
			$column++;
		}

		$writer = new XLsx($spreadsheet);
		$fileName = 'Data Laporan Obat Keluar';
		header('Content-type:vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition:attachment;filename='.$fileName.'.xls');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
    }else{
        return redirect()->to('/Home');
    }

	}
    public function logout()
	{
		session()->destroy();
		return redirect()->to('/Home');
	}
    public function aksi_login()
	{
		$u=$this->request->getPost('username');
		$p=$this->request->getPost('pswd');
		$model= new M_model();
		$data=array(
			'username'=>$u,
			'password'=>md5($p)

		);
		$cek=$model->getWhere2('user', $data);
		if ($cek>0) {
			session()->set('id', $cek['id_user']);
			session()->set('username', $cek['username']);
			session()->set('level', $cek['level']);
			return redirect()->to('/Home/dashboard');
		}else {
			return redirect()->to('/Home');
		}
	}
}