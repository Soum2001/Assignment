

<!-- Modal -->
<!-- <div class="modal fade" id="details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="status" value="">
                <div class="register-box">
                    <div class="register-logo">
                        <b>Details</b>
                    </div>
            
                    <form action="" method="POST" id="form" >
                        <div class="input-group mb-3">
                            <label>Name:</label>
                            <span id="name" name="name">user</span> 
                        </div>
                        <div class="input-group mb-3">
                            <label>Email:</label>
                            <span id="email_id" name="email_id">email</span>  
                        </div>
                        <div class="input-group mb-3">
                        <label>address:</label>
                            <span id="addres" name="addres">address</span> 
                        </div>
                        <div class="input-group mb-3">
                            <label>Phone No:</label>
                                <span id="phn" name="phn">Phone No</span>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="inactive" onclick="status_inactive()">Inactive</button>
                <button type="button" class="btn btn-primary" id="active" onclick="status_active()">Active</button>
            </div>
        </div>
    </div>
</div> -->
        <div class="modal fade" id="add_gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <input type="hidden" id="new_galley_id">
                    <div class="modal-body">
                        <label>gallery name</label>
                        <input type="text" id="gallery_name" name="gallery_name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="new_gallery" onclick="new_gallery()" >Add Gallery</button>
                    </div>
                    
                </div>
            </div>
        </div> 
        
    <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
                    <div class="container">
                            
                        <div id="image">
                            
                        </div>
                        
                    </div>
                    
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="delete_profilepic" onclick="delete_image()">Delete</button>
            <button type="button" class="btn btn-primary" id="set_profilepic" onclick="setprofilepic()">Set as profile</button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="crop_image" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                            <div class="row">
                            
                                <div class="col-md-8">
                                    <img src="" id="crop_img" name="crop_img">
                                </div>
                           
                            <div class="col-md-4">
                                <div class="preview" id="preview" style="width:250px;height:250px;overflow:hidden" ></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" id="user_details"> 
            <input type="hidden" id="status" value="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" id="user_name" name="user_name" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" id="mail_id" name="mail_id">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control" placeholder="address" id="addres" name="addres" ></textarea>
                </div>
                <div class="input-group mb-3">
                    <input type="tel" class="form-control" placeholder="Mobile no" id="mob" name="mob" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
        </div> 
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="inactive" onclick="status_inactive()">Inactive</button>
            <button type="button" class="btn btn-primary" id="active" onclick="status_active()">Active</button>
        </div>
    </div>
    </div>
</div>

