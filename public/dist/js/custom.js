function changeStatus(url,message,userType,className)
{
    swal({
        title: "Are you sure?",   
        text: "Do you want to "+message+" the "+userType+" ?",
        type: "warning",
        showCancelButton: true,   
        confirmButtonColor: "#f8b32d",   
        confirmButtonText: "Yes",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
        window.location = url;
        } else {
            if(message == 'Activate')
            {
               
                $("."+className).prop('checked', false);
            }
            else
            {
             
                $("."+className).prop('checked', true);
              
            }

        }
        
    });
    return false;
}
function deleteRow(url)
{
    swal({
        title: "Are you sure?",   
        text: "Do you want to delete it?",
        type: "warning",
        showCancelButton: true,   
        confirmButtonColor: "#f8b32d",   
        confirmButtonText: "Yes delete it",
        closeOnConfirm: true,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
        window.location = url;
        }
    });
    return false;
}
function getEditEmployees(link)
{   
    var supervisor_id = $('#supervisor_Id').val();
    
    var url = link+'/'+supervisor_id;
    
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(res) {   
            //alert(res); 
            $('#employee_id').html(res);
        }
    });
}
function getAddEmployees(link)
{   
    var supervisor_id = $('#supervisor_id').val();
    //alert(supervisor_id)
    var url = link+'/'+supervisor_id;
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(res) {
            $('#employeeID').html(res);
        }
    });
}
getAddEmployees