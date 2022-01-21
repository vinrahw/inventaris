<?php

namespace App\Controllers;

use App\Models\InventarisModel;

class Inventaris extends BaseController
{
    protected $inventarisModel;
    public function __construct()
    {
        $this->inventarisModel = new InventarisModel();
    }
    public function index()
    {


        $data = [
            'title' => 'Data ICT-BIDUS',
            'inventaris' => $this->inventarisModel->getInventaris()

        ];

        // $inventarisModel = new \App\Models\InventarisModel();
        // $inventarisModel = new InventarisModel();

        // if (empty($data['inventaris'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Ditemukan');
        // }

        return view('inventaris/index', $data);
    }


    public function create()
    {
        // session();
        $data = [
            'title' => 'Data Bidus | Tambah Data',
            'validation' => \Config\Services::validation()

        ];
        return view('inventaris/create', $data);
    }

    public function save()
    {

        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[inventaris.nama]',
                'errors' => [
                    'required' => '{field} inventaris harus diisi',
                    'is_unique' => '{field} inventaris sudah terdaftar'
                ]
            ],

            'jumlah' => [
                'rules' => 'required[inventaris.jumlah]',
                'errors' => [
                    'required' => '{field} inventaris harus diisi'
                ]
            ],


            'keterangan' => [
                'rules' => 'required[inventaris.keterangan]',
                'errors' => [
                    'required' => '{field} inventaris harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/inventaris/create')->withInput()->with('validation', $validation);
        }


        $this->inventarisModel->save([
            'nama' => $this->request->getVar('nama'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/inventaris');
    }

    public function delete($id)
    {
        $this->inventarisModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/inventaris');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Data Bidus | Ubah Data',
            'validation' => \Config\Services::validation(),
            'inventaris' => $this->inventarisModel->getInventaris($id)->getRow()

        ];
        return view('inventaris/edit', $data);
    }

    public function update($id)
    {
        $id = $this->request->getVar('id');
        $this->inventarisModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);


        session()->setFlashdata('pesan', 'Data Berhasil diubah');

        return redirect()->to('/inventaris');
    }
}
