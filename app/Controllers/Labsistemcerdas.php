<?php

namespace App\Controllers;

use App\Models\LabsistemcerdasModel;

class Labsistemcerdas extends BaseController
{
  protected $labsistemcerdasModel;
  public function __construct()
  {
    $this->labsistemcerdasModel = new LabsistemcerdasModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'labsistemcerdas' => $this->labsistemcerdasModel->getLabsistemcerdas()

    ];

    return view('labsistemcerdas/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data sistemcerdas | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('labsistemcerdas/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[labsistemcerdas.nama]',
        'errors' => [
          'required' => '{field} labsistemcerdas harus diisi',
          'is_unique' => '{field} labsistemcerdas sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[labsistemcerdas.jumlah]',
        'errors' => [
          'required' => '{field} labsistemcerdas harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[labsistemcerdas.keterangan]',
        'errors' => [
          'required' => '{field} labsistemcerdas harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/labsistemcerdas/create')->withInput()->with('validation', $validation);
    }

    $this->labsistemcerdasModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/labsistemcerdas');
  }

  public function delete($id)
  {
    $this->labsistemcerdasModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/labsistemcerdas');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data sistemcerdas | Ubah Data',
      'validation' => \Config\Services::validation(),
      'labsistemcerdas' => $this->labsistemcerdasModel->getlabsistemcerdas($id)->getRow()

    ];
    return view('labsistemcerdas/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->labsistemcerdasModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/labsistemcerdas');
  }
}
