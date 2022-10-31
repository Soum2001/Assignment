function loadbanner_img(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#crop__banner')
                .attr('src', e.target.result);
            $('#img_body')
                .attr('src', e.target.result);
        };
        
        $("#crop_banner_image").modal("show");
            // TODO(DN): This is not a solution, will look for better approach
            setTimeout(function(){
            var image=$("#crop__banner");
            var cropper = image.cropper({
                aspectRatio: 1,
                viewMode:3,
                preview:'.preview_banner',
                crop: function(e) {
                  console.log(e.x);
                  console.log(e.y);
                  console.log(e.width);
                  console.log(e.height);
                  console.log(e.rotate);
                  console.log(e.scaleX);
                  console.log(e.scaleY);
                }
                });
                console.log(cropper);
                var cropper = image.data('cropper');
                console.log('abcdd');
        },500);
        reader.readAsDataURL(input.files[0]);
        $(".card-body").css("background-image", "url(" + $("#preview_banner").attr("src")+ ")");
        $('#crop_banner_image').on('hidden.bs.modal', function () {
            location.reload();
           })
    } 
}

function loadprofile_img(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#crop_img')
                .attr('src', e.target.result);
            $('#img_body')
                .attr('src', e.target.result);
        };
     
        $("#crop_image").modal("show");
            setTimeout(function(){
            var image=$("#crop_img");
            var cropper = image.cropper({
                aspectRatio: 1,
                viewMode:3,
                preview:'.preview',
                crop: function(e) {
                  console.log(e.x);
                  console.log(e.y);
                  console.log(e.width);
                  console.log(e.height);
                  console.log(e.rotate);
                  console.log(e.scaleX);
                  console.log(e.scaleY);
                  
                }
                });
            
                console.log(cropper);
                var cropper = image.data('cropper');
                console.log('abcdd');
        },500);
        reader.readAsDataURL(input.files[0]);
        $("#profile_image").attr("src", $("#preview").attr("src"));
        $('#crop_image').on('hidden.bs.modal', function () {
            location.reload();
           })
    }  
    
}

$(document).ready(function(){
    $('#crop').click(function () {
    //$("#profile_image").attr("src", $("#preview").attr("src"));
        var property=$('#profile_imgupload').prop('files')[0];
        var form_data=new FormData();
        form_data.append('profile_imgupload',property);
        $.ajax({
            url:'user_profile_upload.php',
            type:'POST',
            enctype: 'multipart/form-data',
            data:form_data,
            processData: false,
            contentType: false
        });
      $("#crop_image").modal("hide");
      window.location.reload();
    });
    $('#crop_banner_btn').click(function () {
        // cavas=copper.getCropperCanvas({
        //     width:300,
        //     height:300
        // })
    
        //$("#profile_image").attr("src", $("#preview").attr("src"));
            var property=$('#bannerimgupload').prop('files')[0];
            console.log('property'+property.name);
            var form_data=new FormData();
            form_data.append('bannerimgupload',property);
            $.ajax({
                url:'banner_upload.php',
                type:'POST',
                enctype: 'multipart/form-data',
                data:form_data,
                processData: false,
                contentType: false
            });
          $("#crop__banner_img").modal("hide");
          //$("#crop__banner_img").removeData("bs.modal");
          window.location.reload();
        });
    
    
})
function load_custom(input,id)
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {

        };
        reader.readAsDataURL(input.files[0]);
        var property=$('#custom_img').prop('files')[0];
        var form_data=new FormData();
        form_data.append('custom_img',property);
        form_data.append('custom_img',id);

        console.log(form_data);
       
        $.ajax({
            url:'custom_upload.php',
            type:'POST',
            enctype: 'multipart/form-data',
            data:form_data,
            processData: false,
            contentType: false,
            success:function(response){
                console.log(response);
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                if(jsonData.success){
                    alert(jsonData.msg);
                    window.location.reload();
                }else{
                    alert(jsonData.msg);
                }
                
            }
        });

    }
}

