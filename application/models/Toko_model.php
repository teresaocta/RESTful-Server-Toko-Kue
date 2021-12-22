<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Toko_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Toko_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  public function get($id=null, $limit=5, $offset=0)
  {
    if($id===null)
    {
      $this->db->select('id_produk, nama_produk, kategori, harga_produk, stok_produk, nama_drink as bonus');
      $this->db->join('drink', 'produk.id_drink=drink.id_drink');
      return $this->db->get('produk', $limit, $offset)->result();
    }
    else
    {
      $this->db->select('id_produk, nama_produk, kategori, harga_produk, stok_produk, nama_drink as bonus');
      $this->db->join('drink', 'produk.id_drink=drink.id_drink');
      return $this->db->get_where('produk', ['kode'=>$id])->result_array();
    }
  }

  public function get_category($category=null, $limit=5, $offset=0)
  {
    if($category===null)
    {
      return $this->db->get('produk', $limit, $offset)->result();
    }
    else
    {
      return $this->db->get_where('produk', ['kategori'=>$category])->result_array();
    }
  }

  public function get_drink($id=null, $limit=5, $offset=0)
  {
    if($id===null)
    {
      return $this->db->get('drink', $limit, $offset)->result();
    }
    else
    {
      return $this->db->get_where('drink', ['id_drink'=>$id])->result_array();
    }
  }

  public function get_package($id=null, $limit=5, $offset=0)
  {
    if($id===null)
    {
      return $this->db->get('package', $limit, $offset)->result();
    }
    else
    {
      return $this->db->get_where('package', ['id_package'=>$id])->result_array();
    }
  }

  public function count()
  {
    return $this->db->get('produk')->num_rows();
  }

  public function add($data)
  {
    try{
      $this->db->insert('produk',$data);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function add_package($data)
  {
    try{
      $this->db->insert('package',$data);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function add_drink($data)
  {
    try{
      $this->db->insert('drink',$data);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function update($id, $data)
  {
    try{
      $this->db->update('produk',$data, ['id_produk'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function update_package($id, $data)
  {
    try{
      $this->db->update('package',$data, ['id_package'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function update_drink($id, $data)
  {
    try{
      $this->db->update('drink',$data, ['id_drink'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function delete($id)
  {
    try{
      $this->db->delete('produk', ['id_produk'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function delete_package($id)
  {
    try{
      $this->db->delete('package', ['id_package'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function delete_drink($id)
  {
    try{
      $this->db->delete('drink', ['id_drink'=>$id]);
      $error=$this->db->error();
      if(!empty($error['code']))
      {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch(Exception $ex)
    {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }
}

/* End of file Toko_model.php */
/* Location: ./application/models/Toko_model.php */