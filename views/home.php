<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>
                <h4>cookie : &nbsp;</h4>
                <?PHP  if(array_key_exists('id',$_COOKIE))
                    print_r($_COOKIE['id']);
                ?>
                <h4>session : &nbsp;</h4>
                <?PHP if(array_key_exists('id',$_SESSION))
                    print_r($_SESSION['id']);
                ?>
            </h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rerum, officiis. Id architecto ducimus illum, beatae illo enim, repellat quo delectus optio soluta dolorem possimus nostrum aperiam quisquam quam nisi dolorum. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint odit vero ratione porro dolorum debitis commodi eum maxime explicabo, corporis nihil neque doloribus modi fugiat velit error expedita quis blanditiis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe corrupti odit voluptas tenetur obcaecati velit soluta delectus fugit quis laborum nostrum voluptates nobis a optio quidem iusto, itaque quibusdam quae! Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt aperiam, quisquam earum harum quidem maxime odit minus inventore aliquam alias voluptates a excepturi autem quis eius reprehenderit, eveniet quaerat repellendus? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit perspiciatis esse vel sed quidem quisquam vero, voluptates exercitationem corrupti sint recusandae, eos, explicabo optio magnam molestias quasi. Error, suscipit nulla.</p>
        </div>
        <div class="col-4"> 
        
        </div>
    </div>
</div>