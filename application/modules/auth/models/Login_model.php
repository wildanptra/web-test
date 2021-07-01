<?php 

    class Login_model extends NoAuth_Controller {
        
        private $table = 'tb_users';

        public function doLogin()
        {
            $post = $this->input->post();

            $this->db->where('username',$post['username'])
                    ->or_where('email', $post["username"]);
            $user = $this->db->get($this->table)->row();

            if($user){

                $isPasswordTrue = password_verify($post['password'], $user->password);
                // $isAdmin = $user->role == 'admin';
                
                if($isPasswordTrue){
                    
                    $data_session = [
                        'user_logged'   => $user,
                        'username'      => $user->username,
                        'name'          => $user->name,
                        'role'          => $user->role,
                        // 'role'          => $isAdmin,
                    ];

                    $this->session->set_userdata($data_session);
                    $this->_updateLastLogin($user->user_id);
                    return true;

                }
            }

            return false;

        }

        public function isNotLogin()
        {
            return $this->session->userdata('user_logged') == null;   
        }

        private function _updateLastLogin($user_id)
        {
            $sql = "UPDATE {$this->table} SET last_login=now() WHERE user_id={$user_id}";
            $this->db->query($sql);
        }
        
    }

?>