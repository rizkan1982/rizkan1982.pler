<?php

namespace App\Controllers;
use App\Models\M_karyawan;

class Karyawan extends BaseController
{
    public function index()
    {
        if(session()->get('level')==1){
            $model = new M_karyawan();
            $data['jojo']=$model->tampil('karyawan');
            $data['title']= 'Karyawan';
            echo view('header');
            echo view('menuutama');
            echo view('karyawan/view', $data);
            echo view('footer');
        }else{

            return redirect()->to('/home');
        }
    }

    public function create()
    {
        if(session()->get('level')==1){
            $model = new M_karyawan();
            $data['jojo']=$model->tampil('karyawan');
            $data['title']='Karyawan';
            echo view('header');
            echo view('menuutama');
            echo view('karyawan/create', $data); 
            echo view('footer');
        }else{

            return redirect()->to('/home');
        }
    }

    public function aksi_create()
    { 
        if(session()->get('level')==1){
            $a= $this->request->getPost('username');
            $b= $this->request->getPost('password');
            $c= $this->request->getPost('email');
            $d= $this->request->getPost('nik');
            $e= $this->request->getPost('nama');
            $f= $this->request->getPost('alamat');
            $g= $this->request->getPost('notel');
            $h= $this->request->getPost('jk');
            $i= $this->request->getPost('tempat_lahir');
            $j= $this->request->getPost('tanggal_lahir');
            date_default_timezone_set('Asia/Jakarta');

            $foto= $this->request->getFile('foto');
            if($foto && $foto->isValid() && ! $foto->hasMoved())
            {
                $imageName = $foto->getName();
                $foto->move('images/',$imageName);
            }else{
                $imageName='default.png';
            }

        //Yang ditambah ke user
            $data1=array(
                'username'=>$a,
                'password'=>md5($b),
                'email'=>$c,
                'level'=>'2',
                'foto'=>$imageName,
                'created_at'=>date('Y-m-d H:i:s')
            );
            $model=new M_karyawan();
            $model->simpan('user', $data1);
            $where=array('username'=>$a);

            $m=$model->getWhere2('user', $where);
            $iduser = $m['id_user'];

        //Yang ditambah ke karyawan
            $data2=array(
                'nik'=>$d,
                'nama'=>$e,
                'alamat'=>$f,
                'no_telepon'=>$g,
                'jenis_kelamin'=>$h,
                'tempat_lahir'=>$i,
                'tanggal_lahir'=>$j,
                'user'=>$iduser,
                'created_at'=>date('Y-m-d H:i:s')
            );
            $model->simpan('karyawan', $data2);
            echo view('header');
            echo view('menuutama');
            echo view('footer');
            return redirect()->to('karyawan');
        }else{

            return redirect()->to('/home');
        }
    }

    public function edit($id)
    { 
        if(session()->get('level')==1){
            $model=new M_karyawan();
            $where=array('user'=>$id);
            $where2=array('id_user'=>$id);
            $data['jojo']=$model->getWhere('karyawan',$where);
            $data['dar']=$model->getWhere('user',$where2);
            $data['title']='Karyawan';
            echo view('header');
            echo view('menuutama');
            echo view('karyawan/edit',$data);
            echo view('footer');  
        }else{

            return redirect()->to('/home');
        }
    }

    public function aksi_edit()
    { 
        if(session()->get('level')==1){
            $a= $this->request->getPost('username');
            $c= $this->request->getPost('email');
            $d= $this->request->getPost('nik');
            $e= $this->request->getPost('nama');
            $f= $this->request->getPost('alamat');
            $g= $this->request->getPost('notel');
            $h= $this->request->getPost('jk');
            $i= $this->request->getPost('tempat_lahir');
            $j= $this->request->getPost('tanggal_lahir');
            $id= $this->request->getPost('id');
            $id2= $this->request->getPost('id2');
            date_default_timezone_set('Asia/Jakarta');

            $foto= $this->request->getFile('foto');
            if (!empty($foto->getName())) {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    if (file_exists("images/" . $id)) {
                        unlink("images/" . $id);
                    }
                    $imageName = $foto->getName();
                    $foto->move('images/', $imageName);
                }
            } else {
                $imageName = $this->request->getPost('old_foto');
            }

        //Yang ditambah ke user
            $where=array('id_user'=>$id);
            $data1=array(
                'username'=>$a,
                'email'=>$c,
                'foto'=>$imageName,
                'updated_at'=>date('Y-m-d H:i:s')
            );
            $model=new M_karyawan();
            $model->qedit('user', $data1, $where);

        //Yang ditambah ke karyawan
            $where2=array('user'=>$id2);
            $data2=array(
                'nik'=>$d,
                'nama'=>$e,
                'alamat'=>$f,
                'no_telepon'=>$g,
                'jenis_kelamin'=>$h,
                'tempat_lahir'=>$i,
                'tanggal_lahir'=>$j,
                'updated_at'=>date('Y-m-d H:i:s')
            );

            $model->qedit('karyawan', $data2, $where2);
            return redirect()->to('karyawan');
        }else{

            return redirect()->to('/home');
        }
    }

    public function hapus($id)
    {
        if(session()->get('level')==1){
           $model=new M_karyawan();
           $where=array('user'=>$id);
           $where2=array('id_user'=>$id);

           $data=array(
            'updated_at'=>date('Y-m-d H:i:s'),
            'deleted_at'=>date('Y-m-d H:i:s')
        );

           $model->qedit('karyawan', $data, $where);
           $model->qedit('user', $data, $where2);
           return redirect()->to('karyawan');
       }else{

        return redirect()->to('/home');
    }
}
}