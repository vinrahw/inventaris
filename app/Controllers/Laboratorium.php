<?php
 
namespace App\Controllers;

use App\Models\LaboratoriumModel;

class Laboratorium extends BaseController
{
  protected $laboratoriumModel;
  public function __construct()
  {
    $this->laboratoriumModel = new LaboratoriumModel();
  }

  public function index()
  {


    $data = [
      'title' => 'Data Lab Game dan Multimedia',
      'laboratorium' => $this->laboratoriumModel->getLaboratorium()

    ];

    return view('laboratorium/index', $data);
  }


  public function create()
  {

    $data = [
      'title' => 'Data komputasi | Tambah Data',
      'validation' => \Config\Services::validation()

    ];
    return view('laboratorium/create', $data);
  }

  public function save()
  {

    //validasi input
    if (!$this->validate([
      'nama' => [
        'rules' => 'required|is_unique[laboratorium.nama]',
        'errors' => [
          'required' => '{field} laboratorium harus diisi',
          'is_unique' => '{field} laboratorium sudah terdaftar'
        ]
      ],

      'jumlah' => [
        'rules' => 'required[laboratorium.jumlah]',
        'errors' => [
          'required' => '{field} laboratorium harus diisi'
        ]
      ],


      'keterangan' => [
        'rules' => 'required[laboratorium.keterangan]',
        'errors' => [
          'required' => '{field} laboratorium harus diisi'
        ]
      ]
    ])) {
      $validation = \Config\Services::validation();
      return redirect()->to('/laboratorium/create')->withInput()->with('validation', $validation);
    }

    $this->laboratoriumModel->save([
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

    return redirect()->to('/laboratorium');
  }

  public function delete($id)
  {
    $this->laboratoriumModel->delete($id);
    session()->setFlashdata('pesan', 'Data Berhasil dihapus');
    return redirect()->to('/laboratorium');
  }

  public function edit($id)
  {
    $data = [
      'title' => 'Data komputasi | Ubah Data',
      'validation' => \Config\Services::validation(),
      'laboratorium' => $this->laboratoriumModel->getlaboratorium($id)->getRow()

    ];
    return view('laboratorium/edit', $data);
  }

  public function update($id)
  {
    $id = $this->request->getVar('id');
    $this->laboratoriumModel->save([
      'id' => $id,
      'nama' => $this->request->getVar('nama'),
      'jumlah' => $this->request->getVar('jumlah'),
      'spesifikasi_lab' => $this->request->getVar('spesifikasi_lab'),
      'cctv' => $this->request->getVar('cctv'),
      'keterangan' => $this->request->getVar('keterangan')
    ]);

    session()->setFlashdata('pesan', 'Data Berhasil diubah');

    return redirect()->to('/laboratorium');
  }
}
