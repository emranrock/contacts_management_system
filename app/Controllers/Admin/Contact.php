<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Contact as ModelsContact;
use App\Models\Group;

class Contact extends BaseController
{
    protected $contactModel;
    protected $db;
    public function __construct()
    {
        $this->contactModel = new ModelsContact();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        $data['contacts']= $this->contactModel->select('contacts.id,contacts.name,contacts.email,contacts.phone,groups.name as group_name')
        ->join('groups','groups.group_id=group','left outer')->findAll();
        $data["title"] = "Contacts : Manage";
        $data["page"] = "Manage";
        return view('admin/contacts/manage', $data);
    }

    public function add()
    {
        $groups = new Group();
        $data['groups'] = $groups->findAll();
        $data["title"] = "Contact : Add";
        $data["page"] = "Add";
        if ($this->request->is('post')) {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'phone' => 'required|regex_match[/^[0-9]{10}$/]',
                'group' => 'required',
            ];
            
            if ($this->validate($rules)) {
                $data = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'phone' => $this->request->getVar('phone'),
                    'group' => $this->request->getVar('group')
                ];
                $this->contactModel->save($data);
                $this->session->setFlashdata('message', 'Contact added Successfully');
                $this->session->setFlashdata('alert-class', 'success');
                return redirect()->to('admin/contacts/manage');
            }
            $data['validator'] = $this->validator->getErrors();
        }
        return view('admin/contacts/add', $data);
    }

    public function show($id)
    {
        $data['contact'] = $this->contactModel->select('contacts.name,contacts.email,contacts.phone,groups.name as group_name')->join('groups', 'group_id=group', 'contacts')->find($id);
        $data["title"] = "Contact : View";
        $data["page"] = "View contact";
        return view('admin/contacts/show', $data);
    }

    public function edit($id)
    {
        $data['contact'] = $this->contactModel->find($id);
        if ($this->request->is('put')) {
            extract($this->request->getRawInput());
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'phone' => 'required|regex_match[/^[0-9]{10}$/]',
                'group' => 'required',
            ];
            if ($this->validate($rules)) {
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'group' => $group
                ];
                $this->contactModel->update($id, $data);
                $this->session->setFlashdata('message', 'Contact updated Successfully');
                $this->session->setFlashdata('alert-class', 'success');
                return redirect()->to('admin/contacts/manage');
            } else {
                $data['validator'] = $this->validator->getErrors();
            }
        }
        $groups = new Group();
        $data['groups'] = $groups->findAll();
        $data["title"] = "Contact : Edit";
        $data["page"] = "Edit Contact";
        return view('admin/contacts/edit', $data);
    }

    public function delete($id)
    {

        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $result = $this->contactModel->delete($item_id);
            if ($result) {
                $data = 'Delete Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            return $this->response->setJSON($data);
        }
    }
}
