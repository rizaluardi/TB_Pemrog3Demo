<!-- Updated by Rizaluardi-PC -->
<?php

class Model_Jadwal extends CI_Model
{
	 public function getDataJadwal($id_jadwal = null)
    {
        if ($id_jadwal === null) {
            $semua_data_jadwal = $this->db->get("jadwal_db")->result();
            return $semua_data_jadwal;
        } else {
            $data_dosen_byIdjadwal = $this->db->get_where('jadwal_db', ['id_jadwal' => $id_jadwal])->result();
            return $data_dosen_byIdjadwal;
        }
    }
	public function tambahJadwal($data)
	{
		$this->db->insert('jadwal', $data);
		return $this->db->affected_rows();
	}
	public function hapusJadwal($id_jadwal)
	{
		$this->db->delete('jadwal', ['id_jadwal' => $id_jadwal]);
		return $this->db->affected_rows();
	}
	public function ubahJadwal($data, $id_jadwal)
	{
		$this->db->update('jadwal', $data, ['id_jadwal' => $id_jadwal]);
		return $this->db->affected_rows();
	}
}