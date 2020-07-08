<!-- Updated by Rizaluardi-PC -->
<?php

class Model_Ruangan extends CI_Model
{
	
	public function getDataRuangan($kode_ruangan = null)
	{
		if ($kode_ruangan === null) {
			$semua_data_ruangan = $this->db->get("ruangan")->result();
			return $semua_data_ruangan;
		} else {
			$data_ruangan_bykode_ruangan = $this->db->get_where('ruangan', ['kode_ruangan' => $kode_ruangan])->result();
			return $data_ruangan_bykode_ruangan;
		}
	}
	public function tambahRuangan($data)
	{
		$this->db->insert('ruangan', $data);
		return $this->db->affected_rows();
	}
	public function hapusRuangan($kode_ruangan)
	{
		$this->db->delete('ruangan', ['kode_ruangan' => $kode_ruangan]);
		return $this->db->affected_rows();
	}
	public function ubahRuangan($data, $kode_ruangan)
	{
		$this->db->update('ruangan', $data, ['kode_ruangan' => $kode_ruangan]);
		return $this->db->affected_rows();
	}
}