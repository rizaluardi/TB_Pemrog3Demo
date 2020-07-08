<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Ruangan extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Ruangan', 'rng');
	}

	public function index_get()
	{
		$kode_ruangan = $this->get('kode_ruangan');
		if ($kode_ruangan === null) {
			$data_kode_ruangan = $this->rng->getDataRuangan();
		} else {

			$data_kode_ruangan = $this->rng->getDataRuangan($kode_ruangan);
		}
		if ($data_kode_ruangan) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_kode_ruangan
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
		$kode_ruangan = $this->post('kode_ruangan');
		$nama_ruangan = $this->post('nama_ruangan');

		$data = [
			'kode_ruangan' => $kode_ruangan,
			'nama_ruangan' => $nama_ruangan
		];

		if ($kode_ruangan === null || $nama_ruangan === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->rng->tambahRuangan($data) > 0) {
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
		$kode_ruangan = $this->delete('kode_ruangan');
		if ($kode_ruangan === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_ruangan tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->rng->hapusRuangan($kode_ruangan) > 0) {
				$this->response(
					[
						'status' => true,
						'kode_ruangan' => $kode_ruangan,
						'message' => 'data jenjang dengan ' . $kode_ruangan . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data jenjang dengan ' . $kode_ruangan . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$kode_ruangan = $this->put('kode_ruangan');
		$datarng = [
			'nama_ruangan' => $this->put('nama_ruangan'),
		];
		if ($kode_ruangan === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'kode_ruangan tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->rng->ubahRuangan($datarng, $kode_ruangan) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data jenjang dengan kode_ruangan ' . $kode_ruangan . ' berhasil diupdate'
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