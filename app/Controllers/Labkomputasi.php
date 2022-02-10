<?php

namespace App\Controllers;

use App\Models\LabkomputasiModel;

class Labkomputasi extends BaseController
{
  protected $labkomputasiModel;
  public function __construct()
  {
    $this->labkomputasiModel = new LabkomputasiModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'labkomputasi' => $this->labkomputasiModel->getLabkomputasi()

    ];

    return view('labkomputasi/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data komputasi | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('labkomputasi/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[labkomputasi.nama]',
        'errors' => [
          'required' => '{field} labkomputasi harus diisi',
          'is_unique' => '{field} labkomputasi sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[labkomputasi.jumlah]',
        'errors' => [
          'required' => '{field} labkomputasi harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[labkomputasi.keterangan]',
        'errors' => [
          'required' => '{field} labkomputasi harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/labkomputasi/create')->withInput()->with('validation', $validation);
    }

    $this->labkomputasiModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/labkomputasi');
  }

  public function delete($id)
  {
    $this->labkomputasiModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/labkomputasi');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data komputasi | Ubah Data',
      'validation' => \Config\Services::validation(),
      'labkomputasi' => $this->labkomputasiModel->getlabkomputasi($id)->getRow()

    ];
    return view('labkomputasi/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->labkomputasiModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/labkomputasi');
  }
}
