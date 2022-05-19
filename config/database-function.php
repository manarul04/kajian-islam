<?php

function Insert($table, $data){
    global $connect;
    //print_r($data);
    $fields = array_keys( $data );  
    $values = array_map( array($connect, 'real_escape_string'), array_values( $data ) );
    
    return mysqli_query($connect, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($connect) );
}

function Cek($table,$id){
    global $connect;
    // mengambil data barang dengan kode paling besar
    $query = mysqli_query($connect, "SELECT max($id) as kodeTerbesar FROM $table");
    $data = mysqli_fetch_array($query);
    $kode = $data['kodeTerbesar'];

    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    // $urutan = (int) substr($kode, 3, 3);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $kode++;

    
    return $kode;
}

function Laporan($level,$bulan,$tahun,$id){
    global $connect;
    if($level=="redaksi"){
        $query =mysqli_query($connect,"SELECT count(*)as jml FROM berita where status='verified' AND MONTH(waktu_tayang) = ".$bulan." AND Year(waktu_tayang)=".$tahun." AND id_redaksi=".$id);
        $row= mysqli_fetch_array($query);
	    $laporan = $row["jml"];
    }else if($level=="jurnalis"){
        $query =mysqli_query($connect,"SELECT count(*)as jml FROM tb_berita where MONTH(tanggal) = ".$bulan." AND Year(tanggal)=".$tahun." AND id_user=".$id);
        $row= mysqli_fetch_array($query);
	    $laporan = $row["jml"];
    }else if($level=="editorvideo"){
        $query =mysqli_query($connect,"SELECT count(*)as jml FROM video where status='published' AND MONTH(waktu_tayang) = ".$bulan." AND Year(waktu_tayang)=".$tahun." AND id_editorvideo=".$id);
        $row= mysqli_fetch_array($query);
	    $laporan = $row["jml"];
    }
    if($laporan<1){
        $laporan="0";
    }


    return $laporan;
}

function redaksi($kategori, $bulan, $tahun){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(*)AS jml, MONTH(tanggal) AS Bulan FROM berita WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND video='1'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(*)AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function produksi($bulan, $tahun){
    global $connect;
    $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM video WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}

function produksiTahunan(){
    global $connect;
    $tahun= date(Y);
    $sql2 = mysqli_query($connect,"SELECT COUNT(*) AS jml from video where YEAR(tanggal)='$tahun'");
    $row2= mysqli_fetch_array($sql2);
    $total = $row2["jml"];
    echo $total;
}
function produksiBulanan(){
    global $connect;
    $tahun= date(Y);
    $bulan= date(m);
    $sql = mysqli_query($connect,"SELECT COUNT(*) AS jml from video where YEAR(tanggal)='$tahun' AND MONTH(tanggal)='$bulan'");
    $row= mysqli_fetch_array($sql);
    $totalb = $row["jml"];
    echo $totalb;
}
function produksiHarian(){
    global $connect;
    $tahun= date(Y);
    $bulan= date(m);
    $tanggal= date(d);
    $sql = mysqli_query($connect,"SELECT COUNT(*) AS jml from video where YEAR(tanggal)='$tahun' AND MONTH(tanggal)='$bulan' AND DATE(tanggal)='$tanggal'");
    $row= mysqli_fetch_array($sql);
    $totalb = $row["jml"];
    echo $totalb;
}
function chart($bulan, $tahun,$kategori){
    global $connect;
    if($kategori=='kunjungan'){
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE kategori_instansi IS NOT NULL AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun'");
    
    }
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function dataDashboard($kategori,$periode,$waktu){
    global $connect;
    if($kategori=='kunjungan'){
        $kunjungan='kategori_instansi IS NOT NULL AND';
    }else{
        $kunjungan="";
    }
    if($periode=='Tahunan'){
        $tahun= date(Y);
        $sql = mysqli_query($connect,"SELECT COUNT(*) AS jml from $kategori where $kunjungan YEAR(tanggal)='$waktu'");
        $row= mysqli_fetch_array($sql);
        $total = $row["jml"];
        echo $total;
    }else if($periode=='Bulanan'){
        $tahun= date(Y);
        $bulan= date(m);
        $sql2 = mysqli_query($connect,"SELECT COUNT(*) AS jml from $kategori where $kunjungan YEAR(tanggal)='$tahun' AND MONTH(tanggal)='$waktu'");
        $row2= mysqli_fetch_array($sql2);
        $total2 = $row2["jml"];
        echo $total2;
    }else{
        $tahun= date(Y);
        $bulan= date(m);
        $tanggal= date(d);
        $sql3 = mysqli_query($connect,"SELECT COUNT(*) AS jml from $kategori where $kunjungan YEAR(tanggal)='$tahun' AND MONTH(tanggal)='$bulan' AND DATE(tanggal)='$waktu'");
        $row3= mysqli_fetch_array($sql3);
        $total3 = $row3["jml"];
        echo $total3;
    }
}

function totalreporter($kategori, $bulan, $tahun,$idreporter){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM berita WHERE video='1' AND MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND id_reporter='$idreporter'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE MONTH(tanggal)='$bulan' AND YEAR(tanggal)='$tahun' AND id_reporter='$idreporter'");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function laporanredaksitotal($kategori,$bulan,$tahun){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml from berita where Year(tanggal)=Year($tahun) AND Month(tanggal)= Month($bulan) AND video = 1");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml from $kategori where Year(tanggal)=Year($tahun) AND Month(tanggal)= Month($bulan)");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
    
}
function capaian($kategori,$id_reporter,$bulan){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM berita WHERE video='1' AND MONTH(tanggal)=$bulan AND YEAR(tanggal)=YEAR(CURDATE()) AND id_reporter='$id_reporter'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE MONTH(tanggal)=$bulan AND YEAR(tanggal)=YEAR(CURDATE()) AND id_reporter='$id_reporter'");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function dashboardRedaksi($kategori,$bulantahun){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM berita where video='1' AND tanggal LIKE '$bulantahun%'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM $kategori where tanggal LIKE '$bulantahun%'");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function dashboardRedaksiPersen($kategori,$bulantahun){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM berita where video='1' AND tanggal LIKE '$bulantahun%'");
        $sql2 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM berita where video='1' AND WHERE MONTH(tanggal) = MONTH(SUBDATE(CURDATE(), INTERVAL 1 MONTH));");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM $kategori where tanggal LIKE '$bulantahun%'");
        $sql2 = mysqli_query($connect,"SELECT COUNT(*) AS jml FROM $kategori WHERE MONTH(tanggal) = MONTH(SUBDATE(CURDATE(), INTERVAL 1 MONTH));");
    }
    
    $row21= mysqli_fetch_array($sql21);
    $total = $row21["jml"];
    
    
    $row2= mysqli_fetch_array($sql2);
    $totalkemarin = $row2["jml"];
    if($totalkemarin>0){
        $ttl = $total-$totalkemarin;
        $persen =$ttl/$totalkemarin*100;
        if($persen>=0){
            $sts="Naik";
            $txt="success";
            $arrow="up";
        }else{
            $sts="Turun";
            $txt="danger";
            $arrow="down";
        }
    }else{
         $sts="Naik";
         $txt="success";
         $arrow="up";
         $persen="";
     }
     echo '<span class="text-'.$txt.' mr-2"><i class="fa fa-arrow-'.$arrow.'"></i>'.$sts.' '.$persen."%".'</span>';;
     
}
function laporanRedaksi($kategori,$id_reporter,$tanggal){
    global $connect;
    if($kategori=="video"){
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM berita WHERE MONTH(tanggal)=MONTH('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal') AND id_reporter='$id_reporter' AND video='1'");
    }else{
        $sql21 = mysqli_query($connect,"SELECT COUNT(MONTH(tanggal))AS jml, MONTH(tanggal) AS Bulan FROM $kategori WHERE MONTH(tanggal)=MONTH('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal') AND id_reporter='$id_reporter'");
    }
    
    $row21= mysqli_fetch_array($sql21);
    echo $row21["jml"];
}
function Cekada($table,$nama,$value){
    global $connect;
    // mengambil data barang dengan kode paling besar
    $query = mysqli_query($connect, "SELECT count($nama) AS ada FROM $table where $nama='$value'");
    $ada = mysqli_num_rows($query);

    return $ada;
}

function Update($table_name, $form_data, $where_clause=''){   
    global $connect;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){ //substring
                // not found, add key word
                $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause); //trim where clause
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    
    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value){
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);
    
    // append the where statement
    $sql .= $whereSQL;
             
    // run and return the query result
    return mysqli_query($connect,$sql);
}
function text($text){
    $hasil = str_replace("'","\'",$text);
    return $hasil;
}
function Select($text,$text2){
    if($text==$text2){
        echo "Selected";
    }
}
function Delete($table_name, $where_clause=''){   
    global $connect;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        }else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
         
    // run and return the query result resource
    return mysqli_query($connect,$sql);
}  
function Tanggal($tanggal){
    $tgl= substr($tanggal,10,1);
    if($tgl=="T"){
            $t = explode("T", $tanggal);
            echo $t[0]." ".$t[1]; //10
        }else{
            $t = explode(" ", $tanggal);
            echo $t[0]."T".$t[1];
        }
    }
function Bulanlalu(){
    $bulanlalu = new DateTime('first day of previous month');
    echo $bulanlalu->format( 'Y-m-d' );
    }
function Kemarin(){
    $kemarin = new DateTime('yesterday');
    echo $kemarin->format( 'Y-m-d' );
    }
function isset_file($name) {
    return (isset($_FILES[$name]) && $_FILES[$name]['error'] != UPLOAD_ERR_NO_FILE);
}

function Nomorwa($nomor_wa) {
    $nomor="";
    if(substr($nomor_wa,0,2)=="08"){
        $nomor="62".substr($nomor_wa,1);
       
    }else{
        $nomor=$nomor_wa;
    }
    return $nomor;
}

function SendWa($nomor,$pesan){
    $data = [
        'phone' => $nomor, // Receivers phone
        'body' => $pesan, // Message
    ];
    $json = json_encode($data); // Encode data to JSON
    // URL for request POST /message
    $token = '92gp50ymkc5dq76d';
    $instanceId = '310426';
    $url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
    // Make a POST request
    $options = stream_context_create(['http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $json
        ]
    ]);
    // Send a request
    $result = file_get_contents($url, false, $options);

}

function jam($jam){
   echo substr($jam,11,5);
}
function tgljam($jam){
   echo substr($jam,0,16);
}
function NamaBulan($bulan){
    switch($bulan){
        case '01' : $bulan="JANUARI";
        break;
        case '02' : $bulan="FEBRUARI";
        break;
        case '03' : $bulan="MARET";
        break;
        case '04' : $bulan="APRIL";
        break;
        case '05' : $bulan="MEI";
        break;
        case '06' : $bulan="JUNI";
        break;
        case '07' : $bulan="JULI";
        break;
        case '08' : $bulan="AGUSTUS";
        break;
        case '09' : $bulan="SEPTEMBER";
        break;
        case '10' : $bulan="OKTOBER";
        break;
        case '11' : $bulan="NOVEMBER";
        break;
        default : $bulan="DESEMBER";
    }
    
    
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
     
    return  $bulan;
}

//AKuntansi
function sumTransaksi($periode,$tanggal,$kategori){
    global $connect;
    if($periode=="Harian"){
        $sql21 = mysqli_query($connect,"SELECT SUM(nominal) AS jml FROM `transaksi` WHERE kategori_transaksi='$kategori' AND MONTH(tanggal)=MONTH('$tanggal') AND DATE(tanggal)=DATE('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal')");
    }elseif($periode=="Bulanan"){
        $sql21 = mysqli_query($connect,"SELECT SUM(nominal) AS jml FROM `transaksi` WHERE kategori_transaksi='$kategori' AND MONTH(tanggal)=MONTH('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal')");
    }elseif($periode=="Tahunan"){
        $sql21 = mysqli_query($connect,"SELECT SUM(nominal) AS jml FROM `transaksi` WHERE kategori_transaksi='$kategori' AND YEAR(tanggal)=YEAR('$tanggal')");
    }
    
    $row21= mysqli_fetch_array($sql21);
    return number_format($row21["jml"]);
}
function kompres1($maxDim,$file_name,$folder){
    list($width, $height, $type, $attr) = getimagesize( $file_name );
    if ( $width > $maxDim || $height > $maxDim ) {
        $target_filename = $file_name;
        $ratio = $width/$height;
        if( $ratio > 1) {
            $new_width = $maxDim;
            $new_height = $maxDim/$ratio;
        } else {
            $new_width = $maxDim*$ratio;
            $new_height = $maxDim;
        }
        $src = imagecreatefromstring( file_get_contents( $file_name ) );
        $dst = imagecreatetruecolor( $new_width, $new_height );
        imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
        imagedestroy( $src );
        imagepng( $dst, $target_filename ); // adjust format as needed
        imagedestroy( $dst );
        copy($file_name, $folder);
        } 
    }
function kompres($size,$tmp,$location){
    if($size<500000){
        copy($tmp,$location);  
     }elseif($size<700000){
          compressImage($tmp,$location,70); 
      }elseif($size<1500000){
          compressImage($tmp,$location,50); 
      }elseif($size<3000000){
          compressImage($tmp,$location,40); 
      }elseif($size<4500000){
          compressImage($tmp,$location,30); 
      }else{
         // Compress Image
          compressImage($tmp,$location,20); 
      }
}
    
// Compress image
function compressImage($source, $destination, $quality) {

    $info = getimagesize($source);
    
    if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);
    
    elseif ($info['mime'] == 'image/gif') 
      $image = imagecreatefromgif($source);
    
    elseif ($info['mime'] == 'image/png') 
      $image = imagecreatefrompng($source);
    
    imagejpeg($image, $destination, $quality);

}

//Akuntansi
function neracasaldo($akun, $awal, $akhir) {
    global $connect;
    $sql = mysqli_query($connect,"SELECT SUM(nominal)AS totaldebit FROM `tb_transaksi` WHERE debit='$akun' AND tanggal BETWEEN '$awal' AND '$akhir'");
    $row= mysqli_fetch_array($sql);
    $debit = $row["totaldebit"];
    
    $sql2 = mysqli_query($connect,"SELECT SUM(nominal)AS totalkredit FROM `tb_transaksi` WHERE kredit='$akun' AND tanggal BETWEEN '$awal' AND '$akhir'");
    $row2= mysqli_fetch_array($sql2);
    $kredit = $row2["totalkredit"];
    
    $total=$debit-$kredit;
    
    return $total;
}

function posisikeuangan($akun, $tanggal) {
    global $connect;
    $sql = mysqli_query($connect,"SELECT SUM(nominal)AS totaldebit FROM `tb_transaksi` WHERE debit like '$akun%' AND tanggal <= '$tanggal' ");
    $row= mysqli_fetch_array($sql);
    $debit = $row["totaldebit"];
    
    $sql2 = mysqli_query($connect,"SELECT SUM(nominal)AS totalkredit FROM `tb_transaksi` WHERE kredit like '$akun%' AND tanggal <= '$tanggal'");
    $row2= mysqli_fetch_array($sql2);
    $kredit = $row2["totalkredit"];
    
    $total=$debit-$kredit;
    if($total<1){
        $total=$total*-1;
    }
    return $total;
}

function labarugi($akun, $awal, $akhir){
    global $connect;
    $sql = mysqli_query($connect,"SELECT SUM(nominal)AS totaldebit FROM `tb_transaksi` WHERE debit like '$akun%' AND tanggal BETWEEN '$awal' AND '$akhir'");
    $row= mysqli_fetch_array($sql);
    $debit = $row["totaldebit"];
    
    $sql2 = mysqli_query($connect,"SELECT SUM(nominal)AS totalkredit FROM `tb_transaksi` WHERE kredit like '$akun%' AND tanggal BETWEEN '$awal' AND '$akhir'");
    $row2= mysqli_fetch_array($sql2);
    $kredit = $row2["totalkredit"];
    
    $total=$debit-$kredit;
    if($total<1){
        $total=$total*-1;
    }
    return $total;
}

function labarugiBulan($bulan){
    $awal=date(Y)."-".$bulan."-1";
    $akhir=date(Y)."-".$bulan."-31";
    $labarugi=labarugi(4,$awal,$akhir)-labarugi(6,$awal,$akhir);
    return $labarugi;
}

?>