<!-- Updated by Rizaluardi-PC -->
<?php

class Model_Mahasiswa extends CI_Model
{
	
	 public function getDataMahasiswa($nim = null)
    {
        if ($nim === null) {
            $semua_data_mahasiswa = $this->db->get("mahasiswa_db")->result();
            return $semua_data_mahasiswa;
        } else {
            $data_mahasiswa_byNim = $this->db->get_where('mahasiswa_db', ['nim' => $nim])->result();
            return $data_mahasiswa_byNim;
        }
    }
	public function tambahMahasiswa($data)
	{
		$this->db->insert('mahasiswa', $data);
		return $this->db->affected_rows();
	}
	public function hapusMahasiswa($nim)
	{
		$this->db->delete('mahasiswa', ['nim' => $nim]);
		return $this->db->affected_rows();
	}
	public function ubahMahasiswa($data, $nim)
	{
		$this->db->update('mahasiswa', $data, ['nim' => $nim]);
		return $this->db->affected_rows();
	}
}