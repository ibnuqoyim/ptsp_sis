<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function CekTextFromHtml($txt,$defaultvalue=null){
	$result=strip_tags($txt);
	$result=@eregi_replace("&nbsp;",' ',$result);
	$result=trim($result);
	return $result? $txt:$defaultvalue;
}

function GetInput($post,$url='',$defaultvalue='',$rep=1){
	if($post!==false && @eregi("[0-9a-z]",$post)){
		$result=trim($post);
	} elseif(@eregi("[0-9a-z]",$url)) {
		$result=trim($url);
	} else {
		$result=$defaultvalue;
	}
	if($rep){return @eregi_replace("[^0-9 \.a-z_@-]",'',$result);}
	else {return $result;}
}

function GetLenghtTextOfHTML($txt){
	$result=strip_tags($txt);
	$result=@eregi_replace("&nbsp;",' ',$result);
	$result=trim($result);
	return strlen($result);
}

function GetNumber($post,$url='',$defaultvalue=0){
	if($post!==false && @ereg("[0-9]",$post)){
		$result=(int) $post;
	} elseif(@ereg("[0-9]",$url)) {
		$result=(int) $url;
	} else {
		$result=$defaultvalue;
	}
	return $result;
}

function GetPatern($patern,$post,$url='',$defaultvalue='',$autoquote=0,$delimiter='#'){
	if($autoquote){
		if($post!==false && preg_match($delimiter."^".preg_quote($patern)."$".$delimiter.'is',$post)){
			$result=$post;
		} elseif(preg_match($delimiter."^".preg_quote($patern)."$".$delimiter.'is',$url)){
			$result=$url;
		} else {
			$result=$defaultvalue;
		}
	} else {
		if($post!==false && preg_match($delimiter."^".$patern."$".$delimiter.'is',$post)){
			$result=$post;
		} elseif(preg_match($delimiter."^".$patern."$".$delimiter.'is',$url)){
			$result=$url;
		} else {
			$result=$defaultvalue;
		}
	}
	return $result;
}

function GetSort($post,$url='',$defaultvalue='desc'){
	$nondefaultvalue=$defaultvalue=='asc'? 'desc':'asc';
	if($post===false){
		return $url==$defaultvalue? $defaultvalue:$nondefaultvalue;
	} else {
		return $post==$defaultvalue? $defaultvalue:$nondefaultvalue;
	}
}

function GetTanggal($post,$url='',$defaultvalue=''){
	if($post!==false && (preg_match("|^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$|",$post) || preg_match("|^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{2}:[0-9]{2}:[0-9]{2}$|",$post))){
		return $post;
	} elseif(preg_match("|^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$|",$url) || preg_match("|^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{2}:[0-9]{2}:[0-9]{2}$|",$url)){
		return $url;
	} else {
		return $defaultvalue;
	}
}

function GetTextFromHTML($txt){
	$result=preg_replace("#\<br(\s+/|\s*)\>#i",' ',$txt);
	return strip_tags($result);
}

function SetAttr($val,$defaultval='-'){
	return $val? $val:$defaultval;
}

function Strip_HTML($txt,$strip_nl=1){
	$txt=strip_tags(@eregi_replace("&nbsp;",' ',$txt));
	$txt=@ereg_replace("[\r\n]",' ',$txt);
	return trim($txt);
}

function TglIndon($tgl){
	$arrbln=array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	list($thn,$bln,$tgl)=split("[:/ -]",$tgl);
	$tgl=(int) $tgl;
	$bln=(int) $bln;
	return $tgl.' '.$arrbln[$bln].' '.$thn;
}

function do_crypt($Pass)
                {
                        $Result="";

                        for ($i=0;$i<strlen($Pass);$i++)
                        {
                                $tmp=ord($Pass[$i]);
                                $tmp=$tmp+$i;
                                $num1=intval($tmp/100);
                                $num2=intval($tmp%100);
                                $num2=intval($num2/10);
                                $num3=intval($tmp%10);
                                $Result=$Result.$num1;
                                $Result=$Result.$num2;
                                $Result=$Result.$num3;
                        }
                        return $Result;
                }
				
function do_decrypt($CodedPass)
                {
                        $result="";

                        $i=0;
                        while ($i<strlen($CodedPass))
                        {
                                $num1=ord($CodedPass[$i++]);
                                if ($i>=strlen($CodedPass))
                                    break;
                                $num2=ord($CodedPass[$i++]);
                                if ($i>=strlen($CodedPass))
                                    break;
                                $num3=ord($CodedPass[$i++]);
                                if ($i>strlen($CodedPass))
                                    break;
                                $num1=$num1-48;
                                $num2=$num2-48;
                                $num3=$num3-48;

                                $num=$num1*100+$num2*10+$num3;
                                $char=chr($num);
                                $result=$result.$char;
                        }
                        $result1="";
                        for ($i=0;$i<strlen($result);$i++)
                        {
                                $tmp=ord($result[$i]);
                                $tmp=$tmp-$i;
                                $char=chr($tmp);
                                $result1=$result1.$char;
                        }
                        return $result1;
                }
function key_compare_func($key1, $key2)
{
    if ($key1 == $key2)
        return 0;
    else if ($key1 > $key2)
        return 1;
    else
        return -1;
}

?>
