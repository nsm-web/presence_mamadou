<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['id'])){
        header('Location:index.php');
        die();
      }

$id = $_SESSION['id'];

require_once("../db_conn.php");

$labels_php =[];

  $sql = "SELECT id FROM users WHERE role='user'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $id_app = strval($row["id"]);
      array_push($labels_php,$id_app);
    }}
  

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
  <script defer src="face-api.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!--   <script defer src="script2.js"></script> 
 -->
  <title>Reconnaissance Faciale</title>
  
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;

    }

    canvas {
      position: absolute;
    }
  </style>
</head>

<body>
  <video id="video" width="720" height="560" muted controls></video>
  <div id="id"><?php echo $id ; ?></div>
  <!-- <div id="maListe"><?php echo json_encode($labels_php) ; ?></div> -->


  <!-- <input type="hidden" name="maListe" id="maListe" value=<?php echo json_encode($labels_php);?> /> -->




<script>
  var js_array = <?php echo json_encode($labels_php);?>;
 
  sessionStorage.setItem('Thearray', JSON.stringify(js_array));
  var jsid = '<?=$id?>';
   console.log(jsid)
</script>

<script>
$(document).ready(function(){
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
                 precision = result.distance;


                var id = parseInt(jsid);  
                 
                if (label_result == id && precision <= 0.4){
                  setTimeout(
                  function Redirection(){
                    document.location.href="/gestion_presence/connexion/home.php";
                }  , 2000 );
                
                }
                else{

                    document.location.href="/gestion_presence/connexion/index.php";
                }


        
                // console.log(precision)
                // console.log(id)
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
  })
</script>

</body>
</html>