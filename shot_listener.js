/* 
 * @file
 * Contain listening funcion for the Shotnget module
 * 
 */

function listening(rand, randPath, page, time, freq) {
    var clistener = new CListener(rand, randPath, page, time, freq);
    clistener.onFinishedListening = onFinishedListening;
    document.getElementById("shotnget_login_div").addEventListener("click", function(e) { clistener.close(); }, false);
    clistener.startListening();
}
 
function onFinishedListening(rand, error) {
    var listenerConst = new CListenerConst();
    var result = "";
    switch (error) {
        case listenerConst.RESULT_NO_ERROR:
            window.location.replace("url_website/shotnget/redirect.php?_rand=" + rand);
            break;
        case listenerConst.RESULT_TIMEOUT:

            break;
        case listenerConst.RESULT_RAND_ERROR:

            break;
        case listenerConst.RESULT_SERVER_ERROR:

            break;
        case listenerConst.RESULT_PLUGIN_ERROR:

            break;
        case listenerConst.RESULT_SERVER_ERROR_WITH_RETRY:

            break;
        case listenerConst.RESULT_CERTPHONE_ERROR:

            break;
        default:
        window.location.replace("index.html");
        break;
    }
}