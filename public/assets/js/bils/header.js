$(document).ready(function () {

    newMessages = () =>{
        $.ajax({
            url: url+'/message/load-new-message',
            type:'GET',
            async:false,
            success: function(response){
                console.log(response)

            }
        })
    }




})
