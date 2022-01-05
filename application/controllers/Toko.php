<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Toko
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller REST
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

use chriskacerguis\RestServer\RestController;

class Toko extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('toko_model', 'produk');
    $this->methods['index_get']['limit'] = 100;
    $this->methods['package_get']['limit'] = 100;
    $this->methods['drink_get']['limit'] = 100;
  }

  public function index_get()
  {
    $id=$this->get('id');
    $category=$this->get('category');

    if($id===null and $category===null)
    {
      $page=$this->get('page');
      $data_page=3;
      $page=(empty($page)? 1:$page);
      $total_data=$this->produk->count();
      $total_page=ceil($total_data/$data_page);
      $start=($page-1)*$data_page;
      $list = $this->produk->get(null, $data_page, $start);
      if($list)
      {
        $data=[
          'status'=>true,
          'page'=>$page,
          'total_data'=>$total_data,
          'total_page'=>$total_page,
          'data'=>$list
        ];
      }
      else
      {
        $data=[
          'status'=>false,
          'msg'=>'Data tidak ditemukan'
        ];
      }
      $this->response($data, RestController::HTTP_OK);
    }
    elseif($category!==null and $id===null)
    {
      $data=$this->produk->get_category($category);
      if($data)
      {
        $this->response(['status'=>true, 'data'=>$data],RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>$category.' tidak ditemukan'],RestController::HTTP_NOT_FOUND);
      }
    }
    elseif($category===null and $id!==null)
    {
      $data=$this->produk->get($id);
      if($data)
      {
        $this->response(['status'=>true, 'data'=>$data],RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>$id.' tidak ditemukan'],RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post()
  {
    $data=[
      'id_produk'=>$this->post('id_produk'),
      'nama_produk'=>$this->post('nama_produk'),
      'kategori'=>$this->post('kategori'),
      'harga_produk'=>$this->post('harga_produk'),
      'stok_produk'=>$this->post('stok_produk'),
      'id_drink'=>$this->post('id_drink')
    ];

    $simpan=$this->produk->add($data);

    if($simpan['status'])
    {
      $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put()
  {
    $data=[
      'nama_produk'=>$this->put('nama_produk', true),
      'kategori'=>$this->put('kategori', true),
      'harga_produk'=>$this->put('harga_produk', true),
      'stok_produk'=>$this->put('stok_produk', true),
      'id_drink'=>$this->put('id_drink')
    ];

    $id=$this->put('id', true);

    if($id===null)
    {
      $this->response(['status'=>false, 'msg'=>'Masukkan kode yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->produk->update($id, $data);

    if($simpan['status'])
    {
      $status=(int)$simpan['data'];
      if($status>0)
      {
        $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah diubah'], RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>'Tidak ada data diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_delete()
  {
    $id=$this->delete('id');

    if($id===null)
    {
      $this->response(['status'=>false, 'msg'=>'Masukkan kode yang akan dihapus'], RestController::HTTP_BAD_REQUEST);
    }

    $delete=$this->produk->delete($id);

    if($delete['status'])
    {
      $status=(int)$delete['data'];
      if($status>0)
      {
        $this->response(['status'=>true, 'msg'=>'Data '.$id.' telah dihapus'], RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>'Tidak ada data dihapus'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$delete['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function package_get()
  {
    $id=$this->get('id');

    if($id===null)
    {
      $list = $this->produk->get_package();
      $this->response(['status'=>true, 'data'=>$list], RestController::HTTP_OK);
    }
    else
    {
      $data=$this->produk->get_package($id);
      if($data)
      {
        $this->response(['status'=>true, 'data'=>$data],RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>$id.' tidak ditemukan'],RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function package_post()
  {
    $data=[
      'id_package'=>$this->post('id_package'),
      'nama_package'=>$this->post('nama_package'),
      'harga_package'=>$this->post('harga_package'),
      'stok_package'=>$this->post('stok_package'),
      'detail'=>$this->post('detail')
    ];

    $simpan=$this->produk->add_package($data);

    if($simpan['status'])
    {
      $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function package_put()
  {
    $data=[
      'nama_package'=>$this->put('nama_package'),
      'harga_package'=>$this->put('harga_package'),
      'stok_package'=>$this->put('stok_package'),
      'detail'=>$this->put('detail')
    ];

    $id=$this->put('id', true);

    if($id===null)
    {
      $this->response(['status'=>false, 'msg'=>'Masukkan kode yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->produk->update_package($id, $data);

    if($simpan['status'])
    {
      $status=(int)$simpan['data'];
      if($status>0)
      {
        $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah diubah'], RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>'Tidak ada data diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function package_delete()
  {
    $id=$this->delete('id');

    if($id===null)
    {
      $this->response(['status'=>false, 'msg'=>'Masukkan kode yang akan dihapus'], RestController::HTTP_BAD_REQUEST);
    }

    $delete=$this->produk->delete_package($id);

    if($delete['status'])
    {
      $status=(int)$delete['data'];
      if($status>0)
      {
        $this->response(['status'=>true, 'msg'=>'Data '.$id.' telah dihapus'], RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>'Tidak ada data dihapus'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$delete['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function drink_get()
  {
    $id=$this->get('id');

    if($id===null)
    {
      $list = $this->produk->get_drink();
      $this->response(['status'=>true, 'data'=>$list], RestController::HTTP_OK);
    }
    else
    {
      $data=$this->produk->get_drink($id);
      if($data)
      {
        $this->response(['status'=>true, 'data'=>$data],RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>$id.' tidak ditemukan'],RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function drink_post()
  {
    $data=[
      'id_drink'=>$this->post('id_drink'),
      'nama_drink'=>$this->post('nama_drink'),
      'harga_drink'=>$this->post('harga_drink'),
      'availability'=>$this->post('availability')
    ];

    $simpan=$this->produk->add_drink($data);

    if($simpan['status'])
    {
      $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function drink_put()
  {
    $data=[
      'nama_drink'=>$this->put('nama_drink'),
      'harga_drink'=>$this->put('harga_drink'),
      'availability'=>$this->put('availability')
    ];

    $id=$this->put('id', true);

    if($id===null)
    {
      $this->response(['status'=>false, 'msg'=>'Masukkan kode yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->produk->update_drink($id, $data);

    if($simpan['status'])
    {
      $status=(int)$simpan['data'];
      if($status>0)
      {
        $this->response(['status'=>true, 'msg'=>$simpan['data']. ' data telah diubah'], RestController::HTTP_OK);
      }
      else
      {
        $this->response(['status'=>false, 'msg'=>'Tidak ada data diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else
    {
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }
}




/* End of file Toko.php */
/* Location: ./application/controllers/Toko.php */