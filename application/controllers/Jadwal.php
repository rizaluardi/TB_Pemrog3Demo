<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Jadwal extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Jadwal', 'jdl');
	}

	public function index_get(){
		$id_jadwal = $this->get('id_jadwal');
		if ($id_jadwal === null) {
			$data_jadwal = $this->jdl->getDataJadwal();
		} else {
			$data_jadwal = $this->jdl->getDataJadwal($id_jadwal);
		}
		if ($data_jadwal) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_jadwal
						
				],
				REST_Controller::HTTP_OK
			);
		} else {
			$this->response(
				[
					'status' => false,
					'data_person' => "Data Tidak Ditemukan 404"
						
				],
				REST_Controller::HTTP_NOT_FOUND
			);
		}
	}
	public function index_post()
	{
		$id_jadwal = $this->post('id_jadwal');
		$kode_matakuliah_jadwal = $this->post('kode_matakuliah_jadwal');
		$nip_jadwal = $this->post('nip_jadwal');
		$kode_ruangan_jadwal = $this->post('kode_ruangan_jadwal');
		$kode_jurusan_jadwal = $this->post('kode_jurusan_jadwal');
		$hari = $this->post('hari');
		$jam = $this->post('jam');


		$data = [
			'id_jadwal' => $id_jadwal,
			'kode_matakuliah_jadwal' => $kode_matakuliah_jadwal,
			'nip_jadwal' => $nip_jadwal,
			'kode_ruangan_jadwal' => $kode_ruangan_jadwal,
			'kode_jurusan_jadwal' => $kode_jurusan_jadwal,
			'hari' => $hari,
			'jam' => $jam
		];

		if ($id_jadwal === null || $kode_matakuliah_jadwal === null || $nip_jadwal === null || $kode_ruangan_jadwal === null || $kode_jurusan_jadwal === null || $hari === null || $jam === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jdl->tambahJadwal($data) > 0) {
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
		$id_jadwal = $this->delete('id_jadwal');
		if ($id_jadwal === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'id_jadwal tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jdl->hapusJadwal($id_jadwal) > 0) {
				$this->response(
					[
						'status' => true,
						'id_jadwal' => $id_jadwal,
						'message' => 'data jadwal dengan ' . $id_jadwal . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data jadwal dengan ' . $id_jadwal . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$id_jadwal = $this->put('id_jadwal');
		$datajdl = [
			'kode_matakuliah_jadwal' => $this->put('kode_matakuliah_jadwal'),
			'nip_jadwal' => $this->put('nip_jadwal'),
			'kode_ruangan_jadwal' => $this->put('kode_ruangan_jadwal'),
			'kode_jurusan_jadwal' => $this->put('kode_jurusan_jadwal'),
			'hari' => $this->put('hari'),
			'jam' => $this->put('jam')
		];
		if ($id_jadwal === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'id_jadwal tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->jdl->ubahJadwal($datajdl, $id_jadwal) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data kode_ruangan_jadwal mahasiswa dengan id_jadwal ' . $id_jadwal . ' berhasil diupdate'
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