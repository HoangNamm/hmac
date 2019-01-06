$(document).ready(function () {
    var baseURL = 'http://blog.test/api';
    var apiSecretKey = 'ABC123';

    $('#submit').click(function (event) {
        event.preventDefault();
        getValue();
    })

    function getValue(url) {
        var k = $('#key').val();
        var u = $('#username').val();
        var p = $('#password').val();
        var timestamp = getMicrotime(true).toString();
        console.log(k + " : " + u + " : " + p + " : " + timestamp);
        // $.ajax({
        //     type: "POST",
        //     url: baseURL + "/login",
        //     contentType: "application/json; charset=utf-8",
        //     dataType: "json",
        //     data: JSON.stringify({username: u, password: p}),                    
        //     success: function (data) {
        //         $('.loggedOut').hide();
        //         $('.loggedIn').show();
        //     },
        //     error: function (errorMessage) {
        //         alert('Error logging in');
        //     }
        // });
    }

    function getMicrotime (get_as_float) {
 
        var now = new Date().getTime() / 1000;
        var s = parseInt(now, 10);
   
        return (get_as_float) ? now : (Math.round((now - s) * 1000) / 1000) + ' ' + s;
      }
});