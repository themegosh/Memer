function uploadEx() {
    var canvas = document.getElementById('canvas');
    var dataURL = canvas.toDataURL('image/png');
    document.getElementById('hidden_data').value = dataURL;
    var fd = new FormData(document.forms['editForm']);
    var notification = document.getElementById('notification');
    var disableInputs = document.getElementsByClassName('saveDisable');
    var saveSuccess = document.getElementById('saveSuccess');
    var title = document.getElementById('title');
    var topText = document.getElementById('topText');
    var bottomText = document.getElementById('bottomText');
    
    if (title.value.trim() == ""){
        notification.innerHTML = "<div class='alert alert-danger'>Error: You must provide a title...</div>";
        return;
    }
    if (topText.value.trim() == "" && bottomText.value.trim() == ""){
        notification.innerHTML = "<div class='alert alert-danger'>Error: You havent given the image any text...</div>";
        return;
    }


    disableInputs.disabled = true;
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            notification.innerHTML = xhr.responseText;
            disableInputs.disabled = false;
        }
    }
    xhr.open('POST', 'ajaxCreate.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = Math.round((e.loaded / e.total) * 100);
            notification.innerHTML = "<div class='alert alert-warning'>Uploading... "+percentComplete+ " % done.</div>";
        }
    };
    
    xhr.onload = function() {

    };
    xhr.send(fd);
};