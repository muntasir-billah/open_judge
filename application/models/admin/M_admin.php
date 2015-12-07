<?php

class M_admin extends Ci_model {

    public function get_admins() {
        $result = $this->db->get('admin');
        return $result->result();
    }

    public function all_contestants() {
        return $this->db->get('user')->result();
    }

    public function get_single_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('user')->row();
    }

    public function add_contestant($user) {
        $this->db->insert('user', $user);
        return $this->db->insert_id();
    }

    public function update_contestant($user_id, $user) {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $user);
        return $this->db->affected_rows();
    }

    public function get_contest_status($status) {
        $this->db->select('contest_id, contest_start, contest_end');
        $this->db->where('contest_status', $status);
        return $this->db->get('contest')->result();
    }

    public function update_contest_status($contest_id, $data) {
        $this->db->where('contest_id', $contest_id);
        $this->db->update('contest', $data);
        return $this->db->affected_rows();
    }

    public function login_check_admin($username, $password) {
    	$this->db->where('admin_user', $username);
    	$this->db->where('admin_pass', $password);
    	return $this->db->get('admin')->result();
    }

    public function login_check_judge($username, $password) {
    	$this->db->where('judge_user', $username);
    	$this->db->where('judge_pass', $password);
    	return $this->db->get('judge')->result();
    }

    public function get_all_categories() {
        return $this->db->get('category')->result();
    }

    public function insert_problem($problem) {
        $this->db->insert('problem', $problem);
        return $this->db->insert_id();
    }


    public function tag_a_problem($data) {
        $this->db->insert_batch('prob_cat_rel', $data);
        return $this->db->affected_rows();
    }

    public function get_single_problem($problem_id) {
        $this->db->where('problem_id', $problem_id);
        return $this->db->get('prob_for_display')->row();
    }

    public function tags_for_problem($problem_id) {
        $this->db->select('category.category_id, category_name');
        $this->db->join('prob_cat_rel', 'category.category_id = prob_cat_rel.category_id');
        $this->db->where('problem_id', $problem_id);

        return $this->db->get('category')->result();
    }

    public function get_all_problems() {
        return $this->db->get('prob_for_display')->result();
    }

    public function add_contest($contest) {
        $this->db->insert('contest', $contest);
        return $this->db->insert_id();
    }

    public function all_contests() {
        return $this->db->get('contest')->result();
    }

    public function get_contests($status) {
        $this->db->where('contest_status', $status);
        return $this->db->get('contest')->result();
    }

    public function get_single_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('contest')->row();
    }

    public function probs_for_contest($contest_id) {
        $this->db->select('*');
        $this->db->join('prob_cont_rel', 'prob_cont_rel.problem_id = prob_for_display.problem_id');
        $this->db->where('contest_id', $contest_id);

        return $this->db->get('prob_for_display')->result();
    }


    public function probs_except_contest($contest_id) {
        $query = "SELECT * FROM prob_for_display WHERE 
    prob_for_display.problem_id NOT IN (SELECT problem_id FROM prob_cont_rel WHERE contest_id = $contest_id)";

        return $this->db->query($query)->result();
    }
    
    public function delete_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->delete('contest');
        return $this->db->affected_rows();
    }

    public function get_prob_cont_rel($problem_id, $contest_id) {
        $this->db->where('problem_id', $problem_id);
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('prob_cont_rel')->row();
    }

    public function add_prob_cont_rel($data) {
        $this->db->insert('prob_cont_rel', $data);
        return $this->db->insert_id();
    }

    public function get_judge_io($problem_id) {
        $this->db->select('problem_judge_input, problem_judge_output');
        $this->db->where('problem_id', $problem_id);
        return $this->db->get('problem')->row();
    }

    public function remove_prob_cont_rel($problem_id, $contest_id) {
        $this->db->where('problem_id', $problem_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->delete('prob_cont_rel');
        return $this->db->affected_rows();
    }

    public function delete_problem($problem_id) {
        $this->db->where('problem_id', $problem_id);
        $this->db->delete('problem');
        return $this->db->affected_rows();
    }
}
?>