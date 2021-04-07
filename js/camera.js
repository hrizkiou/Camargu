//global vars

var width = 614,
    height = 917,
    streaming = false;
var p;
// DOM elements

var imgFilter;

const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const stickercan = document.getElementById("sticker");
//const photos = document.getElementById("photos");
const photoButton = document.getElementById("photo-button");
const clearButton = document.getElementById("clear-button");

const savebtn = document.querySelector("#photo-save");
savebtn.disabled = true;

const photobtn = document.querySelector("#photo-button");
photobtn.disabled = true;

//get media stream
navigator.mediaDevices
    .getUserMedia({
        video: true,
        audio: false
    })
    .then(function(stream) {
        //link to video source
        video.srcObject = stream;

        //play video
        video.play();
    })
    .catch(function(err) {
        // console.log(`Error: ${err}`);
    });

//play when ready
video.addEventListener(
    "canplay",
    function(e) {
        if (!streaming) {
            //set video canvas height
            height = video.videoHeight / (video.videoWidth / width);

            // video.setAttribute("min-width", width);
            // video.setAttribute("min-height", height);
            // canvas.setAttribute("min-width", width);
            // canvas.setAttribute("min-height", height);
            // resizecanvas(video);

            streaming = true;
            photobtn.disabled = false;
        }
    },
    false
);

//photo button event
photoButton.addEventListener(
    "click",
    function(e) {
        takePicture();
        savebtn.disabled = false;
        e.preventDefault();
    },
    false
);


//clear event
clearButton.addEventListener("click", function(e) {
    canvas.style.display = "none";
    // stickercan.style.display = "none";
    p = '';
});


//take pic from canvas



function takePicture() {
    //create canvas
    const context = canvas.getContext("2d");
    if (width && height) {
        //set canvas props
        canvas.width = 500;
        canvas.height = height;

    }

    //draw an image of the video on the canvas
    context.drawImage(video, 0, 0);

    //create image from the canvas
    const imgUrl = p = canvas.toDataURL("image/png");


    //make canvas visible
    canvas.style.display = "block";
    canvas.setAttribute("class", "thumbnail");

    // canvas.setAttribute("height", "375");

}

var stickerUrl;
var st = [];
var i = 0;


function addSticker(sticker) {

    dImg = new Image();
    dImg.src = "img/stickers/" + sticker;
    stickerUrl = dImg.src;
    st.push(stickerUrl);
    // WAIT TILL IMAGE IS LOADED.
    dImg.onload = function () {
        fill_canvas(dImg);       // FILL THE CANVAS WITH THE IMAGE.
    }
    
}

function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min + 1) + min);
  }

function fill_canvas(img) {
    // CREATE CANVAS CONTEXT.
    var all = document.getElementById('canvas');
    var videox = document.getElementById('video');
    
    // height: 375px;
    // width: 500px;
    index_x = randomIntFromInterval(0, 500 - 100);
    index_y = randomIntFromInterval(0, 375 - 100);
    
    videox.insertAdjacentHTML('afterend', '<img id="sticker" src="'+img.src+'" style="width: 100px; height: 100px;position: absolute; top: '+index_y+'px; left: '+index_x+'px;">');
    all.insertAdjacentHTML('afterend', '<img id="sticker" src="'+img.src+'" style="width: 100px; height: 100px;position: absolute; top: '+index_y+'px; left: '+index_x+'px;">');


}


var upload = document.getElementById("upload");

upload.addEventListener("change", e => {
    var file = upload.files[0];
    if (upload.files.length > 0 && upload.files[0].type.match(/image\/*/)) {
        savebtn.disabled = false;
        var image = new Image();
        const context = canvas.getContext("2d");
        image.onload = () => {
            canvas.width = 500;
            canvas.height = 375;
            canvas.style.display = "block";
            context.drawImage(image, 0, 0, canvas.width, canvas.height);
            canvas.style.display = "block";
        };
        image.src = URL.createObjectURL(upload.files[0]);
        if (file){
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                p = reader.result;
            };
        }

    }
});


function del(){
    var stickercan = document.querySelectorAll('#sticker');
    // stickerUrl = 'undefined';
    // return;
    for ( i = 0; i < stickercan.length; i++) {
        stickercan[i].style.display = "none";
        // st[i] = '';
        }
        st = [];
        // ;
}

document.getElementById("photo-save").addEventListener("click", function() {

    const request = new XMLHttpRequest();
    var data = new FormData();
    data.append('photo', p);
    data.append('sticker', st);
    request.open('POST', 'merge.php');
    request.onload = function () {
        alert(request.responseText);
        // console.log(request.responseText);

    }
    request.send(data);
});


//TEST
// document.getElementById("photo-save").addEventListener("click", function() {

//     const request = new XMLHttpRequest();
//     var data = new FormData();
//     data.append('photo', p);
//     data.append('sticker', st);
//     request.open('POST', 'test.php');
//     request.onload = function () {
//         // alert(request.responseText);
//         console.log(request.responseText);

//     }
//     request.send(data);
// });


