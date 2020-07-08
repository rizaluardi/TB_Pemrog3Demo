<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Jenjang extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Jenjang', 'jnj');
	}

	public function index_get()
	{
		$kode_jenjang = $this->get('kode_jenjang');
		if ($kode_jenjang === null) {
			$data_kode_jenjang = $this->jnj->getDataJenjang();
		} else {

			$data_kode_jenjang = $this->jnj->getDataJenjang($kode_jenjang);
		}
		if ($data_kode_jenjang) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_kode_jenjang
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
		$kode_jenjang = $this->post('kode_jenjang');
		$nama_jenjang = $this->post('nama_jenjang');

		$data = [
			'kode_jenjang' => $kode_jenjang,
			'nama_jenjang' => $nama_jenjang
		];

		if ($kode_jenjang === null || $nama_jenjang === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jnj->tambahJenjang($data) > 0) {
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
		$kode_jenjang = $this->delete('kode_jenjang');
		if ($kode_jenjang === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_jenjang tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jnj->hapusJenjang($kode_jenjang) > 0) {
				$this->response(
					[
						'status' => true,
						'kode_jenjang' => $kode_jenjang,
						'message' => 'data jenjang dengan ' . $kode_jenjang . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data jenjang dengan ' . $kode_jenjang . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$kode_jenjang = $this->put('kode_jenjang');
		$datajnj = [
			'nama_jenjang' => $this->put('nama_jenjang'),
		];
		if ($kode_jenjang === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_jenjang tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jnj->ubahJenjang($datajnj, $kode_jenjang) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data jenjang dengan kode_jenjang ' . $kode_jenjang . ' berhasil diupdate'
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