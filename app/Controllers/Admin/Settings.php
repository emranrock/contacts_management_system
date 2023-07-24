<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Store;
use App\Models\PreBookingItem;
use App\Models\rack;
use App\Models\Barcode;
use App\Models\Option;
use App\Models\Role;
use CodeIgniter\Files\File;

class Settings extends BaseController
{
    /**
     * Index Page for this controller.
     */
    public function Index()
    {
        $Store = new Store();
        $data['store_list'] = $Store->asObject()->findAll();
        $data['pageTitle'] = 'Team-Focus : Stores';
        return view('admin/settings/stores', $data);
    }

    public function general_setting()
    {
        $option = new Option();
        if ($this->request->getMethod() == "post") {
            unset($_POST['submit']);
            $encoded_arr = json_encode($this->request->getPost());
            $data_ins = array(
                'option_name' => 'site_setting',
                'option_value' => $encoded_arr,
            );
            $result = $option->insert($data_ins);
            if ($result) {
                $this->session->setFlashData('message', 'Site Settings Added successfully');
            } else {
                $this->session->setFlashData('message', 'Site Settings Insertion failed');
            }
            return redirect()->to('admin/settings/general_setting');
        }

        $data['site_info'] = $option->asObject()->where('option_name', 'site_setting')->first();
        $data['pageTitle'] = 'Team-Focus : General Settings';
        return view('admin/settings/general_setting', $data);
    }

    public function pre_booking_items()
    {
        $preBookings = new PreBookingItem();
        $data['items'] = $preBookings->asObject()->findAll();
        $data['pageTitle'] = 'Team-Focus : Pre Booking Items List';
        return view('admin/settings/pre_booking', $data);
    }

    public function racks()
    {
        $racks = new rack();
        $data['items'] = $racks->asObject()->findAll();
        $data['pageTitle'] = 'Team-Focus : Manage Rack';
        return view('admin/settings/racks', $data);
    }

    public function bulk()
    {

        if (isset($_POST['importSubmit'])) {
            $validationRule = [
                'file' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[file]',
                        'mime_in[file,csv]',
                        'max_size[file,100]',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                $data = ['errors' => $this->validator->getErrors()];
                return view('admin/settings/bulk', $data);
            }
            $file = $this->request->getFile('file');

            if (!$file->hasMoved()) {
                $filepath = WRITEPATH . 'uploads/' . $file->store();
                $data = ['uploaded_fileinfo' => new File($filepath)];
                /* Load CSV reader library */
                $csvReader = \Config\Services::csvReader(false);
                /* Parse data from CSV file */
                $csvData = $csvReader->parse_csv($file['tmp_name']);
                $filter_data = array();
                foreach ($csvData as $key => $value) {
                    /*$filter_data[] =  array_values($value);*/
                    foreach ($value as $kk => $vv) {
                        if ($key == 1) {
                            $filter_data[] = $kk;
                        }
                        $filter_data[] = $vv;
                    }
                }

                foreach ($filter_data as $kk => $vv) {
                    $rack_name = "";
                    $rack_val = "";
                    if (strpos($vv, "RACK") !== false) {
                        $rack_name = $vv;
                    } else {
                        $rack_val = $vv;
                    }
                    if (!empty($rack_name)) {
                        $id = add_and_retrieve_rack($rack_name);
                    }
                    if (!empty($rack_val)) {
                        $data_ins[] = array(
                            'rack_id' => $id,
                            'barcode' => $rack_val,
                        );
                    }
                }
                $barcode = new Barcode();
                $result = $barcode->insert_batch($data_ins);
                if ($result) {
                    $this->session->setFlashData('message', 'Barcode Added successfully');
                } else {
                    $this->session->setFlashData('message', 'Barcode Insertion failed');
                }
                return redirect()->to('admin/settings/bulk');
            }
        }
        $data['pageTitle'] = 'Team-Focus : General Upload';
        $data['errors'] = [];
        return view('admin/settings/bulk', $data);
    }

    public function file_check($str)
    {
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = $this->get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'csv') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->session->setFlashData('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        } else {
            $this->session->setFlashData('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

    public function barcodeList()
    {

        $barcode = new Barcode();
        $data['barcodes'] = $barcode->asObject()->join("racks", "racks.id = barcodes.rack_id")->findAll();
        $racks = new \App\Models\Rack();
        $data['racks'] = $racks->asObject()->findAll();
        $data['pageTitle'] = 'Team-Focus : Manage Barcode';
        return view('admin/settings/barcode_list', $data);
    }

    public function add_tags()
    {

        $is_option = get_option('tags');
        if (isset($_POST['add_tags'])) {
            $new_arr = [];
            foreach ($_POST as $key => $value) {
                if ($key == "tags") {
                    foreach ($value as $vv) {
                        if (!empty($vv)) {
                            $new_arr[] = $vv;
                        }
                    }
                }
            }
            $encoded_arr = json_encode($new_arr);

            $data_ins = array(
                'option_name' => 'tags',
                'option_value' => $encoded_arr,
            );
            if ($is_option == false) {
                $result = $this->global_model->insert('options', $data_ins);
            } else {
                $result = $this->global_model->update('options', $data_ins, 'option_name', 'tags');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Tag Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Tag Insertion failed');
            }
            redirect()->to('admin/settings/add_tags');
        }
        if ($is_option == false) {
            $data['tags'] = null;
        } else {
            $data['tags'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Tags';
        $data['middle'] = 'settings/add_tags';
        return view('admin/template', $data);
    }
    public function add_options()
    {

        $is_option = get_option('front_option');
        if (isset($_POST['add_option'])) {
            $new_arr = [];
            foreach ($_POST as $key => $value) {
                if ($key == "tags") {
                    foreach ($value as $vv) {
                        if (!empty($vv)) {
                            $new_arr[] = $vv;
                        }
                    }
                }
            }
            $encoded_arr = json_encode($new_arr);

            $data_ins = array(
                'option_name' => 'tags',
                'option_value' => $encoded_arr,
            );
            if ($is_option == false) {
                $result = $this->global_model->insert('options', $data_ins);
            } else {
                $result = $this->global_model->update('options', $data_ins, 'option_name', 'tags');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Tag Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Tag Insertion failed');
            }
            redirect('admin/settings/add_tags');
        }
        if ($is_option == false) {
            $data['tags'] = null;
        } else {
            $data['tags'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Tags';
        $data['middle'] = 'settings/add_tags';
        $this->load->view('admin/template', $data);
    }
    public function roles()
    {
        $role = new Role();
        $data['items'] = $role->asObject()->where('role !=', 'System Administrator')->findAll();
        $data['pageTitle'] = 'Team-Focus : Roles';
        return view('admin/settings/roles', $data);
    }
    
    public function add_payment_methods()
    {

        $is_option = get_option('payment_methods');
        if (isset($_POST['add_methods'])) {
            $fields = array();
            foreach ($_POST['payment_methods'] as $k => $v) {
                if (!empty($v)) {
                    $fields[] = $v;
                }
            }
            $encoded_arr = json_encode($fields);
            $data_ins = array(
                'option_name' => 'payment_methods',
                'option_values' => $encoded_arr,
            );
            if ($is_option == false) {
                $result = $this->global_model->insert('front_options', $data_ins);
            } else {
                $result = $this->global_model->update('front_options', $data_ins, 'option_name', 'payment_methods');
            }
            if ($result > 0) {
                $this->session->set_flashdata('success_msg', 'Added successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Insertion failed');
            }
            redirect()->to('admin/settings/add_payment_methods');
        }
        if ($is_option == false) {
            $data['payment_methods'] = null;
        } else {
            $data['payment_methods'] = $is_option;
        }
        $data['pageTitle'] = 'Team-Focus : Add Payment Methods';
        return view('admin/settings/add_payments_methods', $data);
    }
}
