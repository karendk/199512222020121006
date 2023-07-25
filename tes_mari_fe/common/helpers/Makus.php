<?php

/**
 * @ Author: Karen Dharmakusuma
 * @ Create Time: 2019-12-21 00:56:11
 * @ Modified by: Karen Dharmakusuma
 * @ Modified time: 2023-07-25 09:51:17
 * @ Description: karendk.github.io
 * @ Email: karenmakus@gmail.com
 */

namespace common\helpers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

class Makus
{
    const  DB_FE = 'tes_mari_fe_db';
    const  DB_BE = 'tes_mari_be_db';
    const STATUS = [
        'belum' => '0',
        'sudah' => '1',
    ];

    const API_PEGAWAI="http://localhost:8844/";

    public function avatar($string)
    {
        // $url = 'https://ui-avatars.com/api/?name=';
        // $url .= $string;

        // $url = 'https://api.adorable.io/avatars/80/';
        // $url .= $string.'png';

        // $url = 'https://avatars.dicebear.com/v2/avataaars/';
        // $url .= $string.'.svg';

        // $url = 'https://avatars.dicebear.com/v2/gridy/';
        // $url .= $string.'.svg?&options[background]=%23f0f0f0';

        $url = 'https://avatars.dicebear.com/v2/jdenticon/';
        $url .= $string . '.svg?&options[background]=%23f0f0f0';

        // $url = 'https://i.pravatar.cc/150?u=';
        // $url .= $string;
        /* 
        // JADI LAMBAT
        $connected=@fsockopen("www.example.com", 80); 
        if(!$connected){
            $url=Url::to(['/user.png']);
        } */

        // $url=Url::to(['/img/user.svg']);
        return $url;
    }

    public function fileName($value, $prefix = '')
    {
        // return 123;
        // $ext=end(explode('.',$value->name));
        // return($ext);die();
        // $username=Yii::$app->user->identity->username??'';
        $time = date("Y-m-d");
        $digits = 3;
        $randomNum = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
        $ext = explode('.', $value->name);
        $data = [$prefix, $time, $randomNum, end($ext)];
        $fileName = vsprintf("%s_%s.%s.%s", $data);

        // $time = date("Ymd");
        // //$randomNum=substr(str_shuffle("0123456789"), 0, 3);
        // $digits=3;
        // $randomNum=str_pad(rand(0, pow(10, $digits)-1),$digits,'0',STR_PAD_LEFT);
        // $noSpace=str_replace(' ','',$value->name);
        // $fileName = $time."_".$randomNum.$noSpace;
        return $fileName;
    }

    public function preview($file)
    {
        $html = '
        <object data="https://sumanbogati.github.io/tiny.pdf" type="application/pdf" width="600" height="500">
            <a href="https://sumanbogati.github.io/tiny.pdf">' . $file . '</a>
        </object>';
        return $html;
    }

    public function DecToRomawi($angka)
    {
        // M=1000
        // D=500
        // C=100
        // L=50
        // X=10
        // V=5
        // I=1
        $hsl = "";
        if ($angka < 1 || $angka > 5000) {
            // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
            $hsl = "Batas Angka 1 s/d 5000";
        } else {
            while ($angka >= 1000) {
                // While itu termasuk kedalam statement perulangan
                // Jadi misal variable angka lebih dari sama dengan 1000
                // Kondisi ini akan di jalankan
                $hsl .= "M";
                // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
                // Varible hsl
                $angka -= 1000;
                // Lalu setelah itu varible angka di kurangi 1000 ,
                // Kenapa di kurangi
                // Karena statment ini mengambil 1000 untuk di konversi menjadi M
            }
        }
        if ($angka >= 500) {
            // statement di atas akan bernilai true / benar
            // Jika var angka lebih dari sama dengan 500
            if ($angka > 500) {
                if ($angka >= 900) {
                    $hsl .= "CM";
                    $angka -= 900;
                } else {
                    $hsl .= "D";
                    $angka -= 500;
                }
            }
        }
        while ($angka >= 100) {
            if ($angka >= 400) {
                $hsl .= "CD";
                $angka -= 400;
            } else {
                $angka -= 100;
            }
        }
        if ($angka >= 50) {
            if ($angka >= 90) {
                $hsl .= "XC";
                $angka -= 90;
            } else {
                $hsl .= "L";
                $angka -= 50;
            }
        }
        while ($angka >= 10) {
            if ($angka >= 40) {
                $hsl .= "XL";
                $angka -= 40;
            } else {
                $hsl .= "X";
                $angka -= 10;
            }
        }
        if ($angka >= 5) {
            if ($angka == 9) {
                $hsl .= "IX";
                $angka -= 9;
            } else {
                $hsl .= "V";
                $angka -= 5;
            }
        }
        while ($angka >= 1) {
            if ($angka == 4) {
                $hsl .= "IV";
                $angka -= 4;
            } else {
                $hsl .= "I";
                $angka -= 1;
            }
        }
        return ($hsl);
    }


    public function coverLetter($penawaran_id)
    {
        // $bulan_romawi=$this->DecToRomawi(date('m'));
        // $tahun_romawi=$this->DecToRomawi(date('Y'));        

        // //$nip=Yii::$app->user->identity->nip;
        // $last=Yii::$app->db->createCommand('
        //     SELECT cover_letter 
        //     FROM data_penugasan 
        //     ORDER BY penugasan_id DESC')
        // ->queryOne();

        // if($last){                                       
        //     $lastNo = substr($last['cover_letter'],1,3);// pisah dengan tanda -                                       
        //     $lastNo = $lastNo + 1;// kode tambah 1
        //     if($lastNo>999){$lastNo=1;}//balik ke satu jika lebih dari 999                                       
        //     $no_urut=str_pad($lastNo, 3, '0', STR_PAD_LEFT);//konvert ke 3 digit
        // }else{
        //     $no_urut='001';
        // }
        // $klasifikasi=DafPenawaran::find()
        //     ->joinWith(['jenisKlasifikasiKeg'])
        //     ->where(['daf_penawaran.penawaran_id'=>$penawaran_id])
        //     ->one();
        // // var_dump($klasifikasi->jenisKlasifikasiKeg->nama);die(); 

        // //klasifikasi.no_urut/BP/Kerma-LN/bulan_romawi/tahun_romawi
        // $app_name='/BP/Kerma-LN/';
        // $cl=$klasifikasi->jenisKlasifikasiKeg->status.$klasifikasi->jenisKlasifikasiKeg->id.$no_urut.$app_name.$bulan_romawi.'/'.$tahun_romawi;
        // // $cl=$klasifikasi['klasifikasi_penawaran'].$no_urut.$app_name.$bulan_romawi.'/'.$tahun_romawi;
        // return $cl;
    }


    public function fileSize($url)
    {
        //var_dump($url);die();
        $headers = get_headers($url, TRUE);
        $result = $headers['Content-Length'];
        return $result;
    }

    public function shortenString($string, $max)
    {
        $count = strlen($string);
        $count >= $max ? $result = substr($string, 0, $max) . ".." : $result = $string;
        return $result;
    }

    public function findRole($find, $id = false)
    {
        if ($id == false) {
            $id = Yii::$app->user->id;
        }
        $role = Yii::$app->authManager->getRolesByUser($id);
        $result = false;
        if (is_array($find)) {
            foreach ($role as $key => $value) {
                if (in_array($key, $find)) {
                    // You found the string 
                    $result = true;
                    break;
                } else {
                    $result = false;
                }
            }
        } else {
            foreach ($role as $key => $value) {
                if ($key == $find) {
                    // You found the string 
                    $result = true;
                    break;
                } else {
                    $result = false;
                }
            }
        }
        return $result;
    }

    public function getRoleDescription($find = false, $id = false)
    {
        if ($id == false) {
            $id = Yii::$app->user->id;
        }
        if ($find == false) {
            $find = Yii::$app->user->identity->userLevel;
        }
        $role = Yii::$app->authManager->getRolesByUser($id);
        // var_dump($role);die();
        $result = false;
        if (is_array($find)) {
            foreach ($role as $key => $value) {
                if (in_array($key, $find)) {
                    // You found the string 
                    $result = $value->description;
                    break;
                } else {
                    $result = '-';
                }
            }
        } else {
            foreach ($role as $key => $value) {
                if ($key == $find) {
                    // You found the string 
                    $result = $value->description;
                    break;
                } else {
                    $result = '-';
                }
            }
        }
        return $result;
    }

    public function convertDateSave($date)
    {
        if ($date) {
            $id = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $en = ["January", "February", "March", "Avril", "May", "June", "July", "August", "September", "October", "November", "December"];
            $switchLang = str_ireplace($id, $en, $date);
            $result = date('Y-m-d', strtotime($switchLang));
            return $result;
        }
    }

    public function convertDateInitial($date)
    {
        $id = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $en = ["January", "February", "March", "Avril", "May", "June", "July", "August", "September", "October", "November", "December"];
        $date = date('d F Y', strtotime($date));
        $result = str_ireplace($en, $id, $date);
        return $result;
    }

    public function bulanSama($date1, $date2)
    {
        // $date1=$this->convertDatesave($date1);
        $month1 = explode('-', $date1);
        // $date2=$this->convertDatesave($date2);
        $month2 = explode('-', $date2);

        $result = $month1[1] == $month2[1];
        return $result;
    }

    public function hariSama($date1, $date2)
    {
        // $date1=$this->convertDatesave($date1);
        $month1 = explode('-', $date1);
        // $date2=$this->convertDatesave($date2);
        $month2 = explode('-', $date2);

        $result = $month1[2] == $month2[2];
        return $result;
    }

    public function dateSummary($begin, $end)
    {
        // date_default_timezone_set('Asia/Makassar');
        // setlocale(LC_ALL, 'id_ID');
        // var_dump($begin,$end);
        $bulanSama = $this->bulanSama($begin, $end);
        // $result=$bulanSama;
        if ($bulanSama) {
            $hari_mulai = ltrim(substr($begin, 8, 10), '0');
            $hariSama=$this->hariSama($begin, $end);
            $end = $this->convertDateInitial($end);
            $end = ltrim($end, '0');
            if ($hariSama) {
                $result = date('l',strtotime($begin)).', '.$end;
            } else {
                $result = date('l',strtotime($begin)).', '.$hari_mulai . "-" . $end;
            }
        } else {
            $result = $begin . " - " . $end;
        }
        return $result;
    }

    public function timeSummary($begin, $end)
    {
        $time_begin = explode(':', $begin);
        $time_end = explode(':', $end);

        $result = $time_begin[0].":".$time_begin[1]." s.d. ". $time_end[0].":".$time_end[1];
        return $result;
    }

    // public function dd($any){
    //     echo "<pre style='color:white;background:black'>".__FILE__.":".__LINE__."\n";
    //     array_map(function($any) { 
    //         var_dump($any); 
    //     }, func_get_args());
    //     echo "</pre>";
    //     die();
    // }

    public function d($var, $caller = null)
    {
        // if(!isset($caller)){
        //     $caller = array_shift(debug_backtrace(1));
        // }
        // echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
        // echo '<pre>';
        \yii\helpers\VarDumper::dump($var, 100, true);
        // echo '</pre>';
    }

    public function dd($var)
    {
        $caller = array_shift(debug_backtrace(1));
        $this->d($var, $caller);
        die();
    }

    public function fileType($data)
    {
        $file = explode('.', $data);
        $ext = strtolower(end($file));
        if (
            $ext == 'jpg' ||
            $ext == 'jpeg' ||
            $ext == 'png' ||
            $ext == 'bmp'
        ) {
            $type = 'image';
        } else if (
            $ext == 'doc' ||
            $ext == 'docx' ||
            $ext == 'xls' ||
            $ext == 'xlsx'
        ) {
            $type = 'office';
        } else {
            // $type=end($ext);
            // $ext="object";
            $type = $ext;
        }
        return $type;
    }

    public function createFolder($uploadDir)
    {
        $oldmask = umask(0);
        mkdir($uploadDir, 0777, true);
        umask($oldmask);
    }

    public function get($var)
    {
        $result = Html::encode(Yii::$app->request->get($var)) ?? null;
        return $result;
    }

    public function getRole($url)
    {
        $getUrl = Html::encode(Yii::$app->request->get('role')) ?? null;
        // if($this->findRole('superadmin')){
        //     $result=$url."&role={$getUrl}";
        // }else{
        //     $result=$url;
        // }

        $result = $url . "&role={$getUrl}";
        return $result;
    }

    public function roleUrl($controller)
    {
        // if($this->findRole('superadmin')){
        //     $getRole=Html::encode(Yii::$app->request->get('role'))??null;
        //     $result=Url::to(["/{$controller}?role={$getRole}"]);
        // }else{
        //     $result=Url::to(["/{$controller}"]);
        // }
        $getRole = Html::encode(Yii::$app->request->get('role')) ?? null;
        $result = Url::to(["/{$controller}?role={$getRole}"]);
        return $result;
    }

    public function isUrlRole($role)
    {
        $roleUrl = Html::encode(Yii::$app->request->get('role')) ?? null;
        if ($role == $roleUrl) {
            $result = true;
        } else {
            $result = false;
        }
        // var_dump($role," is ",$roleUrl,$result);die();
        return $result;
    }

    function redirecUrl($controller, $role = '', $id = 0, $statusCode = 303)
    {
        // if($this->findRole('superadmin')){
        //     $result=Url::to(["/{$controller}?id={$id}&role={$role}"]);
        // }else{
        //     $result=Url::to(["/{$controller}?id={$id}"]);
        // }
        $result = Url::to(["/{$controller}?id={$id}&role={$role}"]);
        header('Location: ' . $result, true, $statusCode);
        die();
    }

    public function location($country, $city)
    {
        $result = $country . " / " . $city;
        return $result;
    }

    public function urlSegment($segment){
        return explode('/',Yii::$app->request->getPathInfo())[$segment];
    }
}
