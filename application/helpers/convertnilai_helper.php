<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('OneDigit'))
{
	function OneDigit($number){
		$one_digit=array('0'=>'zero','1'=>'satu','2'=>'dua','3'=>"tiga",'4'=>"empat",'5'=>"lima",'6'=>'enam','7'=>'tujuh',
		'8'=>'delapan','9'=>'sembilan','10'=>'sepuluh','11'=>'sebelas',"12"=>'dua belas','13'=>'tiga belas','14'=>'empat belas',
		'15'=>'lima belas','16'=>'enam belas','17'=>'tujuh belas','18'=>'delapan belas','19'=>'sembilan belas','-'=>'minus');
		return $one_digit[$number];	
	}
}

if ( ! function_exists('TenDigit'))
{
	function TenDigit($number){
		$ten_digit=array('0'=>'','1'=>'','2'=>'dua puluh','3'=>'tiga puluh','4'=>'empat puluh','5'=>'lima puluh','6'=>'enam puluh',
		'7'=>'tujuh puluh','8'=>'delapan puluh','9'=>'sembilan puluh');
		return $ten_digit[$number];
	}
}

if ( ! function_exists('NumberLong'))
{
	function NumberLong($number){
		$number = strlen($number);
		$numberlong=array('3'=>'seratus','4'=>'ribu','5'=>'ribu','6'=>'ribu','7'=>'juta',
		'8'=>'juta','9'=>'juta','10'=>'milyar','11'=>'milyar','12'=>'milyar','13'=>'triliyun','14'=>'triliyun','15'=>'triliyun');
		return $numberlong[$number];	
	}
}

if ( ! function_exists('EraseChar'))
{
	function EraseChar($number) {
		$remove = array("'", "+", "*", "(", ")", " ", "%", ",");
		$number = str_replace($remove, "", $number);
		return $number;
	}
}

if ( ! function_exists('convert'))
{
	function is_number($element) {
  		return preg_match ("/[^0-9]/", $element);
	}
}


if ( ! function_exists('str_rsplit'))
{
	function str_rsplit($str, $sz)
	{
    		if ( !$sz ) { return false; }
    		if ( $sz > 0 ) { return  str_split($str,$sz); }   
    		$l = strlen($str);
   		$sz = min(-$sz,$l);
    		$mod = $l % $sz;
    		if ( !$mod ) { return  str_split($str,$sz); }    

    		return array_merge(array(substr($str,0,$mod)),  str_split(substr($str,$mod),$sz));
	}
}


if ( ! function_exists('TwoDigit'))
{
	function TwoDigit($number) {
	$number =  intval($number);
	$count1 =  substr($number, -2, 1);
	$count2 =  substr($number, -1, 1);
	$counter1 =  TenDigit($count1);
	$counter2 =  OneDigit($count2);
		if(($number>=0) && ($number<=19)) {
			$number =  OneDigit($number);
		} else {
			if ($count2 == 0) {
				$number = $counter1;
			} else {
				$number = $counter1." ".$counter2;
			}
		}
	return $number;
	} 
}

if ( ! function_exists('ThreeDigit'))
{
	function ThreeDigit($number) {
	$count1 =  substr($number, -3, 1);
	$count2 =  substr($number, -2, 2);
	$counter1 =  OneDigit($count1);
	$counter2 =  TwoDigit($count2);
		if ($count2 == 0) {
			if($counter1=='satu'){			
				$number = "seratus";
			}else{
				$number = $counter1." ratus";
			}
		} else if ($count1 == 0) {
			  	$number =  TwoDigit($number);
		} else {
			if($counter1=='satu'){
				$number = "seratus ".$counter2;
			}else{
				$number = $counter1." ratus ".$counter2;
			}
		}
	return $number;
	} 
}

if ( ! function_exists('ThousandDigit'))
{
	function ThousandDigit($number) {
	$NumberLong =  NumberLong($number);
	$splitnumb =  str_rsplit($number,-3);
		$ribuan = $splitnumb[0];
		$ratusan = $splitnumb[1];
		$nratusan =  ThreeDigit($ratusan);
		$nribuan =  NumberSplit($ribuan);
		
		if ($ribuan==0) {
			$number = $nratusan;
		} else {
			if($nratusan=="zero ratus"){
				if($nribuan=='SATU'){
					$number ="se".$NumberLong;
				}else{
					$number = $nribuan." ".$NumberLong;
				}
			}else{
				if($nribuan=='SATU'){
					$number = "se".$NumberLong." ".$nratusan;
				}else{
					$number = $nribuan." ".$NumberLong." ".$nratusan;
				}
			}
			
		}
	return $number;
	}
}

if ( ! function_exists('MillionDigit'))
{
	function MillionDigit($number) {
	$NumberLong =  NumberLong($number);
	$splitnumb =  str_rsplit($number,-3);
	$jutaan = $splitnumb[0];
	$ribuan = $splitnumb[1];
	$ratusan = $splitnumb[2];
	
	$ribuan = $splitnumb[1].$splitnumb[2];
	$nribuan =  ThousandDigit($ribuan);
	$njutaan =  NumberSplit($jutaan);
	
	if ($jutaan==0) {

		$number = $nribuan;
	} else {
		if($nribuan == "zero ratus"){
			$number = $njutaan." ".$NumberLong;
		}else{
			$number = $njutaan." ".$NumberLong." ".$nribuan;
		}
	}
	return $number;
	}
}

if ( ! function_exists('BillionDigit'))
{
	function BillionDigit($number) {
	$NumberLong =  NumberLong($number);
	$splitnumb =  str_rsplit($number,-3);
	$milyaran = $splitnumb[0];
	$jutaan = $splitnumb[1];
	$ribuan = $splitnumb[2];
	$ratusan = $splitnumb[3];
	
	$jutaan = $splitnumb[1].$splitnumb[2].$splitnumb[3];
	$njutaan =  MillionDigit($jutaan);
	$nmilyaran =  NumberSplit($milyaran);
	
	if($milyaran==0) {
		$number = $njutaan;
	} else {
		if($njutaan == 'zero ratus'){
			$number = $nmilyaran." ".$NumberLong;
		}else{
			$number = $nmilyaran." ".$NumberLong." ".$njutaan;
		}	
	}
	return $number;
	}


}

if ( ! function_exists('TrillionDigit'))
{
	function TrillionDigit($number) {
	$NumberLong =  NumberLong($number);
	$splitnumb =  str_rsplit($number,-3);
	$triliunan = $splitnumb[0];
	$milyaran = $splitnumb[1];
	$jutaan = $splitnumb[2];
	$ribuan = $splitnumb[3];
	$ratusan = $splitnumb[4];
	
	$milyaran = $splitnumb[1].$splitnumb[2].$splitnumb[3].$splitnumb[4];
	$nmilyaran =  BillionDigit($milyaran);
	$ntriliunan =  NumberSplit($triliunan);
	
	if($triliunan==0) {
		$number = $nmilyaran;
	} else {
		if($nmilyaran=="zero ratus"){
			$number = $ntriliunan." ".$NumberLong;
		}else{
			$number = $ntriliunan." ".$NumberLong." ".$nmilyaran;
		}
	}
	return $number;
	}
}

if ( ! function_exists('NumberSplit'))
{
	function NumberSplit($number){
	$number =  EraseChar($number);
	if (($number >= 0) && ($number < 100)) {
		$number =  TwoDigit($number);
	} else if (($number >= 100) && ($number < 1000)) {
		$number =  ThreeDigit($number);
	} else if (($number >= 1000) && ($number < 1000000)) {
		$number =  ThousandDigit($number);
	} else if (($number >= 1000000) && ($number < 1000000000)) {
		$number =  MillionDigit($number);
	} else if (($number >= 1000000000) && ($number < 1000000000000)) {
		$number =  BillionDigit($number);
	} else if (($number >= 1000000000000) && ($number < 1000000000000000)) {
		$number =  TrillionDigit($number);
	} else {
		$number = "Not Valid";
	}
	return strtoupper($number);
	}
}

if ( ! function_exists('convertNilaiToKalimat'))
{
	function convertNilaiToKalimat($number) {
	$arraye[0]='';
	$arraye = explode(".",$number);	
	$rupiah = NumberSplit($arraye[0]);
	if(count($arraye) >1){		
		$sen = NumberSplit($arraye[1]);
		$sen = " KOMA ".$sen." SEN";
		$number = $rupiah." RUPIAH ".$sen;

	}else{
		$number = $rupiah." RUPIAH ";
	}
	
	return $number;
	}

}

if ( ! function_exists('formatRupiah'))
{
	function formatRupiah($nilaiUang)
	{
		$nilaiRupiah = "";
		$jumlahAngka = strlen($nilaiUang);
		while($jumlahAngka > 3)
		{
			$nilaiRupiah = "." . substr($nilaiUang,-3) . $nilaiRupiah;
			$sisaNilai = strlen($nilaiUang) - 3;
			$nilaiUang = substr($nilaiUang,0,$sisaNilai);
			$jumlahAngka = strlen($nilaiUang);
		}
 
		$nilaiRupiah = "Rp. " . $nilaiUang . $nilaiRupiah . ",-";
		return $nilaiRupiah;
	}
}

if ( ! function_exists('formatUangInd'))
{
	function formatUangInd($nilaiUang)
	{
		$nilaiRupiah = "";
		$jumlahAngka = strlen($nilaiUang);
		while($jumlahAngka > 3)
		{
			$nilaiRupiah = "." . substr($nilaiUang,-3) . $nilaiRupiah;
			$sisaNilai = strlen($nilaiUang) - 3;
			$nilaiUang = substr($nilaiUang,0,$sisaNilai);
			$jumlahAngka = strlen($nilaiUang);
		}
 
		$nilaiRupiah =  $nilaiUang . $nilaiRupiah . ",-";
		return $nilaiRupiah;
	}
}

