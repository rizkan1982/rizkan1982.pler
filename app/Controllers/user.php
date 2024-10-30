<?php

namespace App\Controllers;
use App\Models\M_user;

class User extends BaseController
{
    public function index()
    {
        if(session()->get('level')==1){
        $model = new M_user();
        $on = 'user.level=level.id_level';
        $data['jojo']=$model->join2('user', 'level', $on);
        $data['title']= 'User';
        echo view('header');
        echo view('menuutama');
        echo view('user/view', $data);
        echo view('footer');
    }else{

        return redirect()->to('/home');
    }
    }

    public function reset_password($id)
    {
        if(session()->get('level')==1){
        $model=new M_user();
        $where=array('id_user'=>$id);
        $user=array('password'=>md5('12345'));
        $model->qedit('user', $user, $where);

        echo view('header');
        echo view('menuutama');
        echo view('footer');

        return redirect()->to('user');  
    }else{

        return redirect()->to('/home');
    } 
    }
}
