<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['slide_m']);
    }
    public function index()
    {
        $data['title'] = 'Slide';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['company'] = $this->db->get('company')->row_array();
        $data['slide'] = $this->slide_m->get()->result();
        $this->template->load('backend', 'backend/slide/data', $data);
    }
    public function add()
    {
        $config['upload_path']          = './assets/images/slide';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'slide-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        $post['picture'] = '';
        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $post['picture'] =  $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('slider');
                return;
            }
        }
        $post['create_by'] = $this->session->userdata('id');
        if ($this->slide_m->add($post)) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
        } else {
            $error = $this->db->error();
            if ($post['picture'] !== '' && is_file('./assets/images/slide/' . $post['picture'])) {
                unlink('./assets/images/slide/' . $post['picture']);
            }
            $this->session->set_flashdata('error', 'Slide gagal disimpan: ' . $error['message']);
        }
        redirect('slider');
    }

    public function edit()
    {
        $config['upload_path']          = './assets/images/slide';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048; // 2 Mb
        $config['file_name']             = 'slide-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        $post = $this->input->post(null, TRUE);
        $old_picture = null;
        if (!empty($_FILES['picture']['name'])) {
            if ($this->upload->do_upload('picture')) {
                $slide = $this->slide_m->get($post['slide_id'])->row();
                $old_picture = $slide ? $slide->picture : null;
                $post['picture'] =  $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('slider');
                return;
            }
        }
        if ($this->slide_m->edit($post)) {
            if ($old_picture !== null && is_file('./assets/images/slide/' . $old_picture)) {
                unlink('./assets/images/slide/' . $old_picture);
            }
            $this->session->set_flashdata('success', 'Data Slide berhasil diupdate');
        } else {
            $error = $this->db->error();
            if (!empty($post['picture']) && is_file('./assets/images/slide/' . $post['picture'])) {
                unlink('./assets/images/slide/' . $post['picture']);
            }
            $this->session->set_flashdata('error', 'Slide gagal diupdate: ' . $error['message']);
        }
        redirect('slider');
    }

    public function delete()
    {
        $slide_id = $this->input->post('slide_id');
        $slide = $this->slide_m->get($slide_id)->row();
        if ($slide->picture != null) {
            $target_file = './assets/images/slide/' . $slide->picture;
            unlink($target_file);
        }
        $this->slide_m->del($slide_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Slide berhasil dihapus');
        }
        echo "<script>window.location='" . base_url('slider') . "'; </script>";
    }
}
