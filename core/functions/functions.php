<?php
  define("MAX_ADMINISTRATIVE_LEVEL", 3); // переменная, определяющая границу административных привелегий ( например 3 означает что адм привелегии распроостраняются на группы с ID<=3)
  define("COLOR_PREDV","#FF99FF");
  define("COLOR_ZAKL","#9999FF");
  define("COLOR_OTKR","#66CCFF");
  define("COLOR_ZAKR","#0099FF");
  define("MK3_VACATION_PROJECT",43);   //отпуск
  define("MK3_ILLNESS_PROJECT",44);    //болезнь

  
  $palette=array('FF50FF','739300', '337370', 'C460C0','800085','F86600', '80D480', 'FF0580', 'FF935B','333399', '00D3F4', 'F5CC69','800000', 'FF6600','808000', '0088F0', '008080', '0000FF', '666699', '808080', 'FF0000', 'FF9900','99CC00', '339966', '33CCCC', '3366FF', '800080', '999999', 'FF00FF', 'FFCC00','FFFF00', '00FF00', '00FF5F', '00C7FF', '993366', 'C060C0', 'FF99CC', 'F5CC99','FF3F99','CCFF5F', '99CCFF', '5FF5F7', );

  
function get_min_access_level() {
/* ****************************************************************** */
/*     Return min access level of user                                */
/* ****************************************************************** */    
if (!isset($_SESSION['user_level']))  { 
       $def_level=0;
    } else {
       $def_level=min($_SESSION['user_level']);
    }
    return (int)$def_level;
  
}    
function __($txt) {
    echo _($txt);
}  
function _money($d){
    return number_format($d,2,'.','');
}
function _cool($d){
    return number_format($d,2,'.',' ');
}
function _safer($param,$type,$default=false) {
    $ret=$default; $flag=false;
    if (isset($_REQUEST['filters'])) parse_str($_REQUEST['filters'],$fil);
    if (isset($fil[$param])) { $flag=true; $ret=$fil[$param];}
    if (isset($_REQUEST[$param])) { $flag=true; $ret=$_REQUEST[$param];} 
    if ($flag) {
     
        
        switch ($type) {
            case "str" : $ret=mysql_real_escape_string($ret);
                         break;
            case "qstr": $ret="'".mysql_real_escape_string($ret)."'";
                         break; 
            case "array":               
                         break;
            case "bool": if (($ret=='on') || ($ret=='true') || ($ret=='1')) $ret=1;
                         if (($ret=='off') || ($ret=='false') || ($ret=='0')) $ret=0;  
                         break;                         
            case "int" : $ret=(int) $ret;
                         break;
            case "datetime" : $ret=date('Y-m-d H:i:s',$ret);
                            break;              
        }                                   
    }
    return $ret;
}
function is_direction() {
    if (!isset($_SESSION['user_level'])) return false; 
    $min=min($_SESSION['user_level']);  
    if (($min==1) or ($min==3)) return true;
    return false;
}

function is_superadmin() {
   if (!isset($_SESSION['user_level'])) return false;
   $min=min($_SESSION['user_level']);
   if ($min>1) return false;
   return true;
}

function MK3_Color($i) {
   global $palette;
   $z=$i % 42;
 /*  $b5= $i % 5;
   $Y = (string) md5($i);
   $r4 = dechex(ord($Y[$b5]));             */
   $color=$palette[$z];
 //  $color=substr_replace($color,$r4,$b5,2); 
   return "#".$color;
  
}
function get_username_by_id($id) {
    $ret='';
    $sql="select fname from login_users where user_id=$id";
     $res = mysql_query($sql) or die(mysql_error());
     if  ($row = mysql_fetch_assoc($res)) {
         $ret=$row['fname'];
     }
     return $ret;
}
function get_def_id_cat($level) {
    $ret=false;
    if (!isset($_SESSION['def_id_cat'])) {
   $sql="select id from login_levels where level_level=$level";
   $res = mysql_query($sql) or die(mysql_error());
     if  ($row = mysql_fetch_assoc($res)) {
        $ret=$row['id'];
        $_SESSION['def_id_cat']=$ret;
        }
   } else { $ret=$_SESSION['def_id_cat']; }
   return $ret;
}
function get_option($str) {
   $ret=false;
   $sql="select option_value from options where option_name='$str'";
   $res = mysql_query($sql) or die(mysql_error());
   if  ($row = mysql_fetch_assoc($res)) {
        $ret=$row['option_value'];
        
      }
   return $ret;    
}
function set_option($name, $str) {
   $ret=false;
   $name="'".mysql_real_escape_string($name)."'";
   $sql="insert into options  (option_name,option_value) values  ($name,'$str') ON DUPLICATE KEY UPDATE option_value='$str'";
   //echo $sql;
   $res = mysql_query($sql) or die(mysql_error());
   return true;    
}

function print_status($txt) {
   $ret=_('закрыт'); 
   if ($txt==1) $ret=_('открыт');
   if ($txt==2) $ret=_('предварительный');
   if ($txt==3) $ret=_('административный');
   return $ret;
}

function is_localhost() {
   $ret=false;
   $res=$_SERVER['HTTP_HOST'];
   if ($res=='localhost') $ret=true;
   return $ret;
}
function get_project_name($id) {
    $res='';
    $sql="select name from calendar_project where id=$id";
    $result=mysql_query($sql);
    if($row = mysql_fetch_assoc($result)) { $res=$row['name']; }
    return $res;
}

function do_log($type,$text,$pid=0) {
     if ($pid==0) { $project=''; } else {
         $project=get_project_name($pid);
     } 
     $uid=(int)$_SESSION['user_id'];
     $user=$_SESSION['username'];
     $text=mysql_real_escape_string($text);
     $sql="INSERT into logs (uid,pid,user,project,type,text) values($uid,$pid,'$user','$project','$type','$text')";
     mysql_query($sql);
     
   
}
function query_to_simple_array($sql) {
     $res=false;
     $result=mysql_query($sql);
     while ($row = mysql_fetch_row($result)) {
            $res[]=$row[0];
     }
     return $res;
}
function query_to_array($sql) {
     $res=false;
     $result=mysql_query($sql);
     while ($row = mysql_fetch_assoc($result)) {
            $res[]=$row;
     }
     return $res;
}
function query_to_value($sql) {
     $res=false;
     $result=mysql_query($sql);
     if ($row = mysql_fetch_row($result)) {
            $res=$row[0];
     }
     return $res;
}

function get_constant_by_group($group) {
     $sql="select * from constants where `group`='$group'";
     $res=array();
     $result=mysql_query($sql);
     while ($row = mysql_fetch_assoc($result)) {
            $i=$row['id'];
            $res[$i]=$row;
     }
     return $res;
}
function get_constant_by_ident($name) {
     $sql="select `value` from constants where `ident`='$name'";
     $res=array();
     $result=mysql_query($sql);
     if ($row = mysql_fetch_assoc($result)) {
            //$i=$row['name'];
            $res=$row['value'];
     }
     return $res;
}
function get_constant_by_type($ctype) {
     $sql="select * from constants where `ctype`='$ctype'";
     $res=array();
     $result=mysql_query($sql);
     while ($row = mysql_fetch_assoc($result)) {
            $i=$row['name'];
            $res[$i]=$row;
     }
     return $res;
}
// ФУНКЦИЯ получения констант
// Если в options имеется переменная вида pr_bidget_ID, то константы приводятся к соответствующим значениям из этой переменной 
function get_sections_pr_budget($id) {
      $cf=get_constant_by_group('kf_type1');
      $cn=get_constant_by_type('const_predv');
      $ar=array();
      $ret=get_option('pr_budget_'.$id);  
      if ($ret!==false) { 
          $my_const=json_decode($ret,true);
          foreach ($cf as $k=>$v) {
             if (array_key_exists($k, $my_const)) {
                 $cf[$k]['value']=$my_const[$k];
             }    
          }
          foreach ($cn as $k=>$v) {
                 $id=$v['id'];
             if (array_key_exists($id, $my_const)) {
                 $cn[$k]['value']=$my_const[$id];
             }    
          }
      }
      $ar['cf']=$cf;
      $ar['cn']=$cn;
      return $ar;
}

function Check_Site() {
      $tm=get_option('block_site');
      if ($tm===false) return false;
      $end=strtotime($tm);
      $cr=strtotime("now");
      if ($cr<$end) {
          
          include('block.inc.php');
          die();
         
      }
}
function get_costs_by_level($level_id,$pid) {
    $ret=array();
    $ret= query_to_array("SELECT sum(timestampdiff(MINUTE,ce.start,ce.end)/60) as hr, sum(ce.itog) as itog  from calendar_events as ce where ce.pro_id=$pid and ce.cat_id=$level_id");
   // print_r($ret); die();
    return $ret;
}
function get_sum_payment_to_partners($sid,$pid,$start=false,$end=false) {
  // возвращает платежи, направленные субподрядчикам по проекту с id=pid по виду деятельности с Id=sid 
  // rev.1.1 19-02-2014  необходимо исправить ошибку в отчете по контрактам : берутся данные за весь период , но если есть переменные start и end , то данные должны быть только за этот период
	$ret='0';
  $wh='';
  if (($start) && ($end)) $wh=" and (`date` BETWEEN '$start' and '$end')"; 
	$sql="select sum(`sum`) as sm from contract_payments where dk='k' and sid=$sid and pid=$pid $wh";
  //echo $sql;
	$res = mysql_query($sql) or die(mysql_error());
	if ($row = mysql_fetch_assoc($res)) {
		$ret=$row['sm'];
	}
 // echo $ret;
	return $ret;
}

function get_commission_for_payment($id,$sum,$pid,$sid,$comm){
         $res=array();   
            // вовзвращает размер комиссии для платежа на сумму $sum по проекту $pid и виду субподряжа $sid
         $ret=get_option('pr_budget_'.$pid); 
         if ($ret!==false) { 
          $my_const=json_decode($ret,true);
         } 
         $prev="(select sum(`sum`) from contract_payments where dk='k' and id=$id) as prev";
         if ($comm!==false) $prev="(select sum(`sum`) from contract_payments where dk='k' and (id=$id or comm_papa_id=$id)) as prev"; 
         if ($id==0) $prev='0 as prev';
         $sql="
              select sb.plan,sb.cid,
              (select `name` from constants where id=sb.cid) as cf_name,
              (select sum(`sum`) from contract_payments where dk='k' and sid=sb.sid and pid=sb.pid) as oplata,
              $prev
              from sections_budget as sb
              where sb.pid=$pid and sb.sid=$sid
             ";
         //echo $sql;
         $result=mysql_query($sql) or die('Error!');
         if ($row = mysql_fetch_assoc($result)) {
             $cff=$row['cid']; $cf=1;
             if (isset($my_const[$cff])) { //нашли коээфициент
                      $cf=$my_const[$cff];  
                }
             $commission=$sum*$cf-$sum; 
             if ($comm===false) $commission=0;
             // проверим на превышение запланированного бюджета
             $plan=$row['plan']*$cf;
             $oplata=$row['oplata'];
             $prev=$row['prev'];
             
             $real=round($oplata+$sum+$commission-$prev,2);
             if ($plan<$real) die(_('Ошибка!').' '._('Превышен планируемый бюджет! Платеж не записан! ').'<br>'._cool($plan).'<'._cool($real));
             $res['commission']=$commission;
             $res['cf_name']=$row['cf_name'];
         }
    return $res;
}
function get_last_payment_to_partners($sid,$pid) {
  	$ret='';
    $sql="select date from contract_payments where dk='k' and sid=$sid and pid=$pid order by date DESC LIMIT 0,1";
    //echo $sql;
    $ret=query_to_value($sql);
    return $ret;
}
function get_plan_cf($plan,$cid,$cf) {
    // plan - значение (сумма), cid -номер коэффициента типа kf_type1 , $cf- array  коэффициентов
   // print_r($cf);
    if ($cid==0) { $ret=$plan; // в базе тупо нет по этому контракту предварительных расчетов
    } else {  
    if (isset($cf[$cid]['value']))  {
        // нашли в массиве констант такую константу
           $coef=$cf[$cid]['value'];
           $ret=($plan*$coef);
    }
    }
   
    if ($ret==0)  $ret=plan;
    if ($ret==0) $ret='0';
    
    return $ret;
}
function print_html_page($htm) {
 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Инжиниринговая компания MK3</title>
  </head><body>';
 echo $htm;
 echo '</body></html>'; 
  
    
}
function get_holidays($year) {
    $arr=array(); 
    if ($js=get_option('holidays_'.$year)) {
        $arr=json_decode($js,true);
    }    
    return $arr;
}

function do_get_year_vacations($uid,$year) {
    $ret=0;
    $start=$year.'-01-01 00:00:00';
    $end=$year.'-12-31 23:59:59';
    $sql="select count(id) as cn from calendar_events where user_id=$uid and allDay=1 and pro_id=".MK3_VACATION_PROJECT." and start>='$start' and end<='$end'";
    $result=mysql_query($sql);
    if ($row=mysql_fetch_assoc($result)) {
        $ret=$row['cn'];
    }
    return $ret;
}
function do_get_year_illnesses($uid,$year) {
    $ret=0;
    $start=$year.'-01-01 00:00:00';
    $end=$year.'-12-31 23:59:59';
    $sql="SELECT timestampdiff(MINUTE,ce.start,ce.end)/60 as hr FROM `calendar_events` as ce WHERE ce.pro_id=".MK3_ILLNESS_PROJECT." and ce.user_id=$uid and start>='$start' and end<='$end'";
    $res=mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($res))  {
          $ret=$ret+$row['hr'];
      }
    return $ret;
}
// ФУНКЦИЯ ПОЛУЧЕНИЯ ДАННЫХ О БЮДЖЕТЕ ПО КОНТРАКТУ: планируемые расходы(часы, субподряды, их коэффициенты), фактические затраты (часы, деньги, платежи), проценты выполнения.
function get_contract_budget($id){
    $ret=array(); 
    // получим значения констант Societe, Noir, 30% и т.д. требуемые данные в const[cf]
    $const=get_sections_pr_budget($id);
    // охуеть какой запрос! получаем из базы все данные (теперь осталось узнать планируемую сумму по субподрядам с учетом коэффициентов)
    // для этого plan надо умножить на const[cf][cid] для тех записей у которых Level_id=0, а sid и cid не равны нулю
    $sql="select sb.sid,sb.plan,sb.cid, 
          (select sum(`sum`) from contract_payments where dk='k' and sid=sb.sid and pid=sb.pid) as oplata,
          sb.level_id,cp.plan_time,(cp.plan_time*sb.plan) as plan_money,
          (SELECT sum(timestampdiff(MINUTE,ce.start,ce.end)/60) from calendar_events as ce where ce.pro_id=sb.pid and ce.cat_id=sb.level_id) as real_time,
          (SELECT sum(ce.itog) from calendar_events as ce where ce.pro_id=sb.pid and ce.cat_id=sb.level_id) as real_money,
          sb.percentage
          from sections_budget as sb
          LEFT JOIN calendar_plan as cp on cp.pro_id=sb.pid and cp.cat_id=sb.level_id
          where sb.pid=$id";
    $res=mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($res))  {
           $target='vid'; $idx=$row['level_id']; 
           if (($row['sid']!=0)&&($row['cid']!=0)) {
               $target='sub';
               // это и есть строка субподряда ( у строк с категориями level_id равен level_level из справочника групп)
               $row['plan_money']=$row['plan']*$const['cf'][$row['cid']]['value'];
               $idx=$row['sid'];
           } 
           $ret[$target][$idx]=$row; 
          
           
    }
    return $ret;
    
}
?>