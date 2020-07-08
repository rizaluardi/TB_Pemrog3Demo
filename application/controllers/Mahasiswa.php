<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH . 'libraries/REST_Controller.php';

class Mahasiswa extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Mahasiswa', 'mhs');
	}

	public function index_get()
	{
		$nim = $this->get('nim');
		if ($nim === null) {
			$data_nim = $this->mhs->getDataMahasiswa();
		} else {

			$data_nim = $this->mhs->getDataMahasiswa($nim);
		}
		if ($data_nim) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_nim
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
		$nim = $this->post('nim');
		$nama_mahasiswa = $this->post('nama_mahasiswa');
		$tanggal_lahir = $this->post('tanggal_lahir');
		$jk = $this->post('jk');
		$no_telepon = $this->post('no_telepon');
		$alamat = $this->post('alamat');
		$kode_jurusan_mhs = $this->post('kode_jurusan_mhs');


		$data = [
			'nim' => $nim,
			'nama_mahasiswa' => $nama_mahasiswa,
			'tanggal_lahir' => $tanggal_lahir,
			'jk' => $jk,
			'no_telepon' => $no_telepon,
			'alamat' => $alamat,
			'kode_jurusan_mhs' => $kode_jurusan_mhs
		];

		if ($nim === null || $nama_mahasiswa === null || $tanggal_lahir === null || $jk === null || $no_telepon === null || $alamat === null || $kode_jurusan_mhs === null) {
			$this->response(
				[
					'status' =>false,
					'message' => 'data yang dikirimkan tidak boleh ada yang kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mhs->tambahMahasiswa($data) > 0) {
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
		$nim = $this->delete('nim');
		if ($nim === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'nim tidak ditemukan'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mhs->hapusMahasiswa($nim) > 0) {
				$this->response(
					[
						'status' => true,
						'nim' => $nim,
						'message' => 'data mahasiswa dengan ' . $nim . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data mahasiswa dengan ' . $nim . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	public function index_put()
	{
		$nim = $this->put('nim');
		$datamhs = [
			'nama_mahasiswa' => $this->put('nama_mahasiswa'),
			'tanggal_lahir' => $this->put('tanggal_lahir'),
			'jk' => $this->put('jk'),
			'no_telepon' => $this->put('no_telepon'),
			'alamat' => $this->put('alamat'),
			'kode_jurusan_mhs' => $this->put('kode_jurusan_mhs'),
		];
		if ($nim === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'nim tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->mhs->ubahMahasiswa($datamhs, $nim) > 0) {
				$this->response(
					[
						'status' => true,
						'message' => 'data mahasiswa dengan nim ' . $nim . ' berhasil diupdate'
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