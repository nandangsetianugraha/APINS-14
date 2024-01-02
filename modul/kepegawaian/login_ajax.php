<?php 
session_start();
require_once '../../config/config.php';
require_once '../../config/db_connect.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	$jenis=$_POST['type'];
	if($jenis==2){
		$phone=$_POST['phone'];
		$cek  = $connect->query("SELECT * FROM ptk WHERE no_hp='$phone'")->num_rows;
		if($cek>0){
			$rndno=rand(100000, 999999);
			$pesan = "Nomor OTP : ".$rndno;
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://api.fonnte.com/send',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => array(
			'target' => $phone,
			'message' => $pesan, 
			'countryCode' => '62', //optional
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: R#FG1-RIrNiz+q1CkyMM' //change TOKEN to your actual token
			),
			));

			$response = curl_exec($curl);

			curl_close($curl);
				//echo $response;
				
			$_SESSION['otp']=$rndno;
			$_SESSION['handphone']=$phone;
			$validator['success'] = true;
			$validator['messages'] = "Kode OTP sudah dikirimkan ke nomor ".$phone;
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Nomor ".$phone." tidak terdaftar!";
		}
	}
	if($jenis==3){
		$otp1=$_POST['otp1'];
		$otp2=$_POST['otp2'];
		$otp3=$_POST['otp3'];
		$otp4=$_POST['otp4'];
		$otp5=$_POST['otp5'];
		$otp6=$_POST['otp6'];
		$otpnya=$otp1.$otp2.$otp3.$otp4.$otp5.$otp6;
		if($otpnya==$_SESSION['otp']){
			$validator['success'] = true;
			$validator['messages'] = "Kode OTP benar!";
			$phone=$_SESSION['handphone'];
			$result  = $connect->query("SELECT * FROM ptk WHERE no_hp='$phone'")->fetch_assoc();
			$idptk=$result['ptk_id'];
			$pengguna = $connect->query("SELECT * FROM pengguna WHERE ptk_id='$idptk'")->fetch_assoc();
			$_SESSION['username'] = $pengguna['username'];
            //$_SESSION['password'] = $mypassword;
			$_SESSION['tapel'] = $tapel_aktif;
			$_SESSION['smt'] = $smt_aktif;
			$_SESSION['unique_id']= $result['ptk_id'];
			$_SESSION['userid'] = $result['ptk_id'];
			$_SESSION['level'] = $pengguna['level'];
			$logDate=date('Y-m-d H:i:s');
			
			$aktivitas = 'Login ke Sistem melalui OTP';
			$sql1="INSERT INTO log(ptk_id, logDate, activity) values('$idptk', '$logDate', '$aktivitas')";
			$query1 = $connect->query($sql1);
		}else{
			$validator['success'] = false;
			$validator['messages'] = "Kode OTP salah!";
		}
	}
	
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}

