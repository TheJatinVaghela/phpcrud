<?php if(!isset($this->userData)){
 echo "<h1>NO USERS CREATE USER <a href='http://localhost/clones/phpcrud/create' > CLICK ME </a> </h1>"   ;
}else { ?>

<h1>UPDATE FORM</h1>

<div class="container">
    <select class="custom-select" id="selc-J">
        <?php 
        foreach($this->userData as $key => $value){
         ?>   
            <option value="<?php echo $value['id']?>" selected><?php echo $value['id']?></option>
        <?php }
        ?>
    </select>
    <button type="" id="btn-J">
            SELECT
    </button>
</div>

<div class="container form-J">
    <form action="" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">Name</label>
                <input id="userName" type="text" class="form-control" name="userName" id="validationCustom01" placeholder="Name" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">IMG</label>
                <img id="img" src="" alt="" width="50px" height="50px"/>
                <button type="button" id="removeIMG" class="btn btn-outline-danger">❌</button>
                
                <input id="imgInput" type="file" accept="img/*" name="userImage" class="form-control" id="validationCustom02" placeholder="Img" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
        </div>

        <button class="btn btn-primary" id="updateUser" type="submit">Update user</button>
    </form>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


</div>

<script>
    $(".form-J").hide();
    $('#imgInput').hide();
    let btn_j =  document.getElementById('btn-J');
    let selectvalue ;
    $('#btn-J').click(function (){
        selectvalue = $("#selc-J").val();
    });
    let userData;
    let old_userData;
    let did_img_upleaded;
    btn_j.onclick = function () {
        
        userData = getuserdata('http://localhost/clones/phpcrud/update_id',JSON.stringify({'id':selectvalue}));
        $(".form-J").fadeIn(500);
        userData.then(result=>{
            userData = result[0];
            console.log(userData);
            $('#userName').val(userData.userName);
            $('#img').attr('src','/clones/phpcrud/assets/img/'+userData.img);
            $('#removeIMG').click(function(){
                $('#img').remove();
                $('#imgInput').fadeIn(500);
                $('#removeIMG').remove();
            });
        });
        
    }
    let newIMG = document.getElementById('imgInput').files[0];
    const form_data = new FormData();
    let updateUser = document.getElementById('updateUser');
    let updateAnswer ;
    updateUser.onclick = function () {
        event.preventDefault();
        
        // newIMG = Object.keys(newIMG).map((key) => [key, newIMG[key]]);
        newIMG = document.getElementById('imgInput').files[0];
        console.log(newIMG);
        console.log($('#img').attr('src'));
        if(newIMG != null || newIMG != undefined){
            form_data.append('userImage', newIMG);
            old_userData =userData;
            userData = imgUpload('http://localhost/clones/phpcrud/imgupload',form_data)
            .then(result=>{
                console.log(result.file);
                did_img_upleaded = getuserdata('http://localhost/clones/phpcrud/update_user',
                JSON.stringify({
                    "id" : old_userData["id"],
                    "userName":$('#userName').val(),
                    "img":result.file
                }));
                return did_img_upleaded;
            })
            .then(result=>{
                console.log('did_img_upleaded');
                console.log(result);
                if(result.data == true){
                    window.location.replace("http://localhost/clones/phpcrud/home");
                }
                // console.log(result);
            })
        }else{
            old_userData =userData;
            userData = getuserdata('http://localhost/clones/phpcrud/update_user',
            JSON.stringify({
                "id" : old_userData["id"],
                "userName":$('#userName').val()
            })).then(result=>{
                console.log('did_img_upleaded');
                if(result.data){
                    window.location.replace("http://localhost/clones/phpcrud/home");
                }
                // console.log(result);
            });
        };
        
        
    }
    async function getuserdata(url,body){
        
        let data = await fetch(url,{
            method:"POST",
            headers:{
                'Content-Type':'application/json'
            },
            body:body
        });
        let responce = await data.json();
        return responce;
    }   
    async function imgUpload(url,file){
        
        let data = await fetch(url,{
            method:"POST",
            body:file
        });
        let responce = await data.json();
        return responce;
    }   

</script>

<?php }?>