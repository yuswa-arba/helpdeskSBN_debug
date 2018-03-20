<?php
class EMAIL_TO_DB {

var $IMAP_host;
var $IMAP_port;
var $IMAP_login;
var $IMAP_pass;
var $link;
var $error = array();
var $status;
var $max_headers = 10;
var $filestore; 
var $file_path = '';
var $partsarray = array();
var $msgid =1;
var $newid;
var $logid;
var $this_file_name = 'mail.php';
var $mode = 'html';
var $spam_folder = 1;
var $file = array();

function connect($host, $port, $login, $pass)
{
    $this->IMAP_host = $host;
    $this->IMAP_login = $login;
    $this->link = imap_open("{". $host . $port."}INBOX", $login, $pass);
        if($this->link)
        {
            $this->status = 'Connected';
        } else
        {
            $this->error[] = imap_last_error();
            $this->status = 'Not connected';
        }
}

function set_path()
{
    $path = $this->file_path;
    return $path;
}

function set_filestore()
{
    $dir = $this->dir_name();
    $path = $this->set_path();
    $this->filestore = $path.$dir;
}

function mailboxmsginfo()
{
    $mailbox = imap_check($this->link);
    if ($mailbox)
    {
        $mbox["Date"]    = $mailbox->Date;
        $mbox["Driver"]  = $mailbox->Driver;
        $mbox["Mailbox"] = $mailbox->Mailbox;
        $mbox["Messages"]= $this->num_message();
        $mbox["Recent"]  = $this->num_recent();
        $mbox["Unread"]  = $mailbox->Unread;
        $mbox["Deleted"] = $mailbox->Deleted;
        $mbox["Size"]    = $mailbox->Size;
    } else
    {
        $this->error[] = imap_last_error();
    }
    return $mbox;
}

function num_message()
{
    return imap_num_msg($this->link);
}

function num_recent()
{
    return imap_num_recent($this->link);
}

function msg_type_subtype($_type)
{
    if($_type > 0)
    {
        switch($_type)
        {
            case '0': $type = "text";
            break;
            case '1': $type = "multipart";
            break;
            case '2': $type = "message";
            break;
            case '3': $type = "application";
            break;
            case '4': $type = "audio";
            break;
            case '5': $type = "image";
            break;
            case '6': $type = "video"; 
            break;
            case '7': $type = "other";
            break;
        }
    }
    return $type;
}
function email_flag()
{
    switch ($char)
    {
        case 'S': if (strtolower($flag) == '\\seen')
        {
            $msg->is_seen = true;
        }
        break;
        case 'A': if (strtolower($flag) == '\\answered')
        {
            $msg->is_answered = true;
        }
        break;
        case 'D': if (strtolower($flag) == '\\deleted')
        {
            $msg->is_deleted = true;
        }
        break;
        case 'F': if (strtolower($flag) == '\\flagged')
        {
            $msg->is_flagged = true;
        }
        break;
        case 'M': if (strtolower($flag) == '$mdnsent')
        {
            $msg->is_mdnsent = true;
        }
        break;
        default:
        break;
    }
}

function parsepart($p,$msgid,$i){

$part=imap_fetchbody($this->link,$msgid,$i);

if ($p->type!=0){

if ($p->encoding==3)$part=base64_decode($part);

if ($p->encoding==4)$part=quoted_printable_decode($part);


switch($p->type) {
case '5': 
$this->partsarray[$i][image] = array('filename'=>imag1,'string'=>$part, 'part_no'=>$i);
break;
}

$filename='';
if (count($p->dparameters)>0){
foreach ($p->dparameters as $dparam){
if ((strtoupper($dparam->attribute)=='NAME') ||(strtoupper($dparam->attribute)=='FILENAME')) $filename=$dparam->value;
}
}
if ($filename==''){
if (count($p->parameters)>0){
foreach ($p->parameters as $param){
if ((strtoupper($param->attribute)=='NAME') ||(strtoupper($param->attribute)=='FILENAME')) $filename=$param->value;
}
}
}
if ($filename!='' ){
$this->partsarray[$i][attachment] = array('filename'=>$filename,'string'=>$part, 'encoding'=>$p->encoding, 'part_no'=>$i,'type'=>$p->type,'subtype'=>$p->subtype);

}
     
}

else if($p->type==0){

if ($p->encoding==4) $part=quoted_printable_decode($part);

if ($p->encoding==3) $part=base64_decode($part);


if (strtoupper($p->subtype)=='PLAIN')1;

else if (strtoupper($p->subtype)=='HTML')1;
$this->partsarray[$i][text] = array('type'=>$p->subtype,'string'=>$part);
}


if (count($p->parts)>0){
foreach ($p->parts as $pno=>$parr){
$this->parsepart($parr,$this->msgid,($i.'.'.($pno+1)));           
}
}
return;
}


function email_headers(){

if($this->max_headers == 'max'){
$headers = imap_fetch_overview($this->link, "1:".$this->num_message(), 0);
} else {
$headers = imap_fetch_overview($this->link, "1:$this->max_headers", 0);
}
if($this->max_headers == 'max') {
$num_headers = count($headers);
} else {
$count =  count($headers);
if($this->max_headers >= $count){
$num_headers = $count;
} else {
$num_headers = $this->max_headers;
}
}

$size=sizeof($headers);
for($i=1; $i<=$size; $i++){

$val=$headers[$i]; 


$subject_s = (empty($val->subject)) ? '[No subject]' : $val->subject;
$lp = $lp +1;
imap_setflag_full($this->link,imap_uid($this->link,$i),'\\SEEN',SE_UID);
$header=imap_headerinfo($this->link, $i, 80,80);

if($val->seen == "0"  && $val->recent == "0") {echo  '<b>'.$val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."</b><br><hr>" ;}
else {echo  $val->msgno . '-' . $subject_s . '-' . $val->from .'-'. $val->date."<br><hr>" ;}
}
}

function email_get(){
$email = array();
$this->set_filestore();

$header=imap_headerinfo($this->link, $this->msgid, 80,80);
$from = $header->from;
$udate= $header->udate;
$to   = $header->to;
$size = $header->Size;

if ($header->Unseen == "U" || $header->Recent == "N") {
$s = imap_fetchstructure($this->link,$this->msgid);
if (count($s->parts)>0){
foreach ($s->parts as $partno=>$partarr){
$this->parsepart($partarr,$this->msgid,$partno+1);
}
} else { 
$text=imap_body($this->link,$this->msgid);
if ($s->encoding==4) $text=quoted_printable_decode($text);

if (strtoupper($s->subtype)=='PLAIN') $text=$text;
if (strtoupper($s->subtype)=='HTML') $text=$text;

$this->partsarray['not multipart'][text]=array('type'=>$s->subtype,'string'=>$text);
}

if(is_array($from)){
foreach ($from as $id => $object) {
$fromname = $object->personal;
$fromaddress = $object->mailbox . "@" . $object->host;
}
}

if(is_array($to)){
foreach ($from as $id => $object) {
$toaddress = $object->mailbox . "@" . $object->host;
}
}

$email['CHARSET']    = $charset;
$email['SUBJECT']    = $this->mimie_text_decode($header->Subject);
$email['FROM_NAME']  = $this->mimie_text_decode($fromname);
$email['FROM_EMAIL'] = $fromaddress;
$email['TO_EMAIL']   = $toaddress;
$email['DATE']       = date("Y-m-d H:i:s",strtotime($header->date));
$email['SIZE']       = $size;
$email['FLAG_RECENT']  = $header->Recent;
$email['FLAG_UNSEEN']  = $header->Unseen;
$email['FLAG_ANSWERED']= $header->Answered;
$email['FLAG_DELETED'] = $header->Deleted;
$email['FLAG_DRAFT']   = $header->Draft;
$email['FLAG_FLAGGED'] = $header->Flagged;

}
return $email;

}

function mimie_text_decode($string){

$string = htmlspecialchars(chop($string));

$elements = imap_mime_header_decode($string);
if(is_array($elements)){
for ($i=0; $i<count($elements); $i++) {
$charset = $elements[$i]->charset;
$txt .= $elements[$i]->text;
}
} else {
$txt = $string;
}
if($txt == ''){
$txt = 'No_name';
}
if($charset == 'us-ascii'){
}
return $txt;
}

function save_files($filename, $part){

$fp=fopen($this->filestore.$filename,"w+");
fwrite($fp,$part);
fclose($fp);
chown($this->filestore.$filename, 'apache');

}
function email_setflag(){

imap_setflag_full($this->link, "2,5","\\Seen \\Flagged"); 

}
function email_delete(){

imap_delete($this->link, $this->msgid); 

}

function email_expunge(){

imap_expunge($this->link);

}


function close(){
imap_close($this->link);   
}


function listmailbox(){
$list = imap_list($this->link, "{".$this->IMAP_host."}", "*");
if (is_array($list)) {
return $list;
} else {
$this->error =  "imap_list failed: " . imap_last_error() . "\n";
}
return array();
}

function spam_detect(){

$email = array();

$id = $this->newid; 
$execute = mysql_query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, Subject, Message, Message_html FROM gx_email WHERE ID='".$id."'");
$row = mysql_fetch_array($execute);
$ID = $row['ID'];
$email['Email']       = $row['EmailFrom'];
$email['Subject']     = $row['Subject'];
$email['Text']        = $row['Message'];
$email['Text_HTML']   = $row['Message_html'];
if($this->check_blacklist($email['Email'])){
$this->update_folder($id, $this->spam_folder);  
}
if($this->check_words($email['Subject'])){
$this->update_folder($id, $this->spam_folder);  
}
if($this->check_words($email['Text'])){
$this->update_folder($id, $this->spam_folder);  
}
if($this->check_words($email['Text_HTML'])){
$this->update_folder($id, $this->spam_folder);  
}
}


function check_blacklist($email){
$execute = mysql_query("SELECT Email FROM gx_list WHERE Email='".addslashes($email)."' AND Type='B'");
$row = mysql_fetch_array($execute);
$e_mail = $row['Email'];
if($e_mail == $email){
return 1;
} else {
return 0;
}

}

function check_words($string){
$string = strtolower($string);
$execute = mysql_query("SELECT Word FROM gx_words ");
while($row = mysql_fetch_array($execute)){

$word = strtolower($row['Word']);

if (eregi($word, $string)) {
return 1;
}
}
}
function db_add_message($email){


$execute = mysql_query("INSERT INTO gx_email (IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, MsgSize) VALUES
('".$message_id."',
'".$email['FROM_EMAIL']."',
'".addslashes(strip_tags($email['FROM_NAME']))."',
'".addslashes(strip_tags($email['TO_EMAIL']))."',
'".$email['DATE']."',
'".date("Y-m-d H:i:s")."',
'".addslashes($email['SUBJECT'])."',
'".$email["SIZE"]."')");

$execute = mysql_query("select LAST_INSERT_ID() as UID");
$row = mysql_fetch_array($execute);
$this->newid = $row["UID"];

}

function db_add_attach($file_orig, $filename){

$execute = mysql_query("INSERT INTO gx_attach (IDEmail, FileNameOrg, Filename) VALUES
('".$this->newid."',
'".addslashes($file_orig)."',
'".addslashes($filename)."')");

}
function db_update_message($msg, $type= 'PLAIN'){

if($type == 'PLAIN') $execute = mysql_query("UPDATE gx_email SET Message='".addslashes($msg)."' WHERE ID= '".$this->newid."'");

if($type == 'HTML')  $execute = mysql_query("UPDATE gx_email SET Message_html='".addslashes($msg)."' WHERE ID= '".$this->newid."'");

}
function add_db_log($email, $info){

$execute = mysql_query("INSERT INTO gx_log (IDemail, Email, Info, FSize, Date_start, Status) VALUES
('".$this->newid."',
'".$email['FROM_EMAIL']."',
'".addslashes(strip_tags($info))."',
'".$email["SIZE"]."',
'".date("Y-m-d H:i:s")."',
'2')");

$execute = mysql_query("select LAST_INSERT_ID() as UID");
$row = mysql_fetch_array($execute);
$this->logid = $row['UID'];

return  $this->logid;

}
function update_folder($id, $folder){

$execute = mysql_query("UPDATE gx_email SET Type = '".addslashes($folder)."' WHERE ID = '".$id."'");

}
function update_db_log($info, $id){

$execute = mysql_query("UPDATE gx_log  SET Status = '1', Info='".addslashes(strip_tags($info))."', Date_finish = '".date("Y-m-d H:i:s")."' WHERE IDlog = '".$id."'");

}
function db_read_log(){

$email = array();

$execute = mysql_query("SELECT IDlog, IDemail, Email, Info, FSize, Date_start, Date_finish, Status FROM gx_log ORDER BY Date_finish DESC LIMIT 100");
while($row = mysql_fetch_array($execute)){
$ID = $row['IDlog'];
$email[$ID]['IDemail']     = $row['IDemail'];
$email[$ID]['Email']       = $row['Email'];
$email[$ID]['Info']        = $row['Info'];
$email[$ID]['Size']        = $row['FSize'];
$email[$ID]['Date_start']  = $row['Date_start'];
$email[$ID]['Date_finish'] = $row['Date_finish'];
}
return $email;
}  
function db_read_emails(){
if (!isset($db)) $db = new DB_WL;
$email = array();
$execute = mysql_query("SELECT ID, IDEmail, EmailFrom, EmailFromP, EmailTo, DateE, DateDb, Subject, Message, Message_html, MsgSize FROM gx_email ORDER BY ID DESC LIMIT 25");
while($row = mysql_fetch_array($execute)){
$ID = $row['ID'];
$email[$ID]['Email']     = $row['EmailFrom'];
$email[$ID]['EmailName'] = $row['EmailFrom'];
$email[$ID]['Subject']   = $row['Subject'];
$email[$ID]['Date']      = $row['DateE'];
$email[$ID]['Size']      = $row['MsgSize'];

}
return $email;
}

function dir_name() {

$year  = date('Y');
$month = date('m');

$dir_n = $year . "_" . $month;
echo $this->set_path();
if (is_dir($this->set_path() . $dir_n)) {
return $dir_n . '/';
} else {
mkdir($this->set_path() . $dir_n, 0777);
return $dir_n . '/';
}
}

function do_action(){

if($this->num_message() >= 1) {

if($this->msgid <= 0) {
$this->msgid = 1;
} else {
$this->msgid = $_GET[msgid] + 1;
}


$email = $this->email_get();

$dir = $this->dir_name();

$ismsgdb = $this->db_add_message($email);

$id_log = $this->add_db_log($email, 'Copy e-mail - start ');

foreach($this->partsarray as $part){
if($part[text][type] == 'HTML'){
$this->db_update_message($part[text][string], $type= 'HTML');
}elseif($part[text][type] == 'PLAIN'){
$message_PLAIN = $part[text][string];
$this->db_update_message($part[text][string], $type= 'PLAIN');
}elseif($part[attachment]){

foreach(array($part[attachment]) as $attach){
$attach[filename] = $this->mimie_text_decode($attach[filename]);
$attach[filename] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $attach[filename]);
$this->add_db_log($email, 'Start coping file:"'.strip_tags($attach[filename]).'"');

$this->save_files($this->newid.$attach[filename], $attach[string]);
$filename =  $dir.$this->newid.$attach[filename];
$this->db_add_attach($attach[filename], $filename);
$this->update_db_log('<b>'.$filename.'</b>Finish coping: "'.strip_tags($attach[filename]).'"', $this->logid);
}
//

}elseif($part[image]){
$message_IMAGE[] = $part[image];

foreach($message_IMAGE as $image){
$image[filename] = $this->mimie_text_decode($image[filename]);
$image[filename] = preg_replace('/[^a-z0-9_\-\.]/i', '_', $image[filename]);
$this->add_db_log($email, 'Start coping file: "'.strip_tags($image[filename]).'"');


$this->save_files($this->newid.$image[filename], $image[string]);
$filename =  $dir.$this->newid.$image[filename];
$this->db_add_attach($image[filename], $filename);
$this->update_db_log('<b>'.$filename.'</b>Finish coping:"'.strip_tags($image[filename]).'"', $this->logid);
}

}

}
$this->spam_detect();
$this->email_setflag(); 
$this->email_delete();
$this->email_expunge();

$this->update_db_log('Finish coping', $id_log);

if($email <> ''){
unset($this->partsarray);
if($this->mode == 'html') {
if(isset($_GET['menu'])){
$menu = $_GET['menu'];
}else{
$menu = '';
}
echo "<meta http-equiv=\"refresh\" content=\"600; url=".$this->this_file_name."?msgid=0&menu=".$menu."\">";
echo ""; 
}

}
} else {
if($this->mode == 'html') {
if(isset($_GET['menu'])){
$menu = $_GET['menu'];
}else{
$menu = '';
}
echo "<meta http-equiv=\"refresh\" content=\"600; url=".$this->this_file_name."?msgid=0&menu=".$menu."\">";
echo "";  
}
}
}
}
?>