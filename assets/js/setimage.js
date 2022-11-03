// function loadbanner_img(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#crop__banner')
//                 .attr('src', e.target.result);
//             $('#img_body')
//                 .attr('src', e.target.result);
//         };
        
//         $("#crop_banner_image").modal("show");
//             // TODO(DN): This is not a solution, will look for better approach
//             setTimeout(function(){
//             var image=$("#crop__banner");
//             var cropper = image.cropper({
//                 aspectRatio: 1,
//                 viewMode:3,
//                 preview:'.preview_banner',
//                 crop: function(e) {
//                   console.log(e.detail.x);
//                   console.log(e.detail.y);
//                   console.log(e.detail.width);
//                   console.log(e.detail.height);
//                   console.log(e.detail.rotate);
//                   console.log(e.detail.scaleX);
//                   console.log(e.detail.scaleY);
//                 }
//                 });
//                 console.log(cropper);
//                 var cropper = image.data('cropper');
//                 console.log('abcdd');
//         },500);
//         reader.readAsDataURL(input.files[0]);
//         $(".card-body").css("background-image", "url(" + $("#preview_banner").attr("src")+ ")");
//         $('#crop_banner_image').on('hidden.bs.modal', function () {
//             location.reload();
//            })
//     } 
// }

var crop_class = {
    cropper : {},
    loadprofile_img:function(input,type){
        crop_class.init(type);
       // alert(type);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#crop_img').attr('src', e.target.result);
                //$('#img_body').attr('src', e.target.result);
            };
            

            /*
            
            */
            

            //var cropper = image.data('cropper');
            console.log('abcdd');
            
            reader.readAsDataURL(input.files[0]);
            $("#profile_image").attr("src", $("#preview").attr("src"));
            $('#crop_image').on('hidden.bs.modal', function () {
                location.reload();
            })
        }  
        var $modal = $('#crop_image');
        $modal.modal("show");

    },
    loadbanner_img:function(input,type){
        crop_class.init(type);
       // alert(type);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#crop_img').attr('src', e.target.result);
                //$('#img_body').attr('src', e.target.result);
            };
            

            /*
            
            */
            
            //var cropper = image.data('cropper');
            console.log('abcdd');
            
            reader.readAsDataURL(input.files[0]);
            
            $('#crop_image').on('hidden.bs.modal', function () {
                location.reload();
            })
        }  
        var $modal = $('#crop_image');
        $modal.modal("show");

    },
   
    init:function(type){

        var $modal = $('#crop_image');
        
        var image=$("#crop_img");
        $modal.on('shown.bs.modal', function() {

            /*
            crop_class.cropper = image.cropper({
                aspectRatio: 1,
                viewMode: 3,
                preview:'.preview'
            });
            */

            image.cropper({
                aspectRatio: 16 / 9,
                crop: function(event) {
                  console.log(event.detail.x);
                }
              });

              crop_class.cropper = image.data('cropper');

        }).on('hidden.bs.modal', function(){
            crop_class.cropper.destroy();
               cropper = null;
        });

        $('#crop').click(function () {
            crop_class.crop(type);
        });
        
        
    },
    crop:function(type){

        crop_class.cropper.crop();

        crop_class.cropper.getCroppedCanvas().toBlob((blob) => {
            const form_data = new FormData();
            form_data.append('profile_imgupload', blob);
            form_data.append('profile_imgupload', type);
            console.log(blob);
            $.ajax({
                url:'user_profile_upload.php',
                type:'POST',
                enctype: 'multipart/form-data',
                data:form_data,
                processData: false,
                contentType: false,
                success:function(response){
                    console.log(response);
                    var jsonData=JSON.parse(response);

                    console.log(jsonData);
                    if(jsonData.success)
                    {
                        $("#crop_image").modal("hide");
                        alert(jsonData.msg);
                    } 
                  
                }
            });
            
        });



        /*

            crop_class.cropper.getCroppedCanvas({
                width:400 ,
                height:400,
                minWidth: 256,
                minHeight: 256,
                maxWidth: 4096,
                maxHeight: 4096,
                fillColor: '#fff',
                imageSmoothingEnabled: false,
                imageSmoothingQuality: 'high',
            })
            crop_class.cropper.getCroppedCanvas().toBlob((blob) => {
                const form_data = new FormData();
                form_data.append('profile_imgupload', blob);
                console.log(bolb);
                $.ajax({
                    url:'user_profile_upload.php',
                    type:'POST',
                    enctype: 'multipart/form-data',
                    data:form_data,
                    processData: false,
                    contentType: false,
                    success:function(){
                        $("#crop_image").modal("hide");
                        window.location.reload();
                    }
                });
                
            });

            */

        }
    }






// $(document).ready(function(){
      
//     $('#crop_banner_btn').click(function () {
//         // cavas=copper.getCropperCanvas({
//         //     width:300,
//         //     height:300
//         // })
    
//         //$("#profile_image").attr("src", $("#preview").attr("src"));
//             var property=$('#bannerimgupload').prop('files')[0];
//             console.log('property'+property.name);
//             var form_data=new FormData();
//             form_data.append('bannerimgupload',property);
//             $.ajax({
//                 url:'banner_upload.php',
//                 type:'POST',
//                 enctype: 'multipart/form-data',
//                 data:form_data,
//                 processData: false,
//                 contentType: false
//             });
//           $("#crop__banner_img").modal("hide");
//           //$("#crop__banner_img").removeData("bs.modal");
//           window.location.reload();
//         });
    
    
// })
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

