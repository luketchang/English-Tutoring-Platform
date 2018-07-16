<!DOCTYPE html>

<?php 

$servername = "db746401298.db.1and1.com";
$username = "dbo746401298";
$password = "Tr@vel000";
$dbName = "db746401298";

session_start(); 

try{
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

    // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // $sql = "INSERT INTO Sessions (firstName, dateLoggedIn)VALUES('$firstName', CURDATE())";
  // $conn -> exec ( $sql );
}
catch(PDOException $e) {
    print "Connection failed: " . $e->getMessage();
}
?>

<html>
<title>Grace English Program - Student</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html{
  position: relative;
/*  overflow: hidden;
*/}
.input {
      width: 50%;
      position: relative;
      left: 10px;
      max-width: 100%;
      height: 22px;
    }
input[type=password] {
      width: 50%;
      position: relative;
      left: 10px;
//      margin-bottom: 200px;
   //   margin: 20px 0px 20px 0px;
      max-width: 100%;
      height: 22px;
    }
  /*input[type=submit]{
    height: 20px;
    text-align: center;
  }*/

    hr{
      margin-top: 15px; margin-bottom: 15px;
      border-color: silver;
    }
    p{
      margin-top: 5px; margin-bottom: 5px;
    }
    h2{
      margin-top: 5px; margin-bottom: 5px;
    }
    h6{
      margin-top: 3px; margin-bottom: 2px;
    }

    .inputElement {
      margin: 3px 0px;
    }
.w3-third{
      height: 100%;
      float: left;
      resize: both;
      display: flex;
      flex-direction: column;
}
}
.w3-twothird{
  height: 100%;
  float: left;
  resize: both;
  display: flex;
  flex-direction: column;
}
}
.sendForm{
  resize: both;
}

#body{
  max-width: 100%;
}
#reportAreaContainer{
    display: flex;
    flex-direction: column;
    min-height: 200px;
}
#questionsContainer{
    display: flex;
    flex-direction: column;
}
#reportArea{
  line-height: 1.5;
  width: 100%;
  margin-top: 20px;
  vertical-align: middle;
}

.democlass{
  color:red;
}

</style>

<script>
    ShowNewProblems();
    createTextMenu();

    function getSessionLength(){
        var url = "sessionTime.php";
        httpQuestionAsync(url, showBlankLogout);
    }
    function showBlankLogout(responseText){
      // document.getElementById("questionArea").innerHTML = ""; 
      window.location = "login.php";
    }

    function showAnswerMessage(responseText) {
      document.getElementById("answerMessageContainer").innerHTML = responseText; 
    }

    function showAssignments(responseText) {
      document.getElementById("reportArea").innerHTML = responseText; 
    }

    function showQuestionsInBox(responseText){
      document.getElementById("questionArea").innerHTML = responseText; 
    }

    function httpGetAsync(theUrl, callbackWhenPageLoaded) { 
      var xmlHttp = new XMLHttpRequest();

      xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
          callbackWhenPageLoaded(xmlHttp.responseText);
      }
      xmlHttp.open("GET", theUrl, true); 
      xmlHttp.send(null);
      // resetFieldStyles();
    }

    var numberOfAnswers;
    function submitAnswer(){
      var missingData = false;
      var url = "SubmitAnswer.php";
      numberOfAnswers = document.getElementById("numbAnswers").className;

      var answers = [];
      var answerID = [];
      for(i=1;i<numberOfAnswers;i++){
        if(missingData==false){
        answers[i] =  document.getElementById("question" + i).value;
        answerID[i] = document.getElementById("question" + i).className;
        if(answers[i]==""){
          missingData=true;
          url += "?missingMessage=" + "Please answer all questions..." + "&missing=" + "true";
        }
        else{
        if(i==1)
          url += "?answer1=" + answers[i] + "&answerID1=" + answerID[i];
        else
          url += "&answer" + i + "=" + answers[i] + "&answerID" + i + "=" + answerID[i];
      
        url += "&numberOfAnswers=" + numberOfAnswers + "&missing=" + "false";
      }
    }
  }
      if(missingData==false){
        document.getElementById("questionArea").innerHTML = "";
        var answerMessageDiv = document.createElement("div");
        answerMessageDiv.setAttribute("id", "answerMessageContainer");
        document.getElementById("questionArea").appendChild(answerMessageDiv);
      }
      httpGetAsync(url, showAnswerMessage);
    }

    function httpQuestionAsync(theUrl, callbackWhenPageLoaded) { 
      var xmlHttp = new XMLHttpRequest();

      xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
          callbackWhenPageLoaded(xmlHttp.responseText);
      }
      xmlHttp.open("GET", theUrl, true); 
      xmlHttp.send(null);
      // resetFieldStyles();
    }


    function httpDisplayAsync(theUrl, callbackWhenPageLoaded) { 
      var xmlHttp = new XMLHttpRequest();

      xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
          callbackWhenPageLoaded(xmlHttp.responseText);
      }
      xmlHttp.open("GET", theUrl, true); 
      xmlHttp.send(null);
      // resetFieldStyles();
    }

    function showTextInBox(responseText){
      document.getElementById("bookArea").innerHTML = responseText; 
    }

    function showTextMenu(responseText){
      document.getElementById("textMenu").innerHTML = responseText; 
    }

    function ShowText(){
      var url = "ShowText.php"; 
      var textName = document.getElementById("textMenuID").value;

      url += "?textName=" + textName;

      httpQuestionAsync(url, showTextInBox);
    }

    function createTextMenu(){
      var url = "createTextMenu.php";

      httpGetAsync(url, showTextMenu);
    }

    function ShowNewProblems() {
      
      var url = "ShowNewProblems.php"; 
        
      httpGetAsync(url, showAssignments);
    }

    function SendMessage(){
      var url = "SendMessage.php"; 
      var toUsername = document.getElementById("toUsername").value;
      var fromUsername = document.getElementById("fromUsername").value;
      var subject = document.getElementById("subject").value;
      var body = document.getElementById("body").value;
      
      resetFieldStyles();

      var errorMessage = "Missing data: ";
      var somethingBlank = false;
      if(fromUsername == ""){
        errorMessage += "from";
        somethingBlank = true;
        document.getElementById("fromUsername").style.background = "yellow";
      }

      if(toUsername == "" && somethingBlank == true){
        errorMessage += ", to";
        document.getElementById("toUsername").style.background = "yellow";
      }
      else if(toUsername == ""){
        errorMessage += "to";
        somethingBlank = true;
        document.getElementById("toUsername").style.background = "yellow";
      }

      if(subject == "" && somethingBlank == true){
        errorMessage += ", subject";
        document.getElementById("subject").style.background = "yellow";
      }
      else if(subject == ""){
        errorMessage += "subject";
        somethingBlank = true;
        document.getElementById("subject").style.background = "yellow";
      }

      if(body == "" && somethingBlank == true){
        errorMessage += ", body";
        document.getElementById("body").style.background = "yellow";
      }
      else if(body == ""){
        errorMessage += "body";
        somethingBlank = true;
        document.getElementById("body").style.background = "yellow";
      }

      url += "?fromWho=" + fromUsername + "&toWhom=" + toUsername + "&subject=" + subject + "&body=" + body;

    
      if(errorMessage == "Missing data: ")
        httpGetAsync(url, showResults);
      else{
        alert(errorMessage);
        somethingBlank = false;
        errorMessage = "Missing data: "
      }
    }

    function ShowQuestions(){

      var url = "ShowQuestions.php"; 
      var textName = document.getElementById("textMenuID").value;

      url += "?textName=" + textName;

      httpQuestionAsync(url, showQuestionsInBox);
    }

  </script>



<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content" style="max-width:1400px; margin-left: -10px;">


  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third" style="width:36%;">
    
      <div class="w3-white w3-text-grey w3-card-4" style="height: 620px; overflow: scroll; margin-top: 5px">
        <div class="w3-display-container">

          <h2 style="padding: 0px 2px 0px 10px; margin-bottom: -10px; color: teal"><b><?php echo "Welcome " . $_SESSION['firstName'] . "!" ?></b> <a href="javascript:getSessionLength();"><img src="logout.png" style="float: right; margin-right: 15px; margin-top: 10px; width:40px; height:35px;"></a> </h2> 
        </div>

        <div class="w3-container">
          <h6><b>Assignments</b></h6>
          <p>
            <div class="w3-container w3-card w3-white" style="margin-top: 5px; padding-bottom: 15px;" id="reportAreaContainer" >
              <p id="reportArea"></p>
            </div>
          </form>
          </p>

          <!-- <form action="javascript:ShowNewProblems();" method="GET">
          <input type="submit" value="View Assignments">
          </form> -->
          </p>
          <hr>

          <h6><b>Questions and Reading</b></h6>
          
            Text Name: <div id="textMenu" style="display: inline"></div>
            <form action="javascript:ShowQuestions(); javascript:ShowText();" method="GET">
          <input type="submit" value="View Questions" style="margin-top: 5px">
          </form>
            <div id="questionsContainer">
              <p id="questionArea" style="color: black"></p>
            </div>

          </p>

          <hr>

          <!-- <h6><b>Submit Answers</b></h6>
          <p>
          <form action="javascript:submitAnswer()" method="GET"> 
            <div class="inputElement">Problem Number:  <select id="questionNumber">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
            <textarea rows="2" cols="34" name="body" placeholder="Answer... "; style="margin-bottom: 0px" id="body"></textarea><br>
            <input type="submit" value="View">
          </form>
          </form>
          </p>
          <hr> -->
          
          <h6><b>Ask Questions (NOT FINISHED)</b></h6>
          <p><form action="javascript:SendMessage();" method="GET"> 

            <div class="inputElement"> 

            <textarea rows="2" cols="34" name="body" placeholder="Message... "; style="margin-bottom: -5px; max-width: 100%" id="answer"></textarea></div>
            <input type="submit" value="Send">
          </form>
          </p>
          <hr>

          <h6><b>View Results (NOT FINISHED)</b></h6>
          <p>
            <div class="w3-container w3-card w3-white" style="margin-top: 5px; padding-bottom: 15px;" id="reportAreaContainer" >
              <p id="reportArea"></p>
            </div>
          </form>
          </p>
          <form action="javascript:ShowNewProblems();" method="GET">
          <input type="submit" value="View Assignments" style="margin-bottom: 10px">
          </form>
          </p>

        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird" style="width: 63%; margin: 0 auto;">
  
      <div class="w3-container w3-card w3-white" style="margin-top: 5px; height: 620px;" id="bookContainer" >

          <p id="bookArea"></p>
      </div>
      </div>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center">
 
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html>

