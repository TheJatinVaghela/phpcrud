<h1>HOME</h1>
<nav class="navbar navbar-light bg-light">
    <a href="create" class="btn btn-outline-success me-2" type="button">create</a>
    <a href="update" class="btn btn-outline-warning me-2" type="button">update</a>
    <a id="truncate" class="btn btn-outline-danger end" type="button">Truncate</a>
</nav>
<br>
<hr>
<div class="container">
    <h1 class="d-flex justify-content-between">USER TABLE </h1>
    <br>
    <hr>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">IMG</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
        <tbody>
            <?php if($this->userData != null){?>
                <?php foreach ($this->userData as $key => $value) { ?>
                    <tr>
                    <th scope="row"><?php echo $value["id"] ?></th>
                    <td><?php echo $value["userName"] ?></td>
                    <td><img src="<?php echo $this->assets."/img/".$value["img"]; ?>" alt="⭐" width="30px" height="30px"/></td>
                    <th scope="col"><a class="btn btn-outline-danger delete_J" name="<?php echo $value["id"]?>" type="button">delete</a></th>
                    </tr>
                <?php }?>
            <?php }?>
        </tbody>
    </table>
    <hr>
    <!-- <?php print_r($this->userData)?> -->
</div>

<script>
    $(document).ready(function() {
        $('#truncate').click(function(){
            let answer = truncate('http://localhost/clones/phpcrud/truncate',JSON.stringify({"id":null}),true);
            answer.then(result=>{
                console.log(result);
                if(result == true){
                    window.location.replace("http://localhost/clones/phpcrud/home");
                };
            })
        });
        
        $('.delete_J').click(function(){
            // console.log($(this).attr('name'));
             let answer = truncate('http://localhost/clones/phpcrud/truncate',JSON.stringify({"id":$(this).attr('name')}),true);
             answer.then(result=>{
                 console.log(result);
                if(result == true){
                    window.location.replace("http://localhost/clones/phpcrud/home");
                };
             });
        });

    });

    async function truncate(url,body,re) {
        let data = await fetch(url,{
            method:"DELETE",
            body:body
        });
        let responce = (re === true)? await data.json() : data;
        return responce;
    }
</script>