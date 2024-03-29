<?php 
 require_once('./Helper.php/ToWebp.php');
require_once("./model/model.php");
class controller extends model 
{   
    protected $update_img = NULL;
    protected $update_user_call;
    protected $update_user;

    public function __construct(){
         parent::__cuntruct();
        
        $path = (isset($_SERVER["PATH_INFO"]))? $_SERVER["PATH_INFO"] : "/home";
        switch ($path) {
            case '/home':
                $this->public_view("./view/home.php");
                break;
            case '/create':{
                $this->public_view("./view/create_form.php");
                break;
            }
            case '/update':{

                $this->public_view("./view/update_form.php");
                break;
            }
            case '/update_id':{
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $data = json_decode(file_get_contents("php://input"), true);
                    $answer = $this->getUserdata('*',$data['id']);
                    echo json_encode($answer);
                };
                break;
            }
            case '/create_user':{
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                   
                    $this->p(["REQ"=>$_REQUEST,"File"=>$_FILES]);
                   
                    $imgName = $this->upload_files($_FILES);
                    $fullPath = "$this->to";

                    $data = ["userName"=>$_REQUEST["userName"],
                            "userEmail"=>$_REQUEST["userEmail"],
                            "userPassword"=>$_REQUEST["userPassword"],
                            "userGender"=>$_REQUEST["userGender"],
                            "userHobby"=>$_REQUEST["userHobby"],
                            "userImage"=>$imgName];
                    $answer = $this->upload_user($data);
                    if(isset($answer)){
                        header("Location: http://localhost/clones/phpcrud/home");
                    }
                };
                break;
            }
            case '/update_user':{
                if($_SERVER["REQUEST_METHOD"]== "POST"){
             
                    $data = json_decode(file_get_contents("php://input"),true);
                    if(isset($data["userImage"])){
                        $this->update_user_call = array();
                        foreach ($data as $key => $value) {
                            if($key == 'userImage'){
                                continue;
                            }else{
                                $this->update_user_call[$key]=$value;
                            };
                        };
                        $this->update_user_call['userImage']=$data["userImage"];
                    }else{

                        $this->update_user_call = array();
                        foreach ($data as $key => $value) {
                            if($key == 'userImage'){
                                
                            }else{
                                $this->update_user_call[$key]=$value;
                            };
                        };
                    };
                    $answer = $this->update_user($this->update_user_call,$data["id"]);

                    echo json_encode(["data"=>$answer]);
                
                };
                break;
            }
            case '/imgupload':{
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                    if(isset($_FILES["userImage"])){
                        //  $this->update_img = ["file"=>'999999.webp'];
	                    //   echo json_encode($this->update_img);
                        //  $this->p($_FILES);
                        $imgName = $this->upload_files($_FILES);
                        $this->update_img = ["file"=>$imgName];
	                    echo json_encode($this->update_img);
                    };
                };
                break;
            }
            case '/truncate':{
                if($_SERVER["REQUEST_METHOD"]=="DELETE"){
                    $data = json_decode(file_get_contents("php://input"),true);
                    if($data["id"] == null){
                        $answer = $this->truncate();
                    }else if($data["id"] != null){
                        $answer = $this->truncate(false,$data["id"]);
                    };
                    echo json_encode($answer);
                };
                break; 
            }
            default:
                $this->public_view("./view/home.php");
                break;
        }
    }

    protected function public_view($url){
        require_once("./view/header.php");
        require_once($url);
        require_once("./view/footer.php");
    }

    protected function upload_files($imgdata){
         
        $time = time();
        $uniq_id = uniqid();

        $combined_id = $time.$uniq_id;

        $imgName = $combined_id.$imgdata["userImage"]["name"];  
        $this->to .= $imgName;
        
       //  $this->p($imgdata["userImage"]["tmp_name"]);
       //  $this->p($to);
        try {
            move_uploaded_file($imgdata["userImage"]["tmp_name"],$this->to );
            return $imgName;
        } catch (\Throwable $th) {
            $this->p("somthing went wrong while uploading product Images");
            exit();
         }
   }


}