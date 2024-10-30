<?php

namespace App\Controllers;
use App\Models\M_level;

class Level extends BaseController
{
    public function index()
    {
        if(session()->get('level')==1){
        $model = new M_level();
        $data['jojo']=$model->tampil('level');
        $data['title']= 'Level';
        echo view('header');
        echo view('menuutama');
        echo view('level/view', $data);
        echo view('footer');
    }else{

        return redirect()->to('/home');
    }
    }
    

    public function create()
    {
        if(session()->get('level')==1){
        $model = new M_level();
        $data['jojo']=$model->tampil('level');
        $data['title']='Level';
        echo view('header');
        echo view('menuutama');
        echo view('level/create', $data); 
        echo view('footer');
    }else{

        return redirect()->to('/home');
    }
    }

    public function aksi_create()
    { 
        if(session()->get('level')==1){
        $a= $this->request->getPost('nama_level');
        $b= $this->request->getPost('keterangan');
        date_default_timezone_set('Asia/Jakarta');

        //Yang ditambah ke user
        $data1=array(
            'nama_level'=>$a,
            'keterangan'=>$b,
            'created_at'=>date('Y-m-d H:i:s')
        );
        $model=new M_level();
        $model->simpan('level', $data1);
        echo view('header');
        echo view('menuutama');
        echo view('footer');
        return redirect()->to('level');
    }else{

        return redirect()->to('/home');
    }
    }

    public function edit($id)
    {
        if(session()->get('level')==1){
        $model = new M_level();
        $where=array('id_level'=>$id);
        $data['jojo']=$model->tampil('level');
        $data['dar']=$model->getWhere('level',$where);
        $data['title']='Level';
        echo view('header');
        echo view('menuutama');
        echo view('level/edit', $data); 
        echo view('footer');
    }else{

        return redirect()->to('/home');
    }
    }

    public function aksi_edit()
    { 
        if(session()->get('level')==1){
        $a= $this->request->getPost('nama_level');
        $b= $this->request->getPost('keterangan');
        $id = $this->request->getPost('id');
        date_default_timezone_set('Asia/Jakarta');

        //Yang ditambah ke user
        $data1=array(
            'nama_level'=>$a,
            'keterangan'=>$b,
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $where=array('id_level'=>$id);
        $model=new M_level();
        $model->qedit('level', $data1, $where);
        echo view('header');
        echo view('menuutama');
        echo view('footer');
        return redirect()->to('level');
    }else{

        return redirect()->to('/home');
    }
    }

    public function hapus($id)
    {
        if(session()->get('level')==1){
        $model=new M_level();
        $model->deletee($id);
        return redirect()->to('level');
    }else{

        return redirect()->to('/home');
    }
    }
}
