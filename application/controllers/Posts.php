<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        $this->load->model("Post");
    }
    public function index_json() {
        $data["posts"] = $this->Post->all();
        echo json_encode($data);
    }
    public function index_html() {
        $data["posts"] = $this->Post->all();
        $this->load->view("partials/posts", $data);
    }
    public function create() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('quote', 'Quote', 'trim|required');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errors', '<span class="errors">'.validation_errors().'</span>');
			redirect(base_url());
        } else {
        // this is an associative array with 'author' and 'name' with values user entered in the form
        // this is what $(this).serialize() sent over to this URL
        $new_post = $this->input->post();
        $this->Post->create($new_post);
        // after we create the new post then we can query the database again and it will include the new 
        // one we just included
        $data["posts"] = $this->Post->all();
        // then we respond to the AJAX request with a partial that will use the $data variable to generate      
        // the appropriate html
        $this->session->set_flashdata('success', '<p class="success">Your Note was successfully added!</p>');
        $this->load->view("partials/posts", $data);
        }
        
    }
    public function index(){
        $this->load->view('posts/index');
    }

}
