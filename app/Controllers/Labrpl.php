<?php

namespace App\Controllers;

use App\Models\LabrplModel;

class Labrpl extends BaseController
{
  protected $labrplModel;
  public function __construct()
  {
    $this->labrplModel = new LabrplModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'labrpl' => $this->labrplModel->getLabrpl()

    ];

    return view('labrpl/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data rpl | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('labrpl/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[labrpl.nama]',
        'errors' => [
          'required' => '{field} labrpl harus diisi',
          'is_unique' => '{field} labrpl sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[labrpl.jumlah]',
        'errors' => [
          'required' => '{field} labrpl harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[labrpl.keterangan]',
        'errors' => [
          'required' => '{field} labrpl harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/labrpl/create')->withInput()->with('validation', $validation);
    }

    $this->labrplModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/labrpl');
  }

  public function delete($id)
  {
    $this->labrplModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/labrpl');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data rpl | Ubah Data',
      'validation' => \Config\Services::validation(),
      'labrpl' => $this->labrplModel->getlabrpl($id)->getRow()

    ];
    return view('labrpl/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->labrplModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/labrpl');
  }
}
