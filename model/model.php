<?php 
class model
{   
    public $to = "./assets/img/";
    public $assets = "/clones/phpcrud/assets";
    protected $db ;
    protected $dbhost = "localhost";
    protected $dbname = "root";
    protected $dbpassword="";
    protected $dbdatabase ="phpNcrud";
    public $userData = array(); 
    public function __cuntruct(){
        $this->connect_db();
    }
    protected function connect_db(){
        $this->db = new mysqli($this->dbhost,$this->dbname,$this->dbpassword,$this->dbdatabase);
        $this->createTB();
        $this->userData = $this->getUserdata('*');
    }

    private function createTB(){
        $sql = 'CREATE TABLE IF NOT EXISTS `user`
        (   
            `id` Bigint(11) unsigned NOT NULL auto_increment primary key,
            `userName` varchar(255) NOT NULL,
            `img` varchar(255) NOT NULL
        )';
        $this->sqli_($sql);
    }

    protected function getUserdata($need , $id=NULL){
       
        $sql = (isset($id) && $id != NULL)?"SELECT ".$need." FROM `user` WHERE `id` = $id": "SELECT ".$need." FROM `user`";
        $data = $this->sqli_($sql,true);

        $array=array();
        $dumy ="";
        if($data->num_rows > 0){
            
            while ($Ndata = $data->fetch_object()) {
                
                $dumy .= json_encode($Ndata);
                array_push($array,json_decode($dumy,true));   
                $dumy = "";  
                
            }   
            
            return $array;
        }else{
            return NULL;
        }
    } 

    protected function upload_user($data){
        $sql= 'INSERT INTO `user`(`userName`,`img`) VALUE('.'"'.$data['userName'].'"'.','.'"'.$data['userImage'].'"'.')' ;
        $answer = $this->sqli_($sql,true);
        return $answer;

    }
    protected function update_user($data,$id){
        if(isset($data["img"])){
            $arr = $this->getUserdata('*',$id);
            if($arr != NULL){
                if(is_file("./assets/img/".$arr[0]['img'])){
                    unlink("./assets/img/".$arr[0]['img']); //delete file
                };
            };
        };
        $sql = 'UPDATE `user` SET';
        foreach ($data as $key => $value) {
            $sql .=' `'.$key.'` = '; 
            $sql .= "'".$value."' ,";
        }
        $sql = substr($sql,0,-1);
        $sql .= ' WHERE `id` = '.$id;
        $answer = $this->sqli_($sql,true);
        // echo $answer;
        return $answer;
    }
    protected function truncate($trunc=true,$id=NULL){
        if($trunc == true){
            $sql = 'truncate user';
            $answer = $this->sqli_($sql,true);
        };
        if($id != NULL){
            $userdata = $this->getUserdata('*',$id);
            unlink("./assets/img/".$userdata[0]["img"]);
            $sql = 'DELETE FROM `user` WHERE `id` = '."'".$id."'";
            $answer = $this->sqli_($sql,true);
        };
        $arr = $this->getUserdata('*');
        if($arr == NULL){
            $files = glob('./assets/img/*'); //get all file names
            foreach($files as $file){
                if(is_file($file))
                unlink($file); //delete file
            };
            return $answer; 
        }else{
            $path = './assets/img';
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $key => $value) {
                foreach ($arr as $key => $value) {
                   if($value != $value['img']){
                        if(is_file($path.$value['img'])){
                            unlink($path.$value['img']);
                        };
                   };
                };
            };
            // header('Location:http://localhost/clones/phpcrud/home');
             return $answer;
        };
        
    }
    private function sqli_($sql , $re=NULL){

        $sqli = $this->db->query($sql);
        if(isset($sqli) || $sqli == 1){
            if($re == true){
                return $sqli;
            }else{
                 //NICE
            }
        }else{  
            //BAD
        }
    }
    public function p($stuf){
        echo"<pre>";
        print_r($stuf);
        echo"</pre>";
    }
}