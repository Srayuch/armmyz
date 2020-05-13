<?php
//-- BEGIN | SETTING FOR SERVER --//

$_CONFIG['SERVER']['IP'] = '127.0.0.1';														//IP SERVER
$_CONFIG['SERVER']['PORT'] = '1503';																		//SQL PORT - ค่าปกติคือ: 1433
$_CONFIG['SERVER']['USER'] = 'sa';															//SQL USER
$_CONFIG['SERVER']['PASS'] = 'GuOatNi@LeGend-Studio';												//SQL PASS
$_CONFIG['SERVER']['DB'] = 'Knz';															//DB NAME
$_CONFIG['SERVER']['DEV'] = 'admin@server.com';												//ADMIN ID - ไอดีแอดมินสำหรับตั้งค่าในเว็บ
$_CONFIG['SERVER']['MD5'] = 2;                                                              //MD5 - ถ้าไม่ใช้ Md5 ใส่ '0' 	ถ้าใช้ Md5 ใส่ '1'     ถ้าใช้แบบ 2 ชั้นใส่ '2'
$_CONFIG['SERVER']['MD5KEY'] = '[u$_9XAJA8#f*d)E';															//MD5key - คีย์ Md5 ชั่นที่ 1
$_CONFIG['SERVER']['MD5KEY2'] = 'g_=x`#Fx5MYR]5GY';															//MD5key2 - คีย์ Md5 ชั่นที่ 2
$_CONFIG['SERVER']['STATUS_URL'] = 'http://103.233.195.184/link/updater/api_getserverinfo.xml';				//Link File 'getserverinfo.xml' เช่น http://warz-thai.com/launcher/getserverinfo.xml
$_CONFIG['SERVER']['FBGROUP_URL'] = 'https://www.facebook.com/groups/ArmyZTH/';				//FACEBOOK GROUP - ลิ้งกลุ่มเฟซบุ๊ค

//-- END | SETTING FOR SERVER --/

/*********************************************************************************************************************************/

//-- BEGIN | FACEBOOK CONFIG --/

$_CONFIG['FB']['REGISTER'] = true;
$_CONFIG['FB']['APP_ID'] = 586964165054161;
$_CONFIG['FB']['FRIEND'] = 10;

//-- END | FACEBOOK CONFIG --/

/*********************************************************************************************************************************/

//-- BEGIN | CHANG CHARACTER NAME & BUY EXP & GC CARD SETTING --//

$_CONFIG['FUNCTIONS']['change_name'] = 10;																										//PRICE FOR CHANG CHARRACTER NAME
$exp_wp = 10000;																																//EXP FOR 1 WP
$text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮะาัิีึืุูเแำไใโ่้๊็๋ฤฦๅๆ+-*/\"_•๑=-><';	//TEXT ตัวอักษรที่อนุญาตให้ใช้ได้
$gc_cardid = 310002;																															//GC CARD ITEMID เลขไอเทมไอดีของบัตรแลก GC CARD
$gccard_x = 500;																																//X CHANGE : GC ที่จะได้รับในการแลก 1 ใบ
$_CONFIG['FUNCTIONS']['ITEMDB_URL'] = 'storage/itemsdb/itemsDB.xml';
$_CONFIG['FUNCTIONS']['PNG_URL'] = 'storage/images/storeicon';

//-- END | CHANG CHARACTER NAME & BUY EXP & GC CARD SETTING --//

/*********************************************************************************************************************************/

//-- BEGIN | TOPUP SETTING --//

$_CONFIG['TOPUP_SYS'] = 'WALLET';												//TMTOPUP & TMPAY & WALLET เลือกช่องทางการตัดบัตรว่าจะใช้ของเจ้าไหน

//TMPAY SYSTEM - ตั้งค่าการเติมเงินสำหรับการใช้ระบบตัดบัตรของ TMTOPUP
$_CONFIG['TOPUP']['APIKEY'] = '-------';										//API PASSKEY FOR TMT, TWPAY
$_CONFIG['TOPUP']['TMTUID'] = '-------';										//TMT UID

//TMPAY SYSTEM - ตั้งค่าการเติมเงินสำหรับการใช้ระบบตัดบัตรของ WALLET
$_CONFIG['WALLET']['NUMBAN'] = 3;												//NUMBAN OF ERROR TIME : จำนวนครั้งที่เติมเงินผิด แล้วจะโดนแบน
$_CONFIG['WALLET']['BANHOUR'] = 1;												//BANHOUR OF ERROR TIME : เติมเงินผิดตามจำนวนครั้งที่กำหนดแล้วจะโดนแบนกี่ชั่วโมง
$_CONFIG['WALLET']['USER'] = '';												//TWUSER : Email ที่ใช้ Login ทรูวอลเลท
$_CONFIG['WALLET']['PASS'] = '';												//TWPASS : Password ที่ใช้ Login ทรูวอลเลท

//TMPAY SYSTEM - ตั้งค่าการเติมเงินสำหรับการใช้ระบบตัดบัตรของ TMPAY
$_CONFIG['tmpay']['merchant_id'] = '-------';									// MERCHANT_ID รหัสร้านค้า ของบัญชี TMPAY.NET
$_CONFIG['tmpay']['resp_url'] = 'http://ไอพีเครื่องเซิร์ฟเวอร์/storage/php/tmpay_resp.php';	// URL ที่ได้ติดตั้งไฟล์ tmpay_resp.php
$_CONFIG['tmpay']['access_ip'] = '203.146.127.112';								// IP ของ TMPAY.NET ที่อนุญาติให้รับส่งข้อมูลบัตรเงินสด (ไม่ควรแก้ไข)

//TRUEMONEY CARD : ราคาบัตรทรู ห้ามเปลี่ยน
$_CONFIG['TMN'][50]['TRUEMONEY'] = '50';
$_CONFIG['TMN'][90]['TRUEMONEY'] = '90';
$_CONFIG['TMN'][150]['TRUEMONEY'] = '150';
$_CONFIG['TMN'][300]['TRUEMONEY'] = '300';
$_CONFIG['TMN'][500]['TRUEMONEY'] = '500';
$_CONFIG['TMN'][1000]['TRUEMONEY'] = '1000';

//-- END | TOPUP SETTING --//


/*********************************************************************************************************************************/

//-- BEGIN | DOWNLOAD SETTING --//

$launcher['name'] = 'K-NightZ.exe';									//LAUNCHER NAME
$launcher['link'] = '#';									//LAUNCHER DOWNLOAD LINK	!พยายามใส่เป็นลิ้งตรงจะง่ายต่อการดาวน์โหลด

$fullclient['name'] = 'KNz_Full_21-10-18.rar';								//FULLCLIENT NAME
$fullclient['link'] = '#';								//FULLCLIENT DOWNLOAD LINK	!พยายามใส่เป็นลิ้งตรงจะง่ายต่อการดาวน์โหลด

//-- END | DOWNLOAD SETTING --//

/*********************************************************************************************************************************/

//-- BEGIN | REPORTS SETTING --//

$reports_dir = 'Reports/Reports/';										//REPORTS URL ค่าดั้งเดิม ( ไม่ควรเปลี่ยน )
$_CONFIG['REPORT']['ALBUMSPERPAGE'] = '500';       											// number of albums per page
$_CONFIG['REPORT']['ITEMPERPAGE'] = '500';       											// number of images per page
$_CONFIG['REPORT']['THUMB_WIDTH'] = '150';      											// width of thumbnails

//-- END | REPORTS SETTING --//

/*********************************************************************************************************************************/

//-- BEGIN | SETTING FOR MUSIC --//

$volume = '50';															//ความดังเริ่มต้น
$autoplay = 'false';													//เปิดให้เล่นเพลงออโต้ = true , ปิดให้เล่นเพลงออโต้ = false
$shuffle = 'true';														//เปิดให้เล่นสลับเพลง = true , ปิดให้เล่นสลับเพลง = false
$repeat = '1';															//เปิดให้เล่นเพลงซ้ำใน Playlist

//เพลงที่ 1
$title[1] = 'คนมีเสน่ห์ - ป้าง นครินทร์';											//ชื่อเพลง
$url[1] = 'https://www.youtube.com/watch?v=R10mrTJpqPw';				//ลิ้งค์เพลงที่เอามาจาก Youtube.com

//เพลงที่ 2
$title[2] = 'คู่คอง Ost.นาคี | ก้อง ห้วยไร่';
$url[2] = 'https://www.youtube.com/watch?v=wsHNUOgJJZU';

//เพลงที่ 3
$title[3] = 'เรื่องของวันพรุ่งนี้ - Slow สโลว์';
$url[3] = 'https://www.youtube.com/watch?v=w9l4rhsYLHg';

//เพลงที่ 4
$title[4] = 'อยู่ไหนก็คิดถึง-เมนทอล ทวีรัตช์';
$url[4] = 'https://www.youtube.com/watch?v=kK9AmO4b4CY';

//เพลงที่ 5
$title[5] = 'แลรักนิรันดร์กาล | ปู่จ๋าน ลองไมค์';
$url[5] = 'https://www.youtube.com/watch?v=xlU_o3vsTt4';

//เพลงที่ 6
$title[6] = 'Alan Walker - Faded';
$url[6] = 'https://www.youtube.com/watch?v=60ItHLz5WEA';

//เพลงที่ 7
$title[7] = 'Calvin Harris - This Is What You Came For';
$url[7] = 'https://www.youtube.com/watch?v=kOkQ4T5WO9E';

//เพลงที่ 8
$title[8] = 'เพชร Ost.กุหลาบตัดเพชร | พัดชา เอนกอายุวัฒน์';
$url[8] = 'https://www.youtube.com/watch?v=iDUPzfuwyZY';

//เพลงที่ 9
$title[9] = 'Fox Stevenson - Turn It Up (Higher)';
$url[9] = 'https://www.youtube.com/watch?v=ZwnoL-thK7Q&list=RDlITExahxoyM&index=11';

//เพลงที่ 10
$title[10] = 'Fox Stevenson - All In';
$url[10] = 'https://www.youtube.com/watch?v=hqfQnD_MMe4&list=RDlITExahxoyM&index=12';

//-- END | SETTING FOR MUSIC --//
?>
