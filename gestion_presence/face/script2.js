const video = document.getElementById('video')

const id = document.getElementById('id');

// var mavariable=document.getElementById("maListe").value;


// Transporter mon array de index.php à script2.js
var sessionString = sessionStorage.getItem('Thearray');

var mavariable =  JSON.parse(sessionString);


Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('/gestion_presence/face/models/'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/gestion_presence/face/models/'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/gestion_presence/face/models/') 
    //heavier/accurate version of tiny face detector
]).then(start)

function start() {
    document.body.append('Models Loaded')
    
    navigator.getUserMedia(
        { video:{} },
        stream => video.srcObject = stream,
        err => console.error(err)
    )
    
    // video.src = '../videos/speech.mp4'
    console.log('video added')
    recognizeFaces()
}

async function recognizeFaces() {

    const labeledDescriptors = await loadLabeledImages()
    console.log(labeledDescriptors)
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.7)


    video.addEventListener('play', async () => {
        console.log('Playing')
        const canvas = faceapi.createCanvasFromMedia(video)
        document.body.append(canvas)

        const displaySize = { width: video.width, height: video.height }
        faceapi.matchDimensions(canvas, displaySize)

        
        var label;
        setInterval(async () => {
            const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()

            const resizedDetections = faceapi.resizeResults(detections, displaySize)

            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

            const results = resizedDetections.map((d) => {
                return faceMatcher.findBestMatch(d.descriptor)
            })
            results.forEach( (result, i) => {
                const box = resizedDetections[i].detection.box
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                drawBox.draw(canvas)
                 label_result =  result.label;


                var id = parseInt(jsid);  
                 
                if (label_result == id) {

                    setTimeout(
                    function RedirectionJavascript(){
                        document.location.href="/gestion_presence/connexion/home.php?id="+id;
                      }  , 5000 );

                }

        
                console.log(label_result)
                console.log(id)
                // console.log(typeof id)


            })
        }, 100)


        
    })
}


function loadLabeledImages() {
    // const labels = ['Black Widow', 'Captain America', 'Hawkeye' , 'Jim Rhodes', 'Tony Stark', 'Thor', 'Captain Marvel']

    // 22 : Ulrich
    // 23 : Mamadou
    // var label_php = mavariable
    // const labels = ['23','22'] // for WebCam


    labels = mavariable

    // window.alert(typeof mavariable);
    return Promise.all(
        labels.map(async (label)=>{
            const descriptions = []
            for(let i=1; i<=2; i++) {
                const img = await faceapi.fetchImage(`/gestion_presence/face/labeled_images/${label}/${i}.jpg`)
                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                console.log(label + i + JSON.stringify(detections))
                descriptions.push(detections.descriptor)
            }
            document.body.append(label+' Faces Loaded | ')
            return new faceapi.LabeledFaceDescriptors(label, descriptions)
        })
    )
}