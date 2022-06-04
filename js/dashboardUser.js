function dashboardProfileUser() {

    document.getElementById('dashboardUser').style.display = 'inline';
    document.getElementById('addressBilling').style.display = 'none';
}

/*
function usersOrders() {

    document.getElementById('usersOrders').style.display = 'inline';
    document.getElementById('editProfileUser').style.display = 'none';
    document.getElementById('dashboardUser').style.display = 'none';
    document.getElementById('editAddressUser').style.display = 'none';
    document.getElementById('addresBilling').style.display = 'none';

}
*/

function addressBilling() {

    document.getElementById('addressBilling').style.display = 'inline';
    document.getElementById('dashboardUser').style.display = 'none';

}
/*
function editAddressUser() {

    document.getElementById('editAddressUser').style.display = 'inline';
    document.getElementById('usersOrders').style.display = 'none';
    document.getElementById('editProfileUser').style.display = 'none';
    document.getElementById('dashboardUser').style.display = 'none';
    document.getElementById('addressBilling').style.display = 'none';

}
*/

function logout(){
    window.location.href = "logout.php";
}

