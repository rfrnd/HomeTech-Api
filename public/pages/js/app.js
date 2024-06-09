console.log('____app js');

const baseUrl = window.location.origin;
const apiHeaders = {
    headers: {
        "Accept": "*/*",
        "Access-Control-Allow-Origin": "*",
        // "Content-Type": "application/json",
        "Content-Type": "multipart/form-data",
    }
};

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min);
}

function breakWord(text){
    let array = text.split(' ');
    let len = 2;

    var newtext = '';
    for(var i=0;i<array.length;i++) {
        newtext +=array[i]+' ';
        if (i % len == 0) {
            newtext += '</br>';//or \n\r
        }
    }
    return newtext;
}

function getCookie (name) {
	let value = `; ${document.cookie}`;
	let parts = value.split(`; ${name}=`);
	if (parts.length === 2) return parts.pop().split(';').shift();
}

$("#logout-btn").on('click', function(e) {
    apiHeaders['headers']['Authorization'] = 'Bearer '+getCookie('ut');
    let url = baseUrl+'/api/user/logout';

    axios.post(url, {}, apiHeaders)
    .then(function (response) {
        console.log('[DATA] response..',response.data);
        document.cookie = 'ue=';
        document.cookie = 'ut=';
        Swal.fire({
            position: "top-end",
            icon: "info",
            title: "Logout successfully..",
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(function() {
            window.location=baseUrl
        }, 1500)
    })
    .catch(function (error) {
        console.log('[ERROR] response..',error)
        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "Failed to logout",
            html: error.response?error.response.data.message:error.message,
            showConfirmButton: false,
            timer: 5000
        });
    });
});

$("#form-login-btn").on('click', function(e) {
    const form = document.getElementById('form-login');
    form.reportValidity() 
    if (!form.checkValidity()) {
    } else {
        $('#form-login-error').html('');
        $('#form-login-loading').show();
        $('#form-login').hide();
        let url = baseUrl+'/api/user/login';
        let formData  = new FormData(form);

        axios.post(url, formData, apiHeaders)
        .then(function (response) {
            console.log('[DATA] response..',response.data);
            document.cookie = 'ue='+formData.get('email');
            document.cookie = 'ut='+response.data.token;
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Login successfully!",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() {
                window.location=baseUrl
            }, 1500)
        })
        .catch(function (error) {
            console.log('[ERROR] response..',error);
            $('#form-login-error').html(error.response?error.response.data.message:error.message);
            $('#form-login-loading').hide();
            $('#form-login').show();
        });
    }
});

$("#form-register-btn").on('click', function(e) {
    const form = document.getElementById('form-register');
    form.reportValidity() 
    if (!form.checkValidity()) {
    } else {
        $('#form-register-error').html('');
        $('#form-register-loading').show();
        $('#form-register').hide();
        let url = baseUrl+'/api/user/register';
        let formData  = new FormData(form);

        axios.post(url, formData, apiHeaders)
        .then(function (response) {
            console.log('[DATA] response..',response.data);
            document.cookie = 'ue='+formData.get('email');
            document.cookie = 'ut='+response.data.token;
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Registered successfully and logged in automatically",
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() {
                window.location=baseUrl
            }, 1500)
        })
        .catch(function (error) {
            console.log('[ERROR] response..',error);
            $('#form-register-error').html(error.message);
            $('#form-register-loading').hide();
            $('#form-register').show();
        });
    }
});