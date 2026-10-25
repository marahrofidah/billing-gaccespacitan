<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['product_m']);
    }


    public function data()
    {
        $data['title'] = 'Product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['product'] = $this->product_m->get()->result();
        $data['company'] = $this->db->get('company')->row_array();
        $this->template->load('backend', 'backend/website/product', $data);
    }
    public function add()
    {
        is_logged_in();
        $this->form_validation->set_rules('name', 'Name product', 'required|trim');

        $data['title'] = 'Add product';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->form_validation->run() == false) {
            $data['company'] = $this->db->get('company')->row_array();
            $this->template->load('backend', 'backend/website/add-product', $data);
        } else {
            $config['upload_path']          = './assets/images/product';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048; // 2 Mb
            $config['file_name']             = 'product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);
            $post = $this->input->post(null, TRUE);
            $post['picture'] = '';
            if (!empty($_FILES['picture']['name'])) {
                if ($this->upload->do_upload('picture')) {
                    $post['picture'] =  $this->upload->data('file_name');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                    redirect('product/add');
                    return;
                }
            }
            $trim = trim($post['name']);
            $slug = strtolower(str_replace(' ', '-', $trim)) . '.html';
            $post['create_by'] = $this->session->userdata('id');
            if ($this->product_m->add($post, $slug)) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            } else {
                $error = $this->db->error();
                if ($post['picture'] !== '' && is_file('./assets/images/product/' . $post['picture'])) {
                    unlink('./assets/images/product/' . $post['picture']);
                }
                $this->session->set_flashdata('error', 'Produk gagal disimpan: ' . $error['message']);
            }
            redirect('product/data');
        }
    }
    public function edit($id)
    {
        is_logged_in();
        $this->form_validation->set_rules('product', 'Nama product', 'required');
        if ($this->form_validation->run() == FALSE) {
            $query  = $this->product_m->get($id);
            if ($query->num_rows() > 0) {
                $data['product'] = $query->row();
                $data['title'] = 'Edit product';
                $data['company'] = $this->db->get('company')->row_array();

                $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
                $this->template->load('backend', 'backend/website/edit-product', $data);
            } else {
                echo "<script> alert ('Data tidak ditemukan');";
                echo "window.location='" . site_url('product/data') . "'; </script>";
            }
        }
    }

    public function edit_product()
    {
        is_logged_in();
        $config['upload_path']          = './assets/images/product';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        $old_picture = null;
        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $product = $this->product_m->get($post['id'])->row();
                $old_picture = $product ? $product->picture : null;
                $post['picture'] =  $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('product/data');
                return;
            }
        }
        if ($this->product_m->edit($post)) {
            if ($old_picture !== null && is_file('./assets/images/product/' . $old_picture)) {
                unlink('./assets/images/product/' . $old_picture);
            }
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
        } else {
            $error = $this->db->error();
            if (!empty($post['picture']) && is_file('./assets/images/product/' . $post['picture'])) {
                unlink('./assets/images/product/' . $post['picture']);
            }
            $this->session->set_flashdata('error', 'Produk gagal diupdate: ' . $error['message']);
        }
        redirect('product/data');
    }
    public function del()
    {
        $id = $this->input->post('id');
        $product = $this->product_m->get($id)->row();
        if ($product->picture != null) {
            $target_file = './assets/images/product/' . $product->picture;
            unlink($target_file);
        }
        $this->product_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        echo "<script>window.location='" . base_url('product/data') . "'; </script>";
    }
}
