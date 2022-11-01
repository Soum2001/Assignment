// // $("#form").submit(function(e) {

// //     e.preventDefault(); // avoid to execute the actual submit of the form.

// //     var form = $(this);
// //     var data = form.serialize();
// //     $.ajax({
// //         type: "POST",
// //         url: "operation.php",
// //         data: {"data" : data}, // serializes the form's elements.
// //         // success: function(data)
// //         // {
// //         //   alert(data); // show response from the php script.
// //         // }
// //     });
    
// // });
// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#profile_img')
//                 .attr('src', e.target.result);
//             $('#sidebar_img')
//                 .attr('src', e.target.result);
//             $('#img_body')
//                 .attr('src', e.target.result);
//         };
//         reader.readAsDataURL(input.files[0]);
//     } 
    
// }

function add(){
    var form = $('#Form');
    console.log(form);
    var id=$("#user_id").val().trim();
    alert(form);
    if(!id)
    {
        $.ajax({
            url: "insert.php",
            type:'POST', 
            data:form.serialize(),
            success:function(response){
                console.log(response);
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                if(jsonData.success){
                    alert(jsonData.msg);
                }else{
                    alert(jsonData.msg);
                }
            }
        });
    }else{
        $.ajax({
            url: "getuser.php",
            type:'POST', 
            data:form.serialize(),
            success:function(response){
                console.log(response);
                var jsonData = JSON.parse(response);
    
                if(jsonData.success){
                    alert(jsonData.msg);
                }else{
                    alert(jsonData.msg);
                }
            }
        })
    } 
}
// function edit_data(id){
//     alert("edit");
//     var id=id;
//     $.ajax({
//         url: "edit.php",
//         type:'POST', 
//         data:{'id':id}, 
//         success:function(response){
            
//             var jsonData = JSON.parse(response);
//             console.log(jsonData.msg);
//             if(jsonData.success){
//                 var userDetails = jsonData.data;
//                 $("#user_id").val(id);
//                 $("#username").val(userDetails.user_name);
//                 $("#email").val(userDetails.email);
//                 $("#address").val(userDetails.address);
//                 $("#phn_no").val(userDetails.phone_no);
//                 $("#register").html('edit');
//                 $("#exampleModalCenter").modal("show");
//             }else{
//                 alert(jsonData.msg);
//             }
            
//         }
//         });

//  }
function delete_data(id){
    var id=id;
    alert(id);
    if (confirm("Are you sure?")) {
    $.ajax({
        url: "delete.php",
        type:'POST', 
        data:{'id':id}, 
        success:function(response){
            console.log(response);
            var jsonData = JSON.parse(response);

            if(jsonData.success){
                alert(jsonData.msg);
                window.location.reload();
            }else{
                alert(jsonData.msg);
            }
            
        }
        });
    }
    else{
        return false;
    }
}
//view user details in popup
function row_select(id){
    var id=id;
    // alert(id);
    // var element = document.getElementById("row"+id);
    //  element.classList.add("highlight");
    $('#status').val(id);
    $.ajax({
        url: "getuser.php",
        type:'POST', 
        data:{'id':id}, 
        success:function(response){
            //console.log(response)
            var jsonData = JSON.parse(response);
            if(jsonData.success){
  
                var userDetails = jsonData.data;

                console.log(userDetails);
                document.getElementById('name').innerText = userDetails.user_name;
                 document.getElementById('email_id').innerText = userDetails.email;
                 document.getElementById('addres').innerText = userDetails.address;
                 document.getElementById('phn').innerText = userDetails.phone_no;
            //    $("#name").val(userDetails.user_name); 
            //     $("#email_id").val(userDetails.email);
            //    // alert($("#email").val());
            //     $("#addres").val(userDetails.address);
            //     $("#phn").val(userDetails.phone_no);
                $("#register").html('edit');
                $("#details_modal").modal("show");
            }else{
              
            }
            
        }
        });
        
}
function status_active()
{  
    var id = $('#status').val();
    
    $.ajax({
        url: "status_change.php",
        type:'POST', 
        data:{'id':id,'state':1}, 
        success:function(response){
            //console.log(response)
            var jsonData = JSON.parse(response);
            if(jsonData.success){
               
                document.getElementById("active").disabled = true;
                document.getElementById("inactive").disabled = false;
                //document.getElementById("active").disabled.style.background='red';
                $("#exampleModalCenter").modal("hide");
                alert(jsonData.msg);
            }else{
                alert(jsonData.msg);
                $("#exampleModalCenter").modal("hide");
            }
            
        }
        });
}
function status_inactive()
{
    var id = $('#status').val();
    
    console.log(id);
    $.ajax({
        url: "status_change.php",
        type:'POST', 
        data:{'id':id,'state':0}, 
        success:function(response){
            //console.log(response)
            var jsonData = JSON.parse(response);
            if(jsonData.success){
                
                document.getElementById("inactive").disabled = true;
                document.getElementById("active").disabled = false;
                $("#exampleModalCenter").modal("hide");
                alert(jsonData.msg);
            }else{
                alert(jsonData.msg);
                $("#exampleModalCenter").modal("hide");
            }
            
        }
        });

}
//View user details in user page
// function user_details(id){
//     alert(id);
//     var id=id;
//     var element = document.getElementById("row"+id);
//     element.classList.add("highlight");
//     $.ajax({
//         url: "edit.php",
//         type:'POST', 
//         data:{'id':id}, 
//         success:function(response){
//             var jsonData = JSON.parse(response);

//             if(jsonData.success){
//                 var userDetails = jsonData.data;
//                 document.getElementById('username').innerText = userDetails.user_name;
//                 document.getElementById('email').innerText = userDetails.email;
//                 document.getElementById('address').innerText = userDetails.address;
//                 document.getElementById('phn_no').innerText = userDetails.phone_no;
//                 $("#register").html('edit');
//                 $("#details_modal .modal-title").html('Details');
//                 $("#details_modal").modal("show");
//             }else{
//                // alert(jsonData.msg);
//             }
            
//         }
//         });
        
// }

$(document).ready(function(){
    $("select.select_user").change (function () {   
        var select_user = $(this).children("option:selected").val();  
        alert(select_user);
        console.log(select_user);
        window.location.href='user_profile.php?select_user='+select_user;
        // $.ajax({
        //     url:"user_profile.php",
        //     type:"POST",
        //     data:{'select_user':select_user}
        // })
     });
    var user_id=$("#user_id").val();
    $.ajax({
        url: "getuser.php",
        type:'POST', 
        data:{'id':user_id}, 
        success:function(response){
            var jsonData = JSON.parse(response);

            if(jsonData.success){
                var userDetails = jsonData.data;
                console.log(userDetails.user_name);
                document.getElementById('username1').innerHTML = userDetails.user_name;
                console.log(document.getElementById('username'));
                document.getElementById('email1').innerHTML = userDetails.email;
                document.getElementById('address1').innerHTML = userDetails.address;
                document.getElementById('phn_no1').innerHTML = userDetails.phone_no;
            }else{
               // alert(jsonData.msg);
            }
            
        }
        });
        $('#userdtable').dataTable();

   
   


});


 