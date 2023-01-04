<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center" id="header">
                    <h1> Student Registration Form </h1>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <form  class= "first"method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="name">Name:</span>
                            </div>
                            <input type="text" name="owner" placeholder="Student full Name" required class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="roll"> Roll No.:</span>
                            </div>
                            <input type="text" name="type" placeholder="Student Roll No." required class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="class">Class:</span>
                            </div>
                            <input type="text" name="owner" required class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="birth"> Date of Birth::</span>
                            </div>
                            <input type="date" name="entry" required class="form-control">

                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="enroll"> Enrollment Date:</span>
                            </div>
                            <input type="date" name="exit" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="enroll"> Address:</span>
                            </div>
                            <input type="text" name="address" placeholder="Student address" class="form-control">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number:</span>
                                <span class="input-group-text">+ 91 </span>
                            </div>
                            <input type="tel" id="phone" name="phone" required class="form-control"
                                pattern="[7-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" required>
                        </div>
                        <br>
                        <input type="button" class="btn btn-primary" id="Save" value="Submit" onclick="saveStudent();">

                    </form>
                </div>
            </div>
        </div>
        <script>
            $("#name").focus();
            function validateAndGetFormData() {
                var nameVar = $("#name").val();
                if (nameVar === "") {
                    alert("Name Required Value");
                    $("#name").focus();
                    return "";
                }
                var roll = $("#roll").val();
                if (rollVar === "") {
                    alert("Roll No. is Required Value");
                    $("#roll").focus();
                    return "";
                }
                var classVar = $("#class").val();
                if (classVar === "") {
                    alert("Class is Required Value");
                    $("#Class").focus();
                    return "";
                }
                var birthVar = $("#birth").val();
                if (birthVar === "") {
                    alert("Date of birth is Required Value");
                    $("#birth").focus();
                    return "";
                }
                var enrollVar = $("#enroll").val();
                if (ClassVar === "") {
                    alert("Enrollment Date is Required Value");
                    $("#enroll").focus();
                    return "";
                }
                var jsonStrObj = {
                    Name: nameVar,
                    Roll: rollVar,
                    class: classVar,
                    birth: birthvar,
                    enroll: enrollvar

                };
                return JSON.stringify(jsonStrObj);
            }
            // This method is used to create PUT Json request.
            function createPUTRequest(connToken, jsonObj, dbName, relName) {
                var putRequest = "{\n"
                    + "\"token\" : \""
                    + connToken
                    + "\","
                    + "\"dbName\": \""
                    + dbName
                    + "\",\n" + "\"cmd\" : \"PUT\",\n"
                    + "\"rel\" : \""
                    + relName + "\","
                    + "\"jsonStr\": \n"
                    + jsonObj
                    + "\n"
                    + "}";
                return putRequest;
            }
            function executeCommand(reqString, dbBaseUrl, apiEndPointUrl) {
                var url = dbBaseUrl + apiEndPointUrl;
                var jsonObj;
                $.post(url, reqString, function (result) {
                    jsonObj = JSON.parse(result);
                }).fail(function (result) {
                    var dataJsonObj = result.responseText;
                    jsonObj = JSON.parse(dataJsonObj);
                });
                return jsonObj;
            }
            function resetForm() {
                $("#name").val("")
                $("#roll").val("");
                $("#class").val("");
                $("#birth").val();
                $("#enroll").val();
              
            }
            function saveStudent() {
                var jsonStr = validateAndGetFormData();
                if (jsonStr === "") {
                    return;
                }
                var putReqStr = createPUTRequest("90938224|-31949272889888759|90954844",
                    jsonStr, "Student", "Student-REL");
                alert(putReqStr);
                jQuery.ajaxSetup({ async: false });
                var resultObj = executeCommand(putReqStr,
                    "http://api.login2explore.com:5577", "/api/iml");
                alert(JSON.stringify(resultObj));
                jQuery.ajaxSetup({ async: true });
                resetForm();
            }
        </script>
</body>

</html>