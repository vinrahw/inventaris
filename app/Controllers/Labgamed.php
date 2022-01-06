<?php

namespace App\Controllers;

use App\Models\LabgamedModel;

class Labgamed extends BaseController
{
	protected $labgamedModel;
	public function __construct()
	{
		$this->labgamedModel = new LabgamedModel();
	}

	public function index()
	{


		$data = [
			'title' => 'Data Lab Game dan Multimedia',
			'labgamed' => $this->labgamedModel->getlabgamed()

		];

		// $labgamedModel = new \App\Models\labgamedModel();
		// $labgamedModel = new labgamedModel();

		// if (empty($data['labgamed'])) {
		//     throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Tidak Ditemukan');
		// }

		return view('labgamed/index', $data);
	}


	public function create()
	{
		// session();
		$data = [
			'title' => 'Data Bidus | Tambah Data',
			'validation' => \Config\Services::validation()

		];
		return view('labgamed/create', $data);
	}

	public function save()
	{

		//validasi input
		if (!$this->validate([
			'nama' => [
				'rules' => 'required|is_unique[labgamed.nama]',
				'errors' => [
					'required' => '{field} labgamed harus diisi',
					'is_unique' => '{field} labgamed sudah terdaftar'
				]
			],

			'jumlah' => [
				'rules' => 'required[labgamed.jumlah]',
				'errors' => [
					'required' => '{field} labgamed harus diisi'
				]
			],

			'kondisi' => [
				'rules' => 'required[labgamed.kondisi]',
				'errors' => [
					'required' => '{field} labgamed harus diisi'
				]
			],

			'keterangan' => [
				'rules' => 'required[labgamed.keterangan]',
				'errors' => [
					'required' => '{field} labgamed harus diisi'
				]
			]
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to('/labgamed/create')->withInput()->with('validation', $validation);
		}

		$this->labgamedModel->save([
			'nama' => $this->request->getVar('nama'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan')
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

		return redirect()->to('/labgamed');
	}

	public function delete($id)
	{
		$this->labgamedModel->delete($id);
		session()->setFlashdata('pesan', 'Data Berhasil dihapus');
		return redirect()->to('/labgamed');
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Data Bidus | Ubah Data',
			'validation' => \Config\Services::validation(),
			'labgamed' => $this->labgamedModel->getlabgamed($id)->getRow()

		];
		return view('labgamed/edit', $data);
	}

	public function update($id)
	{
		$id = $this->request->getVar('id');
		$this->labgamedModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan')
		]);

		session()->setFlashdata('pesan', 'Data Berhasil diubah');

		return redirect()->to('/labgamed');
	}
}
