<?php
/**
 * Kelas Controller untuk mengelola data hafalan
 *
 * Berisi action-action untuk mengelola data hafalan, mulai dari
 * melihat daftar hafalan, menambah, menghapus
 *
 * @since 1.0.0
 */
class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            );
    }
/**
 * Action untuk halaman kelola setoran hafalan santri maupun ustadz disertai filter tampilan data
 *
 * Menampilkan daftar setoran hafalan terbaru dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin, ustadz
 *
 * @param int $_GET['pondok-santri'] (filter-optional)
 * @param int $_GET['gender-santri'] (filter-optional)
 * @param int $_GET['bulan'] (filter-optional)
 * @param int $_GET['tahun'] (filter-optional)
 * @param int $_GET['search-santri-santri'] (filter-optional) keyword nama santri
 *
 * @param int $_GET['pondok-ustadz'] (filter-optional)
 * @param int $_GET['gender-ustadz'] (filter-optional)
 * @param int $_GET['search-santri-ustadz'] (filter-optional) keyword nama ustadz
 *
 * @return page kelola hafalan
 */
    public function actionManage() {
        if(isset($_POST) && !empty($_POST)){
            echo json_encode('');
            Yii::app()->end();
        }
        // mengeset kelompok halaqoh terakhir jika yang dicari hafalan ustadz  
        if($this->cklt_user->group_id == 12){
            if(!empty($this->halaqoh_last)){
                $param_santri['kelompok'] = $this->halaqoh_last->kelompok;
            }
            else{
                $param_santri['kelompok'] = 0;                
            }
        }
        // mengeset hafalan pertama santri untuk membuat opsi tahun
        $first_recitation_santri = (new MutabaahTahfidz())->getFirstLastRecitationByGroup(13,'ASC');
        // mengeset hafalan pertama santri untuk membuat opsi tahun
        $last_recitation_santri = (new MutabaahTahfidz())->getFirstLastRecitationByGroup(13,'DESC');
        // mengeset opsi filter tahun
        $year_sequence_santri = array();
        if(!empty($first_recitation_santri)){
            for($i=date('Y', strtotime($first_recitation_santri->tanggal));$i<=date('Y', strtotime($last_recitation_santri->tanggal));$i++){
                $year_sequence_santri[$i] = $i;
            }
        }
        $year_sequence_santri[date('Y', time())] = date('Y', time());
        $last_month_recite_santri = '';
        $last_year_recite_santri = '';
        if(!empty($last_recitation_santri)){
            $last_month_recite_santri = date('n', strtotime($last_recitation_santri->tanggal));
            $last_year_recite_santri = date('Y', strtotime($last_recitation_santri->tanggal));
        }
        
        $param_santri['nama_lengkap'] = Yii::app()->request->getParam('search-santri-santri');
        $param_santri['jenis_kelamin'] = Yii::app()->request->getParam('gender-santri');
        $param_santri['pondok_id'] = Yii::app()->request->getParam('pondok-santri');
        $param_santri['bulan'] = Yii::app()->request->getParam('bulan', $last_month_recite_santri);
        $param_santri['tahun'] = Yii::app()->request->getParam('tahun', $last_year_recite_santri);
        $param_santri['group'] = 13;
        
        $model_santri = (new MutabaahTahfidz())->getAllHafalan($param_santri);
        $param_ustadz['nama_lengkap'] = Yii::app()->request->getParam('search-santri-ustadz');
        $param_ustadz['jenis_kelamin'] = Yii::app()->request->getParam('gender-ustadz');
        $param_ustadz['pondok_id'] = Yii::app()->request->getParam('pondok-ustadz');
        $param_ustadz['group'] = 12;
        $model_ustadz = (new MutabaahTahfidz())->getAllHafalan($param_ustadz);
        $model_add = new MutabaahTahfidz();
        $this->render('index', array(
            'model_santri' => $model_santri,
            'model_ustadz' => $model_ustadz,
            'model_add' => $model_add,
            'year_sequence_santri' => $year_sequence_santri,
            'last_month_recite_santri' => $last_month_recite_santri,
            'last_year_recite_santri' => $last_year_recite_santri,
            ));
    }
/**
 * Action untuk halaman kelola hafalan santri tertentu sekaligus menambahkan hafalan baru
 *
 * Menampilkan daftar hafalan dalam bentuk tabel yang disertai opsi hapus
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['id'] id santri yang ingin dicari hafalannya
 * @param int $_GET['bulan'] (filter-optional)
 * @param int $_GET['tahun'] (filter-optional)
 *
 * @return page kelola hafalan santri ...
 */
    public function actionView($id) {
        $param['bulan'] = Yii::app()->request->getParam('bulan');
        $param['tahun'] = Yii::app()->request->getParam('tahun');
        $param['id'] = Yii::app()->request->getParam('id');

        // mengeset hafalan pertama santri untuk membuat opsi tahun        
        $first_hafalan = MutabaahTahfidz::model()->find(array('condition'=>"santri_id = {$id}", 'order' => 'tanggal ASC'));
        // mengeset hafalan terakhir santri untuk membuat opsi tahun
        $last_hafalan = MutabaahTahfidz::model()->find(array('condition'=>"santri_id = {$id}", 'order' => 'tanggal DESC'));        

        $year_sequence = array();
        if(!empty($first_hafalan)){
            for($i=date('Y', strtotime($first_hafalan->tanggal));$i<=date('Y', strtotime($last_hafalan->tanggal));$i++){
                $year_sequence[$i] = $i;
            }
        }
        $year_sequence[date('Y', time())] = date('Y', time());
        
        $last_month_recite = '';
        $last_year_recite = 'all';
        if(!empty($last_hafalan)){
            $last_month_recite = date('n', strtotime($last_hafalan->tanggal));
            $last_year_recite = date('Y', strtotime($last_hafalan->tanggal));
        }
        
        $model = (new MutabaahTahfidz())->filterDateHafalan($param, $last_month_recite, $last_year_recite);
        
        $model_add = new MutabaahTahfidz();
        $model_detail = (new Santri())->loadModel($id);
        
        $param_ringkasan['id'] = Yii::app()->request->getParam('id');
        $data = (new MutabaahTahfidz())->getSummary($param_ringkasan, $last_month_recite, $last_year_recite);
        $absent = (new MutabaahTahfidz())->getAbsentDay($param, $last_month_recite, $last_year_recite);
        
        $this->render('view', array('model' => $model, 'model_add' => $model_add,
            'data' => $data,
            'model_detail' => $model_detail, 'ustadz' => $model_detail->user->getUstadz(),
            'year_sequence' => $year_sequence, 'last_month_recite' => $last_month_recite,
            'last_year_recite' => $last_year_recite,
            'absent' => $absent,
            ));
    }
/**
 * Action untuk menambah data hafalan santri
 *
 * Menambahkan data hafalan sesuai atribut yang dikirimkan
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param array $_POST['MutabaahTahfidz'] (optional)
 *      @param string ['MutabaahTahfidz']['search-santri'] keyword nama santri untuk auto suggest jika santri belum dipilih (id = null)
 *      @param int ['MutabaahTahfidz']['absensi'] (1=masuk,2=izin sakit,3=izin lain,4=tanpa keterangan,5=lain-lain)
 *      @param int ['MutabaahTahfidz']['tipe'] (1=ziyadah,2=binadhor,3=murojaah,4=muqaddimah) 
 *      @param int ['MutabaahTahfidz']['setoran_halaman'] (halaman 1-30)
 *      @param int ['MutabaahTahfidz']['ustadz_id'] (id user ustadnya)
 *      @param string ['MutabaahTahfidz']['keterangan']
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional)  
 */
    public function actionAddHafalan() {
        $result = array();
        if (isset($_POST['MutabaahTahfidz']) && !empty($_POST['MutabaahTahfidz'])) {
            $model = new MutabaahTahfidz();
            $model->attributes = $_POST['MutabaahTahfidz'];
            if($this->cklt_user->group_id != 10){
                if(!empty($_POST['MutabaahTahfidz']['santri_id'])){
                    if(!(new Santri())->isMyStudent($model->santri_id, $this->halaqoh_member_list)){
                        throw new CHttpException(404,'The requested page does not exist.');
                    }
                }
            }
            $model->tanggal = date('Y-m-d H:i:s', time());
            $model->nilai = !empty($_POST['MutabaahTahfidz']['nilai']) ? $_POST['MutabaahTahfidz']['nilai'] : 'tidak lulus';
            $model->yang_terbaru = 1;
            if ($_POST['MutabaahTahfidz']['absensi'] == 1) {
                if(!empty($model->setoran_juz) && $model->setoran_juz < 0){
                    $model->setScenario('foursurrah');
                }
                else {
                    $model->setScenario('juz');
                }
            } else {
                $model->setScenario('absent');
            }
            if ($model->validate()) {
                $model->save();
                $result = array('success' => 1, 'messages' => '');
            } else {
                $result = array('success' => 0, 'messages' => $model->errors);
            }
        }
        echo json_encode($result);
    }
/**
 * Action untuk mencari id, nama, foto santri berdasarkan keyword namanya
 *
 * Menampilkan daftar nama beserta foto santri yang sesuai berdasarkan keyword
 * untuk auto suggest
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['query'] keyword nama santri
 *
 * @return string json daftar santri yang sesuai
 */
    public function actionSearchSantri() {
        $halaqoh = '';
        if($this->cklt_user->group_id == 12){
            $halaqoh = $this->halaqoh_last->kelompok;
        }
        $query = Yii::app()->request->getQuery('query');
        $group = 13;
        $result = array();
        if (!empty($query)) {
            $result = $this->getSearchUser($query, $group, $halaqoh);
        }
        echo json_encode($result);
    }
/**
 * Action untuk mencari id, nama, foto ustadz berdasarkan keyword namanya
 *
 * Menampilkan daftar nama beserta foto ustadz yang sesuai berdasarkan keyword
 * untuk auto suggest
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['query'] keyword nama ustadz
 *
 * @return string json daftar ustadz yang sesuai
 */
    public function actionSearchUstadz() {
        $query = Yii::app()->request->getQuery('query');
        $group = 12;
        $result = array();
        if (!empty($query)) {
            $result = $this->getSearchUser($query, $group);
        }
        echo json_encode($result);
    }
/**
 * Fungsi untuk mencari id, nama, foto pengguna berdasarkan keyword nama dan grupnya
 *
 * Menampilkan daftar nama beserta foto pengguna yang sesuai berdasarkan keyword
 * untuk auto suggest
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['query'] keyword nama pengguna
 *
 * @return string json daftar pengguna yang sesuai
 */
    public function getSearchUser($name, $group, $halaqoh = NULL) {
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'user' => array('alias' => 'a'),
            'user.riwayatKelompoks' => array('alias' => 'b'),
            );
        
        if (!empty($halaqoh)) {
            $criteria->compare('b.kelompok', $halaqoh);
            $criteria->compare('b.aktif', 1);
            $criteria->together = true;
        }
        $criteria->compare('a.group_id', $group);
        $criteria->compare('t.nama_lengkap', $name, TRUE);
        
        $model = Santri::model()->findAll($criteria);
        if (!empty($model)) {
            foreach ($model as $santri) {
                $result[] = array('id' => $santri->id, 'name' => ucwords($santri->nama_lengkap), 'photo' => $santri->user->getPhotoIconUrl($santri->id));
            }
        }
        return $result;
    }
/**
 * Action untuk menghapus data hafalan berdasarkan id
 *
 * Menghapus baris data pada tabel mutabaah_tahfidz
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $id id hafalan.
 *
 * @return bool kondisi sukses
 */
    public function actionDelete($id) {
        $model_hafalan = (new MutabaahTahfidz)->loadModelId($id);
        if($this->cklt_user->group_id != 10){
            if(!(new Santri())->isMyStudent($model_hafalan->santri_id, $this->halaqoh_member_list)){
                throw new CHttpException(404,'The requested page does not exist.');
            }
        }
        if (!empty($id)) {
            (new MutabaahTahfidz())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa data hafalan berdasarkan id
 *
 * Menghapus baris data pada tabel mutabaah_tahfidz
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $id id hafalan (multi).
 *
 * @return string json jumlah hafalan yang berhasil dihapus
 */
    public function actionDeleteAll() {
        $result = array('total_delete' => 0);
        if (isset($_POST['id'])) {
            $model_hafalan = (new MutabaahTahfidz)->loadModelId($_POST['id']);
            if($this->cklt_user->group_id != 10){
                if(!(new Santri())->isMyStudent($model_hafalan->santri_id, $this->halaqoh_member_list)){
                    throw new CHttpException(404,'The requested page does not exist.');
                }
            }
            $result['total_delete'] = MutabaahTahfidz::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk melihat rangkuman hafalan santri tertentu berdasarkan bulan dan tahunnya
 *
 * Membuat "buku rapor" hafalan santri tiap bualannya
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $id id santri
 * @param int $_POST['bulan']
 * @param int $_POST['tahun'] 
 *
 * @return html dialog rapor hafalan bulanan santri
 */    
    public function actionSummaryFilter($id) {
        $param['bulan'] = Yii::app()->request->getPost('bulan');
        $param['tahun'] = Yii::app()->request->getPost('tahun');
        $param['id'] = $id;
        //mengeset hafalan pertama santri untuk opsi tahun
        $first_hafalan = MutabaahTahfidz::model()->find(array('condition'=>"santri_id = {$id}", 'order' => 'tanggal ASC'));
        //mengeset hafalan terakhir santri untuk opsi tahun        
        $last_hafalan = MutabaahTahfidz::model()->find(array('condition'=>"santri_id = {$id}", 'order' => 'tanggal DESC'));        

        $year_sequence = array();
        if(!empty($first_hafalan)){
            for($i=date('Y', strtotime($first_hafalan->tanggal));$i<=date('Y', strtotime($last_hafalan->tanggal));$i++){
                $year_sequence[$i] = $i;
            }
        }
        $year_sequence[date('Y', time())] = date('Y', time());
        
        $last_month_recite = '';
        $last_year_recite = 'all';
        if(!empty($last_hafalan)){
            $last_month_recite = date('n', strtotime($last_hafalan->tanggal));
            $last_year_recite = date('Y', strtotime($last_hafalan->tanggal));
        }

        $data = (new MutabaahTahfidz())->getSummary($param, $last_month_recite, $last_year_recite);
        $absent = (new MutabaahTahfidz())->getAbsentDay($param, $last_month_recite, $last_year_recite);        
        ob_start();
        $this->renderPartial('_summary_table', array(
            'data' => $data,
            'absent' => $absent,
            )
        );
        $table = ob_get_contents();
        ob_end_clean();

        echo json_encode(array('table' => $table,'year'=>$param['tahun'],'month'=>  Utility::getIdMonth($param['bulan'])));
    }
/**
 * Action untuk melihat rangkuman hafalan santri tertentu berdasarkan bulan dan tahunnya dalam bentuk PDF
 *
 * Membuat "buku rapor" hafalan santri tiap bualannya
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['id'] 
 * @param int $_GET['bulan']
 * @param int $_GET['tahun'] 
 *
 * @return pdf rapor hafalan santri
 */    
    public function actionPdfSummary(){
        $param['id'] = Yii::app()->request->getQuery('id');
        $param['bulan'] = Yii::app()->request->getQuery('bulan');
        $param['tahun'] = Yii::app()->request->getQuery('tahun');
        $data = (new MutabaahTahfidz())->getSummary($param);
        $santri = Santri::model()->loadModelId($param['id']);
        $bulan = Utility::getIdMonth($param['bulan']);
        $absent = (new MutabaahTahfidz())->getAbsentDay($param, $param['bulan'],$param['tahun']);        
        $pdf = Yii::app()->ePdf->mpdf(
            '','A4-L',0,'',
            5,5,9,9,5,5
            );
        $pdf->SetHeader("RumahTahfidzQu|Mutabaah ".ucwords($santri->nama_lengkap)." Bulan $bulan Tahun {$param['tahun']}|{PAGENO}");
        $pdf->setFooter('{PAGENO}');
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.pdf') . '/mutabaahTahfidz.css');
        $pdf->WriteHTML($css, 1);
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.bootstrap') . '/bootstrap.min.css');
        $pdf->WriteHTML($css, 1);
        $pdf->WriteHTML($this->renderPartial('pdfSummary', array('data'=>$data, 'santri'=>$santri, 'bulan'=>$param['bulan'], 'tahun'=>$param['tahun'],'absent' => $absent), true));
        $pdf->Output("Mutabaah----".ucwords($santri->nama_lengkap)."----".$bulan."_{$param['tahun']}.pdf",EYiiPdf::OUTPUT_TO_BROWSER);                
    }
/**
 * Action untuk melihat rangkuman hafalan kumpulan santri berdasarkan asrama, bulan dan tahunnya dalam bentuk PDF
 *
 * Membuat "buku rapor" hafalan santri tiap bualannya
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_GET['id'] 
 * @param int $_GET['pondok-santri']
 * @param int $_GET['bulan']
 * @param int $_GET['tahun'] 
 *
 * @return pdf rapor hafalan santri
 */        
    public function actionPdfAllSantri(){
        $santri_list = array();
        $param['pondok_id'] = Yii::app()->request->getParam('pondok-santri');
        $param['bulan'] = Yii::app()->request->getParam('bulan');
        $param['tahun'] = Yii::app()->request->getParam('tahun');
        $model_santri = (new Santri())->getSantriActiveByQuarters($param['pondok_id']);
        $bulan = Utility::getIdMonth($param['bulan']);
        $nama_pondok = 'Semua Pondok';
        if(!empty($param['pondok_id'])){
            $nama_pondok = ucwords((new Pondokan())->loadModel($param['pondok_id'])->nama_pondok);
        }
        if(!empty($model_santri)){
            $i = 1;
            foreach($model_santri as $santri){
                $santri_list[] = $santri->nama_lengkap;
                if($i == 1){
                    $param['id'] = $santri->id;
                    $data = (new MutabaahTahfidz())->getSummary($param);
                    $pdf = Yii::app()->ePdf->mpdf(
                        '','A4-L',0,'',
                        5,5,9,9,5,5
                        );
                    $pdf->SetHeader("RumahTahfidzQu|Mutabaah Santri $nama_pondok Bulan $bulan Tahun {$param['tahun']}|{PAGENO}");
                    $pdf->setFooter('{PAGENO}');
                    $css = file_get_contents(Yii::getPathOfAlias('webroot.css.pdf') . '/mutabaahTahfidz.css');
                    $pdf->WriteHTML($css, 1);
                    $css = file_get_contents(Yii::getPathOfAlias('webroot.css.bootstrap') . '/bootstrap.min.css');
                    $pdf->WriteHTML($css, 1);
                    $pdf->WriteHTML($this->renderPartial('pdfSummary', array('data'=>$data, 'santri'=>$santri, 'bulan'=>$param['bulan'], 'tahun'=>$param['tahun']), true));
                }
                else{
                    $param['id'] = $santri->id;
                    $data = (new MutabaahTahfidz())->getSummary($param);
                    $pdf->WriteHTML('<pagebreak sheet-size="A4-L" />');
                    $pdf->WriteHTML($this->renderPartial('pdfSummary', array('data'=>$data, 'santri'=>$santri, 'bulan'=>$param['bulan'], 'tahun'=>$param['tahun']), true));
                }
                $i++;
            }
            $pdf->Output("Mutabaah----".$nama_pondok."----".$bulan."_{$param['tahun']}.pdf",EYiiPdf::OUTPUT_TO_BROWSER);                
        }
    }
/**
 * Action untuk menampilkan opsi juz yang dapat dipilih santri (progresif sesuai hafalan terakhir dan kelulusan hafalannya)
 *
 * Membuat array untuk opsi juz yang dapat dipilih
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_POST['santri_id'] id santri
 * @param int $_POST['type'] tipe hafalan yang ingin dicari opsi juz nya
 *
 * @return string json daftar juz
 */
    public function actionGetMyJuzOption() {
        $param['santri_id'] = Yii::app()->request->getPost('santri_id');
        $param['type'] = Yii::app()->request->getPost('type');
        switch ($param['type']) {
            //jika ziyadah, binadhor urutan 30,29,28,...1,2...27
            // case 1:
            // $last_recitation = Santri::getLastRecitation($param['santri_id'],$param['type']);
            // $juz = "-4";
            // if(!empty($last_recitation)){
            //     $juz = $last_recitation['juz'];
            //     if(strtolower($last_recitation['nilai'] == 'lulus')){
            //         if((int)$juz < -1 || ((int)$juz >= 1 && (int)$juz < 27)){
            //             $juz = ((int)$juz + 1)."";
            //         }
            //         elseif((int)$juz == -1){
            //             $juz = "30";
            //         }
            //         elseif((int)$juz >= 29){
            //             if($last_recitation['halaman'] >= 20){
            //                 $juz = ((int)$juz - 1)."";
            //             }
            //         }
            //         elseif((int)$juz == 28){
            //             if($last_recitation['halaman'] >= 20){
            //                 $juz = "1";
            //             }
            //         }
            //     }
            //     else{
            //         $juz = $last_recitation['juz'];
            //     }
            // }
            // $array_option = Utility::getMyOptionJuz($juz);
            // break;
            //jika murojaah urutan terserah            
            case 3:
            $juz = '';
            $array_option = array();
            $last_recitation = Santri::getLastRecitation($param['santri_id'],'1');
            if(!empty($last_recitation)){
                $juz = $last_recitation['juz'];
                $array_option = Utility::getMyMurojaahJuz($juz);
            }
            break;
            //jika ziyadah, binadhor urutan 30,29,28,...1,2...27
            default:
            $last_recitation = Santri::getLastRecitation($param['santri_id'],$param['type']);
            $juz = "-4";
            if(!empty($last_recitation)){
                $juz = $last_recitation['juz'];
                if(strtolower($last_recitation['nilai'] == 'lulus')){
                    if((int)$juz < -1 || ((int)$juz >= 1 && (int)$juz < 27)){
                        $juz = ((int)$juz + 1)."";
                    }
                    elseif((int)$juz == -1){
                        $juz = "30";
                    }
                    elseif((int)$juz >= 29){
                        if($last_recitation['halaman'] >= 20){
                            $juz = ((int)$juz - 1)."";
                        }
                    }
                    elseif((int)$juz == 28){
                        if($last_recitation['halaman'] >= 20){
                            $juz = "1";
                        }
                    }
                }
                else{
                    $juz = $last_recitation['juz'];
                }
            }
            $array_option = Utility::getMyOptionJuz($juz);
            break;
        }
        $juz_option = $this->renderPartial('_myJuzOption',array('array_option' => $array_option), true);
        echo json_encode(array('juz'=>$juz, 'juz_option'=>$juz_option));
    }
/**
 * Action untuk menampilkan opsi ustadz yang dapat dipilih santri
 *
 * Membuat array untuk opsi ustadz yang dapat dipilih
 *
 * @since 1.0.0
 * @access grup admin dan ustadz
 *
 * @param int $_POST['santri_id'] id santri
 *
 * @return string json daftar ustadz
 */
    public function actionGetMyUstadzOption() {
        $param['santri_id'] = Yii::app()->request->getPost('santri_id');
        $ustadz = User::model()->findByPk($param['santri_id'])->getUstadz();
        $ustadz_option = $this->renderPartial('_myUstadzOption',array('default_key' => $ustadz['id']), true);
        echo json_encode(array('ustadz_option'=>$ustadz_option));
    }

}
