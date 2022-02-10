<?php

namespace App\Controllers;

use App\Models\ItsupportModel;

class Itsupport extends BaseController
{
    protected $itsupportModel;
    public function __construct()
    {
        $this->itsupportModel = new ItsupportModel();
    }
    public function index()
    {


        $data = [
            'title' => 'Data IT-SUPPORT',
            'itsupport' => $this->itsupportModel->getItsupport()


        ];

        // if (empty($data['itsupport'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Data Tidak Ditemukan');
        // }

        return view('itsupport/index', $data);
    }


    public function create()
    {
        // session();
        $data = [
            'title' => 'Data IT-Support | Tambah Data',
            'validation' => \Config\Services::validation()

        ];
        return view('itsupport/create', $data);
    }


    public function save()
    {

        //validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[itsupport.nama]',
                'errors' => [
                    'required' => '{field}  harus diisi',
                    'is_unique' => '{field}  sudah terdaftar'
                ]
            ],

            'jumlah' => [
                'rules' => 'required[itsupport.jumlah]',
                'errors' => [
                    'required' => '{field}  harus diisi'
                ]
            ],

            'keterangan' => [
                'rules' => 'required[itsupport.keterangan]',
                'errors' => [
                    'required' => '{field}  harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/itsupport/create')->withInput()->with('validation', $validation);
        }

        $this->itsupportModel->save([
            'nama' => $this->request->getVar('nama'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/itsupport');
    }

    public function delete($id)
    {
        $this->itsupportModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/itsupport');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Data Bidus | Ubah Data',
            'validation' => \Config\Services::validation(),
            'itsupport' => $this->itsupportModel->getItsupport($id)->getRow()

        ];
        return view('itsupport/edit', $data);
    }

    public function update($id)
    {
        $id = $this->request->getVar('id');
        $this->itsupportModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'jumlah' => $this->request->getVar('jumlah'),
            'kondisi' => $this->request->getVar('kondisi'),
            'keterangan' => $this->request->getVar('keterangan')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');

        return redirect()->to('/itsupport');
    }
}
