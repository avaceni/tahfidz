<?php

class RegistrationForm extends CFormModel {

    public $registrasi_id;
    public $user_id;
    public $pendidikan_id;
    public $tingkat;
    public $tanggal_registrasi_ulang;
    public $pondok_id;
    public $keterangan_pindah;
    public $tanggal_pindah_pondok;
    public $kelompok;
    public $tanggal_dibuat;

    public function rules() {
        return array(
            array('user_id', 'required'),
            array('user_id, pendidikan_id, tingkat, tanggal_registrasi_ulang, pondok_id,'
                . 'keterangan_pindah, tanggal_pindah_pondok, kelompok, tanggal_dibuat, registrasi_id', 'safe'),
        );
    }

    public function attributeLabels() {
        return array(
            'user_id' => 'Santri',
            'pendidikan_id' => 'Pendidikan',
            'tingkat' => 'Kelas/Semester',
            'tanggal_registrasi_ulang' => 'Tanggal Registrasi Ulang',
            'pondok_id' => 'Asrama',
            'keterangan_pindah' => 'Keterangan Pindah Pondok',
            'tanggal_pindah_pondok' => 'Tanggal Pindah Pondok',
            'kelompok' => 'Halaqoh',
            'tanggal_dibuat' => 'Tanggal Gabung Halaqoh',
        );
    }

}
