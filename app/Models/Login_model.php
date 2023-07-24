<?php 

namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'created_at'
    ];

    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($email, $password)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.password, BaseTbl.full_name,BaseTbl.roleId,Roles.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Roles', 'Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.email', $email);
        //$this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        $user = $query->result();

        if (!empty($user)) {
            if (password_verify($password, $user[0]->password)) {
                return $user;
            } 
        }
        return array();
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('userId');
        $this->db->where('email', $email);
        //$this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->insert($data);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->select('userId, email, full_name');
        //$this->db->where('isDeleted', 0);
        $this->where('email', $email);
        $query = $this->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->select('id');
        $this->where('email', $email);
        $this->where('activation_id', $activation_id);
        $query = $this->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->where('email', $email);
        $this->where('isDeleted', 0);
        $this->update('tbl_users', array('password' => getHashedPassword($password)));
        $this->delete('tbl_reset_password', array('email' => $email));
    }
}
