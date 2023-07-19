<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('PostVal')) {
    function PostVal($name=null) {
	   $ci= &get_instance();
        return $ci->input->post(htmlspecialchars($name),true);    
    }
}

if (!function_exists('ConvertToSEO')) {
    function ConvertToSEO ( $fonktmp ) {
        $returnstr = "";
        $turkcefrom = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
        $turkceto   = array("G","U","S","I","O","C","g","u","s","i","o","c");
        $fonktmp = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$fonktmp);
        // Türkçe harfleri ingilizceye çevir
        $fonktmp = preg_replace($turkcefrom,$turkceto,$fonktmp);
        // Birden fazla olan boşlukları tek boşluk yap
        $fonktmp = preg_replace("/ +/"," ",$fonktmp);
        // Boşukları - işaretine çevir
        $fonktmp = preg_replace("/ /","-",$fonktmp);
        // Tüm beyaz karekterleri sil
        $fonktmp = preg_replace("/\s/","",$fonktmp);
        // Karekterleri küçült
        $fonktmp = strtolower($fonktmp);
        // Başta ve sonda - işareti kaldıysa yoket
        $fonktmp = preg_replace("/^-/","",$fonktmp);
        $fonktmp = preg_replace("/-$/","",$fonktmp);
        $returnstr = $fonktmp;
        return $returnstr;
    }
}

if (!function_exists('convertToUtf8')) {
    function convertToUtf8($text) {
        $t=&get_instance();

        return mb_convert_encoding($text, 'UTF-8', "auto");

    }
}

/* HERHANGİ BİR TABLO İÇİNDE İLİŞKİLİ BAŞKA BİR TABLODAN DEĞER OKUYAN FONKSİYON */

if (!function_exists('getRecordOnId'))
{
    function getRecordOnId($table=null, $where=array()){
        $ci =& get_instance();

        $ci->db->from($table);
        $ci->db->where($where);
        $query = $ci->db->get();
        if ($query) {
            return $query->row();
        }
    }
}

/* FORMLARDA KULLANILMAK ÜZERE HERHANGİ BİR TABLO İÇERİĞİNİ AÇILIR MENÜYE GÖNDEREN FONKSİYON */

if (!function_exists('SecenekDoldur'))
{
    function SecenekDoldur($dizi=null,$hangialan=array()){
        $ci=& get_instance();

        foreach ($dizi as $b) {
            $secenekler[0]="Seçim Yapınız";
            $secenekler[$b->id]=$b->$hangialan;
        }
        
        return $secenekler;
    }
}

function isAdmin(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    return true;

    if($user->user_role == "admin")
        return true;
    else
        return false;
}

function get_active_user(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user)
        return $user;
    else
        return false;

}

function getControllerList(){

    $t = &get_instance();

    $controllers = array();
    $t->load->helper("file");

    $files = get_dir_file_info(APPPATH. "controllers", FALSE);

    foreach (array_keys($files) as $file){
        if($file !== "index.html"){
            $controllers[] = strtolower(str_replace(".php", '', $file));
        }
    }

    return $controllers;

}

function send_email($toEmail = "", $subject = "", $message = ""){
    
    $t =& get_instance();

    $t->load->model("emailsettings_model");

    $email_settings = $t->emailsettings_model->get(
        array(
            "isActive"  => 1
        )
    );

    $config = array(

        "protocol"   => $email_settings->protocol,
        "smtp_host"  => $email_settings->host,
        "smtp_port"  => $email_settings->port,
        "smtp_user"  => $email_settings->user,
        "smtp_pass"  => $email_settings->password,
        "starttls"   => true,
        "charset"    => "utf-8",
        "mailtype"   => "html", 
        "wordwrap"   => true,
        "newline"    => "\r\n"
    );

    $t->email->set_header('Content-Type', 'html');
    $t->email->set_crlf("\r\n");
    $t->email->initialize($config);
    
    $t->email->from($email_settings->kimden, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    

    $t->email->message($message);
    /*print_r("<pre>");
    print_r($t->email);
    die(); */
    return $t->email->send();
}

function setUserRoles(){

    $t = &get_instance();

    $t->load->model("User_role_model");

    $user_roles = $t->User_role_model->get_all(
        array(
            "isActive"  => 1
        )
    );

    $roles = [];
    foreach ($user_roles as $role){
        $roles[$role->id] = $role->permissions;
    }
    $t->session->set_userdata("user_roles", $roles);

}

function get_user_roles(){

    $t = &get_instance();
    return $t->session->userdata("user_roles");
}

