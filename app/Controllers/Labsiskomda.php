<?php

namespace App\Controllers;

use App\Models\LabsiskomdaModel;

class Labsiskomda extends BaseController
{
	protected $labsiskomdaModel;
	public function __construct()
	{
		$this->labsiskomdaModel = new LabsiskomdaModel();
	}
	public function index()
	{
		$data = [
			'title' => 'Data Lab Sistem Komputer',
			'labsiskomda' => $this->labsiskomdaModel->getLabsiskomda()
		];

		return view('labsiskomda/index', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Data Lab Sistem Komputer',
			'validation' => \Config\Services::validation()
		];
		return view('labsiskomda/create', $data);
	}

	public function save()
	{
		//validasi input
		if (!$this->validate([
			'nama' => [
				'rules' => 'required|is_unique[labsiskomda.nama]',
				'errors' => [
					'required' => '{field}  harus diisi',
					'is_unique' => '{field}  sudah terdaftar'
				]
			],

			'jumlah' => [
				'rules' => 'required[labsiskomda.jumlah]',
				'errors' => [
					'required' => '{field}  harus diisi'
				]
			],

			'keterangan' => [
				'rules' => 'required[labsiskomda.keterangan]',
				'errors' => [
					'required' => '{field}  harus diisi'
				]
			]
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to('/labsiskomda/create')->withInput()->with('validation', $validation);
		}

		$this->labsiskomdaModel->save([
			'nama' => $this->request->getVar('nama'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan')
		]);

		session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

		return redirect()->to('/labsiskomda');
	}

	public function delete($id)
	{
		$this->labsiskomdaModel->delete($id);
		session()->setFlashdata('pesan', 'Data Berhasil dihapus');
		return redirect()->to('/labsiskomda');
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Data Bidus | Ubah Data',
			'validation' => \Config\Services::validation(),
			'labsiskomda' => $this->labsiskomdaModel->getLabsiskomda($id)->getRow()

		];
		return view('labsiskomda/edit', $data);
	}

	public function update($id)
	{
		$id = $this->request->getVar('id');
		$this->labsiskomdaModel->save([
			'id' => $id,
			'nama' => $this->request->getVar('nama'),
			'jumlah' => $this->request->getVar('jumlah'),
			'keterangan' => $this->request->getVar('keterangan')
		]);

		session()->setFlashdata('pesan', 'Data Berhasil diubah');

		return redirect()->to('/labsiskomda');
	}
}
