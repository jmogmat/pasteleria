
function searchAdmin() {
   
   

   
    var ad = document.getElementById('admin').value;
   
    return $.ajax({
        url: 'api/searchAdmin.php',
        type: 'POST',
        data: {
            administrador: ad

        },
        datatype: 'JSON',
        success:
                function (admin) {
                    let result = typeof admin === "string" ? JSON.parse(admin) : admin;
                    if (result.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!...',
                            text: result.msg,
                            confirmButtonText:
                                    'Continuar',
                        })


                    } else {
                        

                        document.getElementById('tabla_admin').style.display = "none";
                    
                        document.getElementById('tabla_search_admin').style.display = "inline";

                        document.getElementById('td_search_admin_1').style.color = 'darkred';

                        document.getElementById('td_search_admin_1').innerHTML = '# ' + admin[0][0];
                        document.getElementById('td_search_admin_2').innerHTML = admin[0][1];
                        document.getElementById('td_search_admin_3').innerHTML = admin[0][2];
                       
                                      
                    }

                }
    })


}
