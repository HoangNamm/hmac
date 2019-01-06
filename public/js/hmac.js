$(document).ready(function () {
    $('#submit').click(function (event) {
        event.preventDefault();
        var k = $('#key').val();
        var u = $('#username').val();
        var p = $('#password').val();
        console.log(k + " : " + u + " : " + p);
        var myUrl = mgcAwsSigner.getSignedUrlForAction( "login", u, p );
        console.log(myUrl);
    })
    
});

mgcAwsSigner = function(){
 
    var awsAccessKeyId     = "MYACCESSKEYID"
    var awsAccessKeySecret = "MYACCESSKEYSECRET";
    var awsRegionUrl       = "blog.test/api/hmac";
    var awsApiVersion      = "2013-02-01";
        
    function getAWSApiPathArray( action, username, password ){
        var paramArray =  getAWSAuthParamsArray( awsAccessKeyId, getAWSTimeStamp() );
        paramArray.push( "Action="+action );
        paramArray.push( "Username="+username );
        paramArray.push( "Password="+password );
        // ToDo: Add action params array here....
        var paramsSorted = getAWSParamsStringFromArray( paramArray );
        console.log("AAA: " + paramsSorted);
        return paramsSorted;
    }
    
    function getAWSAuthParamsArray( accessKeyId, timeStamp ){
        var paramsArray = [ "AWSAccessKeyId="+accessKeyId,
                            "Timestamp="+timeStamp ,
                            "Version="+awsApiVersion,
                            "SignatureVersion=2",
                            "SignatureMethod=HmacSHA256" ];
        return paramsArray;
    }
    
    function getAWSParamsStringFromArray( paramsArray ){
        paramsArray.sort();
        paramsString = paramsArray.join("&");
        return paramsString;
    }
    
    function getAWSSigningString( apiPath ){
        var signString = "GET\n" + awsRegionUrl + "\n/\n" + apiPath;
        return signString;
    }
    
    function getAWSTimeStamp(){
        var d=new Date();
        var n=d.toJSON();
        return encodeURIComponent(n);
    }
    
    function getSigniture( input, passphrase ){
        var hash = CryptoJS.HmacSHA256(input, passphrase);
        var base64 = hash.toString(CryptoJS.enc.Base64);
        var encode = encodeURIComponent(base64);
        return encode;
    }
 
    return{
    
        getSignedUrlForAction:function( action, username, password ){
            var paramsSort = getAWSApiPathArray( action, username, password  );
            var signingString = getAWSSigningString( paramsSort );
            var signature=  getSigniture( signingString, awsAccessKeySecret );
            return "http://" + awsRegionUrl + "/?" + paramsSort + "&Signature=" + signature;
        }
    } 
}();
