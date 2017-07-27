// JavaScript Document
//Author: Djono Amidjojo, 16 August 2008
//Email: djonoamidjojo@gmail.com

function decimalCurrency(txt) {
	regExp = /^[0-9]+(\.[0-9]+)*$/;
	return regExp.test(txt.value);
}

function numeric(txt){
    var flag=true;
    for(i=0;txt.value.length>i;i++){
        code=txt.value.charCodeAt(i);
        if (( (code>=48) && (code<=57) ) || (code == 45) || (code == 43))
            flag=true
        else {
            flag=false;
            break;
        }
    }
    return flag;
}

function commaSplit(srcNumber,JumDigit) {
	var txtNumber = '' + srcNumber;
	if (isNaN(txtNumber)) {
		txtNumber=replaceString(",",".",txtNumber);
	}
	var arrNumber = txtNumber.split('.');
	if(isNaN(arrNumber[1])){
		txtNumber+='.000';	
		arrNumber = txtNumber.split('.');
	}
	if(arrNumber[1].length>0 && arrNumber[1].length<JumDigit){
		do {
			txtNumber += '0';
			arrNumber = txtNumber.split('.');
		} while (arrNumber[1].length<JumDigit);
	}
	if(arrNumber[1].length>JumDigit){ txtNumber=formatDecimal(txtNumber,JumDigit); }
	return txtNumber;
}

function formatUang(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + num);
}

function HanyaAngkaAbjad(evt) { //angka huruf only
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if ((charCode >= 48 && charCode < 58) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode==46 || charCode==8 || charCode==9 || charCode==13) {//tanda panah, koma,tab,backspace,del dan enter boleh
        return true;
    } else {
        return false;
    }
}

function HanyaAngka(evt) { //angka only
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if ((charCode >= 48 && charCode < 58) || (charCode >= 96 && charCode <= 105) || (charCode >= 37 && charCode <= 40) || charCode==8 || charCode==45 || charCode==46 || charCode==17 || charCode==86 || charCode==86 || charCode==9 || charCode==13) { //tanda panah, koma,tab,backspace,del,ctrl dan enter boleh
        return true;
    } else {
        return false;
		//alert(charCode);
    }
}


function setCookie(c_name,value,expiredays)
	{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toUTCString());
}
	
function getCookie(c_name)
	{
	if (document.cookie.length>0)
	  {
	  c_start=document.cookie.indexOf(c_name + "=");
	  if (c_start!=-1)
		{
		c_start=c_start + c_name.length+1;
		c_end=document.cookie.indexOf(";",c_start);
		if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	  }
	return "";
}
