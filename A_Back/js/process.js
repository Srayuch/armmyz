function sweet(string,bool){
	if(bool){
		sweetAlert(
		  'สำเร็จ',
		  string,
		  'success'
		)		
	}else{
		sweetAlert(
		  'ล้มเหลว',
		  string,
		  'error'
		)		
	}
}

function re(str){
	return str.replace(/\s/g, "");
}

$( "#submit-login" ).click(function () {
	var accountname	= $("#accountname").val();
	var password 	= $("#password").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {accountname : accountname, password : password, cmd : 'login'},
		success: function(res){
			if (re(res)=='LOGIN:TRUE')
			{
				sweet("เข้าสู่ระบบสำเร็จ.....กรุณารอสักครู่",true);
				setTimeout(function(){
					location.reload();
				}, 2000);		
			}
			else if (re(res)=='LOGIN:FALSE')
			{
				sweet("อีเมลหรือรหัสผ่านไม่ถูกต้อง",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#accountname").val("");
			$("#password").val("");			
		}
	});
})

function js_popup(theURL,width,height) { //v2.0
	leftpos = (screen.availWidth - width) / 2;
    toppos = (screen.availHeight - height) / 2;
  	window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
}	

$( "#submit-changepass" ).click(function () {
	var userencrypt	= $("#userencrypt").val();
	var passold		= $("#passold").val();
	var newpass1 	= $("#newpass1").val();	
	var newpass2 	= $("#newpass2").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {userencrypt : userencrypt, passold : passold, newpass1 : newpass1, newpass2 : newpass2, cmd : 'changepass'},
		success: function(res){
			if (re(res)=='CHANGEPASS:TRUE')
			{
				sweet("เปลี่ยนรหัสผ่านสำเร็จ",true);	
			}
			else if (re(res)=='CHANGEPASS:FALSE')
			{
				sweet("รหัสผ่านไม่ถูกต้องกรุณาตรวจสอบใหม่อีกครั้ง",false);	
			}
			else if (re(res)=='CHANGEPASS:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);	
			}
			else if (re(res)=='CHANGEPASS:NMATCH')
			{
				sweet("รหัสผ่านผ่านใหม่ไม่ตรงกัน",false);	
			}
			else if (re(res)=='CHANGEPASS:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
			}
			else if (re(res)=='CHANGEPASS:CHARLENGTH')
			{
				sweet("ความยาวตัวอักษรควรอยู่ที่ระหว่าง 6-16 ตัวอักษร",false);	
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);	
			}
			$("#passold").val("");
			$("#newpass1").val("");	
			$("#newpass2").val("");			
		}
	});
})

$( "#submit-gcamount" ).click(function () {
	
	var true50		= $("#true50").val();
	var true90		= $("#true90").val();
	var true150 	= $("#true150").val();	
	var true300 	= $("#true300").val();
	var true500 	= $("#true500").val();
	var true1000 	= $("#true1000").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {true50 : true50, true90 : true90, true150 : true150, true300 : true300, true500 : true500, true1000 : true1000, cmd : 'gcamount'},
		success: function(res){				
			if (re(res)=='GCAMOUNT:TRUE')
			{
				sweet("บันทึกการเปลี่ยนแปลงสำเร็จ...",true);				
			}
			else if (re(res)=='GCAMOUNT:GCMOUNTVALID')
			{
				sweet("รูปแบบสามารถใช้งานได้เพียงตัวเลขเท่านั้น",false);	
			}
			else if (re(res)=='GCAMOUNT:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);	
			}
			else if (re(res)=='GCAMOUNT:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);	
			}
			$("#itemid").val("");
			$("#itemname").val("");	
			$("#itemamount").val("");			
		}
	});
})

$( "#submit-addpromotion" ).click(function () {
	
	var trueamount	= $("#trueamount").val();
	var itemid		= $("#itemid").val();
	var itemname 	= $("#itemname").val();	
	var itemamount 	= $("#itemamount").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {trueamount : trueamount, itemid : itemid, itemname : itemname, itemamount : itemamount, cmd : 'addpromotion'},
		success: function(res){			
			var arr = res.split('#');
			if (re(arr[0])=='ADDPROMOTION:TRUE')
			{
				sweet("เพิ่มไอเทมโปรโมชั่นสำเร็จ...",true);
				$(arr[1]).hide().prependTo('#table-promotion').fadeIn(700);		
			}
			else if (re(arr[0])=='ADDPROMOTION:TRUEAMOUNTVALID')
			{
				sweet("รูปแบบมูลค่าบัตรไม่ถูกต้อง",false);	
			}
			else if (re(arr[0])=='ADDPROMOTION:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);	
			}
			else if (re(arr[0])=='ADDPROMOTION:NUMVALID')
			{
				sweet("รหัสไอเทม หรือ จำนวนไอเทม ไม่ถูกต้อง",false);	
			}
			else if (re(arr[0])=='ADDPROMOTION:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);	
			}
			$("#itemid").val("");
			$("#itemname").val("");	
			$("#itemamount").val("");			
		}
	});
})

$( "#submit-addpoint1" ).click(function () {
	var username	= $("#username1").val();
	var quantity 	= $("#quantity1").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {username : username, quantity : quantity, cmd : 'addpoint1'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDPOINT:TRUE')
			{
				sweet(username + " ได้รับ GC จำนวน " + quantity + " เรียบร้อย",true);
			}
			else if (re(arr[0])=='ADDPOINT:FALSE')
			{
				sweet("ไม่มีไอดีหรืออีเมลนี้อยู่ในระบบ",false);
			}
			else if (re(arr[0])=='ADDPOINT:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='ADDPOINT:ISLOW')
			{
				sweet("จำนวน GC ไม่สามารถต่ำกว่า 1 ได้",false);
			}
			else if (re(arr[0])=='ADDPOINT:NUMVALID')
			{
				sweet("GC อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDPOINT:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#username1").val("");
			$("#quantity1").val("");			
		}
	});
})

$( "#submit-addpoint2" ).click(function () {
	var username	= $("#username1").val();
	var quantity 	= $("#quantity1").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {username : username, quantity : quantity, cmd : 'addpoint2'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDPOINT:TRUE')
			{
				sweet("ทั้งหมดได้รับ GC จำนวน " + quantity + " เรียบร้อย",true);
			}
			else if (re(arr[0])=='ADDPOINT:NOTNULL')
			{
				sweet("ไอดี / อีเมล ปล่อยว่างไว้",false);
			}
			else if (re(arr[0])=='ADDPOINT:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='ADDPOINT:ISLOW')
			{
				sweet("จำนวน GC ไม่สามารถต่ำกว่า 1 ได้",false);
			}
			else if (re(arr[0])=='ADDPOINT:NUMVALID')
			{
				sweet("GC อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDPOINT:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#username1").val("");
			$("#quantity1").val("");			
		}
	});
})	

$( "#submit-additem1" ).click(function () {
	var username	= $("#username2").val();
	var itemindex 	= $("#itemindex2").val();	
	var quantity 	= $("#quantity2").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {username : username, itemindex : itemindex, quantity : quantity, cmd : 'additem1'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDITEM:TRUE')
			{
				sweet(username + " ได้รับ item รหัส " + itemindex + " จำนวน " + quantity + " ชิ้นเรียบร้อย",true);
			}
			else if (re(arr[0])=='ADDITEM:FALSE')
			{
				sweet("ไม่มีไอดีหรืออีเมลนี้อยู่ในระบบ",false);
			}
			else if (re(arr[0])=='ADDITEM:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='ADDITEM:INDEXVALID')
			{
				sweet("รหัส Item อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDITEM:NUMVALID')
			{
				sweet("จำนวนอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDITEM:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#username2").val("");
			$("#itemindex2").val("");
			$("#quantity2").val("");			
		}
	});
})

$( "#submit-additem2" ).click(function () {
	var username	= $("#username2").val();
	var itemindex 	= $("#itemindex2").val();	
	var quantity 	= $("#quantity2").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: {username : username, itemindex : itemindex, quantity : quantity, cmd : 'additem2'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDITEM:TRUE')
			{
				sweet("ทั้งหมดได้รับ item รหัส " + itemindex + " จำนวน " + quantity + " ชิ้นเรียบร้อย",true);
			}
			else if (re(arr[0])=='ADDITEM:NOTNULL')
			{
				sweet("ไอดี / อีเมล ปล่อยว่างไว้",false);
			}
			else if (re(arr[0])=='ADDITEM:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='ADDITEM:INDEXVALID')
			{
				sweet("รหัส Item อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDITEM:NUMVALID')
			{
				sweet("จำนวนอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น",false);
			}
			else if (re(arr[0])=='ADDITEM:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#itemindex2").val("");
			$("#quantity2").val("");	
			$("#username2").val("");			
		}
	});
})

$( "button[id='submit-buyitem']" ).click(function () {
	var id			= $(this).val();
	var username	= $("#usernameplayer" + id).val();
	var itemid 		= $("#buyitemid" + id).val();
	swal({
		type: 'question',
		text: 'ท่านแน่ใจหรือไม่...ที่จะซื้อไอเทมชิ้นนี้',
		showConfirmButton: true,
		confirmButtonText: 'ยืนยัน',
		confirmButtonColor: '#3085d6',
		showCancelButton: true,
		cancelButtonText: 'ยกเลิก',
		cancelButtonColor: '#aaa',
	}).then(function(result) {
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: {username : username, itemid : itemid,  cmd : 'buyspcitem'},
			success: function(res){
				var arr = res.split('#');
				if (re(arr[0])=='BUYSPCITEM:TRUE')
				{
					sweet("ซื้อไอเทมสำเร็จ",true);
					setTimeout(function(){
						location.reload();
					}, 2000);
				}
				else if (re(arr[0])=='BUYSPCITEM:NOWP')
				{
					sweet("WebPoint ของท่านไม่พอ กรุณาเติมเงิน",false);
				}
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
				}
				$("#usernameplayer" + id).val("");
				$("#buyitemid" + id).val("");
			}
		});
	}).done();
})

$( "#submit-gencodegc" ).click(function () {	
	var gcpoint 	= $("#gcpoint").val();	
	var limit 		= $("#limit").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { gcpoint : gcpoint, limit : limit, cmd : 'gencodegc'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='GENCODEGC:TRUE')
			{	
				sweet("สร้าง Itemcode สำเร็จ...",true);	
				$(arr[1]).hide().prependTo('#table-gencode').fadeIn(700);	
			}
			else if (re(arr[0])=='GENCODEGC:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน...",false);
			}
			else if (re(arr[0])=='GENCODEGC:NUMVALID')
			{
				sweet("จำนวนอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='GENCODEGC:LIMITVALID')
			{
				sweet("จำนวนครั้งการใช้โคดซ้ำอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='GENCODEGC:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#gcpoint").val("");	
			$("#limit").val("");		
		}
	});
})

$( "#submit-movenow" ).click(function () {	
	var schar 	= $("#schar").val();	
	var map 	= $("#map").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { schar : schar, map : map, cmd : 'movenow'},
		success: function(res){
			if((res)=='MOVENOW:TRUE')
			{
				sweet("เทเลพอตสำเร็จแล้ว...",true);	
			}	
			else if((res)=='MOVENOW:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน...",false);
			}		
			else if((res)=='MOVENOW:ANULL')
			{
				sweet("กรุณาเลือกตัวละครและแผนที่ที่จะไป...",false);
			}
			else if((res)=='MOVENOW:CNULL')
			{
				sweet("กรุณาเลือกตัวละคร...",false);
			}	
			else if((res)=='MOVENOW:MNULL')
			{
				sweet("กรุณาเลือกแผนที่ที่จะไป...",false);
			}
			else if((res)=='MOVENOW:NOTENOUGH')
			{
				sweet("ยอดเงินของคุณมีไม่เพี้ยงพอ...",false);
			}			
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#mapname").val("");
			$("#mapid").val("");	
		}
	});
})

$( "#submit-addmap" ).click(function () {	
	var mapname 	= $("#mapname").val();	
	var mapid 		= $("#mapid").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { mapname : mapname, mapid : mapid, cmd : 'addmap'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDMAP:TRUE')
			{
				sweet("เพิ่มแผนที่สำเร็จ...",true);	
				$(arr[1]).hide().prependTo('#table-addmap').fadeIn(700);	
				$(arr[2]).appendTo('#datamap');
				$("#datamap").effect( "highlight", {color:"#ff0000"}, 800 );
			}
			else if (re(arr[0])=='ADDMAP:PAYVALID')
			{
				sweet("รหัสแผนที่อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}	
			else if (re(arr[0])=='ADDMAP:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#mapname").val("");
			$("#mapid").val("");	
		}
	});
})

$( "#submit-addpos" ).click(function () {	
	var placename 	= $("#placename").val();
	var datamap 	= $("#datamap").val();	
	var posX 		= $("#posX").val();	
	var posY 		= $("#posY").val();	
	var posZ 		= $("#posZ").val();	
	var pay 		= $("#pay").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { placename : placename, datamap : datamap, posX : posX, posY : posY, posZ : posZ, pay : pay, cmd : 'addpos'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDPOS:TRUE')
			{
				sweet("เพิ่มจุดเทเลพอตสำเร็จ...",true);	
				$(arr[1]).hide().prependTo('#table-addpos').fadeIn(700);		
			}
			else if (re(arr[0])=='ADDPOS:PAYVALID')
			{
				sweet("ค่าบริการอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='ADDPOS:MAPVALID')
			{
				sweet("ข้อมูลแผนที่ไม่ถูกต้อง...",false);
			}		
			else if (re(arr[0])=='ADDPOS:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}	
			else if (re(arr[0])=='ADDPOS:POSVALID')
			{
				sweet("PosX PosY PosZ ผิดรูปแบบ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#placename").val("");
			$("#posX").val("");
			$("#posY").val("");
			$("#posZ").val("");
			$("#pay").val("");		
		}
	});
})
$( "#submit-addreward" ).click(function () {	
	var amount		= $("#amount").val();
	var itemid		= $("#itemid").val();	
	var quantity	= $("#quantity").val();	
	var itemname	= $("#itemname").val();		
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { amount : amount, itemid : itemid, quantity : quantity, itemname : itemname, cmd : 'addreward'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDREWARD:TRUE')
			{
				sweet("เพิ่มรีวอร์ดสำเร็จ...",true);	
				$(arr[1]).hide().prependTo('#table-addreward').fadeIn(700);		
			}
			else if (re(arr[0])=='ADDREWARD:AMOUNTVALID')
			{
				sweet("ยอดเงินสะสมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='ADDREWARD:ITEMIDVALID')
			{
				sweet("รหัสไอเทมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='ADDREWARD:QTVALID')
			{
				sweet("จำนวนไอเทมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}		
			else if (re(arr[0])=='ADDREWARD:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#amount").val("");
			$("#itemid").val("");
			$("#quantity").val("");
			$("#itemname").val("");
		}
	});
})
$(document).ready(function() {
	$("#itemid").keyup(function(event) {
		var id = $("#itemid").val();
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: { id : id, cmd : 'getitemname'},
			success: function(res){
				var arr = res.split('#');	
				$("#itemname").val(arr[0]);
			}
		});
	});
});

$( "#submit-spcitem" ).click(function () {	
	var itemid		= $("#itemid").val();
	var itemname	= $("#itemname").val();		
	var opt1		= $("#opt1").val();	
	var opt2		= $("#opt2").val();
	var opt3		= $("#opt3").val();
	var price		= $("#price").val();
	var quantity	= $("#quantity").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { itemid : itemid, itemname : itemname, opt1 : opt1, opt2 : opt2, opt3 : opt3, price : price, quantity : quantity, cmd : 'addspcitem'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='ADDSPCITEM:TRUE')
			{
				sweet("เพิ่มไอเทมพิเศษสำเร็จ...",true);	
				$(arr[1]).hide().prependTo('#table-addspcitem').fadeIn(700);		
			}
			else if (re(arr[0])=='ADDSPCITEM:ITEMIDVALID')
			{
				sweet("รหัสไอเทมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='ADDSPCITEM:PRICEVALID')
			{
				sweet("ราคาไอเทมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='ADDSPCITEM:QTVALID')
			{
				sweet("จำนวนไอเทมอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}		
			else if (re(arr[0])=='ADDSPCITEM:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#itemid").val("");
			$("#itemname").val("");
			$("#opt1").val("");
			$("#opt2").val("");
			$("#opt3").val("");
			$("#price").val("");
			$("#quantity").val("");
		}
	});
})
$( "#submit-gencodeitem" ).click(function () {
	var itemindex 	= $("#itemindex").val();	
	var itemname 	= $("#itemname").val();	
	var quantity 	= $("#quantity").val();	
	var ilimit 		= $("#ilimit").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { itemindex : itemindex, itemname : itemname, quantity : quantity, limit : ilimit, cmd : 'gencodeitem'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='GENCODEITEM:TRUE')
			{
				sweet("สร้าง Itemcode สำเร็จ...",true);
				$(arr[1]).hide().prependTo('#table-gencode').fadeIn(700);
			}
			else if (re(arr[0])=='GENCODEITEM:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน...",false);
			}
			else if (re(arr[0])=='GENCODEITEM:INDEXVALID')
			{
				sweet("รหัส Item อนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='GENCODEITEM:LIMITVALID')
			{
				sweet("จำนวนครั้งการใช้โคดซ้ำอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='GENCODEITEM:NUMVALID')
			{
				sweet("จำนวนอนุญาตให้ใส่ได้เพียงตัวเลขเท่านั้น...",false);
			}
			else if (re(arr[0])=='GENCODEITEM:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#itemindex").val("");	
			$("#itemname").val("");		
			$("#quantity").val("");		
			$("#ilimit").val("");	
		}
	});
})

$( "#submit-banned" ).click(function () {
	var banned 		= $("#banned").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { banned : banned, cmd : 'banned'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='BANNED:TRUE')
			{
				sweet("ทำการแบน banned สำเร็จ...",true);
				$(arr[1]).hide().prependTo('#table-banned').fadeIn(700);
				$("#acc_status").html('<span style="color:red; font-weight: bold">BAN ID</span>');
			}
			else if (re(arr[0])=='BANNED:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน...",false);
			}
			else if (re(arr[0])=='BANNED:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else if (re(arr[0])=='BANNED:NOUSER')
			{
				sweet("ไม่พบ ไอดี / อีเมล ในระบบ...",false);
			}
			else if (re(arr[0])=='BANNED:ALREADYBAN')
			{
				sweet("อีเมลนี้ถูกแบนอยู่ก่อนหน้านี้แล้ว...",false);
			}
			else if (re(arr[0])=='BANNED:FALSE')
			{
				sweet("อีเมลนี้ถูกแบนอยู่ก่อนหน้านี้แล้ว...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#banned").val("");
			$("#findchar").val("");				
		}
	});
})

$( "#submit-unban" ).click(function () {
	var cid		= $("#cid").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { cid : cid, cmd : 'unban'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='UNBAN:TRUE')
			{
				sweet("ทำการปลดแบนสำเร็จ...",true);
				$("#acc_status").html('<span style="color:green; font-weight: bold">NORMAL</span>');
			}
			else if (re(arr[0])=='UNBAN:FNULL')
			{
				sweet("กด F5 1 ครั้งก่อนนะครับ...",false);
			}
			else if (re(arr[0])=='UNBAN:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else if (re(arr[0])=='UNBAN:ALREADY')
			{
				sweet("ไอดีไม่ได้โดนแบน ไม่จำเป็นต้องปลดแบน...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#cid").val("");			
		}
	});
})

$( "#submit-hwidban" ).click(function () {
	var hardwareid	= $("#hardwareid").val();
	var cid			= $("#cid").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { hardwareid : hardwareid, cid : cid, cmd : 'hwidban'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='HWIDBAN:TRUE')
			{
				sweet("ทำการแบน HardwareID สำเร็จ...",true);
				$("#acc_status").html('<span style="color:red; font-weight: bold">BAN HWID</span>');
			}
			else if (re(arr[0])=='HWIDBAN:FNULL')
			{
				sweet("กด F5 1 ครั้งก่อนนะครับ...",false);
			}
			else if (re(arr[0])=='HWIDBAN:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else if (re(arr[0])=='HWIDBAN:ALREADY')
			{
				sweet("ไอดีนี้โดนแบน HardwareID อยู่แล้ว...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#hardwareid").val("");
			$("#cid").val("");			
		}
	});
})

$( "#submit-hwidunban" ).click(function () {
	var hardwareid	= $("#hardwareid").val();
	var cid			= $("#cid").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { hardwareid : hardwareid, cid : cid, cmd : 'hwidunban'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='HWIDUNBAN:TRUE')
			{
				sweet("ทำการปลดแบน HardwareID สำเร็จ...",true);
				$("#acc_status").html('<span style="color:green; font-weight: bold">NORMAL</span>');
			}
			else if (re(arr[0])=='HWIDUNBAN:FNULL')
			{
				sweet("กด F5 1 ครั้งก่อนนะครับ...",false);
			}
			else if (re(arr[0])=='HWIDUNBAN:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else if (re(arr[0])=='HWIDBAN:ALREADY')
			{
				sweet("ไอดีนี้ไม่โดนแบน HardwareID ไม่จำเป็นต้องปลดแบน...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#hardwareid").val("");
			$("#cid").val("");			
		}
	});
})

$( "#submit-findchar" ).click(function () {
	var findchar 		= $("#findchar").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { findchar : findchar, cmd : 'findchar'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='FINDCHAR:TRUE')
			{
				sweet("ค้นหาตัวละคร " + findchar + " สำเร็จ...",true);
				$("#banned").val(arr[1]);
			}
			else if (re(arr[0])=='FINDCHAR:FAILED')
			{
				sweet("ไม่พบชื่อตัวละครนี้...",false);
			}
			else if (re(arr[0])=='FINDCHAR:FNULL')
			{
				sweet("กรุณากรอกชื่อตัวละคร...",false);
			}
			else if (re(arr[0])=='FINDCHAR:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
})

$( "#submit-conf" ).click(function () {
	var conf_ip 		= $("#conf_ip").val();	
	var conf_user 		= $("#conf_user").val();	
	var conf_pass 		= $("#conf_pass").val();	
	var conf_dbname		= $("#conf_dbname").val();
	var conf_license	= $("#conf_license").val();
	var conf_passkey	= $("#conf_passkey").val();
	var conf_tmnid		= $("#conf_tmnid").val();
	var conf_adminid	= $("#conf_adminid").val();
	var conf_md5		= $("#conf_md5").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { conf_ip : conf_ip, conf_user : conf_user, conf_pass : conf_pass, conf_dbname : conf_dbname, conf_license : conf_license, conf_passkey : conf_passkey, conf_tmnid : conf_tmnid, conf_adminid : conf_adminid, conf_md5 : conf_md5, cmd : 'conf'},
		success: function(res){
			if (re(res)=='CONF:TRUE')
			{
				sweet("บันทึกข้อมูลสำเร็จ...",true);
				setTimeout(function(){
					location.reload();
				}, 2000);
			}
			else if (re(res)=='CONF:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน...",false);
			}
			else if (re(res)=='CONF:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
		}
	});
})

$( "#submit-senditemcode" ).click(function () {
	var itemcodekey	= $("#itemcodekey").val();	
	var userencrypt	= $("#userencrypt").val();	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { itemcodekey : itemcodekey, userencrypt : userencrypt, cmd : 'senditemcode'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='SENDITEMCODE:TRUE')
			{
				sweet("ใช้งาน Itemcode สำเร็จ",true);	
				$(arr[1]).hide().prependTo('#table-itemcode	').fadeIn(700);
			}
			else if (re(arr[0])=='SENDITEMCODE:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:CHARVALID')
			{
				sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:FALSE')
			{
				sweet("รหัส Itemcode ไม่ถูกต้อง",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:USED')
			{
				sweet("รหัส Itemcode ถูกใช้งานแล้ว",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:NOTCODE')
			{
				sweet("Itemcode นี้ไม่อยู่ในระบบ",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:NOTREMAIN')
			{
				sweet("Itemcode หมดอายุหรือใช้งานครบกำหนด",false);
			}
			else if (re(arr[0])=='SENDITEMCODE:USERISUSE')
			{
				sweet("Itemcode 1 ID สามารถใช้งานได้เพียง 1 ครั้ง",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",2);
			}
			$("#itemcodekey").val("");	
		}
	});
})

$( "#submit-startmultiple" ).click(function () {
	var start_date	= $("#start_date").val();	
	var end_date	= $("#end_date").val();	
	var multiple	= $("#multiple").val();	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { start_date : start_date, end_date : end_date, multiple : multiple, cmd : 'startmultiple'},
		success: function(res){	
			var arr = res.split('#');
			if (re(arr[0])=='STARTMULTIPLE:TRUE')
			{
				sweet("ดำเนินการแก้ไขกิจกรรมสำเร็จ กรุณารอสักครู่",true);
				$( "span#multi_status" ).html(arr[1]).effect( "highlight", {color:"#ccff99"}, 450 );
				$( "span#multi_wait" ).html(arr[2]).effect( "highlight", {color:"#ccff99"}, 450 );
				$( "span#multi_start" ).html(arr[3]).effect( "highlight", {color:"#ccff99"}, 450 );
				$( "span#multi_end" ).html(arr[4]).effect( "highlight", {color:"#ccff99"}, 450 );
			}
			else if (re(arr[0])=='STARTMULTIPLE:TIMEVALID')
			{
				sweet("เวลาเริ่มกิจกรรมไม่สามารถมากกว่าเวลาหมดกิจกรรมได้",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
		}
	});
})

function delpromotion(id,encode){	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'deletepromotion'},
		success: function(res){
			if (re(res)=='DELETEPROMOTION:TRUE')
			{
				sweet("ลบรายการโปรโมชั่นสำเร็จ...",true);
				$("#delpromotion"+id).fadeOut(700, function(){ $("#delpromotion"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function delmap(id,encode){	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'delmap'},
		success: function(res){
			if (re(res)=='DELETEADD:TRUE')
			{
				sweet("ลบรายการแผนที่สำเร็จ...",true);
				$("#delmap"+id).fadeOut(700, function(){ $("#delmap"+id).remove();});
				$("#delmapoption"+id).fadeOut(700, function(){ $("#delmapoption"+id).remove();});
				$("#datamap").effect( "highlight", {color:"#ff0000"}, 800 );
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function delpos(id,encode){	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'delpos'},
		success: function(res){
			if (re(res)=='DELETEPOS:TRUE')
			{
				sweet("ลบรายการจุดเทเลพอตสำเร็จ...",true);
				$("#delpos"+id).fadeOut(700, function(){ $("#delpos"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function deldata(id,encode){
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'deleteid'},
		success: function(res){
			if (re(res)=='DELETEID:TRUE')
			{
				sweet("ลบรายการสำเร็จ...",true);
				$("#del"+id).fadeOut(700, function(){ $("#del"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function delreward(id,encode){
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'deletereward'},
		success: function(res){
			if (re(res)=='DELETEREWARD:TRUE')
			{
				sweet("ลบรายการสำเร็จ...",true);
				$("#delreward"+id).fadeOut(700, function(){ $("#delreward"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function delspcitem(id,encode){
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'deletespcitem'},
		success: function(res){
			if (re(res)=='DELETESPCITEM:TRUE')
			{
				sweet("ลบรายการสำเร็จ...",true);
				$("#delspcitem"+id).fadeOut(700, function(){ $("#delspcitem"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function delbanned(id,encode){
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'deletebanned'},
		success: function(res){
			if (re(res)=='DELETEBANNED:TRUE')
			{
				sweet("ทำรายการปลดแบนสำเร็จ...",true);
				$("#delbanned"+id).fadeOut(700, function(){ $("#delbanned"+id).remove();});
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

function getreward(id,encode){
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { id : id, encode : encode, cmd : 'getreward'},
		success: function(res){
			if(re(res)=='GETREWARD:TRUE')
			{
				sweet("รับไอเทมรีวอร์ดสำเร็จ...",true);
				$("button#btnreward"+id).prop('disabled', true);
				$("button#btnreward"+id).removeAttr('onclick');
				$("button#btnreward"+id).removeClass("btn btn-success btn-xs");
				$("button#btnreward"+id).toggleClass("btn btn-danger btn-xs");
				
				$("span#spanreward"+id).text(" รับไอเทมรีวอร์ดสำเร็จ...!!");
			}
			else if(re(res)=='GETREWARD:USED')
			{
				sweet("ไอเทมรีวอร์ดนี้ถูกใช้งานไปแล้ว...",false);
			}			
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
		}
	});
}

$(document).ready(function(){
	if( $('span#multi_status').length || $('td#Refill_multiple').length || $('td#RefillTw_multiple').length ){
		setInterval(function() {
			$.get('storage/php/process.php?cmd=getStatusMultiple&data=1', function (data1) {					
				var arr = data1.split('#');	
				$( "span#multi_status" ).html(arr[0]);
				$( "span#multi_num" ).html(arr[1]);					
				$( "span#multi_wait" ).html(arr[2]);
				$( "span#multi_start" ).html(arr[3]);
				$( "span#multi_end" ).html(arr[4]);		
				$( "td#RefillStatusMultiple" ).html(arr[0]);	
			});	
			$.get('storage/php/process.php?cmd=getStatusMultiple&data=2', function (data2) {
				var arr = data2.split('#');	
				$( "td#Refill_multiple" ).html(arr[0]);
				$( "td#Refill_amountID0" ).html(arr[1]);
				$( "td#Refill_amountID1" ).html(arr[2]);
				$( "td#Refill_amountID2" ).html(arr[3]);
				$( "td#Refill_amountID3" ).html(arr[4]);
				$( "td#Refill_amountID4" ).html(arr[5]);
				$( "td#Refill_amountID5" ).html(arr[6]);				
			});	
			$.get('storage/php/process.php?cmd=getStatusMultiple&data=3', function (data3) {
				var arr = data3.split('#');	
				$( "td#RefillTw_multiple" ).html(arr[0]);
				$( "td#RefillTw_amountID0" ).html(arr[1]);
				$( "td#RefillTw_amountID1" ).html(arr[2]);
				$( "td#RefillTw_amountID2" ).html(arr[3]);
				$( "td#RefillTw_amountID3" ).html(arr[4]);
				$( "td#RefillTw_amountID4" ).html(arr[5]);
				$( "td#RefillTw_amountID5" ).html(arr[6]);				
			});		
		}, 1000);
	}
	$('#start_datepick').datetimepicker();
	$('#end_datepick').datetimepicker({
		useCurrent: false //Important! See issue #1075
	});
	$("#start_datepick").on("dp.change", function (e) {
		$('#end_datepick').data("DateTimePicker").minDate(e.date);
	});
	$("#end_datepick").on("dp.change", function (e) {
		$('#start_datepick').data("DateTimePicker").maxDate(e.date);
	});	
	$('.start_datepick').datetimepicker({
		format: 'MM/DD/YYYY hh:mm A'
		,defaultDate: new Date(),
	}).datepicker("setDate", new Date());	
	$('.end_datepick').datetimepicker({
		format: 'MM/DD/YYYY hh:mm A'
		,defaultDate: new Date(),
	}).datepicker("setDate", new Date());			
	$('#map').on('change', function() {		
		var arr = this.value.split('#');	
		$( "p#pay" ).html(arr[1]).effect( "highlight", {color:"#ccff99"}, 450 );
		$( "p#pmap" ).html(arr[2]).effect( "highlight", {color:"#ccff99"}, 450 );
	});
	$('#schar').on('change', function() {
		var arr = this.value.split('#'); 
		$( "p#pname" ).html(arr[1]).effect( "highlight", {color:"#ccff99"}, 450 );
	});		
});

$('#submit-register').on('click', function() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for( var i=0; i < 7; i++ )
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	var formhtml = "<form><div class='form-group'><label for='reac'></label><input type='text' class='form-control' id='reac' placeholder='อีเมล หรือ ไอดี'></div>";
	formhtml += "<div class='form-group'><label for='reps1'></label><input type='password' class='form-control' id='reps1' placeholder='รหัสผ่าน'></div></form>";
	formhtml += "<div class='form-group'><label for='reps2'></label><input type='password' class='form-control' id='reps2' placeholder='รหัสผ่านอีกครั้ง'></div></form>";
	formhtml += "<div class='form-group'><label for='ccha' class='ccha'>รหัสความปลอดภัย "+text+"</canvas></label><label for='ccha'></label><input type='text' class='form-control' id='ccha1' placeholder='รหัสความปลอดภัย'><input type='hidden' class='form-control' id='ccha2' value='"+text+"'></div></form>";
	formhtml += "</form>";
    swal({
      html: formhtml,
	  imageUrl: 'storage/images/WarZ-logo.png',
	  imageWidth: 200,
	  imageHeight: 97,
	  animation: true,
	  confirmButtonText: '<i class="fa fa-user-plus"> สมัครเล่นเกม</i>',
      preConfirm: function() {
        return new Promise(function(resolve) {
          resolve([
            $('#reac').val(),
            $('#reps1').val(),
            $('#reps2').val(),
            $('#ccha1').val(),
            $('#ccha2').val(),
          ]);
        });
      }
    }).then(function(result) {
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: { account : result[0], pass1 : result[1], pass2 : result[2], ccha1 : result[3], ccha2 : result[4], cmd : 'register'},
			success: function(res){
				if(re(res)=='REGISTER:TRUE')
				{
					sweet("สมัครเสร็จสมบูรณ์ ขอให้เล่นเกมส์อย่างสนุกนะคะ...",true);
				}
				else if (re(res)=='REGISTER:FNULL')
				{
					sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);	
				}
				else if(re(res)=='REGISTER:ALREADYUSE')
				{
					sweet("อีเมลนี้ถูกใช้งานแล้วก่อนหน้า...",false);
				}
				else if (re(res)=='REGISTER:NOTMATCH')
				{
					sweet("รหัสผ่านไม่ตรงกัน",false);	
				}
				else if (re(res)=='REGISTER:CCHANOTMATCH')
				{
					sweet("รหัสความปลอดภัยไม่ถูกต้อง",false);	
				}
				else if(re(res)=='REGISTER:CHARLENGTH')
				{
					sweet("ความยาวตัวอักษรควรอยู่ที่ระหว่าง 6-16 ตัวอักษร",false);	
				}
				else if (re(res)=='REGISTER:CHARVALID')
				{
					sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
				}
				else if (re(res)=='REGISTER:CHARVALID')
				{
					sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
				}			
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
				}
			}
		});		
    }).done();
});

$( "#query-itemdb" ).click(function () {
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { cmd : 'queryitemdb'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0]) != "" & re(arr[0]) != "ADDITEMDB:FNULL" & re(arr[0]) != "ADDITEMDB:XMLFALSE")
			{
				var myIframe = document.getElementById("dbstatus");
				myIframe.contentDocument.write( re(arr[0]) );
				sweet("เพิ่ม ItemsDB ลง SQL สำเร็จ...",true);
			}
			else if (re(arr[0]) == "ADDITEMDB:FNULL")
			{
				sweet("กรุณากด F5 ก่อนกดแอดไอเทมลง SQL อีกครั้ง...",false);
			}
			else if (re(arr[0]) == "ADDITEMDB:XMLFALSE")
			{
				sweet("เกิดปัญหาไม่สามารถโหลดไฟล์ itemDB ได้ หรือ ไม่มีไฟล์ itemDB อยู่...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#query_dburl").val("");				
		}
	});
})

$( "button[id='wallet_open']" ).click(function () {
	var amout		= $("#wallet_amout").val();
	var uid			= $("#userid").val();
	var merchant 	= $("#merchant_id").val();
	var theURL		= "https://www.twpay.co/websrc?cmd=express-checkout&merchant=" + merchant + "&amount=" + amout + "&userid=" + uid;
	var width		= 500;
	var height		= 630;
	var	leftpos 	= (screen.availWidth - width) / 2;
    var	toppos 		= 20;
	var windowFeatures = "width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos ;
	window.open(theURL, "topup", windowFeatures, "POS", "toolbar=no", "scrolling=no");
})

$(document).ready(function(){
	if( $('span#status').length || $('span#Online').length || $('span#Accounts').length || $('span#Character').length ){
		setInterval(function() {	
			$.get('storage/php/process.php?cmd=getserverinfo', function (data) {
				var arr = data.split('#');	
				$( "span#status" ).html(arr[1]);
				$( "span#Online" ).html(arr[2]);
				$( "span#Accounts" ).html(arr[3]);
				$( "span#Character" ).html(arr[4]);				
			});		
		}, 1000);
	}		
});

$(document).ready(function() {
        // colorbox settings
        $(".albumpix").colorbox({rel:'albumpix'});
});

$("#del_reports").click(function () {
	var patch	= $("#patch").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { patch : patch, cmd : 'delimages'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='DELIMG:TRUE')
			{
				sweet("ทำการลบไฟล์ Reports สำเร็จ...",true);
			}
			else if (re(arr[0])=='DELIMG:FNULL')
			{
				sweet("กด F5 1 ครั้งก่อนนะครับ...",false);
			}
			else if (re(arr[0])=='DELIMG:CHMOD777')
			{
				sweet("ต้องการสิทธิ์การเข้าถึงโฟลเดอร์ Reports...<br>ให้ทำการ CHMOD777",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}
			$("#patch").val("");			
		}
	});
})

$('#dl_btn').on('click', function() {
	var lcname		= $("#launcher_name").val();
	var lcversion	= $("#launcher_version").val();
	var lclink		= $("#launcher_link").val();
	var fcname		= $("#fullclient_name").val();
	var fcversion	= $("#fullclient_version").val();
	var fclink		= $("#fullclient_link").val();
	var formhtml = "<table class='table' cellspacing='0' cellpadding='0'><thead class='thead'>";
	formhtml += "<tr><th>#</th><th>ชื่อไฟล์</th><th>เวอร์ชั่น</th><th>ดาวน์โหลด</th></tr>";
	formhtml += "</thead><tbody class='tbody'>";
	formhtml += "<tr><td>1</td><td>" + lcname + "</td><td>" + lcversion + "</td>";
	formhtml += "<td><a href=' " + lclink + " '><button type='button' class='btn btn-success' ><i class='fa fa-download'></i> ดาวน์โหลด</button></a></td>";
	formhtml += "</tr><tr>";
	formhtml += "<td>2</td><td>" + fcname + "</td><td>" + fcversion + "</td>";
	formhtml += "<td><a href=' " + fclink + " '><button type='button' class='btn btn-success' ><i class='fa fa-download'></i> ดาวน์โหลด</button></a></td>";
	formhtml += "</tr></tbody></table>";
    swal({
		html: formhtml,
		imageUrl: 'storage/images/WarZ-logo.png',
		imageWidth: 200,
		imageHeight: 97,
		animation: true,
		showConfirmButton: false
    });
});

$('#show_ban').on('click', function() {
	var banlist		= $("#ban_list").val();				
	var formhtml = "<table class='table'><thead class='thead' align='center'><tr>";
		formhtml += "<th>#</th><th>ชื่อตัวละคร</th><th>สถานะแบน</th>";
		formhtml += "</tr></thead><tbody class='tbody '>";
		formhtml += banlist;
		formhtml += "</tbody></table>";
	swal({
		html: formhtml,
		width: 400,
		animation: true,
		showConfirmButton: false
	});
});

$( "button[id='submit-newname']" ).click(function () {
	var id			= $(this).val();
	var charid		= $("#charid" + id).val();
	var formhtml = "<label for='itemid'>กรุณากรอกชื่อตัวละครที่ต้องการเปลี่ยน</label>";
		formhtml += "<input type='text' class='form-control' id='newname' placeholder='กรอกชื่อใหม่ที่ต้องการ'>";
	swal({
		html: formhtml,
		width: 400,
		animation: true,
		confirmButtonText: '<i class="fa fa-user-plus"> เปลี่ยนชื่อ</i>',
		preConfirm: function() {
			return new Promise(function(resolve) {
				resolve([
					$('#newname').val(),
				]);
			});
		}
	}).then(function(result) {
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: { charid : charid, newname : result[0], cmd : 'changename'},
			success: function(res){
				if(re(res)=='CHANGE:TRUE')
				{
					sweet("เปลี่ยนชื่อตัวละคร, สำเร็จ... ",true);
					setTimeout(function(){
						location.reload();
					}, 2000);
				}
				else if (re(res)=='CHANGE:FNULL')
				{
					sweet("กรุณากรอกชื่อใหม่ให้ครบถ้วน",false);	
				}
				else if(re(res)=='CHANGE:CHARVALID')
				{
					sweet("ชื่อที่จะเปลี่ยนมีตัวอักษรต้องห้าม <br> กรุณาลองใหม่...",false);
				}
				else if (re(res)=='CHANGE:NOWP')
				{
					sweet("คุณมี WebPoints ไม่พอ, <br> กรุณาเติมเงิน...",false);	
				}
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
				}
			}
		});	
    }).done();
});

$('#submit-changeexp').on('click', function() {
	var charname	= $("#charnameexp").val();
	var wpamount	= $("#wpforexp").val();
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { charname : charname, wpamount : wpamount, cmd : 'changeexp'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='EXP:TRUE')
			{
				sweet("ท่านได้ทำการแลกแต้มสกิลจำนวน " + arr[1] + "EXP<br>ในราคา " + wpamount + " WP เรียบร้อยแล้ว",true);
				setTimeout(function(){
					location.reload();
				}, 2000);
			}
			else if (re(arr[0])=='EXP:FNULL')
			{
				sweet("กรุณากรอกจำนวน WP ที่ต้องการแลกให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='EXP:CHARVALID')
			{
				sweet("คุณกรอกจำนวนไม่ถูกต้อง<br>กรุณาลองใหม่อีกครั้ง",false);
			}
			else if (re(arr[0])=='EXP:NULLCHAR')
			{
				sweet("ไม่พบตัวละครในระบบลองกด F5 แล้วลองใหม่อีกครั้ง",false);
			}
			else if (re(arr[0])=='EXP:NOWP')
			{
				sweet("ท่านมี WebPoints ไม่พอ, กรุณาเติมเงิน...",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
			}	
			$("#wpforexp").val("");	
		}
	});
});

$("#submit-redeem").click(function () {
	var numgccard	= $("#gccard").val();	
	var userencrypt	= $("#userid").val();	
	$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { gccard : numgccard, userid : userencrypt, cmd : 'redeemgc'},
		success: function(res){
			var arr = res.split('#');
			if (re(arr[0])=='REDEEM:TRUE')
			{
				sweet("แลก GC สำเร็จ.....กรุณารอสักครู่",true);
				setTimeout(function(){
					location.reload();
				}, 2000);
			}
			else if (re(arr[0])=='REDEEM:FNULL')
			{
				sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
			}
			else if (re(arr[0])=='REDEEM:FALSE')
			{
				sweet("จำนวนบัตรไม่ถูกต้อง",false);
			}
			else
			{
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
			$("#numgccard").val("");	
		}
	});
})

function submit_tmpay() {
	var tmc_pass = $("#tmn_password").val();
	var point = $("#ref3").val();
	var uid = $("#ref1").val();
	var email = $("#ref2").val();
	if(tmc_pass == "" || uid == "" & email || "") {
		sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
		return false;
	} else if((tmc_pass*1) != tmc_pass) {
		sweet("กรุณากรอกเฉพาะตัวเลขเท่านั้น",false);
		return false;
	} else if(tmc_pass.length < 14) {
		sweet("กรุณากรอกรหัสบัตรเงินสดให้ครบ 14 หลัก",false);
		return false;
	} else if(point == "") {
		sweet("กรุณาเลือกชนิดของ Points ที่ได้รับ<br>หลังจากเติมเงิน สำเร็จ",false);
		return false;
	}
	swal("ระบบกำลังส่งข้อมูลบัตร")
	swal.showLoading()
	setTimeout(function(){
		$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { tmc_pass : tmc_pass, point : point, uid : uid, email : email, cmd : "tmpay"},
		success: function(res){
			var arr = res.split("#");
			if (re(arr[0])=="TMPAY:TRUE") {
				swal("กำลังตรวจสอบสถานะการเติมเงิน<br>" + arr[1])
				swal.showLoading()
				setTimeout(function(){
					$.ajax({
						type: "POST",
						url: "storage/php/process.php",
						data: { tmc_pass : tmc_pass, uid : uid, cmd : "tmpaycheck"},
						success: function(res){
							var arr = res.split("#");
							if (re(arr[0])=="TMPAY:CHECKTRUE") {
								sweet("ยินดีด้วย! รายการเติมเงินของท่าน<br>สำเร็จแล้ว...",true);
								setTimeout(function(){
									location.reload();
								}, 3000);
							} else if (re(arr[0])=="TMPAY:USED") {
								sweet("บัตรเงินสดถูกใช้ไปแล้ว" ,false);
								setTimeout(function(){
									location.reload();
								}, 3000);
							} else if (re(arr[0])=="TMPAY:INVALID") {
								sweet("รหัสบัตรเงินสดไม่ถูกต้อง" ,false);
								setTimeout(function(){
									location.reload();
								}, 3000);
							} else if (re(arr[0])=="TMPAY:NOTTRUEMONEY") {
								sweet("เป็นบัตรทรูมฟู (ไม่ใช่บัตรทรูมันนี่) ",false);
								setTimeout(function(){
									location.reload();
								}, 3000);
							} else {
								sweet("เติมเงินไม่สำเร็จ กรุณาลองใหม่อีกครั้ง<br>" + arr[0],false);
								setTimeout(function(){
									location.reload();
								}, 3000);
							}
						}
					});
				}, 20000);
			}
			else if(re(arr[0])=="TMPAY:NOTSUCCESS") {
				sweet("เติมเงินไม่สำเร็จ กรุณาลองใหม่อีกครั้ง<br>" + arr[1],false);
				setTimeout(function(){
					location.reload();
				}, 2000);
			} else {
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
		}	
		});
	}, 500);
}

function submit_wallet() {
	var tmc_pass = $("#tmn_password").val();
	var point = $("#ref3").val();
	var uid = $("#ref1").val();
	var email = $("#ref2").val();
	if(tmc_pass == "" || uid && email == "") {
		sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
		return false;
	} else if((tmc_pass*1) != tmc_pass) {
		sweet("กรุณากรอกเฉพาะตัวเลขเท่านั้น",false);
		return false;
	} else if(tmc_pass.length < 14) {
		sweet("กรุณากรอกรหัสบัตรเงินสดให้ครบ 14 หลัก",false);
		return false;
	} else if(point == "") {
		sweet("กรุณาเลือกชนิดของ Points ที่ได้รับ<br>หลังจากเติมเงิน สำเร็จ",false);
		return false;
	}
	swal("กำลังตรวจสอบข้อมูลบัตร")
	swal.showLoading()
	setTimeout(function(){
		$.ajax({
		type: "POST",
		url: "storage/php/process.php",
		data: { tmc_pass : tmc_pass, point : point, uid : uid, email : email, cmd : "wallet"},
		success: function(res){
			var arr = res.split("#");
			if (re(arr[0])=="WALLET:TRUE") {
				sweet("คุณได้เติมเงินจำนวน " + arr[1] + " บาท<br>ได้รับ " + arr[2] + " " + arr[3] + " สำเร็จ!",true);
				setTimeout(function(){
					location.reload();
				}, 5000);
			}
			else if(re(arr[0])=="WALLET:REFILLBAN") {
				sweet("คุณเติมเงินผิดเกินจำนวนครั้งที่กำหนด<br>กรุณาลองใหม่ใน " + arr[1] + " ชม.",false);
				setTimeout(function(){
					location.reload();
				}, 5000);
			} else if(re(arr[0])=="WALLET:NOTSUCCESS") {
				sweet("เติมเงินไม่สำเร็จ กรุณาลองใหม่อีกครั้ง<br>" + arr[1],false);
				setTimeout(function(){
					location.reload();
				}, 5000);
			} else if(re(arr[0])=="WALLET:SERVERBUSY") {
				sweet("ไม่มีการตอบรับจาก Server<br>" + arr[1],false);
				setTimeout(function(){
					location.reload();
				}, 5000);
			} else {
				sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
			}
		}	
		});
	}, 500);
}

$("#submit-charrent").click(function () {
	var hero	= $("#Rent_HeroID").val();	
	var day		= $("#Rent_Day").val();	
	if(hero == "" ) {
		sweet("กรุณาเลือกตัวละครที่ต้องการเช่า",false);
		return false;
	} else if(day == "") {
		sweet("กรุณาเลือกจำนวนวันที่ต้องการเช่า",false);
		return false;
	}
	swal({
		type: 'question',
		text: 'ท่านแน่ใจหรือไม่...ที่จะเช่าตัวละครนี้',
		showConfirmButton: true,
		confirmButtonText: 'ยืนยัน',
		confirmButtonColor: '#3085d6',
		showCancelButton: true,
		cancelButtonText: 'ยกเลิก',
		cancelButtonColor: '#aaa',
	}).then(function(result) {
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: { hero : hero, day : day, cmd : 'charrent'},
			success: function(res){
				var arr = res.split('#');
				if (re(arr[0])=='CHARRENT:TRUE')
				{
					sweet("เช่าตัวละครสำเร็จ",true);
					setTimeout(function(){
						location.reload();
					}, 2000);
				}
				else if (re(arr[0])=='CHARRENT:NOWP')
				{
					sweet("WebPoint ของท่านไม่พอ....กรุณาเติมเงิน",false);
				}
				else if (re(arr[0])=='CHARRENT:FALSE')
				{
					sweet("Error : ไม่สามารถเช่าตัวละครได้\n" + arr[1],false);
				}
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
				}
				$("#Rent_HeroID").val("");	
				$("#Rent_Day").val("");
			}
		});
	}).done();
});

$("#submit-starrent").click(function () {	
	var day		= $("#Rent_Day").val();	
	if(day == "" ) {
		sweet("กรุณาเลือกจำนวนวันที่ต้องการเช่า",false);
		return false;
	}
	swal({
		type: 'question',
		text: 'ท่านแน่ใจหรือไม่...ที่จะทำการเช่าดาวหน้าชื่อ',
		showConfirmButton: true,
		confirmButtonText: 'ยืนยัน',
		confirmButtonColor: '#3085d6',
		showCancelButton: true,
		cancelButtonText: 'ยกเลิก',
		cancelButtonColor: '#aaa',
	}).then(function(result) {
		$.ajax({
			type: "POST",
			url: "storage/php/process.php",
			data: { day : day, cmd : 'starrent'},
			success: function(res){
				var arr = res.split('#');
				if (re(arr[0])=='STARRENT:TRUE')
				{
					sweet("เช่าดาวหน้าชื่อสำเร็จ",true);
					setTimeout(function(){
						location.reload();
					}, 2000);
				}
				else if (re(arr[0])=='STARRENT:NOWP')
				{
					sweet("WebPoint ของท่านไม่พอ....กรุณาเติมเงิน",false);
				}
				else if (re(arr[0])=='STARRENT:FALSE')
				{
					sweet("Error : ไม่สามารถเช่าดาวหน้าชื่อได้\n" + arr[1],false);
				}
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
				}	
				$("#Rent_Day").val("");
			}
		});
	}).done();
});