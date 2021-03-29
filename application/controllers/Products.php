<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('products_model','product');
	}
	/***** Listing of products ****/
	public function index()
	{
		$data['products'] = $this->product->getProducts(); 
		$this->load->view('products/index', $data);
	}
	/***** Add product *******/
	public function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required|is_unique[products.slug]');
		if ($this->form_validation->run() == TRUE)
        {			
			if( isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] != ''){ 
				$config['upload_path'] = 'uploads/';
	        	$config['allowed_types'] = 'gif|jpg|png';
	        	$config['file_name'] = $fileName= time().$_FILES["product_image"]['name'];

	     	    $this->load->library('upload', $config);
	     	    if (!$this->upload->do_upload('product_image')) {
		            $error = array('error' => $this->upload->display_errors());	            
		            $this->session->set_flashdata('error', $error['error']);
		            redirect('add-product');
		        } else {
		            $uploaded = array('image_metadata' => $this->upload->data());
		        }
		    }else{
		    	$fileName = '';
		    }    
			$form_data = array
	        (
	            'slug' => $this->input->post('slug'),
	            'title' => $this->input->post('title'),
	            'description' => $this->input->post('description'),
	            'image' => $fileName
	        );
			$saved = $this->product->addProduct($form_data); 
			if($saved){
	            $this->session->set_flashdata('success', 'Product added successfully!');
	            redirect('/');	            
	        }else{
	            $this->session->set_flashdata('error', 'Something went wrong!');
	            redirect('add-product');	         
	        }            
        }
        else
        {
			$this->load->view('products/add');
        }
	}
	/**** update product *******/
	public function edit()
	{
		$id = $this->uri->segment(2);
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('slug', 'Slug', 'required');
		if ($this->form_validation->run() == TRUE)
        {
			if( isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] != ''){ 
				$config['upload_path'] = 'uploads/';
	        	$config['allowed_types'] = 'gif|jpg|png';
	        	$config['file_name'] = $fileName= time().$_FILES["product_image"]['name'];

	     	    $this->load->library('upload', $config);
	     	    if (!$this->upload->do_upload('product_image')) {
		            $error = array('error' => $this->upload->display_errors());	            
		            $this->session->set_flashdata('error', $error['error']);
		            redirect('add-product');
		        } else {
		            $uploaded = array('image_metadata' => $this->upload->data());
		        }
		    }else{
		    	$fileName = $this->input->post('old_image');
		    }    
		    $form_data = array
	        (
	            'slug' => $this->input->post('slug'),
	            'title' => $this->input->post('title'),
	            'description' => $this->input->post('description'),
	            'image' => $fileName
	        );
			$updated = $this->product->updateProduct($form_data,$id); 
			if($updated){
	            $this->session->set_flashdata('success', 'Product updated successfully!');
	        }else{
	            $this->session->set_flashdata('error', 'Something went wrong!');
	        }
	        redirect('/');
	    }else{
 			$data['product'] = $this->product->getProductById($id);  			
	    	$this->load->view('products/edit', $data);
	    }    
	}
	/**** View product *****/
	public function view()
	{
		$id = $this->uri->segment(2);		
		$data['product'] = $this->product->getProductbyId($id); 
		$this->load->view('products/view', $data);
	}
	/**** delete product *******/
	public function delete()
	{
		$id = $this->uri->segment(2);
		$deleted = $this->product->deleteProduct($id); 
		if($deleted){
            $this->session->set_flashdata('success', 'Product deleted successfully!');            
        }else{
            $this->session->set_flashdata('error', 'Something went wrong!');
        }
        redirect('products/index');
	}
}
