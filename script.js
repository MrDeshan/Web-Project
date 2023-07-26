document.addEventListener("DOMContentLoaded", function() {
    var weightInput = document.getElementById("weight");
    var heightInput = document.getElementById("height");
    var resultContainer = document.getElementById("result");
  
    function calculateBMI() {
      var weight = parseFloat(weightInput.value);
      var height = parseFloat(heightInput.value);
      var bmi = weight / ((height / 100) * (height / 100));
      resultContainer.innerHTML = "<div class='result-text'>Your BMI: " + bmi.toFixed(2) + "</div>";
    }
  
    weightInput.addEventListener("input", calculateBMI);
    heightInput.addEventListener("input", calculateBMI);
  });
  