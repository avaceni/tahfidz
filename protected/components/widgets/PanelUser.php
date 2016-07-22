<?php

class PanelUser extends CWidget {
    public $santri;
    public $link;
    public $santri_array;

    public function init() {
        
    }

    public function run() {
        $this->prepareData();
        $this->renderView();
    }
    
    private function prepareData() {
        $last_recitation = Santri::getLastRecitation($this->santri->id);
        $this->santri_array['nama_lengkap'] = ucwords($this->santri->nama_lengkap);
        $this->santri_array['juz'] = !empty(Santri::getJuz($this->santri->id)) ? floor(Santri::getJuz($this->santri->id)) . " Juz" : "- Juz";
        $this->santri_array['sekolah'] = ($this->santri->user->getSantriEducation() != '') ? $this->santri->user->getSantriEducation() . ', ' : '';
        $this->santri_array['umur'] = Utility::calcutateAge($this->santri->tanggal_lahir);
        $this->santri_array['pondok'] = ucwords($this->santri->user->getPondokan());        
        $this->santri_array['hafalan'] = !empty($last_recitation) ? "Juz " . $last_recitation['juz'] . " Halaman " . $last_recitation['halaman'] : '-';
        $this->santri_array['ustadz'] = !empty($this->santri->user->getUstadz())?$this->santri->user->getUstadz()['name']:'-';
        $this->santri_array['action'] = Yii::app()->createAbsoluteUrl('santri/data/photoupload', array('id'=>$this->santri->id));
        $this->santri_array['image'] = ( new User())->getPhotoUrl($this->santri->id);
    }    

    private function renderView() {
        $this->render('panel_user');
    }
}

?>
