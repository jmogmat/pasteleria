
function searchUpdateByDate() {

    var date1 = document.getElementById('fecha1').value;
    var date2 = document.getElementById('fecha2').value;



    return $.ajax({
        url: 'api/searchUpdateByDate.php',
        type: 'POST',
        data: {
            dateOne: date1,
            dateTwo: date2

        },
        datatype: 'JSON',
        success:
                function (updates) {

                    let result = typeof updates === "string" ? JSON.parse(updates) : updates;
                    if (result.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!...',
                            text: result.msg,
                            confirmButtonText:
                                    'Continuar',
                        })


                    } else {

                        console.log(updates)
                        
                     
                            
                 


                        document.getElementById('table_users_updates').style.display = "none";

                        document.getElementById('tableUpdates').style.display = "inline";
                        

                     
                         document.getElementById('td_search_user_1').innerHTML = updates[0][0];
                         document.getElementById('td_search_user_2').innerHTML = updates[0][1];
                         document.getElementById('td_search_user_3').innerHTML = updates[0][2];
                         document.getElementById('td_search_user_4').innerHTML = updates[0][3];
                         document.getElementById('td_search_user_5').innerHTML = updates[0][4];
                         document.getElementById('td_search_user_6').innerHTML = updates[0][5];
                         document.getElementById('td_search_user_7').innerHTML = updates[0][6];
                         document.getElementById('td_search_user_8').innerHTML = updates[0][7];
                         document.getElementById('td_search_user_9').innerHTML = updates[0][8];
                         document.getElementById('td_search_user_10').innerHTML = updates[0][9];
                         document.getElementById('td_search_user_11').innerHTML = updates[0][10];
                         document.getElementById('td_search_user_12').innerHTML = updates[0][11];
                         document.getElementById('td_search_user_13').innerHTML = updates[0][12];
                         document.getElementById('td_search_user_14').innerHTML = updates[0][13];
                         document.getElementById('td_search_user_15').innerHTML = updates[0][14];
                         document.getElementById('td_search_user_16').innerHTML = updates[0][15];
                         document.getElementById('td_search_user_17').innerHTML = updates[0][16];
                         document.getElementById('td_search_user_18').innerHTML = updates[0][17];
                         document.getElementById('td_search_user_19').innerHTML = updates[0][18];
                         document.getElementById('td_search_user_20').innerHTML = updates[0][19];
                         document.getElementById('td_search_user_21').innerHTML = updates[0][20];
                         document.getElementById('td_search_user_22').innerHTML = updates[0][21];
                         document.getElementById('td_search_user_23').innerHTML = updates[0][22];
                         document.getElementById('td_search_user_24').innerHTML = updates[0][23];
                         
                         
                         
                    }

                }
    })


}

