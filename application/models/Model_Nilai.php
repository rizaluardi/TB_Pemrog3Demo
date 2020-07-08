<!-- Updated by Rizaluardi-PC -->
<?php

class Model_Nilai extends CI_Model
{
    public function getDataNilai($id_nilai = null)
    {
        if ($id_nilai === null) {
            $semua_data_nilai = $this->db->get("nilai_db")->result();
            return $semua_data_nilai;
        } else {
            $data_nilai_byIdnilai = $this->db->get_where('nilai_db', ['id_nilai' => $id_nilai])->result();
            return $data_nilai_byIdnilai;
        }
    }
	public function tambahNilai($data)
	{
		$this->db->insert('nilai', $data);
		return $this->db->affected_rows();
	}
	public function hapusNilai($id_nilai)
	{
		$this->db->delete('nilai', ['id_nilai' => $id_nilai]);
		return $this->db->affected_rows();
	}
	public function ubahNilai($data, $id_nilai)
	{
		$this->db->update('nilai', $data, ['id_nilai' => $id_nilai]);
		return $this->db->affected_rows();
	}
}