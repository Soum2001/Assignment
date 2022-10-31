function profile_page(id){
   
    $.ajax({
        url: "view_profile.php",
        type:'POST', 
        data:{'gallery_type':1,'id':id},
        success:function(response){
            jQuery('#image_body').html(response);  
        }
    });
}
function banner_page(id){
   
    $.ajax({
        url: "view_banner.php",
        type:'POST', 
        data:{'gallery_type':2,'id':id},
        success:function(response){
            jQuery('#image_body').html(response);  
        }
    });
}
function select_profile_page(select_user)
{
    alert(select_user);
}
function  popup_pic(id)
{
  
    var div = document.getElementById("image");
    div.innerHTML = "";
    var imagem=document.createElement("img");
    imagem.style.width = '450px';
    imagem.style.height = '410px';
    imagem.src=document.getElementById(id).getAttribute("src");
    div.appendChild(imagem);
    document.getElementById("set_profilepic").setAttribute('value',id);

    $("#image_modal").modal("show");

}
function setprofilepic()
{
    var profile_pic_id=$("#set_profilepic").val();
  
    $.ajax({
        url: "setprofile_pic.php",
        type:'POST', 
        data:{'set_profilepic_id':profile_pic_id},
        success:function(response){
            console.log(response);
            var jsonData=JSON.parse(response);
            console.log(jsonData.success);
            if(jsonData.success){
                $("#image_modal").modal("hide");
                window.location.reload();
                alert(jsonData.msg);
            }else{
                alert(jsonData.msg);
            }

        }
    });

}
function delete_image()
{
    var pic_id=$("#set_profilepic").val();

    $.ajax({
        url: "removepic.php",
        type:'POST', 
        data:{'pic_id':pic_id},
        success:function(response){
            console.log(response);
            var jsonData=JSON.parse(response);
            console.log(jsonData.success);
            if(jsonData.success){
                $("#image_modal").modal("hide");
                window.location.reload();
                alert(jsonData.msg);
            }else{
                alert(jsonData.msg);
            }

        }
    });

}
function paginate_pic(page){
    $.ajax({
        url: "view_profile.php",
        type:'POST', 
        data:{'page':page,'gallery_type':1},
        success:function(response){
            //console.log(response);
            jQuery('#image_body').html(response); 

        }
    });
}

function add_gallery(id){
    document.getElementById("new_galley_id").setAttribute('value',id);
   
    $("#add_gallery").modal("show");
}
function new_gallery()
{
    
    var new_gallery_id=$("#new_galley_id").val();
    var gallery_name=$("#gallery_name").val();

    $.ajax({
        url: "add_new_gallery.php",
        type:'POST', 
        data:{'new_gallery_id':new_gallery_id,'gallery_name':gallery_name},
        success:function(response){
            var jsonData=JSON.parse(response);
            console.log(jsonData.success);
            if(jsonData.success){
                $("#add_gallery").modal("hide");
                window.location.reload();
                alert(jsonData.msg);
            }else{
                alert(jsonData.msg);
                // var ul = document.getElementById("navbar");
                // var li = document.createElement("li");
                // li.classList.add("nav-item");
                // var a=document.createElement("a"); 
                // a.setAttribute('id',new_gallery_id);
                // a.classList.add("nav-link");
                // a.innerHTML=gallery_name;
                // li.appendChild(a);
                // ul.appendChild(li);
                // console.log(ul);
                // // window.location.reload();
                $("#add_gallery").modal("hide");
                window.location.reload();

            }

        }
    });

}
function load_gallery(id){
    alert(id);
    $.ajax({
        url: "view_profile.php",
        type:'POST', 
        data:{'gallery_id':id},
        success:function(response){
            jQuery('#image_body').html(response);  
        }
    });

}
    
    // if (!id)
    // {
    //     var div = document.getElementById("image");
    //     div.innerHTML = "";
    //     var imagem=document.createElement("img");
    //     imagem.style.width = '250px';
    //     imagem.style.height = '250px';
    //     imagem.src="./assest/image/default-avatar.png";
    //     div.appendChild(imagem);
    //     $("#image_modal").modal("show");
    // }

   


// function delete_image(img_id)
// {
   
//     if (confirm("Are you sure?")) {
//         $.ajax({
//             url: "delete_image.php",
//             type:'POST', 
//             data:{'img_id':img_id},
//             success:function(response){
//                 console.log(response);
//                 var jsonData = JSON.parse(response);
//                 console.log(jsonData);
//                 if(jsonData.success)
//                 {
//                     alert(jsonData.msg);
//                     $(this).remove(); 
//                 }else{
//                     alert(jsonData.msg);
//                 }
//             }
//         });
//     }
//     else{
//         return false;
//     }
    
// }
// function set_profile_img(img_id)
// {
//     alert(img_id);
//     $.ajax({
//         url: "profile.php",
//         type:'POST', 
//         data:{'img_id':img_id},
//         dataType:"json",
//         success:function(response){
           
//             var jsonData = JSON.parse(JSON.stringify(response));
//             console.log(jsonData);
//             if(jsonData.success){
//                 $("#image_modal").modal("hide");
//                 alert(jsonData.msg);
//                 window.location.reload();
//             }else{
//                 alert(jsonData.msg);
//             }
//         }
//     });
// }