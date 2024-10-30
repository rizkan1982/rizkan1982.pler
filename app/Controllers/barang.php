<?php

namespace App\Controllers;
use App\Models\B_model;

class barang extends BaseController
{
public function index()
	{
		if(session()->get('id')>0) {
			$model=new B_model();
			$data['a'] = $model->tampil('barang');
            $data['title']= 'Obat';
            echo view('header');
			echo view('menuutama');
			echo view('barang/barang',$data);
			echo view('footer');
		}else{
			return redirect()->to('/Home');
		}

	}

    public function hapus($id)
    {
		if(session()->get('id')>0) {
        $model=new B_model();
        $model->deletee($id);
        return redirect()->to('barang');
	}else{
        return redirect()->to('/Home');
    }
    }

	public function tambah_barang()
	{
		if(session()->get('id')>0) {
		$model=new B_model();
			$data['a'] = $model->tampil('barang');
            $data['title']= 'Obat';
            echo view('header');
			echo view('menuutama');
			echo view('barang/tambah_barang', $data);
			echo view('footer');
		}else{
			return redirect()->to('/Home');
		}
	}

	public function aksi_tambah_barang()
	{
		if(session()->get('id')>0) {
		$a=$this->request->getPost('nama_brg');
		$b=$this->request->getPost('kode_brg');
		$c=$this->request->getPost('stock');
		$d=$this->request->getPost('harga');
        $e=$this->request->getPost('tanggal');

		$simpan=array(
			'nama_brg'=>$a,
			'kode_brg'=>$b,
			'stock'=>$c,
			'harga'=>$d,
            'tanggal'=>$e,
            'created_at'=>date('Y-m-d H:i:s')
		);
		$model=new B_model();
		$model->simpan('barang',$simpan);
		return redirect()->to('/barang/index');
	}else{
        return redirect()->to('/Home');
    }

	}
	public function edit_barang($id)
	{
		if(session()->get('id')>0) {
			$model=new B_model();
			$where=array('id_barang'=>$id);
			$data['jojo']=$model->getWhere('barang',$where);
            $data['title']= 'Obat';
            echo view('header');
			echo view('menuutama');
			echo  view('barang/edit_barang',$data);
			echo view('footer');
		}else{
			return redirect()->to('/Home');
		}

	}
	public function aksi_edit_barang()
	{
		if(session()->get('id')>0) {
		$id=$this->request->getPost('id');
		$a=$this->request->getPost('nama_brg');
		$b=$this->request->getPost('kode_brg');
		$c=$this->request->getPost('stock');
		$d=$this->request->getPost('harga');
        $e=$this->request->getPost('tanggal');

		$where=array('id_barang'=>$id);
		$simpan=array(
			'nama_brg'=>$a,
			'kode_brg'=>$b,
			'stock'=>$c,
			'harga'=>$d,
            'tanggal'=>$e,
            'updated_at'=>date('Y-m-d H:i:s')
		);
		$model=new B_model();
		$model->qedit('barang',$simpan, $where);
		return redirect()->to('/barang/index');
	}else{
        return redirect()->to('/Home');
    }

	}
}