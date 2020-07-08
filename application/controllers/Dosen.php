<!-- Updated by Rizaluardi-PC -->
<?php

require APPPATH.'/libraries/REST_Controller.php';
/**
 * 
 */
class Dosen extends REST_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Dosen', 'dsn');
	}
	//fungsi CRUD (GET,POST,PUT,DELETE) simpan di bawah fungsi constructor
	public function index_get(){
		$nip = $this->get('nip');
		if ($nip === null) {
			$data_dosen = $this->dsn->getDataDosen();
		} else {
			$data_dosen = $this->dsn->getDataDosen($nip);
		}
		if ($data_dosen) {
			$this->response(
				[
					'status' => true,
					'data_person' => $data_dosen
						
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

	public function index_post(){
		$nip = $this->post('nip');
		$nama_dosen = $this->post('nama_dosen');
		$tanggal_lahir = $this->post('tanggal_lahir');
		$jk = $this->post('jk');
		$no_telepon = $this->post('no_telepon');
		$alamat = $this->post('alamat');

		$data = [
			'nip' => $nip,
			'nama_dosen' => $nama_dosen,
			'tanggal_lahir' => $tanggal_lahir,
			'jk' => $jk,
			'no_telepon' => $no_telepon,
			'alamat' => $alamat
		];
		if ($nip === null || $nama_dosen === null || $tanggal_lahir === null || $jk === null || $no_telepon === null || $alamat === null) {
			//return $this->empty_response();
			$this->response(
				[
					'status' => false,
					'message' => 'data yang dikirimkan tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			//jika data tersimpan
			if ($this->dsn->tambahDosen($data) > 0) {
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
						'message' => 'Gagal menambahkan data'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
	//fungsi delete
	public function index_delete(){
		$nip = $this->delete('nip');
		if ($nip === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'nip tidak boleh kosong'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			if ($this->dsn->hapusDosen($nip) > 0){
				//kondisi ketika OK
				$this->response(
					[
						'status' => true,
						'message' => 'data dosen dengan nip : ' . $nip . ' berhasil dihapus'
					],
					REST_Controller::HTTP_OK
				);
			} else {
				$this->response(
					[
						'status' => false,
						'message' => 'data dosen dengan npm : ' . $nip . ' tidak ditemukan'
					],
					REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}

	//fungsi update
	public function index_put(){
		$nip = $this->put('nip');
		$datadsn = [
			'nama_dosen' => $this->put('nama_dosen'),
			'tanggal_lahir' => $this->put('tanggal_lahir'),
			'jk' => $this->put('jk'),
			'no_telepon' => $this->put('no_telepon'),
			'alamat' => $this->put('alamat') 
		];
		if ($nip === null) {
			$this->response(
				[
					'status' => false,
					'message' => 'nip tidak boleh kosong bro'
				],
				REST_Controller::HTTP_BAD_REQUEST
			);
		} else {
			//jika data tersimpan
			if($this->dsn->ubahDosen($datadsn, $nip) > 0){
				$this->response(
					[
						'status' => true,
						'message' => 'data dosen dengan nip : ' .$nip. ' berhasil diupdate'
					],
					REST_Controller::HTTP_CREATED
				);
			} else {
				$this->response(
				[
					'status' => false,
					'message' => 'data tidak ada yg di update'
				],
				REST_Controller::HTTP_BAD_REQUEST
				);
			}
		}
	}
}
?>