<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;


class Login extends BaseController
{

    /**
     * Index Page for this controller.
     */
    public function Index()
    {
        
        $isLoggedIn = $this->session->has('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            return view('admin/login', []);
        }else{
           return redirect()->to('admin/home');
        }
    }



    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        if (!$this->validate(
            [
                'email' => "required",
                'password'  => 'required',
            ]
        )) {
            return view('admin/login', ['errors' => $this->validator->getErrors()]);
        }
        $userModel = new User();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->join('roles','roleId','role_id')->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $sessionArray = array(
                    'userId' => $data['id'],
                    'role' => $data['roleId'],
                    'roleText' => $data['role'],
                    'name' => $data['full_name'],
                    'isLoggedIn' => TRUE
                );
                $this->session->set($sessionArray);
                return redirect()->to('admin');
            }else{
                $this->session->setFlashdata('msg', 'Password is incorrect.');
            }
        } else {
            $this->session->setFlashdata('error', 'Email or password mismatch');
        }
        redirect('admin/login');
    }

    public function loginAuth($email,$password){

    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        return view('admin/forgotPassword');
    }

    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        $this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            return $this->forgotPassword();
        } else {
            $email = $this->request->getVar('login_email');
            if ($this->login_model->checkEmailExist($email)) {
                $encoded_email = urlencode($email);
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum', 15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] =  getBrowserAgent();
                $data['client_ip'] = $this->request->getIPAddress();
                $save = $this->login_model->resetPasswordUser($data);
                if ($save) {
                    $data1['reset_link'] = base_url("admin/resetPasswordConfirmUser/") . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);
                    if (!empty($userInfo)) {
                        $data1["name"] = $userInfo[0]->full_name;
                        $data1["email"] = $userInfo[0]->email;
                        $data1["message"] = "Reset Your Password";
                    }
                    $sendStatus = resetPasswordEmail($data1);
                    if ($sendStatus) {
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                } else {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            } else {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect()->to('admin/forgotPassword');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);

        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);

        $data['email'] = $email;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1) {
            return view('admin/newPassword', $data);
        } else {
            redirect('admin/login');
        }
    }

    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->request->getVar("email");
        $activation_id = $this->request->getVar("activation_code");



        $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        } else {
            $password = $this->request->getVar('password');
            $cpassword = $this->request->getVar('cpassword');

            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            if ($is_correct == 1) {
                $this->login_model->createPasswordUser($email, $password);
                $status = 'success';
                $message = 'Password changed successfully';
            } else {
                $status = 'error';
                $message = 'Password changed failed';
            }
            setFlashData($status, $message);
            redirect("admin/login");
        }
    }
}
