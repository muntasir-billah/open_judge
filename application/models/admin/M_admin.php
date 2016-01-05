<?php

class M_admin extends Ci_model {

    public function get_admins() {
        $result = $this->db->get('admin');
        return $result->result();
    }

    // Contestant Functions

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

    public function user_handle_check($user_handle) {
        $this->db->where('user_handle', $user_handle);
        $result = $this->db->get('user');
        return $result->num_rows();
    }

    public function delete_contestant($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user');
        return $this->db->affected_rows();
    }

    public function get_users_for_contest($contest_id) {
        $this->db->select('*');
        $this->db->join('user_cont_rel', 'user_cont_rel.user_id = user.user_id');
        $this->db->where('contest_id', $contest_id);
        $this->db->where('user_type', 0);
        return $this->db->get('user')->result();
    }

     public function users_except_contest($contest_id) {
        $query = "SELECT * FROM user WHERE 
    `user`.`user_id` NOT IN (SELECT user_id FROM user_cont_rel WHERE contest_id = $contest_id)";

        return $this->db->query($query)->result();
    }

    public function get_user_cont_rel($user_id, $contest_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('user_cont_rel')->row();
    }

    public function add_user_cont_rel($data) {
        $this->db->insert('user_cont_rel', $data);
        return $this->db->insert_id();
    }

    public function remove_user_cont_rel($user_id, $contest_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->delete('user_cont_rel');
        return $this->db->affected_rows();
    }

    // Judges Functions

    public function all_judges() {
        return $this->db->get('judge')->result();
    }

    public function get_single_judge($judge_id) {
        $this->db->where('judge_id', $judge_id);
        return $this->db->get('judge')->row();
    }

    public function add_judge($judge) {
        $this->db->insert('judge', $judge);
        return $this->db->insert_id();
    }

    public function update_judge($judge_id, $judge) {
        $this->db->where('judge_id', $judge_id);
        $this->db->update('judge', $judge);
        return $this->db->affected_rows();
    }

    public function judge_handle_check($judge_user) {
        $this->db->where('judge_user', $judge_user);
        $result = $this->db->get('judge');
        return $result->num_rows();
    }

    public function delete_judge($judge_id) {
        $this->db->where('judge_id', $judge_id);
        $this->db->delete('judge');
        return $this->db->affected_rows();
    }

    public function get_judges_for_contest($contest_id) {
        $this->db->select('*');
        $this->db->join('judge_cont_rel', 'judge_cont_rel.judge_id = judge.judge_id');
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('judge')->result();
    }

     public function judges_except_contest($contest_id) {
        $query = "SELECT * FROM judge WHERE 
    `judge`.`judge_id` NOT IN (SELECT judge_id FROM judge_cont_rel WHERE contest_id = $contest_id)";

        return $this->db->query($query)->result();
    }

    public function get_judge_cont_rel($judge_id, $contest_id) {
        $this->db->where('judge_id', $judge_id);
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('judge_cont_rel')->row();
    }

    public function add_judge_cont_rel($data) {
        $this->db->insert('judge_cont_rel', $data);
        return $this->db->insert_id();
    }

    public function remove_judge_cont_rel($judge_id, $contest_id) {
        $this->db->where('judge_id', $judge_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->delete('judge_cont_rel');
        return $this->db->affected_rows();
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
        return $this->db->affected_rows();
    }

    //login check functions //

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

    //=============================//



    public function update_contest($contest_id, $contest) {
        $this->db->where('contest_id', $contest_id);
        $this->db->update('contest', $contest);
        return $this->db->affected_rows();
    }

    public function get_all_categories() {
        return $this->db->get('category')->result();
    }

    public function insert_problem($problem) {
        $this->db->insert('problem', $problem);
        return $this->db->insert_id();
    }

    public function update_problem($problem, $problem_id) {
        $this->db->where('problem_id', $problem_id);
        $this->db->update('problem', $problem);
        return $this->db->affected_rows();
    }


    public function tag_a_problem($data) {
        $this->db->insert_batch('prob_cat_rel', $data);
        return $this->db->affected_rows();
    }

    public function check_problem_tag($problem_id, $category_id) {
        $this->db->where('problem_id', $problem_id);
        $this->db->where('category_id', $category_id);
        return $this->db->get('prob_cat_rel')->num_rows();
    }

    public function get_single_problem($problem_id) {
        $this->db->where('problem_id', $problem_id);
        return $this->db->get('prob_for_display')->row();
    }

    public function get_single_problem_full($problem_id) {
        $this->db->where('problem_id', $problem_id);
        return $this->db->get('problem')->row();
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
        $this->db->order_by('contest_start', 'desc');
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
        $this->db->order_by('prob_cont_rel_order');

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

    public function get_prob_cont_rel_for_cont($contest_id) {
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('prob_cont_rel')->result();
    }

    public function add_prob_cont_rel($data) {
        $this->db->insert('prob_cont_rel', $data);
        return $this->db->insert_id();
    }

    public function update_prob_cont_rel($prob_cont_rel_id, $data) {
        $this->db->where('prob_cont_rel_id', $prob_cont_rel_id);
        $this->db->update('prob_cont_rel', $data);
        return $this->db->affected_rows();
    }

    public function update_batch_prob_cont_rel($prob_cont_rel) {
        $this->db->update_batch('prob_cont_rel', $prob_cont_rel, 'prob_cont_rel_id');
        return $this->db->affected_rows();
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

    public function if_contest_running($contest_id) {
        $this->db->select('contest_status');
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('contest')->row();
    }

    public function get_single_submission($submission_id) {
        $this->db->where('submission_id', $submission_id);
        return $this->db->get('submission')->row();
    }

    public function get_sub_for_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('submission_time', 'desc');
        return $this->db->get('submission')->result();
    }

    public function get_sub_for_contest_without_source($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('submission_time', 'desc');
        return $this->db->get('submissions_without_source')->result();
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

    public function update_submission($submission_id, $submission) {
        $this->db->where('submission_id', $submission_id);
        $this->db->update('submission', $submission);
        return $this->db->affected_rows();
    }
    
    public function update_batch_submission($submission) {
        $this->db->update_batch('submission', $submission, 'submission_id');
        return $this->db->affected_rows();
    }

    public function get_prev_submissions_by_user($user_id, $contest_id, $problem_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->where('problem_id', $problem_id);
        $result = $this->db->get('submission');
        return $result->num_rows();
    }

    public function check_existing_solution($user_id, $contest_id, $problem_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->where('problem_id', $problem_id);
        $this->db->where('submission_result', 1);
        $result = $this->db->get('submission');
        if($result->num_rows() > 0) return true;
        else return false;
    }

    public function if_first_submission($user_id, $contest_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        $result = $this->db->get('rank');
        if($result->num_rows() == 0) return true;
        else return false;
    }

    public function get_rank($user_id, $contest_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        return $this->db->get('rank')->row();
    }

    public function get_prob_cont_order($contest_id, $problem_id) {
        $this->db->select('prob_cont_rel_order');
        $this->db->where('contest_id', $contest_id);
        $this->db->where('problem_id', $problem_id);
        $result = $this->db->get('prob_cont_rel')->row();
        return $result->prob_cont_rel_order;
    }

    public function update_rank($user_id, $contest_id, $rank) {
        $this->db->where('user_id', $user_id);
        $this->db->where('contest_id', $contest_id);
        $this->db->update('rank', $rank);
        return $this->db->affected_rows();
    }

    public function insert_rank($rank) {
        $this->db->insert('rank', $rank);
        return $this->db->insert_id();
    }

    public function insert_batch_rank($rank) {
        $this->db->insert_batch('rank', $rank);
        return $this->db->affected_rows();
    }

    public function update_batch_rank($rank) {
        $this->db->update_batch('rank', $rank, 'rank_id');
        return $this->db->affected_rows();
    }

    // public function new_submission_for_contest($contest_id) {
    //     $this->db->where('submission_status', 1);
    //     $this->db->where('contest_id', $contest_id);
    //     return $this->db->get('submission')->result();
    // }

    public function new_sub() {
        $this->db->where('submission_status', 1);
        $this->db->order_by('submission_time');
        $this->db->limit(1);
        return $this->db->get('submission')->row();
    }

    public function get_ranklist($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('rank_solved', 'desc');
        $this->db->order_by('rank_penalty');
        return $this->db->get('rank')->result();

    }

    public function get_clar_for_contest($contest_id) {
        $this->db->where('contest_id', $contest_id);
        $this->db->order_by('clarification_time', 'desc');
        return $this->db->get('clarification')->result();
    }

    public function insert_clarification($clarification) {
        $this->db->insert('clarification', $clarification);
        return $this->db->insert_id();
    }

    public function update_clarification($clarification, $clarification_id) {
        $this->db->where('clarification_id', $clarification_id);
        $this->db->update('clarification', $clarification);
        return $this->db->affected_rows();
    }

    public function delete_clarification($clarification_id) {
        $this->db->where('clarification_id', $clarification_id);
        $this->db->delete('clarification');
        return $this->db->affected_rows();
    }

}
?>