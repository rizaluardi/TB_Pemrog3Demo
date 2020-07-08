<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Nilai extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Nilai', 'nl');
	}

	public function index_get()
	{
		$id_nilai = $this->get('id_nilai');
		if ($id_nilai === null) {
			$data_id_nilai = $this->nl->getDataNilai();
		} else {

			$data_id_nilai = $this->nl->getDataNilai($id_nilai);
		}
		if ($data_id_nilai) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_id_nilai
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
		$id_nilai = $this->post('id_nilai');
		$nim_nilai = $this->post('nim_nilai');
		$kode_matakuliah_nilai = $this->post('kode_matakuliah_nilai');
		$nilai = $this->post('nilai');


		$data = [
			'id_nilai' => $id_nilai,
			'nim_nilai' => $nim_nilai,
			'kode_matakuliah_nilai' => $kode_matakuliah_nilai,
			'nilai' => $nilai
		];

		if ($id_nilai === null || $nim_nilai === null || $kode_matakuliah_nilai === null || $nilai === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->nl->tambahNilai($data) > 0) {
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
		$id_nilai = $this->delete('id_nilai');
		if ($id_nilai === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'id_nilai tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->nl->hapusNilai($id_nilai) > 0) {
				$this->response(
					[
						'status' => true,
						'id_nilai' => $id_nilai,
						'message' => 'data nilai mahasiswa dengan ' . $id_nilai . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data nilai mahasiswa dengan ' . $id_nilai . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$id_nilai = $this->put('id_nilai');
		$datanl = [
			'nim_nilai' => $this->put('nim_nilai'),
			'kode_matakuliah_nilai' => $this->put('kode_matakuliah_nilai'),
			'nilai' => $this->put('nilai')
		];
		if ($id_nilai === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'id_nilai tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->nl->ubahNilai($datanl, $id_nilai) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data nilai mahasiswa dengan id_nilai ' . $id_nilai . ' berhasil diupdate'
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