function connexion() {
    let form = document.getElementById("form");

    var fd = new FormData();

    for (var i = 0; i < form.length; i++) {
        fd.append(form[i].name, form[i].value);
    }

    document.getElementById('btn_connexion').disabled = true;

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'connexion.php');

    xhr.send(fd);

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('btn_connexion').disabled = false;

            response = JSON.parse(xhr.responseText);

            if (response.success != '') {
                document.getElementById('form').reset();
                document.getElementById('message_box').innerHTML = response.success;
                document.getElementById('username_error').innerHTML = '';
                document.getElementById('password_error').innerHTML = '';
            } else {
                document.getElementById('username_error').innerHTML = response.username_error;
                document.getElementById('password_error').innerHTML = response.password_error;
            }

        }
    }
}