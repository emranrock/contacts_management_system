<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Store;
use App\Models\PreBookingItem;
use App\Models\Rack;
use App\Models\Barcode;
use App\Models\Role;

class Ajax extends BaseController
{

    /** Notifications */
   
    /** stores */
    public function saveStore()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getPost());
            $info = array(
                'store_name' => $store_name,
                'store_url' => $api_url,
                'token' => $api_token,
                'status' => $status,
            );

            $store = new Store();
            $result = $store->insert($info);
            if ($result === true) {
                $data = "Added Successfully";
            } else {
                $data = "Please Fill Field";
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }

    public function fetchEdits($id)
    {

        if ($this->request->isAJAX()) {
            $store = new Store();
            $response = $store->asObject()->find($id);
            if (!empty($response)) {
                $data = '';
                if ($response->status == "yes") {
                    $check = "checked";
                } else if ($response->status == "no") {
                    $check = "checked";
                } else {
                    $check = "";
                }
                $token_input = !empty($response->token) ? '***********' . substr($response->token, -8) : "";
                $data .= '<input type="hidden" name="id" id="store_id" value="' . $id . '" />
                <div class="row">
                    <div class="form-group ">
                    <label class="col-md-2 col-form-label" for="store_name_edit">Store Name:-</label>
                    <div class="col-md-10">
                        <input type="text" name="store_name" id="store_name_edit" class="form-control" placeholder="Name" value="' . $response->store_name . '">
                        <div class="alert" id="error"></div>
                    </div>
                    </div>
                    <div class="form-group ">
                    <label class="col-md-2 col-form-label" for="api_url_edit">Api Url:-</label>
                    <div class="col-md-10">
                        <input type="text" name="api_url" id="api_url_edit" class="form-control" placeholder="Url" value="' . $response->store_url . '">
                        <div class="alert" id="error"></div>
                    </div>
                    </div>
                    <div class="form-group ">
                    <label class="col-md-2 col-form-label">Token:-</label>
                    <div class="col-md-10">
                        <input type="text" name="api_token" id="api_token" class="form-control" placeholder="Token" value="' . $token_input . '">
                        <div class="alert" id="error"></div>
                    </div>
                    </div>
                    <div class="form-group ">
                    <label class="col-md-2 col-form-label">Active</label>
                    <div class="col-md-10">
                        <label for="enable">
                        Yes:-
                        <input type="radio" name="status" id="enable" value="yes" ' . $check . '>
                        </label>
                        <label for="disable">
                        No:-
                        <input type="radio" name="status" id="disable" value="no" ' . $check . '>
                        </label>
                    </div>
                    </div>
                </div>';
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            unset($data);
            ob_end_flush();
        }
        exit;
    }
    public function store_update()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            if ("*****" == substr($api_token, 0, 5)) {
                $info = array(
                    'store_name' => $store_name,
                    'store_url' => $api_url,
                    'status' => $status,
                );
            } else {
                $info = array(
                    'store_name' => $store_name,
                    'store_url' => $api_url,
                    'token' => $api_token,
                    'status' => $status,
                );
            }
            $store = new Store();
            $result = $store->update($id, $info);
            if ($result === true) {
                $data = "Record Updated Successfully";
            } else {
                $data = $store->errors();
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }

    public function delete_Store()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $store = new Store();
            $result = $store->delete($classId);
            if ($result === true) {
                $data = "Record Deleted !";
            } else {
                $data = $store->errors();
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    /** end store */

    /** pre booking */
    public function saveitem()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getPost());
            if (!empty($item_name)) {
                $info = array(
                    'item' => $item_name,
                    'status' => $status,
                    'created_at' => time(),
                    'updated_at' => 0,
                );
                $preBookedItem = new PreBookingItem();
                $data = $preBookedItem->insert($info);
            } else {
                $data = 'Please Fill Stores Field';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function updateitem()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            if (!empty($item_name)) {
                $info = array(
                    'item' => $item_name,
                    'status' => $status,
                );
                $preBookedItem = new PreBookingItem();
                $data = $preBookedItem->update($id, $info);
            } else {
                $data = 'Please Fill Items Field';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }

    public function deleteitem()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $preBookedItem = new PreBookingItem();
            $result = $preBookedItem->delete($item_id);
            if ($result === true) {
                $data = "Record Deleted !";
            } else {
                $data = 'Something Went Wrong !';
            }
        }
        ob_start('ob_gzhandler');
        echo json_encode($data);
        ob_end_flush();
    }
    /** end pre booking */

    /** ranks */
    public function add_rack()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getPost());
            if (!empty($rank_name)) {
                $info = array(
                    'title' => $rank_name,
                );
                $rack = new Rack();
                $data = $rack->insert($info);
            }else{
                $data = 'Please Fill Field';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function update_rack()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $info = array(
                'title' => $title_editable,
            );
            $rack = new Rack();
            $result = $rack->update($id,$info);
            if ($result) {
                $data ='Updated Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }

    public function delete_rack()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $rack = new Rack();
            $result = $rack->delete($item_id);
            if ($result) {
                $data ='Delete Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    /** end rank */

    /** barcode */
    public function add_barcode()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getPost());
            if (!empty($rack)) {
                $info = array(
                    'rack_id' => $rack,
                    'barcode' => $barcode,
                );
                $new_barcode = new Barcode();
                $result = $new_barcode->insert($info);
                if ($result) {
                    $data =  'Barcode Added successfully';
                } else {
                    $data = 'Barcode Insertion failed';
                }
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function update_barcode()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $info = array(
                'rack_id' => $rack_editable,
                'barcode' => $barcode_editable,
            );
            $new_barcode = new Barcode();
            $result = $new_barcode->update($id,$info);
            if ($result) {
                $data =  'Barcode Update successfully';
            } else {
                $data = 'Barcode Update failed';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
        
    }

    public function delete_barcode()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $new_barcode = new Barcode();
            $result = $new_barcode->delete($item_id);
            if ($result) {
                $data ='Deleted Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
        
    }
    /** end barcode */

    /** rows */
    public function saveRow()
    {
        if (isset($_POST['title'])) {
            extract($_POST);
            if (!empty($title)) {
                $info = array(
                    'title' => $title,
                    'rank_id' => $rank,
                    'item_capacity' => (int)$capacity,
                );

                $data = $this->global_model->insert("rows", $info);
            } else {
                $data = 'Please Fill Field';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function updateRow()
    {
        if (isset($_POST['id'])) {
            extract($_POST);
            $new_id = decode_url($id);
            $info = array(
                'title' => $title,
                'rank_id' => $rank_id,
                'item_capacity' => $capacity,
            );
            $this->load->model('global_model');
            $qry = $this->global_model->update("rows", $info, 'id', $new_id);
            if ($qry > 0) {
                $data = $qry;
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function deleteRow()
    {
        if (isset($_POST['id'])) {
            extract($_POST);

            $new_id = decode_url($id);
            $qry = $this->global_model->delete("rows", 'id', $new_id);
            if ($qry > 0) {
                $data = $qry;
            } else {
                $data = 'Something Went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    /** end rows */

    /** assign product to rank and row */

    public function assign_products()
    {
        $this->load->model('global_model');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            extract($_POST);
            if (!empty($id) && !empty($rank) && !empty($row)) {
                $id_arr = explode(",", $id);
                foreach ($id_arr as $p_id) {
                    $db_data = array(
                        'row_id' => $row,
                        'rank_id' => $rank,
                        'product_id' => $p_id,
                        'status' => 'occupied',
                    );
                    $data =  $this->global_model->insert("assign_product", $db_data);
                }
            } else {
                $data = 'Please Fill Field';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }


    /** Roles */
    public function saveRole()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getPost());
            if (!empty($role_name)) {
                $info = array(
                    'role' => $role_name
                );
                $new_role = new Role();
                $result = $new_role->insert($info);
                if ($result) {
                    $data =  'Role Added Successfully';
                } else {
                    $data = 'Role Insertion failed';
                }
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    public function updateRole()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $info = array(
                'role' => $title_editable
            );
            $new_role = new Role();
            $result = $new_role->update($id,$info);
            if ($result) {
                $data =  'Role Updated Successfully';
            } else {
                $data = 'Role Updating failed';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }

    public function deleteRole()
    {
        if ($this->request->isAJAX()) {
            extract($this->request->getRawInput());
            $new_role = new Role();
            $result = $new_role->delete($item_id);
            if ($result) {
                $data ='Deleted Successfully';
            } else {
                $data = 'Something went Wrong !';
            }
            ob_start('ob_gzhandler');
            echo json_encode($data);
            ob_end_flush();
        }
    }
    /** end Roles */
}
