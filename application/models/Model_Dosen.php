<!-- Updated by Rizaluardi-PC -->
<?php

//extends class Model
/**
 * 
 */
class Model_Dosen extends CI_Model
{
	
	public function getDataDosen($nip = null)
	{
		if ($nip === null) {
			$semua_data_dosen = $this->db->get("dosen")->result();
			return $semua_data_dosen;
		} else {
			$data_dosen_byNip = $this->db->get_where('dosen', ['nip' => $nip])->result();
			return $data_dosen_byNip;
		}
	}
	//fungsi tambah data
	public function tambahDosen($data){
		//menggunakan query builder
		$this->db->insert('dosen', $data);
		return $this->db->affected_rows();
	}
	//fungsi hapus data
	public function hapusDosen($nip){
		//menggunakan query builder
		$this->db->delete('dosen', ['nip' => $nip]);
		return $this->db->affected_rows();
	}
	//fungsi update data mahasiswa
	public function ubahDosen($data, $nip){
		//menggunakan query builder
		$this->db->update('dosen', $data, ['nip' => $nip]);
		return $this->db->affected_rows();
	}
	
}
?>