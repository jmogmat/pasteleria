
function searchUserActive() {

    var user = document.getElementById('userActive').value;

    return $.ajax({
        url: 'api/searchUserActive.php',
        type: 'POST',
        data: {
            userActive: user

        },
        datatype: 'JSON',
        success:
                function (userActive) {

                    let result = typeof userActive === "string" ? JSON.parse(userActive) : userActive;
                    if (result.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!...',
                            text: result.msg,
                            confirmButtonText:
                                    'Continuar',
                        })


                    } else {

                        console.log(userActive)


                        document.getElementById('tabla_usuarios').style.display = "none";

                        document.getElementById('tablaUserActive').style.display = "inline";

                        document.getElementById('td_search_user_1').style.color = 'darkred';


                        document.getElementById('td_search_user_1').innerHTML = '# ' + userActive[0][0];
                        document.getElementById('td_search_user_2').innerHTML = userActive[0][1];
                        document.getElementById('td_search_user_3').innerHTML = userActive[0][2];
                        document.getElementById('td_search_user_4').innerHTML = userActive[0][3];
                        document.getElementById('td_search_user_5').innerHTML = userActive[0][4];
                        document.getElementById('td_search_user_6').innerHTML = userActive[0][5];
                        document.getElementById('td_search_user_7').innerHTML = userActive[0][6];
                        document.getElementById('td_search_user_8').innerHTML = userActive[0][7];
                        document.getElementById('td_search_user_9').innerHTML = userActive[0][8];
                        document.getElementById('td_search_user_10').innerHTML = userActive[0][9];
                        document.getElementById('td_search_user_11').innerHTML = userActive[0][10];
                        document.getElementById('td_search_user_12').innerHTML = userActive[0][11];
                        document.getElementById('td_search_user_13').innerHTML = userActive[0][12];
                        document.getElementById('td_search_user_14').innerHTML = userActive[0][13];
                        document.getElementById('td_search_user_15').innerHTML = userActive[0][14];
                        document.getElementById('td_search_user_15').style.color = 'green';



                    }

                }
    })


}


