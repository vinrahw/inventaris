<?php

namespace App\Controllers;

use App\Models\LabalgoprogModel;

class Labalgoprog extends BaseController
{
  protected $labalgoprogModel;
  public function __construct()
  {
    $this->labalgoprogModel = new LabalgoprogModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'labalgoprog' => $this->labalgoprogModel->getLabalgoprog()

    ];

    return view('labalgoprog/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data algoprog | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('labalgoprog/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[labalgoprog.nama]',
        'errors' => [
          'required' => '{field} labalgoprog harus diisi',
          'is_unique' => '{field} labalgoprog sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[labalgoprog.jumlah]',
        'errors' => [
          'required' => '{field} labalgoprog harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[labalgoprog.keterangan]',
        'errors' => [
          'required' => '{field} labalgoprog harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/labalgoprog/create')->withInput()->with('validation', $validation);
    }

    $this->labalgoprogModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/labalgoprog');
  }

  public function delete($id)
  {
    $this->labalgoprogModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/labalgoprog');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data algoprog | Ubah Data',
      'validation' => \Config\Services::validation(),
      'labalgoprog' => $this->labalgoprogModel->getlabalgoprog($id)->getRow()

    ];
    return view('labalgoprog/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->labalgoprogModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/labalgoprog');
  }
}
