var video = document.createElement("video");
var canvasElement = document.getElementById("qr-canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");
var outputContainer = document.getElementById("output");
var outputMessage = document.getElementById("outputMessage");
var outputData = document.getElementById("outputData");
var stopRecord = false
var selectCoin = null

function drawLine(begin, end, color) {
    canvas.beginPath();
    canvas.moveTo(begin.x, begin.y);
    canvas.lineTo(end.x, end.y);
    canvas.lineWidth = 4;
    canvas.strokeStyle = color;
    canvas.stroke();
}

function initQR(coin){
    selectCoin = coin
    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
        video.srcObject = stream;
        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
        video.play();
        requestAnimationFrame(tick);
    });
}

function tick() {
    loadingMessage.innerText = "⌛ Loading video..."
    if (video.readyState === video.HAVE_ENOUGH_DATA) {
        loadingMessage.hidden = true;
        canvasElement.hidden = false;
        outputContainer.hidden = false;
        canvasElement.height = $(window).width() < 960?280:video.videoHeight;
        canvasElement.width = $("#qr-scan-div").innerWidth();
        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
        var code = jsQR(imageData.data, imageData.width, imageData.height, {
            inversionAttempts: "dontInvert",
        });
        if (code) {
            drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
            drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
            drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
            drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
            // check valid bitcoin address
            if (selectCoin === 'btc' && WAValidator.validate(code.data, 'bitcoin')){
                outputData.value = code.data;
                stopRecord = true
            }
            else if(selectCoin === 'bch' && WAValidator.validate(code.data, 'BCH')) {
                outputData.value = code.data;
                stopRecord = true
            }
            else if(selectCoin === 'ltc' && WAValidator.validate(code.data, 'LTC')) {
                outputData.value = code.data;
                stopRecord = true
            }
            else if(selectCoin === 'eth' && WAValidator.validate(code.data, 'ethereum')) {
                outputData.value = code.data;
                stopRecord = true
            }
            else if(selectCoin === 'devvio' && ['02', '03'].indexOf(code.data.substr(0,2)) > -1){
                outputData.value = code.data;
                stopRecord = true
            }
        }
    }
    if(!stopRecord){
        requestAnimationFrame(tick);
    }else{
        $("#qr-canvas").addClass('d-none')

        axios.get('/api/username-from-addr/' + code.data.replace(/[^a-zA-Z0-9-_]/g, ''))
            .then(function(res){
                $("#username-input").removeClass('d-none')
                $("#username-input").val(res.data.name)
                $("#userid-input").val(res.data.id)
            })
    }
}