<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>US Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>
    <script>
      $(document).ready(function () {
        $('button').on('click', gradeQuiz);

        $('.q5-choice').on('click', function () {
          $('.q5-choice').css('background', '');
          $(this).css('background', 'rgb(255, 255, 0)');
          this.classList.add('q5-selected');
        });

        $('.q10-choice').on('click', function () {
          const currentSelected = document.querySelector('.q10-selected');
          if (currentSelected) {
            currentSelected.classList.remove('q10-selected');
          }
          this.classList.add('q10-selected');
        });

        displayQ4Choices();

        // global
        let score = 0;
        let totalAttempts = localStorage.getItem('total_attempts') || 0;

        function displayQ4Choices() {
          let q4ChoicesArray = _.shuffle(['Maine', 'Rhode Island', 'Maryland', 'Delaware']);

          for (let i = 0; i < q4ChoicesArray.length; i += 1) {
            const choice = q4ChoicesArray[i];
            const choiceHtml = `<input type="radio" name="q4" id="${choice}" value="${choice}"><label for="${choice}">${choice}</label>`;
            $('#q4-choices').append(choiceHtml);
          }
        }

        function isFormValid() {
          let isValid = true;
          if ($('#q1').val() === '') {
            isValid = false;
            $('#validation-feedback').html('Question1 was not answered');
          }
          return isValid;
        }

        function rightAnswer(index) {
          $(`#q${index}-feedback`).html('Correct!');
          $(`#q${index}-feedback`).attr('class', 'bg-success text-white');
          $(`#mark-img-${index}`).html('<img src="./img/checkmark.png" alt="checkmark">');
          score += 20;
        }

        function wrongAnswer(index) {
          $(`#q${index}-feedback`).html('Incorrect!');
          $(`#q${index}-feedback`).attr('class', 'bg-warning text-white');
          $(`#mark-img-${index}`).html('<img src="./img/xmark.png" alt="xMark">');
        }

        function gradeQuiz() {
          $('#validation-feedback').html('');
          if (!isFormValid()) {
            return;
          }

          let q1Response = $('#q1').val().toLowerCase();
          let q2Response = $('#q2').val();
          let q4Response = $('input[name=q4]:checked').val();
          let q6Response = $('#q6').val().toLowerCase();
          let q7Response = $('#q7').val();
          let q9Response = $('input[name=q9]:checked').val();

          // question 1
          if (q1Response === 'sacramento') {
            rightAnswer(1);
          }
          else {
            wrongAnswer(1);
          }
          // question 2
          if (q2Response === 'mo') {
            rightAnswer(2);
          }
          else {
            wrongAnswer(2);
          }
          // question 3
          if ($('#Jefferson').is(':checked') && $('#Roosevelt').is(':checked') && !$('#Jackson').is(':checked') && !$('#Franklin').is(':checked')) {
            rightAnswer(3);
          }
          else {
            wrongAnswer(3);
          }

          // question 4
          if (q4Response === 'Rhode Island') {
            rightAnswer(4);
          }
          else {
            wrongAnswer(4);
          }

          // question 5
          if (document.getElementById('seal-2').classList.contains('q5-selected')) {
            rightAnswer(5);
          }
          else {
            wrongAnswer(5);
          }

          // question 6
          if (q6Response === 'new york') {
            rightAnswer(6);
          }
          else {
            wrongAnswer(6);
          }

          // question 7
          if (q7Response === 'ak') {
            rightAnswer(7);
          }
          else {
            wrongAnswer(7);
          }

          // question 8
          if ($('#ny').is(':checked') && $('#ga').is(':checked') && !$('#ca').is(':checked') && !$('#tx').is(':checked')) {
            rightAnswer(8);
          }
          else {
            wrongAnswer(8);
          }

          // question 9
          if (q9Response === 'q9-wyoming') {
            rightAnswer(9);
          }
          else {
            wrongAnswer(9);
          }

          // question 10
          if (document.getElementById('q10-nj').classList.contains('q10-selected')) {
            rightAnswer(10);
          }
          else {
            wrongAnswer(10);
          }

          const scoreElement = document.getElementById('total-score');
          if (score < 80) {
            scoreElement.classList.add('low-score');
          }
          else {
            scoreElement.classList.add('high-score');
            alert('congrats! you got the high score!');
          }

          $('#total-score').html(`Total Score: ${score}`);
          $('#total-attempts').html(`Total Attempts ${++totalAttempts}`);
          localStorage.setItem('total_attempts', totalAttempts);
        }
      });
    </script>
</head>
<body class="text-center">
<h1 class="jumbotron">US Geography Quiz</h1>
<h3><span id="mark-img-1"></span>What is the capital of California?</h3>
<input type="text" id="q1">
<br><br>
<h3 id="validation-feedback" class="bg-danger text-white"></h3>
<div id="q1-feedback"></div>
<br><br>
<h3><span id="mark-img-2"></span>What is the longest river?</h3>
<select id="q2">
    <option value="">Select One</option>
    <option value="ms">Mississippi</option>
    <option value="mo">Missouri</option>
    <option value="co">Colorado</option>
    <option value="de">Delaware</option>
</select>
<br><br>
<div id="q2-feedback"></div>
<br><br>
<h3><span id="mark-img-3"></span>What presidents are carved into Mount Rushmore?</h3>
<input type="checkbox" id="Jackson"> <label for="Jackson">A.Jackson</label>
<input type="checkbox" id="Franklin"> <label for="Franklin">B.Franklin</label>
<input type="checkbox" id="Jefferson"> <label for="Jefferson">T.Jefferson</label>
<input type="checkbox" id="Roosevelt"> <label for="Roosevelt">T.Roosevelt</label>
<br><br>
<div id="q3-feedback"></div>
<br><br>
<h3><span id="mark-img-4"></span>What is the smallest U.S. State?</h3>
<div id="q4-choices"></div>
<br><br>
<div id="q4-feedback"></div>
<br><br>
<h3><span id="mark-img-5"></span>What image is in the Great Seal of the State of California</h3>
<img src="./img/seal1.png" alt="seal 1" class="q5-choice" id="seal-1">
<img src="./img/seal2.png" alt="seal 2" class="q5-choice" id="seal-2">
<img src="./img/seal3.png" alt="seal 3" class="q5-choice" id="seal-3">
<br><br>
<div id="q5-feedback"></div>
<br><br>
<h3><span id="mark-img-6"></span>What is the most populated city in the United States?</h3>
<input type="text" id="q6">
<br><br>
<div id="q6-feedback"></div>
<br><br>
<h3><span id="mark-img-7"></span>What is the largest state?</h3>
<select id="q7">
    <option value="">Select One</option>
    <option value="ca">California</option>
    <option value="tx">Texas</option>
    <option value="az">Arizona</option>
    <option value="ak">Alaska</option>
</select>
<br><br>
<div id="q7-feedback"></div>
<br><br>
<h3><span id="mark-img-8"></span>Which states were among the original 13?</h3>
<input type="checkbox" id="ny"> <label for="ny">New York</label>
<input type="checkbox" id="ga"> <label for="ga">Georgia</label>
<input type="checkbox" id="ca"> <label for="ca">California</label>
<input type="checkbox" id="tx"> <label for="tx">Texas</label>
<br><br>
<div id="q8-feedback"></div>
<br><br>
<h3><span id="mark-img-9"></span>What is the least populated U.S. State?</h3>
<input type="radio" name="q9" id="q9-delaware" value="q9-delaware"><label for="q9-delaware">Delaware</label>
<input type="radio" name="q9" id="q9-florida" value="q9-florida"><label for="q9-florida">Florida</label>
<input type="radio" name="q9" id="q9-arizona" value="q9-arizona"><label for="q9-wyoming">Arizona</label>
<input type="radio" name="q9" id="q9-wyoming" value="q9-wyoming"><label for="q9-wyoming">Wyoming</label>
<br><br>
<div id="q9-feedback"></div>
<br><br>
<h3><span id="mark-img-10"></span>What image is of New Jersey?</h3>
<img src="./img/NJ.png" alt="nj" class="q10-choice" id="q10-nj">
<img src="./img/FL.jpg" alt="fl" class="q10-choice" id="q10-fl">
<br><br>
<div id="q10-feedback"></div>
<br><br>
<button class="btn btn-outline-success">Submit Quiz</button>
<br><br>
<h2 id="total-score" class="text-info"></h2>
<h3 id="total-attempts"></h3>
</body>
</html>
