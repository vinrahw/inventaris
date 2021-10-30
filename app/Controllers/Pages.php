<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home | Inventaris Lab'
		];

		return view('pages/home', $data);
	}

	public function about()
	{
		$data = [
			'title' => 'About | Inventaris Lab'
		];
		return view('pages/about', $data);
	}

	public function contact()
	{
		$data = [
			'title' => 'Contact | Inventaris Lab'
		];
		return view('pages/contact', $data);
	}
}
