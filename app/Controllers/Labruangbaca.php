<?php

namespace App\Controllers;

use App\Models\LabruangbacaModel;

class Labruangbaca extends BaseController
{
  protected $labruangbacaModel;
  public function __construct()
  {
    $this->labruangbacaModel = new LabruangbacaModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'labruangbaca' => $this->labruangbacaModel->getLabruangbaca()

    ];

    return view('labruangbaca/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data ruangbaca | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('labruangbaca/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[labruangbaca.nama]',
        'errors' => [
          'required' => '{field} labruangbaca harus diisi',
          'is_unique' => '{field} labruangbaca sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[labruangbaca.jumlah]',
        'errors' => [
          'required' => '{field} labruangbaca harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[labruangbaca.keterangan]',
        'errors' => [
          'required' => '{field} labruangbaca harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/labruangbaca/create')->withInput()->with('validation', $validation);
    }

    $this->labruangbacaModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/labruangbaca');
  }

  public function delete($id)
  {
    $this->labruangbacaModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/labruangbaca');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data ruangbaca | Ubah Data',
      'validation' => \Config\Services::validation(),
      'labruangbaca' => $this->labruangbacaModel->getlabruangbaca($id)->getRow()

    ];
    return view('labruangbaca/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->labruangbacaModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/labruangbaca');
  }
}
