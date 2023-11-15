<?php
class database {

    public $servername="localhost";
	public $username="shamalchaya_admin";
	public $pass="Bangla%desh&20233";
	public $db_name="shamalchaya_database";
// 	public $username="root";
// 	public $pass="";
// 	public $db_name="microcredit";
	public $link;
	public $eror;

	public function __construct()
	{
		$this->db_connect();
	}

	private function db_connect()
	{
		$this->link= new mysqli($this->servername,$this->username,$this->pass,$this->db_name) or die ("database connect failed".$this->link->error."(".$this->link->errno.")");
			mysqli_query($this->link,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

		if(!$this->link)
		{
			echo $this->eror="connection failed";
		}
	}

	public function my_money_format($num){
    $money=explode('.',$num);
    if(strlen($money[1])==0)
        $money[1]='00';
    if(strlen($money[0])==0)
        $money[0]='0';
    if(strlen($money[0])>2){
        $taka=$money[0];
        $thousand=substr($taka, -3);
        $taka=substr($taka,0,strlen($taka)-3);
        $i=0;
        while(strlen($taka)>0){
            if(strlen($taka)>1){
                $pp[$i]=substr($taka, -2);
                $taka=substr($taka,0,strlen($taka)-2);
            }else{
                $pp[$i]=substr($taka, -1);
                $taka=substr($taka,0,strlen($taka)-1);
            }
            $i++;
        }
        for($j=sizeof($pp)-1;$j>=0;$j--)
            $taka_add .=$pp[$j].',';
        return $taka_add.$thousand;
    }else
        return $money[0].".".$money[1];
}

public function month_name($month)
{

	if($month==1)
	return 'জানুয়ারি';
	else if($month==2)
	return 'ফেব্রুয়ারি';
	else if($month==3)
	return 'মার্চ';

	else if($month==4)
	return 'এপ্রিল';

	else if($month==5)
	return 'মে';

	else if($month==6)
	return 'জুন';

	else if($month==7)
	return 'জুলাই';

	else if($month==8)
	return 'আগস্ট';

	else if($month==9)
	return 'সেপ্টেম্বর';

	else if($month==10)
	return 'অক্টোবর';


	else if($month==11)
	return 'নভেম্বর';


	else if($month==12)
	return 'ডিসেম্বর';

}

public function custome_date($d)
{
	$date=explode('-',$d);
	$newDate=$date[2].'-'.$date[1].'-'.$date[0];
	return($newDate);

}


	public function _destruct()
	{
		$this->link->close();
	}

}

?>



