<?php

class Utility {

    function __construct() {
        
    }

    public static function findDirFromPath($path) {
        $arrDir = array();
        $openDir = opendir($path);
        while (false !== ($entry = readdir($openDir))) {
            $arrDir[] = $entry;
        }
        return $arrDir;
        closedir($path);
    }

    public static function findFileFromFolder($folder) {
        $arrFile = array();
        $dir = dir($folder) or die("path: $folder not found.");
        while (false !== ($entry = $dir->read())) {
            $arrFile[] = $entry;
        }
        return $arrFile;
    }

    public static function findMethodFromFile($file) {
        include_once "$file";
        $exfile = explode("/", $file);
        $class = str_replace(".php", "", $exfile[count($exfile) - 1]);
        $arrMethod = array();
        $handle = fopen($file, "r");
        $functions = fread($handle, filesize($file));
        $class_method = get_class_methods($class);
//        $object = new $class(0);
//        if(method_exists($object, "defaultAccessRules"))
//                $object->defaultAccessRules();
        foreach ($class_method as $function) {
            if ((strpos($function, "action") !== false) && ($function != "actions"))
                $arrMethod[$function] = str_replace("action", "", $function);
        }
        fclose($handle);
        return $arrMethod;
    }

    public static function extractFile($file, $destination) {
        $zip = new ZipArchive();
        $zip->open($file);
        if ($zip->extractTo($destination)) {
            $zip->close();
            return true;
        }
        return false;
    }

    public static function rmdirNotEmpty($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        Utility::rmdirNotEmpty($dir . "/" . $object);
                    else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public static function generateUrl($url = "") {
        $result = array();
        $arrUrl = explode("|", $url);
        foreach ($arrUrl as $url) {
            $url = trim($url);
            $param = substr($url, 0, strpos($url, "="));
            $index = substr($url, strpos($url, "#") + 1);
            $value = substr($url, strpos($url, "=") + 1);
            if (strpos($url, "GET")) {
                if (isset($_GET["$index"]))
                    $result[$param] = $_GET["$index"];
            }else if (strpos($url, "POST")) {
                if (isset($_POST["$index"]))
                    $result[$param] = $_POST["$index"];
            }else if (isset($value)) {
                $result[$param] = $value;
            }
        }
        if (!isset($result[0]))
            return $result;
        else
            return array();
    }

    public static function toGeneral($word) {
        $word = ucfirst($word);
        $word = str_replace("_", " ", $word);
        return $word;
    }

    public static function actionEnabledGrid($value, $arr) {
        return (array_search($value, $arr)) ? "true" : "false";
    }

    public static function repeatSymbol($iterasi = 0, $symbol = " |- ") {
        $repeatSymbol = "";
        for ($i = 0; $i < $iterasi; $i++)
            $repeatSymbol .= $symbol;

        return $repeatSymbol;
    }

    public static function convertCheckedToIcon($cheked) {
        $path = Yii::app()->baseUrl . "/images/resource/";
        if ($cheked == 1)
            return CHtml::image("$path/checked.png", '', array("style" => "text-align: center;"));
        else if ($cheked == 0)
            return CHtml::image("$path/unchecked.png");
    }

    public static function getImageFromFolder($fileImage) {
        $pathUrl = Yii::app()->baseUrl . "/images/$fileImage";
        $path = Yii::getPathOfAlias("webroot.images");

        $file = $pathUrl;
        $fileName = $path . "/" . $fileImage;
        $photo = is_file($fileName) ? CHtml::image($file, '', array("width" => '131px', "style" => "display: block;float:left;")) : "Tidak Ada Foto";
        return $photo;
    }

    public static function getDateFormat($datetime) {
        $w = date('w', strtotime($datetime)); // 0=Sunday
        $n = date('n', strtotime($datetime)); // 1=January

        $j = date('j', strtotime($datetime)); //
        $Y = date('Y', strtotime($datetime)); //

        switch ($w) {
            case '0':
                $day_id = 'Ahad';
                break;
            case '1':
                $day_id = 'Senin';
                break;
            case '2':
                $day_id = 'Selasa';
                break;
            case '3':
                $day_id = 'Rabu';
                break;
            case '4':
                $day_id = 'Kamis';
                break;
            case '5':
                $day_id = 'Jumat';
                break;
            case '6':
                $day_id = 'Sabtu';
                break;
            default:
                break;
        }

        switch ($n) {
            case '1':
                $month_id = 'Januari';
                break;
            case '2':
                $month_id = 'Februari';
                break;
            case '3':
                $month_id = 'Maret';
                break;
            case '4':
                $month_id = 'April';
                break;
            case '5':
                $month_id = 'Mei';
                break;
            case '6':
                $month_id = 'Juni';
                break;
            case '7':
                $month_id = 'Juli';
                break;
            case '8':
                $month_id = 'Agustus';
                break;
            case '9':
                $month_id = 'September';
                break;
            case '10':
                $month_id = 'Oktober';
                break;
            case '11':
                $month_id = 'November';
                break;
            case '12':
                $month_id = 'Desember';
                break;
            default:
                break;
        }

        return $day_id . ', ' . $j . ' ' . $month_id . ' ' . $Y;
    }

    public static function shortText($var, $len = 60, $txt_titik = "...") {
        if (strlen($var) < $len) {
            return $var;
        }
        if (preg_match("/(.{1,$len})\s/", $var, $match)) {
            return $match [1] . $txt_titik;
        } else {
            return substr($var, 0, $len) . $txt_titik;
        }
    }

//    dibuat oleh rizqi, 19-03-2014
//    digunakan untuk mengirim email $destination = array(array('destinationEmail', 'destinationName'))
    public static function sentEmail($senderName, $senderEmail, $destinations = array(), $subject, $message) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $model_officer = Site::model()->findOfficer();
        if(!empty($model_officer)){
            file_put_contents('assets/email'.time(), json_encode(array('email'=>$model_officer->feed_email, 'password'=>$model_officer->password)));
        }
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
//        $mail->Username = 'spotkytestingemail@gmail.com';
        $mail->Username = $model_officer->feed_email;
//        $mail->Password = 'spotkytestingemails';
        $mail->Password = $model_officer->password;
//        awal sender
        $mail->SetFrom($senderEmail, $senderName);
//        akhir sender
//        awal subject
        $mail->Subject = $subject;
//        akhir subject
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
//        awal message
        $mail->MsgHTML($message);
//        akhir message
//        awal destination
        foreach ($destinations as $destination) {
            $mail->AddAddress($destination['destinationEmail'], $destination['desitinationName']);
        }
        $mail->Send();
//        akhir destination
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getDateFormat2($datetime, $separator_type = '/') {
        return date('d/m/Y', strtotime($datetime));
        ;
    }

    public static function getHumanReadableFilesize($size) {
        $mod = 1024;
        $units = explode(' ', 'B KB MB GB TB PB');
        for ($i = 0; $size > $mod; $i++) {
            $size /= $mod;
        }
        return round($size, 2) . ' ' . $units[$i];
    }

    public static function getHumanFilesize($bytes, $decimals = 2) {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    public static function getMetaKeyFromTitle($title) {
        $pattern = array(
            '( di | ke | bagi | pada | kepada | untuk | dan | atau | tetapi | sesudah | jika | agar | supaya | dengan | bahwa | karena | ketika | maka | sedangkan | hingga | meski | lalu | sambil | serta | apabila | andaikata | sebab | sebelum | selama | sehingga | seandainya | sekiranya | melainkan | semenjak | andaikan | bagaikan | asalkan | jangankan | walaupun | meskipun | kendatipun | lagi | hanya | sekalipun | sungguhpun | melainkan | tatkala | kecuali | seraya | sambil )i',
            '/^ /',
            '/ $/',
            '/[^a-zA-Z0-9 ]/',
            '/ +/');
        $replacement = array(' ', '', '', '', ', ');
        return preg_replace($pattern, $replacement, strtolower($title));
    }

    public static function getHighlighSearch($text, $key, $max_len) {
        $text_result = NULL;
        $last_keyword = '';

        //merapikan keyword
        $pattern_slice_keyword = array(
            '/^ /',
            '/ $/',
            '/[^a-zA-Z0-9 ]/',
            '/ +/');
        $replacement_slice_keyword = array('', '', '', ' ');
        $tidy_key = preg_replace($pattern_slice_keyword, $replacement_slice_keyword, $key);
        $array_slice_key = explode(' ', $tidy_key);

        //membuat keyword terakhir
        $ia = 1;
        foreach ($array_slice_key as $key => $value) {
            if ($ia > 2) {
                if ($ia == 3) {
                    $last_keyword .= $value;
                } else {
                    $last_keyword .= ' ' . $value;
                }
            }
            $ia++;
        }

        if ($last_keyword != '') {
            $key_search = '(' . $tidy_key . '|' . $array_slice_key[0] . '|' . $array_slice_key[1] . '|' . $last_keyword . ')';
            $array_keyword = array($tidy_key, $array_slice_key[0], $array_slice_key[1], $last_keyword);
        } elseif (isset($array_slice_key[1])) {
            $key_search = '(' . $tidy_key . '|' . $array_slice_key[0] . '|' . $array_slice_key[1] . ')';
            $array_keyword = array($tidy_key, $array_slice_key[0], $array_slice_key[1]);
        } else {
            $key_search = '(' . $tidy_key . '|' . $array_slice_key[0] . ')';
            $array_keyword = array($tidy_key, $array_slice_key[0]);
        }

        $array_keyword_replaced = array();
        $array_keyword_replacement = array();
        foreach ($array_slice_key as $value) {
            $array_keyword_replaced[] = '/(' . $value . ')/i';
            $array_keyword_replacement[] = '<b>\1</b>';
        }

        //mencari lokasi keyword
        $pattern_key_front = '/^' . $key_search . '.{1,' . $max_len . '}/i';
        $pattern_key_back = '/\s.{1,' . $max_len . '}' . $key_search . '$/';
        $pattern_key_middle = '/(.{1,' . round($max_len / 2) . '})' . $key_search . '(.{1,' . round($max_len / 2) . '})/i';
        $pattern_key_nothing = '/^.{1,' . $max_len . '}\s/i';

        // ^key...$
        if (preg_match($pattern_key_front, $text, $text_result)) {
            return preg_replace($array_keyword_replaced, $array_keyword_replacement, $text_result[0]) . '...';
        }

        // ^...key$
        else if (preg_match($pattern_key_back, $text, $text_result)) {
            return '...' . preg_replace($array_keyword_replaced, $array_keyword_replacement, $text_result[0]);
        }

        // ^...key...$
        else if (preg_match($pattern_key_middle, $text, $text_result)) {
            return '...' . preg_replace($array_keyword_replaced, $array_keyword_replacement, $text_result[0]) . '...';
        }

        // ^...$        
        else {
            if (preg_match($pattern_key_nothing, $text, $text_result)) {
                return $text_result[0] . ' ...';
            } else {
                return '';
            }
        }
    }
    
    public static function getReligion($religion_id) {
        $religion = '';
        switch ($religion_id) {
            case '1':
                $religion = 'Islam';
                break;
            case '2':
                $religion = 'Kristen';
                break;
            case '3':
                $religion = 'Katholik';
                break;
            case '4':
                $religion = 'Hindu';
                break;
            case '5':
                $religion = 'Budha';
                break;
            case '6':
                $religion = 'Konghuchu';
                break;
            default:
                break;
        }
        return $religion;
    }

    public static function getEducation($education_id) {
        $education = '';
        switch ($education_id) {
            case '1':
                $education = 'Tidak sekolah';
                break;
            case '2':
                $education = 'SD';
                break;
            case '3':
                $education = 'SMP';
                break;
            case '4':
                $education = 'SMA/SMK';
                break;
            case '5':
                $education = 'D1';
                break;
            case '6':
                $education = 'D2';
                break;
            case '7':
                $education = 'D3';
                break;
            case '8':
                $education = 'S1/D4';
                break;
            case '9':
                $education = 'S2';
                break;
            case '10':
                $education = 'S3';
                break;
            default:
                break;
        }
        return $education;
    }
    
    public static function getKinship($kinship_id) {
        $kinship = '';
        switch ($kinship_id) {
            case '1':
                $kinship = 'Ayah';
                break;
            case '2':
                $kinship = 'Ibu';
                break;
            case '3':
                $kinship = 'Wali';
                break;
            default:
                break;
        }
        return $kinship;
    }
    public static function getGender($gender_id) {
        $gender = '';
        switch ($gender_id) {
            case '1':
                $gender = 'putra';
                break;
            case '2':
                $gender = 'putri';
                break;
            default:
                break;
        }
        return $gender;
    }    
 
    public static function getSantriEducation($education_id) {
        $education = '';
        switch ($education_id) {
            case '2':
                $education = 'SD';
                break;
            case '3':
                $education = 'SMP';
                break;
            case '4':
                $education = 'SMA';
                break;
            case '8':
                $education = 'Kuliah';
                break;
            default:
                break;
        }
        return $education;
    }
    public static function getNumberOfDate($month, $year) {
        $date = date('t', strtotime("$year-$month-1"));
        return $date;
    }
    
    public static function replaceNotAlphanumeric($text) {
        $pattern = array('/^ /','/ $/','/[^a-zA-Z0-9]/','/ +/');
        $replacement = array('', '', '', '');
        $result = preg_replace($pattern, $replacement, $text);
        return $result;
    }
    
    public static function getBloodType($type){
        $blood_type = '';
        switch ($type) {
            case '1':
                $blood_type = 'A';
                break;
            case '2':
                $blood_type = 'B';
                break;
            case '3':
                $blood_type = 'AB';
                break;
            case '4':
                $blood_type = 'O';
                break;
            default:
                break;
        }
        return $blood_type;
    }
    
    public static function getBloodList(){
        $blood = array(
            1 => 'A',
            2 => 'B',
            3 => 'AB',
            4 => 'O',
        );
        return $blood;
    }
    
    public static function getReligionList(){
        $religion = array(
            1=>'Islam',2=>'Kristen',3=>'Katholik',4=>'Hindu',5=>'Budha',6=>'Konghuchu'
        );
        return $religion;
    }
    
    public static function getEducationList(){
        $education = array(
            1=>'Tidak Sekolah', 2=>'SD', 3=>'SMP', 4=>'SMA', 5=>'D1', 6=>'D2', 7=>'D3', 8=>'S1', 9=>'S2', 10=>'S3'
        );
        return $education;
    }
        public static function getSantriEducationList(){
        $education = array(
            2=>'SD', 3=>'SMP', 4=>'SMA',8=>'Kuliah'
        );
        return $education;
    }
        public static function getFamilyRelationList(){
        $family = array(
            1=>'Ayah',2=>'Ibu',3=>'Wali'
        );
        return $family;
    }
    
    public static function getRecitationType($type_id) {
        $type = '';
        switch ($type_id) {
            case '1':
                $type = 'Ziyadah';
                break;
            case '2':
                $type = 'Binadhor';
                break;
            case '3':
                $type = 'Murojaah';
                break;
            case '4':
                $type = 'Muqaddimah';
                break;
            default:
                break;
        }
        return $type;    
    }
    
    public static function getRecitationList() {
        $recitation = array('1'=>'Ziyadah','2'=>'Binadhor','3'=>'Murojaah');
        return $recitation;
    }
    
    public static function getSequenceArray($from = 1, $to ){
        $result = array();
        for($i=$from;$i<=$to;$i++){
            $result["$i"] = "$i";
        }
        return $result;
    }
    
    public static function getMonthList(){
        $month = array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April'
            ,'5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus'
            ,'9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
        return $month;
    }
    
    public static function calcutateAge($dob){
        $age = '-';
        $dob = date("Y-m-d",strtotime($dob));
        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();
        $diff = $dobObject->diff($nowObject);
        if(!empty($diff)){
            $age = $diff->y;
        }
        return $age;

    }
    
    public static function getReregistrationStatus($status_id){
        $status = '';
        switch ($status_id) {
            case '1'://telat 2 kali registrasi ulang
                $status = 'Telat Registrasi';
                break;
            case '2':
                $status = 'Keluar';
                break;
            case '3':
                $status = 'Sudah Registrasi';
                break;
            case '4':
                $status = 'Belum Registrasi';
                break;
            case '5':
                $status = 'Belum Ada Tahun Ajaran';
                break;
            case '6':
                $status = 'Lulus';
                break;
            default:
                break;
        }
        return $status;    
    }
    
    public static function convertDateId($text) {
        $pattern = array('/[^0-9]*Jan[^0-9]*/i','/[^0-9]*Feb[^0-9]*/i','/[^0-9]*Mar[^0-9]*/i','/[^0-9]*Apr[^0-9]*/i',
            '/[^0-9]*Mei[^0-9]*/i','/[^0-9]*Jun[^0-9]*/i','/[^0-9]*Jul[^0-9]*/i','/[^0-9]*Agu[^0-9]*/i',
            '/[^0-9]*Sep[^0-9]*/i','/[^0-9]*Okt[^0-9]*/i','/[^0-9]*Nov[^0-9]*/i','/[^0-9]*Des[^0-9]*/i');
        $replacement = array('-01-', '-02-', '-03-', '-04-','-05-'
            ,'-06-', '-07-', '-08-','-09-', '-10-', '-11-', '-12-');
        $result = preg_replace($pattern, $replacement, $text);
        return $result;
    }
    
    public static function checkPathExist($location){
        $check_location = explode('/', $location);
        $path_alias = implode('.', $check_location);
        $path = Yii::getPathOfAlias("webroot.$path_alias");
        if (!is_readable($path)){
            mkdir($path, 0777, true);
        }
    }
    
    public static function getAbsentList(){
        $description = array(1=>'Masuk',2=>'Izin Sakit',3=>'Izin Lain',4=>'Tanpa Keterangan',5=>'Lain-lain');
        return $description;
    }
    
    public static function getAbsentType($absent_id){
        $absent = '';
        switch ($absent_id) {
            case '1'://telat 2 kali registrasi ulang
                $absent = 'Masuk';
                break;
            case '2':
                $absent = 'Izin Sakit';
                break;
            case '3':
                $absent = 'Izin Lain';
                break;
            case '4':
                $absent = 'Tanpa Keterangan';
                break;
            case '5':
                $absent = 'Lain-lain';
                break;
            default:
                break;
        }
        return $absent;    
    }
    
    public static function getMuqaddimah(){
        $surah = array(1=>'Ar-Rahman',2=>'Al-Waqiah',3=>'Al-Mulk',4=>'Yasin');
        return $surah;
    }
    
    public static function getIdMonth($id){
        $month = '';
        switch ($id) {
            case '1':
                $month = 'Januari';
                break;
            case '2':
                $month = 'Februari';
                break;
            case '3':
                $month = 'Maret';
                break;
            case '4':
                $month = 'April';
                break;
            case '5':
                $month = 'Mei';
                break;
            case '6':
                $month = 'Juni';
                break;
            case '7':
                $month = 'Juli';
                break;
            case '8':
                $month = 'Agustus';
                break;
            case '9':
                $month = 'September';
                break;
            case '10':
                $month = 'Oktober';
                break;
            case '11':
                $month = 'November';
                break;
            case '12':
                $month = 'Desember';
                break;
            default:
                break;
        }
        return $month;
    }

    public static function getFourSurahName($id){
        $surrah = '';
        switch ($id) {
            case '-4':
                $month = 'Ar-Rahman';
                break;
            case '-3':
                $month = 'Al-Waqiah';
                break;
            case '-2':
                $month = 'Al-Mulk';
                break;
            case '-1':
                $month = 'Yasin';
                break;
            default:
                break;
        }
        return $month;
    }    
    
    public static function getMergeJuz(){
        $result = array();
        $result ['-4'] = 'Ar-Rahman';
        $result ['-3'] = 'Al-Waqiah';
        $result ['-2'] = 'Al-Mulk';
        $result ['-1'] = 'Yasin';
        for($i=30;$i>=28;$i--){
            $result["$i"] = "$i";
        }
        for($i=1;$i<=27;$i++){
            $result["$i"] = "$i";
        }
        return $result;
    }

    public static function getMyOptionJuz($last_juz){
        $index = (int)array_search($last_juz, array_keys(Utility::getMergeJuz()));
        $output = array_slice(Utility::getMergeJuz(), $index, 1, true);
        return $output;
    }

    public static function getMyMurojaahJuz($last_juz){
        $index = (int)array_search($last_juz, array_keys(Utility::getMergeJuz()));
        $output = array_slice(Utility::getMergeJuz(), 0, $index+1, true);
        return $output;
    }

    public static function getQuartersOwneship($status){
        $result = "";
        switch ($status) {
            case 1:
                $result = "sewa";
                break;
            case 2:
                $result = "pinjaman";
                break;
            case 3:
                $result = "milik yayasan";
                break;
            default:
                break;
        }
        return $result;
    }

    public static function getQuartersOwnershipList(){
        $description = array(1=>'Sewa',2=>'Pinjaman',3=>'Milik Yayasan');
        return $description;
    }

}
?>
