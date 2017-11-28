<?php
/*
نوشته شده توسط دانیال ملک زاده (@JanPHP) و دریافت اخبار: @Danial_Rbo
*/
//----######------
define('API_KEY','توکن');
//----######------
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//----######------
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//----######------
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $update->message->from->first_name;
$username = $update->message->from->username;
$textmessage = isset($update->message->text)?$update->message->text:'';
$txtmsg = $update->message->text;
$reply = $update->message->reply_to_message->forward_from->id;
$stickerid = $update->message->reply_to_message->sticker->file_id;
$admin =  328130490;
$admins = 
$step = file_get_contents("data/".$from_id."/step.txt");

//-------
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function save($filename,$TXTdata)
	{
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
//----######------
$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@DarkskyTM&user_id=".$from_id);
	
	if (strpos($inch , '"status":"left"') !== false ) {
SendMessage($chat_id,"💎برای فعال شدن ربات اول وارد ربات زیر شوید💎
🆔: @DarkskyTM
🏡تا بخش های ربات برای شما فعال شود🏡");
}
elseif(isset($update->callback_query)){
    $callbackMessage = '';
    var_dump(makereq('answerCallbackQuery',[
        'callback_query_id'=>$update->callback_query->id,
        'text'=>$callbackMessage
    ]));
    $chat_id = $update->callback_query->message->chat->id;
    
    $message_id = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    if (strpos($data, "del") !== false ) {
    $botun = str_replace("del ","",$data);
    unlink("bots/".$botun."/index.php");
    save("data/$chat_id/bots.txt","");
    save("data/$chat_id/tedad.txt","0");
    var_dump(
        makereq('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"ربات شما با موفقیت حذف شد !",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"به کانال ما بپیوندید",'url'=>"https://telegram.me/DarkSkyTM"]
                    ]
                ]
            ])
        ])
    );
 }
 else {
    var_dump(
        makereq('editMessageText',[
            'chat_id'=>$chat_id,
            'message_id'=>$message_id,
            'text'=>"خطا",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>"به کانال ما بپیوندید",'url'=>"https://telegram.me/DarkskyTM"]
                    ]
                ]
            ])
        ])
    );
 }
}

elseif ($textmessage == '🏡بازگشت🏡') {
save("data/$from_id/step.txt","none");
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"سلام😉✋
💎به سرویس تبچی ساز تلگرام خوش آمدید💎

💎شما می توانید با این ربات تبچی خود را بسازید و آن را مدیریت کنید💎

🏜برای ساخت ربات یکی از گزینه ها را انتخاب کنید🏜

🆔: @DarkSkyTM",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
['text'=>"🌀ساخت ربات🌀"],['text'=>"🚀ربات های من🚀"]
],
[
['text'=>"🚧حذف ربات🚧"],['text'=>"📚راهنما📚"]
],
[
['text'=>"⚠️قوانین⚠️"],['text'=>"☎️پشتیبانی☎️"]
],
[
['text'=>"🔸مدیریت🔹"],['text'=>"🔰بروزرسانی ربات🔰️"]
],
[
['text'=>"📖سوال شما!؟📖"],['text'=>"🌐سایت ما🌐"]
],
[
['text'=>"✅ارسال نظر✅"]
  
                ]
                
            	],
            	'resize_keyboard'=>false
       		])
    		]));
}
elseif ($step == 'delete') {
$botun = $txtmsg ;
if (file_exists("bots/".$botun."/index.php")) {

$src = file_get_contents("bots/".$botun."/index.php");

if (strpos($src , $from_id) !== false ) {
save("data/$from_id/step.txt","none");
unlink("bots/".$botun."/index.php");
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"🚀 ربات شما با موفقیت پاک شده است 
یک ربات جدید بسازید 😄",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                   ['text'=>"🌀ساخت ربات🌀"],['text'=>"🏡بازگشت🏡"]
                ]
                
            	],
            	'resize_keyboard'=>false
       		])
    		]));
}
else {
SendMessage($chat_id,"خطا!
شما نمی توانید این ربات را پاک کنید ! ");
}
}
else {
SendMessage($chat_id,"یافت نشد.");
}
}
elseif ($step == 'create bot') {
$token = $textmessage ;

			$userbot = json_decode(file_get_contents('https://api.telegram.org/bot'.$token .'/getme'));
			//==================
			function objectToArrays( $object ) {
				if( !is_object( $object ) && !is_array( $object ) )
				{
				return $object;
				}
				if( is_object( $object ) )
				{
				$object = get_object_vars( $object );
				}
			return array_map( "objectToArrays", $object );
			}

	$resultb = objectToArrays($userbot);
	$un = $resultb["result"]["username"];
	$ok = $resultb["ok"];
		if($ok != 1) {
			//Token Not True
			SendMessage($chat_id,"توکن نا معتبر!");
		}
		else
		{
		SendMessage($chat_id,"در حال ساخت ربات ...");
		if (file_exists("bots/$un/index.php")) {
		$source = file_get_contents("bot/index.php");
		$source = str_replace("[*BOTTOKEN*]",$token,$source);
		$source = str_replace("328130490",$from_id,$source);
		save("bots/$un/index.php",$source);	
		file_get_contents("https://api.telegram.org/bot".$token."/setwebhook?url=https://www.darkskytm9898.xyzhost.cf/Tabchi/Tabchi/bots/$un/index.php");

var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"🚀 ربات شما با موفقیت آپدیت شده است 

[برای ورود به ربات خود کلیک کنید 😃](https://telegram.me/$un)",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                 [
                ['text'=>"🏡بازگشت🏡"]
                ]
            	],
            	'resize_keyboard'=>false
       		])
    		]));
		}
		else {
		$source = file_get_contents("bot/index.php");
		$source = str_replace("[*BOTTOKEN*]",$token,$source);
		$source = str_replace("328130490",$from_id,$source);
		save("data/$from_id/tedad.txt","1"); 		save("data/$from_id/step.txt","none"); 		save("data/$from_id/bots.txt","$un");
		mkdir("bots/$un");
		save("bots/$un/index.php","$from_id\n");
		save("bots/$un/index.php",$source);
		mkdir("bots/$un/admin");
		
		save("bots/$un/admin/start.txt","   خوش آمدید دستور /help را وارد کنید.");
		save("bots/$un/admin/Member.txt","$from_id\n");
		save("bots/$un/admin/gp.txt","1");
			mkdir("bots/$un/user");
		mkdir("bots/$un/user/$from_id");
		save("bots/$un/user/$from_id/step.txt","none");
			file_get_contents("https://api.telegram.org/bot".$token."/setwebhook?url=https://www.darkskytm9898.xyzhost.cf/Tabchi/Tabchi/bots/$un/index.php");
		

var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"😀ربات شما با موفقیت ساخته شد😀
[👈برای ورود به ربات خود کلیک کنید👉](https://telegram.me/$un)
",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
[
                   ['text'=>"🌀ساخت ربات🌀"],['text'=>"🏡بازگشت🏡"]
                ]
                
             ],
             'resize_keyboard'=>false
         ])
      ]));
  }
}
}
elseif ($textmessage == '📚راهنما📚'){
sendmessage($chat_id,'ساخت ربات در تلگرام شامل دو بخش مجزا است.
   1. ساخت ربات
   2.مدیریت پیام ها
    ساخت ربات فقط از طریق پیام دادن به @BotFather (ربات ساخته شده توسط تلگرام) انجام می شود. پس از ایجاد ربات کدی مشابه کد زیر دریافت می کنید که اصطلاحا Token نامیده می شود.
115789024:AAHhiU9qwwQAMc4HoX9TGarm9mvejn5HUJc

برای مدیریت پیام ها می توانید ربات خود را به سرورهای ما متصل کنید.
 برای انجام این کار لطفا Token را ارسال کنید.
برای راحتی کار می توانید متن دریافت از BotFather را اینجا Paste کنید.
در صورتی که کد Token ندارید بروی دکمه راهنمای ساخت Token کلیک کنید تا آموزش ساخت آن را دریافت کنید.');
}
elseif ($textmessage == '☎️پشتیبانی☎️'){
sendmessage($chat_id,'💎خب دوستان عزیز اگر پیشنهاد نظر یا انتقادی دارید می توانید با ما در مان بگذارید💎
🆔: @mriven
🆔: @mrivenbot');
}
elseif ($textmessage == '⚠️قوانین⚠️'){
sendmessage($chat_id,'⚠️خب دوستان هر گونه سوء استفاده از ربات پی گرد دارد و تیم دارک اسکی هیچ مسعولیتی را قبول نمی کند با تشکر⚠️');
}
elseif($textmessage == '✅ارسال نظر✅'){
  file_put_contents('data/'.$from_id."/step.txt","nzr");
  SendMessage($chat_id,"پیامتون رو در قالب یک متن ارسال کنید تا به دست پشتیبانی برسد :

را ارسال کنید ➡");
}
  elseif($step == 'nzr'){
  if($textmessage){
  file_put_contents('data/'.$from_id."/step.txt","none");
  SendMessage($chat_id,"پیام شما ثبت شد و بزودی جواب داده میشود ✅");
  if($from_username == null){
  $from_username = '---';
  }else{
  $from_username = "@$from_username";
  }
  SendMessage(328130490,"
کاربری با مشخصات : 
$from_id
$username
یک پیام به شما ارسال کرد ✅
متن پیام :
 $textmessage");
  }else{
  SendMessage($chat_id,"فقط متن میتوانید ارسال کنید ❎ .");
  }
  }
elseif ($textmessage == '🌐سایت ما🌐'){
sendmessage($chat_id,'🌐سایت ما🌐
✳️: xyzhost.cf
🆔: @DarkSkyTM');
}
elseif ($textmessage == '📖سوال شما!؟📖'){
sendmessage($chat_id,'سوالات رایج شما:

1-چطور از ربات ساخته شده استفاده کنیم؟
پاسخ: وارد ربات شوید و دستور /help را ارسال کنید.
2-چرا سرعت ربات های ما پایین هستند؟
پاسخ: به این خاطر که حجم ربات های ساخته شده بالا هستند.
3-چطور ربات ها به گروه اد میشوند؟
پاسخ: باید خودتان رباتتان را به گروه اضافه کنید. ما در حال ساخت سامانه ای هستیم که با استفاده از ربات cli بتوانیم ربات هارا به گروه بیفزاییم هزینه این سامانه ۲۰ هزار تومان است.

موفق باشید!');
}
elseif ($textmessage == '🔸مدیریت🔹')
if ($from_id == $admin)
{
var_dump(makereq('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام قربان😃👋\nبه پنل مدیریت📋 ربات خود خوش آمدید😁",
'reply_to_message_id'=>$message_id,
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
['text'=>"آمار📊"]
],
[
['text'=>"📤پیام همگانی📤"]
],
[
['text'=>"🏡بازگشت🏡"]
                       ]
                  ],
'resize_keyboard'=>false
                       ])
               ]));
}else{
sendmessage($chat_id,"🙃تو ادمین نیستی الکی میگی که ادمینی از این دستور استفاده نکن😂");
}
elseif ($textmessage == 'آمار📊' && $from_id == $admin) { 
    $number = count(scandir("bots"))-1; 
    $usercount = -1; 
    $fp = fopen( "data/users.txt", 'r'); 
    while( !feof( $fp)) { 
        fgets( $fp); 
        $usercount ++; 
    } 
    fclose( $fp); 
    SendMessage($chat_id,"👥اعضای ربات : ".$usercount."\n🤖تعداد رباتهای فعال : $number"); 
}
elseif ($textmessage == '📤پیام همگانی📤')
if ($from_id == $admin)
{
save("data/$from_id/step.txt","sendtoall");
var_dump(makereq('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"پیام خود را ارسال کنید : ",
'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode(['keyboard'=>
[[['text'=>"🏡بازگشت🏡"]]],
'resize_keyboard'=>false
                 ])
            ]
        )
    );
}else{
SendMessage($chat_id,"شما ادمین نیستید.");
}
elseif ($step == 'sendtoall')
{
SendMessage($chat_id,"پیام در حال ارسال میباشد...⏰");
save("data/$from_id/step.txt","none");
$fp = fopen( "data/users.txt", 'r');
while( !feof( $fp)) {
$ckar = fgets( $fp);
SendMessage($ckar,$textmessage);
}
SendMessage($chat_id,"پیام شما با موفقیت به تمام کاربران ارسال شد👍");
}
elseif($textmessage == '🚀ربات های من🚀')
{
$botname = file_get_contents("data/$from_id/bots.txt");
if ($botname == "") {
SendMessage($chat_id,"شما هنوز هیچ رباتی نساخته اید !");
return;
}
 	var_dump(makereq('sendMessage',[
	'chat_id'=>$update->message->chat->id,
	'text'=>"لیست ربات های شما : ",
	'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[
	['text'=>"👉 @".$botname,'url'=>"https://telegram.me/".$botname]
	]
	]
	])
	]));
}
elseif($textmessage == '/start')
{

if (!file_exists("data/$from_id/step.txt")) {
mkdir("data/$from_id");
save("data/$from_id/step.txt","none");
save("data/$from_id/tedad.txt","0");
save("data/$from_id/bots.txt","");
$myfile2 = fopen("data/users.txt", "a") or die("Unable to open file!");	
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
}

var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	 'text'=>"سلام😉✋
💎به سرویس تبچی ساز تلگرام خوش آمدید💎

💎شما می توانید با این ربات تبچی خود را بسازید و آن را مدیریت کنید💎

🏜برای ساخت ربات یکی از گزینه ها را انتخاب کنید🏜

🆔: @DarkSkyTM",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
              [
['text'=>"🌀ساخت ربات🌀"],['text'=>"🚀ربات های من🚀"]
],
[
['text'=>"🚧حذف ربات🚧"],['text'=>"📚راهنما📚"]
],
[
['text'=>"⚠️قوانین⚠️"],['text'=>"☎️پشتیبانی☎️"]
],
[
['text'=>"🔸مدیریت🔹"],['text'=>"🔰بروزرسانی ربات🔰️"]
],
[
['text'=>"📖سوال شما!؟📖"],['text'=>"🌐سایت ما🌐"]
],
[
['text'=>"✅ارسال نظر✅"]
  
                ]
                
            	],
            	'resize_keyboard'=>false
       		])
    		]));
}
elseif ($textmessage == '🚧حذف ربات🚧') {
if (file_exists("data/$from_id/step.txt")) {

}
$botname = file_get_contents("data/$from_id/bots.txt");
if ($botname == "") {
SendMessage($chat_id,"شما هنوز هیچ رباتی نساخته اید !");

}
else {
//save("data/$from_id/step.txt","delete");


 	var_dump(makereq('sendMessage',[
	'chat_id'=>$update->message->chat->id,
	'text'=>"یکی از ربات های خود را انتخاب کنید : ",
	'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[
	['text'=>"👉 @".$botname,'callback_data'=>"del ".$botname]
	]
	]
	])
	]));

/*
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"یکی از ربات های خود را جهت پاک کردن انتخاب کنید : ",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
            	[
            	['text'=>$botname]
            	],
                [
                   ['text'=>"🏡بازگشت🏡"]
                ]
                
            	],
            	'resize_keyboard'=>true
       		])
    		])); */
}
}
elseif ($textmessage == '🌀ساخت ربات🌀') {

$tedad = file_get_contents("data/$from_id/tedad.txt");
if ($tedad >= 1) {
SendMessage($chat_id,"تعداد ربات های ساخته شده شما زیاد است !
اول باید یک ربات را پاک کنید ! $tedad");
return;
}
save("data/$from_id/step.txt","create bot");
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"توکن را وارد کنید : ",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                   ['text'=>"🏡بازگشت🏡"]
                ]
                
            	],
            	'resize_keyboard'=>false
       		])
    		]));
}
elseif ($textmessage == '🔰بروزرسانی ربات🔰️') {

save("data/$from_id/step.txt","create bot");
var_dump(makereq('sendMessage',[
        	'chat_id'=>$update->message->chat->id,
        	'text'=>"توکن را وارد کنید : ",
		'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
            	'keyboard'=>[
                [
                   ['text'=>"🏡بازگشت🏡"]
                ]
                
            	],
            	'resize_keyboard'=>false
       		])
    		]));
}

else
{
SendMessage($chat_id,"❌یافت نشد❌");
}
?>
