<?php

class M_user extends Ci_model {

    public function get_users() {
        $result = $this->db->get('user');
        return $result->result();

    }
}
?>