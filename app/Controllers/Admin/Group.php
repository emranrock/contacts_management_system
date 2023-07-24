<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\Contact;
use App\Models\Group as ModelsGroup;


class Group extends BaseController
{
    protected $groupModel = '';

    public function __construct()
    {
        $this->groupModel =  new ModelsGroup();
    }
    public function index()
    {
        
        $data['groups'] = $this->groupModel->getGroups();
        $data["title"] = "Group : Manage";
        $data["page"] = "Manage";
        return view('admin/groups/manage', $data);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[3]',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $this->request->getVar('name')
                ];
                $this->groupModel->save($data);
                $this->session->setFlashdata('message','Group added Successfully');
                $this->session->setFlashdata('alert-class','success');
                return redirect()->to('admin/groups/manage');
            } else {
                $data['validator'] = $this->validator->getErrors();
            }
        }
        $data["title"] = "Group : Add";
        $data["page"] = "Add New Group";
        return view('admin/groups/add', $data);
    }

    public function show($id)
    {

        $data['group']= $this->groupModel->find($id);
        $data["title"] = "Group : View";
        $data["page"] = "View Group";
        return view('admin/groups/show', $data);
    }

    public function edit($id)
    {
        $data['group']= $this->groupModel->find($id);
        if ($this->request->is('put')) {
            extract($this->request->getRawInput());
            $rules = [
                'name' => 'required|min_length[3]',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $name
                ];
                $this->groupModel->update($id,$data);
                $this->session->setFlashdata('message','Group updated Successfully');
                $this->session->setFlashdata('alert-class','success');
                return redirect()->to('admin/groups/manage');
            } else {
                $data['validator'] = $this->validator->getErrors();
            }
        }
        
        $data["title"] = "Group : Edit";
        $data["page"] = "Edit Group";
        return view('admin/groups/edit', $data);
    }

    public function delete($id){

        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $result = $this->groupModel->delete($item_id);
            if ($result) {
                $data ='Delete Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            return $this->response->setJSON($data);
        }
    }
}
