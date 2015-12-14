function uploadEx() {
    var canvas = document.getElementById('canvas');
    var dataURL = canvas.toDataURL('image/png');
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms['editForm']);
    var notification = document.getElementById('notification');
    var disableInputs = document.getElementsByClassName('saveDisable');
    var saveSuccess = document.getElementById('saveSuccess');
    var title = document.getElementById('title');

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        notification.innerHTML = xhr.responseText;
        //window.location.replace("memes.php?txtSearch="+title.value);
    }
}
    xhr.open('POST', 'ajaxCreate.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            console.log(percentComplete + '% uploaded');
            console.log('Succesfully uploaded');
        }
    };
    
    

    xhr.onload = function() {

    };
    xhr.send(fd);
};