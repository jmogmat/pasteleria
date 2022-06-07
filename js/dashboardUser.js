function dashboardProfileUser() {

    document.getElementById('dashboardUser').style.display = 'inline';
    document.getElementById('addressBilling').style.display = 'none';
}

function addressBilling() {

    document.getElementById('addressBilling').style.display = 'inline';
    document.getElementById('dashboardUser').style.display = 'none';

}


function logout(){
    window.location.href = "logout.php";
}

