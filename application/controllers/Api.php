<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  public function index(){
    echo "API Komuditas Pangan";
  }

  public function getSiswa($id = '')
  {
    if (isset($id)) {
      $this->db->where('no_induk',$id);
      $q = $this->db->get('siswa');
      echo json_encode($q->row());
    }
  }

  public function getNilai()
  {
    $id = $this->input->get('id',true);
    $kdmp = $this->input->get('kdmp',true);
    $this->db->order_by('created_at', 'desc');
    $q = $this->db->get_where('nilai', array('no_induk' => $id, 'kdmp' => $kdmp));
    echo json_encode($q->row());
    
  }



  public function getHarga()
  {
    $id = $this->input->get('id');
    $komuditas = $this->input->get('komuditas');
    $kota = $this->input->get('kota');
    
    $this->db->select('harga.*, komuditas.nama as nama_komuditas, komuditas.satuan as satuan, kota.nama as kota');
    $this->db->from('harga');
    $this->db->join('komuditas', 'komuditas.id = harga.komuditas_id');
    $this->db->join('kota', 'kota.id = harga.kota_id');
    if ($id != NULL) {
      $this->db->where('harga.id',$id);
    }else if ($komuditas != NULL) {
      $this->db->where('komuditas.id',$komuditas);
    }else if ($kota != NULL) {
      $this->db->where('kota.id',$kota);
    }

    $q = $this->db->get();
    if ($q->num_rows() > 1) {
      echo json_encode($q->result());
    }else if($q->num_rows == 1){
      echo json_encode($q->row());
    }else{
      echo "Daftar Harga Kosong";
    }

  }

  public function UserLogin()
  {
    $username   = $this->input->post('username', true);
    $password   = hash("sha256", $this->input->post('password', true));
    $q = $this->db->get_where('pengguna', array('username' => $username, 'password' => $password));

    $res = new stdClass();
    if ($q->num_rows() == 1) {
        $res->status = true;
        $res->message = 'berhasil login';
        $res->data = $q->row();
    }else{
        $res->status = false;
        $res->message = 'Email or password is wrong!';
    }
    echo json_encode($res);
  }

  public function UserRegister()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[pengguna.username]');

    $res = new stdClass();
    if ($this->form_validation->run() == FALSE)
    {
        $res->status = false;
        $res->message = 'Username Sudah terdaftar';
    }
    else
    {
    $kota_id    = $this->input->post('kota_id',TRUE);
    $username   = $this->input->post('username', true);
    $password   = $this->input->post('password', true);
    $nama       = $this->input->post('nama',TRUE);

    $data = array(
        'kota_id'   => $kota_id,
        'username'  => $username,
        'password'  => hash("sha256", $password),
        'nama'      => $nama);

    $q = $this->db->insert('pengguna', $data);
    
    if ($q) {
        $res->status = true;
        $res->message = 'Akun berhasil didaftarkan';
        $res->data = $data;
    }else{
        $res->status = false;
        $res->message = 'Gagal mendaftarkan akun';
    }
    }
    echo json_encode($res);
  }

  public function saveHarga()
  {
    $user_id = $this->input->post('user_id',TRUE);
    $komuditas_id = $this->input->post('komuditas_id',TRUE);
    $kota_id = $this->input->post('kota_id',TRUE);
    $harga = $this->input->post('harga',TRUE);

    if ($user_id == NULL || $komuditas_id == NULL || $kota_id == NULL || $harga == NULL) {
      echo "failed";
    }else{
      $data = array(
        'user_id'       => $user_id,
        'komuditas_id'  => $komuditas_id,
        'kota_id'       => $kota_id,
        'harga'         => $harga);

      $q = $this->db->insert('harga', $data);

      if ($q) {
        echo "berhasil";
      }else{
        echo "failed";
      }
      
    }

  }

}
