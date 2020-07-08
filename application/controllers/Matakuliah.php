<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Matakuliah extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Matakuliah', 'mkh');
	}

	public function index_get()
	{
		$kode_matakuliah = $this->get('kode_matakuliah');
		if ($kode_matakuliah === null) {
			$data_kode_matakuliah = $this->mkh->getDataMatakuliah();
		} else {

			$data_kode_matakuliah = $this->mkh->getDataMatakuliah($kode_matakuliah);
		}
		if ($data_kode_matakuliah) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_kode_matakuliah
				],
				REST_Controller::HTTP_OK
			);
		} else {
			$this->response(
				[
					'status' => false,
					'message' => "Data tidak ditemukan"
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		}
	}
	public function index_post()
	{
		$kode_matakuliah = $this->post('kode_matakuliah');
		$nama_matakuliah = $this->post('nama_matakuliah');
		$sks = $this->post('sks');


		$data = [
			'kode_matakuliah' => $kode_matakuliah,
			'nama_matakuliah' => $nama_matakuliah,
			'sks' => $sks
		];

		if ($kode_matakuliah === null || $nama_matakuliah === null || $sks === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mkh->tambahMatakuliah($data) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data berhasil ditambahkan'
					],
					REST_Controller::HTTP_CREATED
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'gagal menambahkan data'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_delete()
	{
		$kode_matakuliah = $this->delete('kode_matakuliah');
		if ($kode_matakuliah === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_matakuliah tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mkh->hapusMatakuliah($kode_matakuliah) > 0) {
				$this->response(
					[
						'status' => true,
						'kode_matakuliah' => $kode_matakuliah,
						'message' => 'data jurusan dengan ' . $kode_matakuliah . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data jurusan dengan ' . $kode_matakuliah . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$kode_matakuliah = $this->put('kode_matakuliah');
		$datamkh = [
			'nama_matakuliah' => $this->put('nama_matakuliah'),
			'sks' => $this->put('sks'),
		];
		if ($kode_matakuliah === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_matakuliah tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mkh->ubahMatakuliah($datamkh, $kode_matakuliah) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data jurusan dengan kode_matakuliah ' . $kode_matakuliah . ' berhasil diupdate'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data tidak ada yg diupdate'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
}