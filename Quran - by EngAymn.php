<?php

# For -> Eng - AymnAldorafy : @VSSSQ

ob_start();

$API_KEY = "6699025351:AAEfKEKRWNmKzVGTKqz6B9w5BzgkvKEcpi0"; //التوكن.
$AymnAldorafy = 6877747792; //الأدمن.
define("API_KEY",$API_KEY);
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
function aymn($method,$datas=[]){
$aymnnn = http_build_query($datas);
$url = "https://api.telegram.org/bot".API_KEY."/".$method."?$aymnnn";
$aymnnn = file_get_contents($url);
return json_decode($aymnnn);
}
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message) || isset($update->callback_query)):
$message = $update->message ;
$data=  $update->callback_query->data;
$id = $message->from->id ?? $update->callback_query->from->id;
$chat_id = $message->chat->id ?? $update->callback_query->message->chat->id;
$text = $message->text ;
$user = $message->from->username ?? $update->callback_query->from->username;
$name = $message->from->first_name ?? $update->callback_query->from->first_name;
$message_id = $message->message_id ?? $update->callback_query->message->message_id;
$type = $message->chat->type ?? $update->callback_query->message->chat->type;
$reply = $message->reply_to_message;
endif;
#======={خزن}=======#
$AymnAll = file_get_contents('Members.txt');
$AymnMember = explode("\n",$AymnAll);
$AymnCount = count($AymnMember);
$EngAymnData = json_decode(file_get_contents('Data.json'),1);
$exAymn = explode("-",$data);
 #======={التحقق من اليوزر}=======#
 if($user == null){$EngAldorafy = "❌";}else{$EngAldorafy = "@".$user;}
 #======={ازرار القائمة الرئيسية}=======#
 $EngAymnButton = [
 [['text'=>"📖 ︙بدء القراءة.",'callback_data'=>"StartRead"]],
 [['text'=>"🧑🏻‍💼︙مطور البوت.",'url'=>"tg://user?id=6877747792"]],
 ];
 #======={الازرار الثانوية}=======#
 $EngAymnBack = [
 [['text'=>"🔄 ⌯ إستئناف.",'callback_data'=>"ReRead"]],
 [['text'=>"♻️ ⌯ البدء من جديد.",'callback_data'=>"ReadPage1"]],
 [['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]],
 ];
 #======={زر الرجوع}=======#
 $EngAymnBackButton = [
[['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]], 
 ];
 #======={فكشن الخزن}=======#
 function aldorafy(){
	global $EngAymnData;
file_put_contents('Data.json', json_encode($EngAymnData,448));
} 
 #======={البدء}=======#
if($text == "/start"){
	if(!in_array($id,$AymnMember)){
		file_put_contents("Members.txt",$id."\n",FILE_APPEND);
		$EngAymnData["data"][$id]["data"] = "";
	aldorafy();
		aymn('sendMessage',[
		'chat_id'=>$AymnAldorafy,
		'text'=>"
		*☑️ ⌯ تم دخول شخص جديد الى البوت !.*

*👤︙الاسم :* [$name](tg://user?id=$id)
🆔︙الايدي : `$id`
*🌀︙اليوزر :* *$EngAldorafy*

*✅ ⌯ إجمالي عدد مستخدمين البوت : $AymnCount 🤖.*
		",
		'parse_mode'=>"MarkDown",
		]);
	aymn('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
	*🧑🏻‍💼 ⌯ مرحباً عزيزي* [$name](tg://user?id=$id)

*🤖 ⌯ هذا البوت* مخصص لقراءة *القرآن الكريم ☑️.*

*👇🏻 ⌯ تحكم* الان عبر *الضغط* على الأزرار *بالأسفل.*
	",
	'parse_mode'=>"MarkDown",
	'reply_markup'=>json_encode([
	'inline_keyboard'=> $EngAymnButton
	])
	]);
	return;
	}
	$EngAymnData["data"][$id]["data"] = "";
	aldorafy();
	aymn('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"
	*🧑🏻‍💼 ⌯ مرحباً عزيزي* [$name](tg://user?id=$id)

*🤖 ⌯ هذا البوت* مخصص لقراءة *القرآن الكريم ☑️.*

*👇🏻 ⌯ تحكم* الان عبر *الضغط* على الأزرار *بالأسفل.*
	",
	'parse_mode'=>"MarkDown",
	'reply_markup'=>json_encode([
	'inline_keyboard'=> $EngAymnButton
	])
	]);
	return;
	}
	if($data == "EngAymnBack"){
		$EngAymnData["data"][$id]["data"] = "";
	    aldorafy();
	aymn('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message_id,
				]);
		aymn('sendMessage',[
		'chat_id'=>$chat_id,
		'text'=>"
		*🧑🏻‍💼 ⌯ مرحباً عزيزي* [$name](tg://user?id=$id)

*🤖 ⌯ هذا البوت* مخصص لقراءة *القرآن الكريم ☑️.*

*👇🏻 ⌯ تحكم* الان عبر *الضغط* على الأزرار *بالأسفل.*
		",
		'parse_mode'=>"MarkDown",
		'reply_markup'=>json_encode([
		'inline_keyboard'=> $EngAymnButton
		])
		]);
		return;
		}
		if($data == "StartRead"){
			$EngAymnData["data"][$id]["data"] = "Read";
			aldorafy();
			aymn('editmessagetext',[
			'chat_id'=>$chat_id,
			'message_id'=>$message_id,
			'text'=>"
*🧑🏻‍💼 ⌯ حسناً عزيزي* [$name](tg://user?id=$id)

*📖 ⌯ أرسل الان* رقم الصفحة المراد *قراءتها ☑️.*
*🔘 ⌯ ويمكنك* الضغط على *( 🔄 ⌯ إستئناف )* للمواصلة من *حيث توقفت.*
*🧿 ⌯ أو يمكنك* الضغط على *( ♻️︙البدء من جديد )* للبدء من بداية *المصحف.*
			",
			'parse_mode'=>"MarkDown",
			'reply_markup'=>json_encode([
			'inline_keyboard'=> $EngAymnBack
			])
			]);
			return;
			}
			if($text && $EngAymnData["data"][$id]["data"] == "Read"){
				if($text > 604 || 0 >= $text){
					aymn('sendMessage',[
					'chat_id'=>$chat_id,
					'text'=>"
*⚠️︙عذراً ، لايوجد صفحة بهذا الرقم.*
🧿︙الصفحات من رقم *1* وحتى رقم *604*
",
					'parse_mode'=>"MarkDown",
					'reply_markup'=>json_encode([
					'inline_keyboard'=> $EngAymnBackButton
					])
					]);
					return;
					}
				$PageTake = $text - 1;
				$PageGive = $text + 1;
				$EngAymnData["data"][$id]["Page"] = $text;
				$EngAymnData["data"][$id]["data"] = "";
				aldorafy();
				aymn('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message_id,
				]);
				aymn('sendPhoto',[
				'chat_id'=>$chat_id,
				'photo'=>"https://quran.ksu.edu.sa/png_big/$text.png",
				'caption'=>"*📖 ⌯ الصفحة رقم $text.*",
				'parse_mode'=>"MarkDown",
				'reply_markup'=>json_encode([
				'inline_keyboard'=> [
					[['text'=>"⬅️︙التالي.",'callback_data'=>"TurnPage-$PageGive"],['text'=>"➡️︙السابق.",'callback_data'=>"TurnPage-$PageTake"]],
					[['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]],
					]
					])
					]);
					return;
					}
					if($exAymn[0] == "TurnPage"){
						$Page = $exAymn[1];
						if($Page == 0 || $Page == 605){
							if($Page == 0){$Error = "سابقة";}elseif($Page == 605){$Error = "تالية";}
							aymn('answerCallbackQuery',[
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"
							⚠️︙عذراً ، لايوجد صفحات $Error ☑️.
							",
							'show_alert'=>true,
							]);
							return;
							}
							aymn('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message_id,
				]);
				$PageTake = $Page - 1;
				$PageGive = $Page + 1;
				$EngAymnData["data"][$id]["Page"] = $Page;
				$EngAymnData["data"][$id]["data"] = "";
				aldorafy();
				aymn('sendPhoto',[
				'chat_id'=>$chat_id,
				'photo'=>"https://quran.ksu.edu.sa/png_big/$Page.png",
				'caption'=>"*📖 ⌯ الصفحة رقم $Page.*",
				'parse_mode'=>"MarkDown",
				'reply_markup'=>json_encode([
				'inline_keyboard'=> [
					[['text'=>"⬅️︙التالي.",'callback_data'=>"TurnPage-$PageGive"],['text'=>"➡️︙السابق.",'callback_data'=>"TurnPage-$PageTake"]],
					[['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]],
					]
					])
					]);
					return;
					}
					if($data == "ReRead"){
						$Page = $EngAymnData["data"][$id]["Page"];
						if($Page == null || $Page == ""){
							aymn('answerCallbackQuery',[
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"
							⚠️︙أنت لم تقرأ أي شيء بعد.
							",
							'show_alert'=> true,
							]);
							return;
							}
							$PageTake = $Page - 1;
				$PageGive = $Page + 1;
				$EngAymnData["data"][$id]["Page"] = $Page;
				$EngAymnData["data"][$id]["data"] = "";
				aldorafy();
				aymn('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message_id,
				]);
				aymn('sendPhoto',[
				'chat_id'=>$chat_id,
				'photo'=>"https://quran.ksu.edu.sa/png_big/$Page.png",
				'caption'=>"*📖 ⌯ الصفحة رقم $Page.*",
				'parse_mode'=>"MarkDown",
				'reply_markup'=>json_encode([
				'inline_keyboard'=> [
					[['text'=>"⬅️︙التالي.",'callback_data'=>"TurnPage-$PageGive"],['text'=>"➡️︙السابق.",'callback_data'=>"TurnPage-$PageTake"]],
					[['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]],
					]
					])
					]);
					return;
					}
					if($data == "ReadPage1"){
						$Page = 1;
						$PageTake = $Page - 1;
				$PageGive = $Page + 1;
				$EngAymnData["data"][$id]["Page"] = $Page;
				$EngAymnData["data"][$id]["data"] = "";
				aldorafy();
				aymn('deleteMessage',[
				'chat_id'=>$chat_id,
				'message_id'=>$message_id,
				]);
				aymn('sendPhoto',[
				'chat_id'=>$chat_id,
				'photo'=>"https://quran.ksu.edu.sa/png_big/$Page.png",
				'caption'=>"*📖 ⌯ الصفحة رقم $Page.*",
				'parse_mode'=>"MarkDown",
				'reply_markup'=>json_encode([
				'inline_keyboard'=> [
					[['text'=>"⬅️︙التالي.",'callback_data'=>"TurnPage-$PageGive"],['text'=>"➡️︙السابق.",'callback_data'=>"TurnPage-$PageTake"]],
					[['text'=>"🔙︙رجوع.",'callback_data'=>"EngAymnBack"]],
					]
					])
					]);
					return;
					}