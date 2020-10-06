<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">

<body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>


    <script type="text/javascript">
    function ReadHandwrittenImage(sourceImageUrl) {

        // Request parameters.
        var params = {
            "handwriting": "true",
        };

        // This operation requrires two REST API calls. One to submit the image for processing,
        // the other to retrieve the text found in the image.
        //
        // Perform the first REST API call to submit the image for processing.
        $.ajax({
                url: "https://" +
                    "eastus2" +
                    ".api.cognitive.microsoft.com/vision/" +
                    "v1.0/recognizeText" +
                    "?" +
                    $.param(params),

                // Request headers.
                beforeSend: function(jqXHR) {
                    jqXHR.setRequestHeader("Content-Type", "application/json");
                    jqXHR.setRequestHeader("Ocp-Apim-Subscription-Key",
                        encodeURIComponent('8adc12d68d634971a12eac5cd3cbbb57'));
                },

                type: "POST",

                // Request body.
                data: '{"url": ' + '"' + sourceImageUrl + '"}',
            })

            .done(function(data, textStatus, jqXHR) {
                // Show progress.
                //document.write("Handwritten image submitted.");

                // Note: The response may not be immediately available. Handwriting recognition is an
                // async operation that can take a variable amount of time depending on the length
                // of the text you want to recognize. You may need to wait or retry this GET operation.
                //
                // Try once per second for up to ten seconds to receive the result.
                var tries = 10;
                var waitTime = 100;
                var taskCompleted = false;

                var timeoutID = setInterval(function() {
                    // Limit the number of calls.
                    if (--tries <= 0) {
                        window.clearTimeout(timeoutID);
                        //document.write("The response was not available in the time allowed.");
                        return;
                    }

                    // The "Operation-Location" in the response contains the URI to retrieve the recognized text.
                    var operationLocation = jqXHR.getResponseHeader("Operation-Location");

                    // Perform the second REST API call and get the response.
                    $.ajax({
                            url: operationLocation,

                            // Request headers.
                            beforeSend: function(jqXHR) {
                                jqXHR.setRequestHeader("Content-Type", "application/json");
                                jqXHR.setRequestHeader("Ocp-Apim-Subscription-Key",
                                    encodeURIComponent('8adc12d68d634971a12eac5cd3cbbb57'));
                            },

                            type: "GET",
                        })

                        .done(function(data) {
                            // If the result is not yet available, return.
                            if (data.status && (data.status === "NotStarted" || data.status ===
                                    "Running")) {
                                return;
                            }

                            // Show formatted JSON on webpage.
                            //document.write(JSON.stringify(data, null, 2));
                            //$("#demo").text(JSON.stringify(data, null, 2));
                            //$_SESSION['datosimgJSON']=JSON.stringify(data, null, 2));
                            console.log(JSON.stringify(data, null, 2));
                            var swas = JSON.stringify(data, null, 2);
                            //$("#demo").text(swas);
                            var x, i = "";
                            var w = JSON.parse(swas);
                            //var ss = JSON.stringify(w.recognitionResult);
                            var palabrasenFoto=[];
                            lineas=w.recognitionResult.lines;

                            for (let index = 0; index < lineas.length; index++) {
                                for (let index2 = 0; index2 < lineas[index].words.length; index2++) {
                                    w=lineas[index].words[index2].text;
                                    palabrasenFoto.push(w);
                                }
                                
                            }
                            //w=w.recognitionResult.lines[0].words[0].text;
                            //w=JSON.stringify(w);
                            //palabrasenFoto=JSON.stringify(palabrasenFoto);
                            //$("#demo").text(palabrasenFoto);






                            
                            var palabrasPartidos = ["UCS","MAS","UDN","NULO","BLANCO"];
                            var x = {
                                "palabras": ["MAS", "X", "23", "CC", "12", "BDN", "DXDD", "35"]
                            };
                            var result = {
                                "resultados": {}
                            };
                           // result.resultados["MAS"] = "2";
                            //result = JSON.stringify(result);


                            x = x.palabras;
                            //x = "MAS";
                            x = JSON.stringify(x);
                            x = JSON.parse(x);
                            //x=x[0];
                            //x=parseInt(x,10);

                            for (let index = 0; index < palabrasPartidos.length; index++) {
                                for (let index2 = 0; index2 < palabrasenFoto.length; index2++) {
                                    if (JSON.stringify(palabrasPartidos[index]) == JSON.stringify(palabrasenFoto[index2])) {
                                        for(let index3=index2+1;index3<palabrasenFoto.length;index3++){
                                            if (isNaN(palabrasenFoto[index3])) {
                                                if (JSON.stringify(palabrasenFoto[index3]) == JSON.stringify(palabrasPartidos[index])) {
                                                    
                                                    $("#demo").text("Error1");
                                                    break;

                                                } else {
                                                    if (palabrasPartidos.includes(palabrasenFoto[index3]) == true) {
                                                       
                                                        $("#demo").text("Error2");
                                                        break;
                                                    } else {
                                                        
                                                    }
                                                }
                                            } else {

                                                result.resultados[palabrasPartidos[index]]=parseInt(palabrasenFoto[index3],10);
                                                break;
                                            }
                                    }

                                     
                                    }
                                }

                            }
                            result = JSON.stringify(result);
                            $("#demo").text(result);

                            var b = JSON.stringify(ddd);
                            var xx = JSON.stringify(x);
                            var xxx = JSON.parse(xx);
                            var xxxx = xxx.palabras;


                            var xxxxx = JSON.stringify(xxxx);

                            //$("#demo").text(xxxxx);
                            var ddd2 = ["MAS", "CC", "BDN"];



                            var sss = JSON.parse(ss);
                            var x = sss.lines;
                            x = JSON.stringify(x);
                            //$("#demo").text(x);

                            // Indicate the task is complete and clear the timer.
                            taskCompleted = true;
                            window.clearTimeout(timeoutID);
                        })

                        .fail(function(jqXHR, textStatus, errorThrown) {
                            // Indicate the task is complete and clear the timer.
                            taskCompleted = true;
                            window.clearTimeout(timeoutID);

                            // Display error message.
                            var errorString = (errorThrown === "") ? "Error. " : errorThrown + " (" +
                                jqXHR.status + "): ";
                            errorString += (jqXHR.responseText === "") ? "" : (jQuery.parseJSON(jqXHR
                                    .responseText).message) ?
                                jQuery.parseJSON(jqXHR.responseText).message : jQuery.parseJSON(jqXHR
                                    .responseText).error.message;
                            alert(errorString);
                        });
                }, waitTime);
            })

            .fail(function(jqXHR, textStatus, errorThrown) {
                // Put the JSON description into the text area.
                //document.write(JSON.stringify(jqXHR, null, 2));

                // Display error message.
                var errorString = (errorThrown === "") ? "Error. " : errorThrown + " (" + jqXHR.status + "): ";
                errorString += (jqXHR.responseText === "") ? "" : (jQuery.parseJSON(jqXHR.responseText).message) ?
                    jQuery.parseJSON(jqXHR.responseText).message : jQuery.parseJSON(jqXHR.responseText).error
                    .message;
                alert(errorString);
            });
    }
    </script>

    <pre id="demo">
    </pre>
    <h1></h1>
    <div name="dieg" id="dieg">
        <br>
        <script id="sc">
        ReadHandwrittenImage('<?php echo $_SESSION['imageUrl']; ?>');
        </script>
    </div>
</body>

</html>