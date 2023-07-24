<?php 
namespace App\Controllers\Admin;
use App\Controllers\BaseController;


class Site_setting extends BaseController
{
   
    public function index()
    {
        $data['pageTitle'] = 'Team-Focus : Add Site Settings';
        if (isset($_POST['submit'])) {
            // var_dump($_POST);exit;

            $this->form_validation->set_rules('site_name', 'Site Title', 'required');
            $this->form_validation->set_rules('site_description', 'Site Description', 'required');
            $this->form_validation->set_rules('site_contact_number', 'Site Contact Number', 'required');
            $this->form_validation->set_rules('site_email', 'Site Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                extract($_POST);
                $arr = array();
                foreach ($social_links as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = $v;
                    }
                }
                $obj = json_encode($arr);
                //var_dump($obj);exit;
                $userInfo = array(
                    //'sid' => $sid,
                    'site_name' => $site_name,
                    'site_description' => $site_description,
                    'site_contact_number' => $site_contact_number,
                    'site_email' => $site_email,
                    'address' => $address,
                    'about_us' => $abouts,
                    'social_links' => $obj,
                );

                $this->load->model('global_model');

                $result = $this->global_model->insert('site_setting', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'New Site created successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'Site creation failed');
                }
                redirect('admin/site_setting');
            }
        } else {
            $data['middle'] = 'site/add';
            $this->load->view('admin/template', $data);
        }
    }

    public function show()
    {
        $data['pageTitle'] = 'Team-Focus : Manage Site';
         // Turn caching on 
         $this->db->cache_on();
        $qry = $this->global_model->customeQuery('select * from site_setting');
         // Turn caching off 
         $this->db->cache_off();
        $data['userRecords'] = $qry->result();
        $data['middle'] = 'site/manage';
        $this->load->view('admin/template', $data);
    }

    public function edit($id = null)
    {
        $data['pageTitle'] = 'Team-Focus : Edit Site';
        extract($_POST);
        $new_id = decode_url($id);
        if (isset($_POST['update'])) {
            //var_dump();exit;
            $this->form_validation->set_rules('site_name', 'Site Title', 'required');
            $this->form_validation->set_rules('site_description', 'Site Description', 'required');
            $this->form_validation->set_rules('site_contact_number', 'Site Contact Number', 'required');
            $this->form_validation->set_rules('site_email', 'Site Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->edit();
            } else {
                $arr = array();
                foreach ($social_links as $key => $value) {
                    foreach ($value as $k => $v) {
                        $arr[$k] = $v;
                    }
                }
                $obj = json_encode($arr);
                $post_id = decode_url($id);
                $userInfo = array(
                    //'sid' => $sid,
                    'site_name' => $site_name,
                    'site_description' => $site_description,
                    'site_contact_number' => $site_contact_number,
                    'site_email' => $site_email,
                    'address' => $address,
                    'about_us' => $abouts,
                    'social_links' => $obj,
                );
                //var_dump($new_id);exit;
                $result = $this->global_model->update('site_setting', $userInfo, 'site_id', $post_id);
                //var_dump($result);exit;
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Updated successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'Site Updation failed');
                }
                redirect('admin/site_setting/show');
            }
        } else {
            $qry = $this->global_model->customeQuery("select * from site_setting where site_id='$new_id'");
            $data['records'] = $qry->result();
            $data['middle'] = 'site/edit';
            $this->load->view('admin/template', $data);
        }
    }


    public function delete()
    {
        extract($_POST);
        $new_id = decode_url($id);
        $result = $this->global_model->delete('site_setting', 'site_id', $new_id);
        if ($result > 0) {
            echo true;
        } else {
            echo false;
        }
    }

    // home items settings

    public function home_page()
    {
        if (isset($_POST['home_page_settings'])) {
            extract($_POST);
            //var_dump($option);exit;
            $new_arr = array();
            foreach ($option as $key => $value) {
                //var_dump($key);exit;
                foreach ($value as $k => $v) {
                    //var_dump($v);exit;
                    $new_arr[$key][$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            //var_dump($id);exit;
            $userInfo = array(
                //'sid' => $sid,
                'options' => $obj,
            );
            $did = decode_url($id);
            if ($did > 0) {
                $result = $this->global_model->update('site_options', $userInfo, 'option_id', $did);
                //var_dump('site_options',$userInfo,'option_id',$did);exit;
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Options Updation successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'Site Option Updation Failed');
                }
            } else {
                $result = $this->global_model->insert('site_options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Site Options Created successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'Site Option Creation Failed');
                }
            }

            redirect('admin/site_setting/home_page');
        } else {
            $res = $this->global_model->customeQuery('select option_id,options from site_options');
            if (!empty($res->row()->option_id)) {
                $data['ids'] = $res->row()->option_id;
                $data['options'] = $res->row()->options;
            } else {
                $data['ids'] = 0;
            }
            $data['pageTitle'] = 'Home Page Setting';
            $data['middle'] = 'site/homepage';
            $this->load->view('admin/template', $data);
        }
    }


    // about items settings

    public function about_page()
    {
        if (isset($_POST['about_page_settings'])) {
            extract($_POST);
            //var_dump($option);exit;
            $new_arr = array();
            foreach ($option as $key => $value) {
                foreach ($value as $k => $v) {
                    //var_dump($v);exit;
                    $new_arr[$k] = $v;
                }
            }
            $obj = json_encode($new_arr);
            //var_dump($id);exit;
            $userInfo = array(
                //'sid' => $sid,
                'options' => $obj,
            );
            $did = decode_url($id);
            if ($did > 0) {
                $result = $this->global_model->update('site_options', $userInfo, 'option_id', $did);
                //var_dump('site_options',$userInfo,'option_id',$did);exit;
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'about Options Updation successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'about Option Updation Failed');
                }
            } else {
                $result = $this->global_model->insert('site_options', $userInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'about Options Created successfully');
                    //var_dump($result);exit;
                } else {
                    $this->session->set_flashdata('error', 'about Option Creation Failed');
                }
            }

            redirect('admin/site_setting/about_page');
        } else {
            $res = $this->global_model->customeQuery('select option_id,options from site_options');
            if (!empty($res->row()->option_id)) {
                $data['ids'] = $res->row()->option_id;
                $data['options'] = $res->row()->options;
            } else {
                $data['ids'] = 0;
            }
            $data['pageTitle'] = 'About Page Setting';
            $data['middle'] = 'site/aboutpage';
            $this->load->view('admin/template', $data);
        }
    }
}
