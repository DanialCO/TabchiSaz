<?php
ob_start();
define('API_KEY','[*BOTTOKEN*]');
$admin =  "328130490";
$GetINFObot = json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getMe"));
$UserNameBot = $GetINFObot->result->username;
function save($filename,$TXTdata){
	$myfile = fopen($filename, "w") or die("Unable to open file!");
	fwrite($myfile, "$TXTdata");
	fclose($myfile);
	}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$button_manage = json_encode(['keyboard'=>[
[['text'=>'']],
[['text'=>'🔻فوروارد همگانی کاربر🔺'],['text'=>'🔹فوروارد همگانی گروه🔹']],
[['text'=>'🔸️پیام همگانی کاربر🔸'],['text'=>'📤️پیام همگانی گروه📤']],
[['text'=>'📤️پیام همگانی گروه📤']],
[['text'=>'📊آمار کاربر📊'],['text'=>'📊آمار گروه📊']],
[['text'=>'✏️تنظیم پیام استارت✏️']],
],'resize_keyboard'=>true]);
$button_remove = json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true]);
$button_back = json_encode(['keyboard'=>[
[['text'=>'️منوی اصلی']],
],'resize_keyboard'=>true]);

$update = json_decode(file_get_contents('php://input'));
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->message->from->id;
$messageid = $update->callback_query->message->message_id;
$data_id = $update->callback_query->id;
$txt = $update->callback_query->message->text;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$from_username = $update->message->from->username;
$from_first = $update->message->from->first_name;
$forward_id = $update->message->forward_from->id;
$forward_chat = $update->message->forward_from_chat;
$forward_chat_username = $update->message->forward_from_chat->username;
$forward_chat_msg_id = $update->message->forward_from_message_id;
$text = $update->message->text;
$message_id = $update->message->message_id;
$stickerid = $update->message->sticker->file_id;
$videoid = $update->message->video->file_id;
$voiceid = $update->message->voice->file_id;
$fileid = $update->message->document->file_id;
$photo = $update->message->photo;
$photoid = $photo[count($photo)-1]->file_id;
$musicid = $update->message->audio->file_id;
$sticker_id = $update->message->sticker->file_id;
$video_id = $update->message->video->file_id;
$voice_id = $update->message->voice->file_id;
$file_id = $update->message->document->file_id;
$music_id = $update->message->audio->file_id;
$photo2_id = $update->message->photo[2]->file_id;
$photo1_id = $update->message->photo[1]->file_id;
$photo0_id = $update->message->photo[0]->file_id;
$caption = $update->message->caption;
$cde = time();
$type = $update->message->chat->type;
$code = md5("$cde$from_id");
$command = file_get_contents('user/'.$from_id."/command.txt");
$gold = file_get_contents('user/'.$from_id."/gold.txt");
$coin = file_get_contents('user/'.$from_id."/coin.txt");
$wait = file_get_contents('user/'.$from_id."/wait.txt");
$coin_wait = file_get_contents('user/'.$wait."/coin.txt");
$number = file_get_contents('user/'.$from_id."/number.txt");
$class = file_get_contents("shop/dokme.php");
$code_taiid = file_get_contents('user/'.$from_id."/code taiid.txt");
$Member = file_get_contents('admin/Member.txt');
$NZR = file_get_contents('admin/NZR.txt');
$Tedad_Nazar = file_get_contents('admin/Tedad Nazar.txt');
$ads = file_get_contents('ads/Ads.txt');
$_sticker = file_get_contents("shop/button/sticker/$text.txt");
$_1sticker = file_get_contents("shop/button/sticker/pool/$text.txt");
$_video = file_get_contents("shop/button/video/$text.txt");
$_1video = file_get_contents("shop/button/video/pool/$text.txt");
$_voice = file_get_contents("shop/button/voice/$text.txt");
$_1voice = file_get_contents("shop/button/voice/pool/$text.txt");
$_file = file_get_contents("shop/button/file/$text.txt");
$_1file = file_get_contents("shop/button/file/pool/$text.txt");
$_music = file_get_contents("shop/button/music/$text.txt");
$_1music = file_get_contents("shop/button/music/pool/$text.txt");
$_photo = file_get_contents("shop/button/photo/$text.txt");
$_1photo = file_get_contents("shop/button/photo/pool/$text.txt");
$_rss = file_get_contents("shop/button/feed/$text.txt");
$_1rss = file_get_contents("shop/button/feed/pool/$text.txt");
$_text = file_get_contents("shop/button/text/$text.txt");
$_1text = file_get_contents("shop/button/text/pool/$text.txt");
$_caption = file_get_contents("shop/button/caption/$text.txt");
$_caption = str_replace("FIRSTNAME",$first,$_caption);
$_caption = str_replace("LASTNAME",$last,$_caption);
$_caption = str_replace("USERID",$from_id,$_caption);
$_caption = str_replace("USERNAME",$username,$_caption);
$startt = file_get_contents("admin/start.txt");
function SendMessage($chatid,$text,$message_id,$parsmde,$disable_web_page_preview,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
        'reply_to_message_id'=>$message_id,
	'parse_mode'=>$parsmde,
	'disable_web_page_preview'=>$disable_web_page_preview,
	'reply_markup'=>$keyboard
	]);
	}
function SendMessage2($chatid,$text,$parsmde,$disable_web_page_preview,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>$parsmde,
	'disable_web_page_preview'=>$disable_web_page_preview,
	'reply_markup'=>$keyboard
	]);
	}
function ForwardMessage($chatid,$from_chat,$message_id){
	bot('ForwardMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat,
	'message_id'=>$message_id
	]);
	}
function SendPhoto($chatid,$photo,$keyboard,$caption){
	bot('SendPhoto',[
	'chat_id'=>$chatid,
	'photo'=>$photo,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
function SendAudio($chatid,$audio,$keyboard,$caption,$sazande,$title){
	bot('SendAudio',[
	'chat_id'=>$chatid,
	'audio'=>$audio,
	'caption'=>$caption,
	'performer'=>$sazande,
	'title'=>$title,
	'reply_markup'=>$keyboard
	]);
	}
function SendDocument($chatid,$document,$keyboard,$caption){
	bot('SendDocument',[
	'chat_id'=>$chatid,
	'document'=>$document,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
function SendSticker($chatid,$sticker,$keyboard){
	bot('SendSticker',[
	'chat_id'=>$chatid,
	'sticker'=>$sticker,
	'reply_markup'=>$keyboard
	]);
	}
function SendVideo($chatid,$video,$keyboard,$duration){
	bot('SendVideo',[
	'chat_id'=>$chatid,
	'video'=>$video,
	'duration'=>$duration,
	'reply_markup'=>$keyboard
	]);
	}
function SendVoice($chatid,$voice,$keyboard,$caption){
	bot('SendVoice',[
	'chat_id'=>$chatid,
	'voice'=>$voice,
	'caption'=>$caption,
	'reply_markup'=>$keyboard
	]);
	}
function SendContact($chatid,$first_name,$phone_number,$keyboard){
	bot('SendContact',[
	'chat_id'=>$chatid,
	'first_name'=>$first_name,
	'phone_number'=>$phone_number,
	'reply_markup'=>$keyboard
	]);
	}
function SendChatAction($chatid,$action){
	bot('sendChatAction',[
	'chat_id'=>$chatid,
	'action'=>$action
	]);
	}
function KickChatMember($chatid,$user_id){
	bot('kickChatMember',[
	'chat_id'=>$chatid,
	'user_id'=>$user_id
	]);
	}
function LeaveChat($chatid){
	bot('LeaveChat',[
	'chat_id'=>$chatid
	]);
	}
function GetChat($chatid){
	bot('GetChat',[
	'chat_id'=>$chatid
	]);
	}
function GetChatMembersCount($chatid){
	bot('getChatMembersCount',[
	'chat_id'=>$chatid
	]);
	}
function GetChatMember($chatid,$userid){
	$truechannel = json_decode(file_get_contents('https://api.telegram.org/bot'.API_KEY."/getChatMember?chat_id=".$chatid."&user_id=".$userid));
	$tch = $truechannel->result->status;
	return $tch;
	}
function AnswerCallbackQuery($callback_query_id,$text,$show_alert){
	bot('answerCallbackQuery',[
        'callback_query_id'=>$callback_query_id,
        'text'=>$text,
		'show_alert'=>$show_alert
    ]);
	}
function EditMessageText($chat_id,$message_id,$text,$parse_mode,$disable_web_page_preview,$keyboard){
	 bot('editMessagetext',[
    'chat_id'=>$chat_id,
	'message_id'=>$message_id,
    'text'=>$text,
    'parse_mode'=>$parse_mode,
	'disable_web_page_preview'=>$disable_web_page_preview,
    'reply_markup'=>$keyboard
	]);
	}
function EditMessageCaption($chat_id,$message_id,$caption,$keyboard,$inline_message_id){
	 bot('editMessageCaption',[
    'chat_id'=>$chat_id,
	'message_id'=>$message_id,
    'caption'=>$caption,
    'reply_markup'=>$keyboard,
	'inline_message_id'=>$inline_message_id
	]);
	}
// start source
  //===============
	if($text == '/start'){
  file_put_contents('user/'.$from_id."/command.txt","none");
  SendMessage($chat_id,"$startt",$message_id,"html","true",$button_remove);
  }
	//===============
	elseif ($text == '/help'){
sendmessage($chat_id,'🔺راهنمای دستورات🔻
➖➖➖➖➖➖➖➖➖➖➖
🔹 : /startPM
▪️تعیین متن استارت▫️
🔹 : /panel
▪️ورود به مدیریت▫️
🔹 : /amaru
▪️تعداد امار کاربران▫️
🔹 : /amarg
▪️تعداد امار گروه▫️
🔹 : /farwardu
▪️فروارد همگانی به کاربران▫️
🔹 : /farwardg
▪️فروارد همگانی به گروه▫️
🔹 : /PmHameu
▪️پیام همگانی به کاربرها▫️
🔹 : /PmHameg
▪️پیام همگانی به گروه▫️
🆔: @TeleTabchiSazBot');
}
elseif($text == '️منوی اصلی' and $from_id == $admin){
  file_put_contents('user/'.$from_id."/command.txt","none");
  SendMessage($chat_id," شما به منوی اصلی برگشتید",$message_id,"html","true",$button_manage);
  }
  elseif($text == '✏️تنظیم پیام استارت✏️' and $from_id == $admin){
    file_put_contents('user/'.$from_id."/command.txt","pmstart");
  SendMessage($chat_id,"متن خود را ارسال نمایید",$message_id,"html","true",$button_back);
  }
elseif($text == '/startPM️' and $from_id == $admin){
    file_put_contents('user/'.$from_id."/command.txt","pmstart");
  SendMessage($chat_id,"متن خود را ارسال نمایید",$message_id,"html","true",$button_back);
  }
  	elseif($command == 'pmstart' and $from_id == $admin) {
  	  save("admin/start.txt","$text");
  	    SendMessage($chat_id,"متن جدید ثبت گردید.",$message_id,"html","true",$button_manage);
  	    }
  elseif($text == '/panel' and $from_id == $admin){
  SendMessage($chat_id,"به پنل مدیریت خوش اومدی",$message_id,"html","true",$button_manage);
  }
  elseif($text == '📊آمار کاربر📊' and $from_id == $admin){
	$txtt = file_get_contents('admin/Member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
	SendMessage($chat_id,"کل کاربران: $mmemcount نفر",$message_id,"html","true");
	}
elseif($text == ' /amaru' and $from_id == $admin){
	$txtt = file_get_contents('admin/Member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
	SendMessage($chat_id,"کل کاربران: $mmemcount نفر",$message_id,"html","true");
	}
	elseif($text == '📊آمار گروه📊' and $from_id == $admin | $from_id == $admin2){
	$txtt = file_get_contents('admin/gp.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
	SendMessage($chat_id,"کل گروه ها: $mmemcount",$message_id,"html","true");
	}
elseif($text == '/amarg' and $from_id == $admin | $from_id == $admin2){
	$txtt = file_get_contents('admin/gp.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
	SendMessage($chat_id,"کل گروه ها: $mmemcount",$message_id,"html","true");
	}
  elseif($text == '🔻فوروارد همگانی کاربر🔺' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a fwd");
	SendMessage($chat_id,"پیام مورد نظر را فوروارد کنید",$message_id,"html","true",$button_back);
	}
	elseif($command == 's2a fwd' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.",$message_id,"html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			ForwardMessage($user,$admin,$message_id);
		}
	}
elseif($text == '/farwardu' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a fwd");
	SendMessage($chat_id,"پیام مورد نظر را فوروارد کنید",$message_id,"html","true",$button_back);
	}
	elseif($command == 's2a fwd' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.",$message_id,"html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			ForwardMessage($user,$admin,$message_id);
		}
	}
	elseif($text == '🔹فوروارد همگانی گروه🔹' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a fwd gp");
	SendMessage($chat_id,"پیام مورد نظر را فوروارد کنید",$message_id,"html","true",$button_back);
	}
elseif($text == '/farwardg' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a fwd gp");
	SendMessage($chat_id,"پیام مورد نظر را فوروارد کنید",$message_id,"html","true",$button_back);
	}
	elseif($command == 's2a fwd gp' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.",$message_id,"html","true",$button_manage);
	$all_member = fopen( "admin/gp.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			ForwardMessage($user,$admin,$message_id);
		}
	}
	elseif($text == '🔸️پیام همگانی کاربر🔸' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a");
	SendMessage($chat_id,"پیامتون رو وارد کنید",$message_id,"html","true",$button_back);
	}
elseif($text == '/PmHameu' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a");
	SendMessage($chat_id,"پیامتون رو وارد کنید",$message_id,"html","true",$button_back);
	}
	elseif($command == 's2a' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.",$message_id,"html","true",$button_manage);
	$all_member = fopen( "admin/Member.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($sticker_id != null){
			SendSticker($user,$stickerid);
			}
			elseif($videoid != null){
			SendVideo($user,$videoid,$caption);
			}
			elseif($voiceid != null){
			SendVoice($user,$voiceid,'',$caption);
			}
			elseif($fileid != null){
			SendDocument($user,$fileid,'',$caption);
			}
			elseif($musicid != null){
			SendAudio($user,$musicid,'',$caption);
			}
			elseif($photoid != null){
			SendPhoto($user,$photoid,'',$caption);
			}
			elseif($text != null){
			SendMessage2($user,$text,"html","true");
			}
		}
	}
	elseif($text == '📤️پیام همگانی گروه📤' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a gp");
	SendMessage($chat_id,"پیامتون رو وارد کنید",$message_id,"html","true",$button_back);
	}
elseif($text == 'PmHameg' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","s2a gp");
	SendMessage($chat_id,"پیامتون رو وارد کنید",$message_id,"html","true",$button_back);
	}
	elseif($command == 's2a gp' and $from_id == $admin){
	file_put_contents("user/".$from_id."/command.txt","none");
	SendMessage($chat_id,"پیام شما در صف ارسال قرار گرفت.",$message_id,"html","true",$button_manage);
	$all_member = fopen( "admin/gp.txt", 'r');
		while( !feof( $all_member)) {
 			$user = fgets( $all_member);
			if($sticker_id != null){
			SendSticker($user,$stickerid);
			}
			elseif($videoid != null){
			SendVideo($user,$videoid,$caption);
			}
			elseif($voiceid != null){
			SendVoice($user,$voiceid,'',$caption);
			}
			elseif($fileid != null){
			SendDocument($user,$fileid,'',$caption);
			}
			elseif($musicid != null){
			SendAudio($user,$musicid,'',$caption);
			}
			elseif($photoid != null){
			SendPhoto($user,$photoid,'',$caption);
			}
			elseif($text != null){
			SendMessage2($user,$text,"html","true");
			}
		}
	}
  // End Source
 $user = file_get_contents('admin/Member.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('admin/Member.txt');
      $add_user .= $chat_id."\n";
     file_put_contents('admin/Member.txt',$add_user);
    }
    $user = file_get_contents('admin/gp.txt');
    $members = explode("\n",$user);
    if (!in_array($chat_id,$members)){
      $add_user = file_get_contents('admin/gp.txt');
      $add_user .= $chat_id."\n";
If($from_id != $chat_id){ file_put_contents('admin/gp.txt',$add_user);
}
    }
    unlink('error_log');
	?>
