$(document).ready(function () {
    var url = $('.site_url').val();


    newMessages = () =>{
        $.ajax({
            url: url+'/message/load-new-message',
            type:'GET',
            async:false,
            success: function(response){
                response = JSON.parse(response)
                html = '';
                $.each(response, function (key, value) {
                    if(value.group_name && value.category_name){
                        user = value.group_name+'('+value.category_name+')'
                    }
                    else {
                        user = value.app_user_name
                    }
                    html +='<li> ' +
                        '       <a href="#" onclick="viewMessage()">' +
                        '           <div class="clearfix">' +
                        '               <div class="thread-image">' +
                        '                   <img alt="" src='+url+'/assets/images/avatar-3.jpg"> ' +
                        '               </div> ' +
                        '               <div class="thread-content"> ' +
                        '                   <span class="author">'+user+'</span> ' +
                        '                   <span class="preview">'+value.app_user_message+'</span> ' +
                        '                   <span class="time">14 hrs</span>' +
                        '               </div> ' +
                        '           </div>' +
                        '        </a>' +
                        '   </li>'

                })
                $('#message_header').html(html)
                console.log(response)

            }
        })
    }
    newMessages()




})
