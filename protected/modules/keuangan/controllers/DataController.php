<?php

class DataController extends CkltController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }
/**
 * Action untuk halaman kelola keuangan sekaligus tambah dan hapus
 *
 * Menampilkan daftar kas masuk dan keluar dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['donation_month']
 * @param int $_GET['donation_year']
 * @param int $_GET['donation_quarter']  filter kas masuk berdasar asrama
 *
 * @param int $_GET['expenditure_month']
 * @param int $_GET['expenditure_year']  
 * @param int $_GET['expenditure_quarter']  filter kas keluar berdasar asrama 
 *
 * @return page kelola kas masuk, kas keluar
 */    
    public function actionManage() {
        $first_donation = Donasi::model()->find(array('order' => 'tanggal ASC'));
        $last_donation = Donasi::model()->find(array('order' => 'tanggal DESC'));
        $year_sequence_donation = array();
        if(!empty($first_donation)){
            for($i=date('Y', strtotime($first_donation->tanggal));$i<=date('Y', strtotime($last_donation->tanggal));$i++){
                $year_sequence_donation[$i] = $i;
            }
        }
        $year_sequence_donation[date('Y', time())] = date('Y', time());        
        $last_month_donation = date('n', time());
        $last_year_donation = date('Y', time());
        //mencari kas masuk terakhir jika ada untuk ditampilkan pertama kali
        if(!empty($last_donation)){
            $last_month_donation = date('n', strtotime($last_donation->tanggal));
            $last_year_donation = date('Y', strtotime($last_donation->tanggal));
        }        

        //mengeset kas masuk pertama untuk filter tahun        
        $param_donation['donation_month'] = Yii::app()->request->getParam('donation_month');
        //mengeset kas masuk pertama untuk filter tahun        
        $param_donation['donation_year'] = Yii::app()->request->getParam('donation_year');

        $model_donation = (new Donasi())->getAllDonation($param_donation,$last_month_donation,$last_year_donation);

        //mengeset kas keluar pertama untuk filter tahun
        $first_expenditure = Pengeluaran::model()->find(array('order' => 'tanggal ASC'));
        //mengeset kas keluar terakhir untuk filter tahun        
        $last_expenditure = Pengeluaran::model()->find(array('order' => 'tanggal DESC'));
        $year_sequence_expenditure = array();
        //mencari kas kelua terakrhir jika ada untuk ditampilkan pertama kali
        if(!empty($first_expenditure)){
            for($i=date('Y', strtotime($first_expenditure->tanggal));$i<=date('Y', strtotime($last_expenditure->tanggal));$i++){
                $year_sequence_expenditure[$i] = $i;
            }
        }
        $year_sequence_expenditure[date('Y', time())] = date('Y', time());        
        $last_month_expenditure = date('n', time());
        $last_year_expenditure = date('Y', time());
        if(!empty($last_expenditure)){
            $last_month_expenditure = date('n', strtotime($last_expenditure->tanggal));
            $last_year_expenditure = date('Y', strtotime($last_expenditure->tanggal));
        }       
        $param_expenditure['expenditure_month'] = Yii::app()->request->getParam('expenditure_month');
        $param_expenditure['expenditure_year'] = Yii::app()->request->getParam('expenditure_year');
        $param_expenditure['expenditure_quarters'] = Yii::app()->request->getParam('expenditure_quarters');
        $model_expenditure = (new Pengeluaran())->getAllExpenditure($param_expenditure, $last_month_expenditure, $last_year_expenditure);
        $model_donation_add = new Donasi();
        $model_expenditure_add = new Pengeluaran();
        $donation = (new Donasi())->getTotalDonation();
        $expenditure = (new Pengeluaran())->getTotalExpenditure();
        $this->render('index',
            array(
                'model_donation_add'=>$model_donation_add,
                'model_expenditure_add'=>$model_expenditure_add,
                'total_donation' => !empty($donation)?(int)$donation->donation_total:0,
                'total_expenditure'=> !empty($expenditure)?(int)$expenditure->expenditure_total:0,
                'model_donation'=>$model_donation,
                'year_sequence_donation'=>$year_sequence_donation,
                'last_month_donation'=>$last_month_donation,
                'last_year_donation'=>$last_year_donation,
                'model_expenditure' => $model_expenditure,
                'year_sequence_expenditure'=>$year_sequence_expenditure,
                'last_month_expenditure'=>$last_month_expenditure,
                'last_year_expenditure'=>$last_year_expenditure,
            )
        );
    }
/**
 * Action untuk halaman kelola kas masuk sekaligus tambah dan hapus
 *
 * Menampilkan daftar kas masuk dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['donation_month']
 * @param int $_GET['donation_year']
 * @param int $_GET['donation_quarter']  filter kas masuk berdasar asrama
 *
 * @return page kelola kas masuk
 */   
    public function actionDonation() {
        $first_donation = Donasi::model()->find(array('order' => 'tanggal ASC'));
        $last_donation = Donasi::model()->find(array('order' => 'tanggal DESC'));
        $year_sequence_donation = array();
        if(!empty($first_donation)){
            for($i=date('Y', strtotime($first_donation->tanggal));$i<=date('Y', strtotime($last_donation->tanggal));$i++){
                $year_sequence_donation[$i] = $i;
            }
        }
        $year_sequence_donation[date('Y', time())] = date('Y', time());        
        $last_month_donation = date('n', time());
        $last_year_donation = date('Y', time());
        if(!empty($last_donation)){
            $last_month_donation = date('n', strtotime($last_donation->tanggal));
            $last_year_donation = date('Y', strtotime($last_donation->tanggal));
        }        
        
        $param_donation['donation_month'] = Yii::app()->request->getParam('donation_month');
        $param_donation['donation_year'] = Yii::app()->request->getParam('donation_year');

        $model_donation = (new Donasi())->getAllDonation($param_donation,$last_month_donation,$last_year_donation);
        $model_donation_add = new Donasi();
        $donation = (new Donasi())->getTotalDonation();
        $expenditure = (new Pengeluaran())->getTotalExpenditure();
        $page_donation = (new Donasi())->getTotalDonation($last_month_donation, $last_year_donation);
        $this->render('donation',
            array(
                'model_donation_add'=>$model_donation_add,
                'total_donation' => !empty($donation)?(int)$donation->donation_total:0,
                'total_expenditure'=> !empty($expenditure)?(int)$expenditure->expenditure_total:0,
                'model_donation'=>$model_donation,
                'year_sequence_donation'=>$year_sequence_donation,
                'last_month_donation'=>$last_month_donation,
                'last_year_donation'=>$last_year_donation,
                'page_donation' =>!empty($page_donation)?(int)$page_donation->donation_total:0,
            )
        );
    }
/**
 * Action untuk halaman kelola kas keluar sekaligus tambah dan hapus
 *
 * Menampilkan daftar kas keluar dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['expenditure_month']
 * @param int $_GET['expenditure_year']  
 * @param int $_GET['expenditure_quarter']  filter kas keluar berdasar asrama 
 *
 * @return page kelola kas keluar
 */   
    public function actionExpenditure() {
        $first_expenditure = Pengeluaran::model()->find(array('order' => 'tanggal ASC'));
        $last_expenditure = Pengeluaran::model()->find(array('order' => 'tanggal DESC'));
        $year_sequence_expenditure = array();
        if(!empty($first_expenditure)){
            for($i=date('Y', strtotime($first_expenditure->tanggal));$i<=date('Y', strtotime($last_expenditure->tanggal));$i++){
                $year_sequence_expenditure[$i] = $i;
            }
        }
        $year_sequence_expenditure[date('Y', time())] = date('Y', time());        
        $last_month_expenditure = date('n', time());
        $last_year_expenditure = date('Y', time());
        if(!empty($last_expenditure)){
            $last_month_expenditure = date('n', strtotime($last_expenditure->tanggal));
            $last_year_expenditure = date('Y', strtotime($last_expenditure->tanggal));
        }       
        $param_expenditure['expenditure_month'] = Yii::app()->request->getParam('expenditure_month');
        $param_expenditure['expenditure_year'] = Yii::app()->request->getParam('expenditure_year');
        $param_expenditure['expenditure_quarters'] = Yii::app()->request->getParam('expenditure_quarters');
        $model_expenditure = (new Pengeluaran())->getAllExpenditure($param_expenditure, $last_month_expenditure, $last_year_expenditure);
        $model_expenditure_add = new Pengeluaran();
        $donation = (new Donasi())->getTotalDonation();
        $expenditure = (new Pengeluaran())->getTotalExpenditure();
        $page_expenditure = (new Pengeluaran())->getTotalExpenditure($last_month_expenditure, $last_year_expenditure);
        $this->render('expenditure',
            array(
                'model_expenditure_add'=>$model_expenditure_add,
                'total_expenditure'=> !empty($expenditure)?(int)$expenditure->expenditure_total:0,
                'total_donation' => !empty($donation)?(int)$donation->donation_total:0,                
                'model_expenditure' => $model_expenditure,
                'year_sequence_expenditure'=>$year_sequence_expenditure,
                'last_month_expenditure'=>$last_month_expenditure,
                'last_year_expenditure'=>$last_year_expenditure,
                'page_expenditure' =>!empty($page_expenditure)?(int)$page_expenditure->expenditure_total:0,
            )
        );
    }
/**
 * Action untuk menghapus data kas masuk berdasarkan id
 *
 * Menghapus baris data pada tabel donation
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id donation.
 *
 * @return bool kondisi sukses
 */    
    public function actionDeleteDonation($id) {
        if (!empty($id)) {
            (new Donasi())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa data kas masuk berdasarkan id
 *
 * Menghapus baris data pada tabel donation
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id donation (multi).
 *
 * @return string json jumlah kas masuk yang berhasil dihapus
 */
    public function actionDeleteAllDonation() {
        $result = array('total_delete' => 0);
        if (isset($_POST['id'])) {
            $result['total_delete'] = Donasi::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk menghapus data kas keluar berdasarkan id
 *
 * Menghapus baris data pada tabel expenditure
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id expenditure.
 *
 * @return bool kondisi sukses
 */    
    public function actionDeleteExpenditure($id) {
        if (!empty($id)) {
            (new Pengeluaran())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa data kas keluar berdasarkan id
 *
 * Menghapus baris data pada tabel expenditure
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id expenditure (multi).
 *
 * @return string json jumlah kas keluar yang berhasil dihapus
 */
    public function actionDeleteAllExpenditure() {
        $result = array('total_delete' => 0);
        if (isset($_POST['id'])) {
            $result['total_delete'] = Pengeluaran::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk menambahkan data kas masuk
 *
 * Menambahkan data kas masuk ke dalam tabel donation
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Donasi']
 * @param string ['Donasi']['nama_donatur']
 * @param int ['Donasi']['jumlah']
 * @param string date ['Donasi']['tanggal'] 
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */    
    public function actionAddDonation(){
        $result = array();
        if (isset($_POST['Donasi']) && !empty($_POST['Donasi'])) {
            $model = new Donasi();
            $model->attributes = $_POST['Donasi'];
            $model->pembuat = $this->cklt_user->id;
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
 * Action untuk mengubah data kas masuk
 *
 * Mengubah data kas masuk dalam tabel donation
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Donasi']
 * @param string ['Donasi']['nama_donatur']
 * @param int ['Donasi']['jumlah']
 * @param string date ['Donasi']['tanggal'] 
 *
 * @return html dialog kas masuk
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */ 
    public function actionUpdateDonation($id){
        $model = (new Donasi())->loadModelId($id);
        if (isset($_POST['Donasi'])) {
            $messages = array();
            $model->attributes = $_POST['Donasi'];
            $model->pembuat = $this->cklt_user->id;
            if($model->validate()){
                $model->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_addDonationDialogForm', array('model_add' => $model, 'action'=>'updateDonation'));
        echo $form;
        Yii::app()->end();
    }
/**
 * Action untuk menambah data kas keluar
 *
 * Menambah data kas keluar dalam tabel expenditure
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Expenditure']
 * @param string ['Expenditure']['keperluan']
 * @param int ['Expenditure']['jumlah']
 * @param string date ['Expenditure']['tanggal'] 
 * @param string ['Expenditure']['pondok_id'] 
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */
    public function actionAddExpenditure(){
        $result = array();
        if (isset($_POST['Pengeluaran']) && !empty($_POST['Pengeluaran'])) {
            $model = new Pengeluaran();
            $model->attributes = $_POST['Pengeluaran'];
            $model->pembuat = $this->cklt_user->id;
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
 * Action untuk mengubah data kas keluar
 *
 * Mengubah data kas keluar dalam tabel expenditure
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['Expenditure']
 * @param string ['Expenditure']['keperluan']
 * @param int ['Expenditure']['jumlah']
 * @param string date ['Expenditure']['tanggal'] 
 * @param string ['Expenditure']['pondok_id'] 
 *
 * @return html dialog ubah kas keluar 
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */    
    public function actionUpdateExpenditure($id){
        $model = (new Pengeluaran())->loadModelId($id);
        if (isset($_POST['Pengeluaran'])) {
            $messages = array();
            $model->attributes = $_POST['Pengeluaran'];
            if($model->validate()){
                $model->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_addExpenditureDialogForm', array('model_add' => $model, 'action'=>'updateExpenditure'));
        echo $form;
        Yii::app()->end();
    }
/**
 * Action untuk menampilkan halaman kelola kas masuk dalam bentuk PDF
 *
 * Menampilkan daftar kas masuk dalam bentuk tabel dalam bentuk PDF
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['donation_month']
 * @param int $_GET['donation_year']  
 *
 * @return pdf kelola kas keluar
 */   
    public function actionPdfDonation(){
        $param_donation['donation_month'] = Yii::app()->request->getParam('donation_month');
        $param_donation['donation_year'] = Yii::app()->request->getParam('donation_year');
        $model_donation = (new Donasi())->getAllDonation($param_donation, null, null, 1000000);
        $page_donation = (new Donasi())->getTotalDonation($param_donation['donation_month'], $param_donation['donation_year']);
        $month_donation = "Rp ".number_format($page_donation->donation_total, 2, ",", ".");

        $pdf = Yii::app()->ePdf->mpdf(
                '','A4',0,'',
                5,5,9,9,5,5
                );
        $bulan = Utility::getIdMonth($param_donation['donation_month']);
        $pdf->SetHeader("RumahTahfidzQu|Daftar Donasi Bulan $bulan Tahun {$param_donation['donation_year']}|{PAGENO}");
        $pdf->setFooter('{PAGENO}');
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.pdf') . '/mutabaahTahfidz.css');
        $pdf->WriteHTML($css, 1);
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.bootstrap') . '/bootstrap.min.css');
        $pdf->WriteHTML($css, 1);
        $pdf->WriteHTML($this->renderPartial('pdfDonation', array('model_donation'=>$model_donation, 'bulan' => $bulan, 'tahun' => $param_donation['donation_year'], 'month_donation' => $month_donation), true));
        $pdf->Output("Donasi----".  Utility::getIdMonth($param_donation['donation_month'])."_{$param_donation['donation_year']}.pdf",EYiiPdf::OUTPUT_TO_BROWSER);                
    }

/**
 * Action untuk menampilkan halaman kelola kas keluar dalam bentuk PDF
 *
 * Menampilkan daftar kas keluar dalam bentuk tabel dalam bentuk PDF
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['expenditure_month']
 * @param int $_GET['expenditure_year']  
 * @param int $_GET['expenditure_quarters'] filter khusus asrama  
 *
 * @return pdf kelola kas keluar
 */       
    public function actionPdfExpenditure(){
        $param_expenditure['expenditure_month'] = Yii::app()->request->getParam('expenditure_month');
        $param_expenditure['expenditure_year'] = Yii::app()->request->getParam('expenditure_year');
        $param_expenditure['expenditure_quarters'] = Yii::app()->request->getParam('expenditure_quarters');
        $model_expenditure = (new Pengeluaran())->getAllExpenditure($param_expenditure, null, null, 1000000);
        $page_expenditure = (new Pengeluaran())->getTotalExpenditure($param_expenditure['expenditure_month'], $param_expenditure['expenditure_year']);
        $month_expenditure = "Rp ".number_format($page_expenditure->expenditure_total, 2, ",", ".");

        $pdf = Yii::app()->ePdf->mpdf(
                '','A4',0,'',
                5,5,9,9,5,5
                );
        $bulan = Utility::getIdMonth($param_expenditure['expenditure_month']);
        $nama_pondok = 'Semua Pondok';
        $pondok = (new Pondokan())->loadModel($param_expenditure['expenditure_quarters']);
        if(!empty($pondok)){
            $nama_pondok = 'Asrama '.ucwords($pondok->nama_pondok);
        }
        $pdf->SetHeader("RumahTahfidzQu|Daftar Pengeluaran $nama_pondok Bulan $bulan Tahun {$param_expenditure['expenditure_year']}|{PAGENO}");
        $pdf->setFooter('{PAGENO}');
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.pdf') . '/mutabaahTahfidz.css');
        $pdf->WriteHTML($css, 1);
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.bootstrap') . '/bootstrap.min.css');
        $pdf->WriteHTML($css, 1);
        $pdf->WriteHTML($this->renderPartial('pdfExpenditure', array('model_expenditure'=>$model_expenditure, 'bulan' => $bulan, 'tahun' => $param_expenditure['expenditure_year'], 'pondok' => $nama_pondok, 'month_expenditure' => $month_expenditure), true));
        $pdf->Output("Pengeluaran----".  Utility::getIdMonth($param_expenditure['expenditure_month'])."_{$param_expenditure['expenditure_year']}.pdf",EYiiPdf::OUTPUT_TO_BROWSER);
    }
/**
 * Action untuk menampilkan total kas masuk pada bulan ini
 *
 * Menampilkan jumlah kas masuk bulan ini
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_POST['donation_month']
 * @param int $_POST['donation_year']  
 *
 * @return string json kas masuk
 */ 
    public function actionGetDonationMonth(){
        $month = Yii::app()->request->getPost('donation_month');
        $year = Yii::app()->request->getPost('donation_year');
        $page_donation = (new Donasi())->getTotalDonation($month, $year);
        
                echo json_encode("Rp ".number_format($page_donation->donation_total, 2, ",", "."));
    }
/**
 * Action untuk menampilkan total kas keluar pada bulan ini
 *
 * Menampilkan jumlah kas keluar bulan ini
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_POST['expenditure_month']
 * @param int $_POST['expenditure_year']  
 *
 * @return string json kas keluar
 */ 
    public function actionGetExpenditureMonth(){
        $month = Yii::app()->request->getPost('expenditure_month');
        $year = Yii::app()->request->getPost('expenditure_year');
        $page_expenditure = (new Pengeluaran())->getTotalExpenditure($month, $year);
        
                echo json_encode("Rp ".number_format($page_expenditure->expenditure_total, 2, ",", "."));
    }
/**
 * Action untuk halaman kelola donasi barang sekaligus tambah dan hapus
 *
 * Menampilkan daftar donasi barang dalam bentuk tabel yang disertai opsi 
 * lihat detail dan hapus
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['donation_month']
 * @param int $_GET['donation_year']
 *
 * @return page kelola donasi barang
 */ 
    public function actionGoods() {
        $first_donation = DonasiBarang::model()->find(array('order' => 'tanggal ASC'));
        $last_donation = DonasiBarang::model()->find(array('order' => 'tanggal DESC'));
        $year_sequence_donation = array();
        if(!empty($first_donation)){
            for($i=date('Y', strtotime($first_donation->tanggal));$i<=date('Y', strtotime($last_donation->tanggal));$i++){
                $year_sequence_donation[$i] = $i;
            }
        }
        $year_sequence_donation[date('Y', time())] = date('Y', time());        
        $last_month_donation = date('n', time());
        $last_year_donation = date('Y', time());
        if(!empty($last_donation)){
            $last_month_donation = date('n', strtotime($last_donation->tanggal));
            $last_year_donation = date('Y', strtotime($last_donation->tanggal));
        }        
        
        $param_donation['donation_month'] = Yii::app()->request->getParam('donation_month');
        $param_donation['donation_year'] = Yii::app()->request->getParam('donation_year');

        $model_donation = (new DonasiBarang())->getAllDonation($param_donation,$last_month_donation,$last_year_donation);
        $model_donation_add = new DonasiBarang();
        $this->render('goods',
            array(
                'model_donation_add'=>$model_donation_add,
                'model_donation'=>$model_donation,
                'year_sequence_donation'=>$year_sequence_donation,
                'last_month_donation'=>$last_month_donation,
                'last_year_donation'=>$last_year_donation,
            )
        );
    }
/**
 * Action untuk menambahkan data donasi barang
 *
 * Menambahkan data donasi barang ke dalam tabel donasi barang
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['DonasiBarang']
 * @param string ['DonasiBarang']['nama_donatur']
 * @param string ['DonasiBarang']['nama_barang'] 
 * @param string ['DonasiBarang']['detail_barang']
 * @param string date ['DonasiBarang']['tanggal'] 
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */    
    public function actionAddGoods(){
        $result = array();
        if (isset($_POST['DonasiBarang']) && !empty($_POST['DonasiBarang'])) {
            $model = new DonasiBarang();
            $model->attributes = $_POST['DonasiBarang'];
            $model->pembuat = $this->cklt_user->id;
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
 * Action untuk menghapus data donasi barang berdasarkan id
 *
 * Menghapus baris data pada tabel donasi barang
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id donasi barang
 *
 * @return bool kondisi sukses
 */
    public function actionDeleteGoods($id) {
        if (!empty($id)) {
            (new DonasiBarang())->loadModelId($id)->delete();
        }
    }
/**
 * Action untuk menghapus beberapa donasi barang berdasarkan id
 *
 * Menghapus baris data pada tabel donasi barang
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $id id donasi barang (multi).
 *
 * @return string json jumlah donasi barang yang berhasil dihapus
 */
    public function actionDeleteAllGoods() {
        $result = array('total_delete' => 0);
        if (isset($_POST['id'])) {
            $result['total_delete'] = DonasiBarang::model()->deleteByPk($_POST['id']);
        }
        echo json_encode($result);
    }
/**
 * Action untuk mengubah data donasi barang
 *
 * Mengubah data donasi barang dalam tabel donasi barang
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param array $_POST['DonasiBarang']
 * @param string ['DonasiBarang']['nama_donatur']
 * @param string ['DonasiBarang']['nama_barang'] 
 * @param string ['DonasiBarang']['detail_barang']
 * @param string date ['DonasiBarang']['tanggal'] 
 *
 * @return string json array status
 *      @return int success kondisi sukses 
 *      @return string message keterangan error (optional) 
 */    
    public function actionUpdateGoods($id){
        $model = (new DonasiBarang())->loadModelId($id);
        if (isset($_POST['DonasiBarang'])) {
            $messages = array();
            $model->attributes = $_POST['DonasiBarang'];
            $model->pembuat = $this->cklt_user->id;
            if($model->validate()){
                $model->save();
                $messages = array('success' => 1, 'messages'=>'');
            }
            else{
                $messages = array('success' => 0, 'messages' => $model->errors);
            }
            echo json_encode($messages);
            Yii::app()->end();
        }
        $form = $this->renderPartial('_addGoodsDialogForm', array('model_add' => $model, 'action'=>'updateGoods'));
        echo $form;
        Yii::app()->end();
    }
/**
 * Action untuk menampilkan halaman kelola donasi barang dalam bentuk PDF
 *
 * Menampilkan daftar donasi barang dalam bentuk tabel dalam bentuk PDF
 *
 * @since 1.0.0
 * @access grup admin
 *
 * @param int $_GET['donation_month']
 * @param int $_GET['donation_year']  
 *
 * @return pdf kelola kas keluar
 */       
    public function actionPdfGoods(){
        $param_donation['donation_month'] = Yii::app()->request->getParam('donation_month');
        $param_donation['donation_year'] = Yii::app()->request->getParam('donation_year');
        $model_donation = (new DonasiBarang())->getAllDonation($param_donation, null, null, 1000000);

        $pdf = Yii::app()->ePdf->mpdf(
                '','A4',0,'',
                5,5,9,9,5,5
                );
        $bulan = Utility::getIdMonth($param_donation['donation_month']);
        $pdf->SetHeader("RumahTahfidzQu|Daftar Donasi Barang Bulan $bulan Tahun {$param_donation['donation_year']}|{PAGENO}");
        $pdf->setFooter('{PAGENO}');
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.pdf') . '/mutabaahTahfidz.css');
        $pdf->WriteHTML($css, 1);
        $css = file_get_contents(Yii::getPathOfAlias('webroot.css.bootstrap') . '/bootstrap.min.css');
        $pdf->WriteHTML($css, 1);
        $pdf->WriteHTML($this->renderPartial('pdfGoods', array('model_donation'=>$model_donation, 'bulan' => $bulan, 'tahun' => $param_donation['donation_year'], 'month_donation' => $month_donation), true));
        $pdf->Output("Donasi Barang----".  Utility::getIdMonth($param_donation['donation_month'])."_{$param_donation['donation_year']}.pdf",EYiiPdf::OUTPUT_TO_BROWSER);                
    }

}
