<?php

class M_user extends Ci_model {

    public function get_users() {
        $result = $this->db->get('user');
        return $result->result();

    }

    public function login_check_user($username, $password) {
    	$this->db->where('user_handle', $username);
    	$this->db->where('user_pass', $password);
    	return $this->db->get('user')->result();
    }

    public function get_contests($status, $user_id) {
        $this->db->select('*');
        $this->db->join('user_cont_rel', 'user_cont_rel.contest_id = contest.contest_id');
        $this->db->where('contest_status', $status);
        $this->db->where('user_id', $user_id);
        return $this->db->get('contest')->result();
    }

    public function get_all_contests($user_id) {
        $this->db->select('*');
        $this->db->join('user_cont_rel', 'user_cont_rel.contest_id = contest.contest_id');
        $this->db->where('user_id', $user_id);
        return $this->db->get('contest')->result();
    }

    public function check_user_access($contest_id, $user_id) {
    	$this->db->where('contest_id', $contest_id);
    	$this->db->where('user_id', $user_id);
        $result = $this->db->get('user_cont_rel');
        return $result->num_rows();
    }

    public function probs_for_contest($contest_id) {
        $this->db->select('*');
        $this->db->join('prob_cont_rel', 'prob_cont_rel.problem_id = prob_for_display.problem_id');
        $this->db->where('contest_id', $contest_id);

        return $this->db->get('prob_for_display')->result();
    }

    public function get_single_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('contest')->row();
    }

    // Others

    public function get_contest_status($status) {
        $this->db->select('contest_id, contest_start, contest_end');
        $this->db->where('contest_status', $status);
        return $this->db->get('contest')->result();
    }

    public function update_contest_status($contest_id, $data) {
        $this->db->where('contest_id', $contest_id);
        $this->db->update('contest', $data);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function submit_solution($submission) {
        $this->db->insert('submission', $submission);
        return $this->db->insert_id();
    }

    public function get_sub_for_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('submission_time', 'desc');
        return $this->db->get('submission')->result();
    }

    public function get_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row();

    }

    public function get_prob_cont_count($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $result = $this->db->get('prob_cont_rel');
        return $result->num_rows();
    }

    
    public function get_ranklist($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('rank_solved', 'desc');
        $this->db->order_by('rank_penalty');
        return $this->db->get('rank')->result();

    }

}
?>