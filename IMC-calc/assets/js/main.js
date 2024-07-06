const form = document.querySelector('form#form');
const submit = form.querySelector('input#submit');

const inputWeight = document.querySelector('input#peso');
const inputHeight = document.querySelector('input#altura');
const card = document.querySelector('div.card');


form.addEventListener('submit', handleSubmit);
submit.addEventListener('click', handleSubmit);

function handleSubmit(e) {
  e.preventDefault();
  const weight = inputWeight.value;
  const height = inputHeight.value;

  imcScore = calculateIMC(weight, height);
  setResults(imcScore);
}

function calculateIMC(weight, height) {
  if (weight <= 0) {
    return -1;
  }
  if (height <= 0) {
    return -2;
  }

  heightInMeters = height / 100;
  imcValue = weight / (heightInMeters**2);
  imcValue = imcValue.toFixed(1);

  
  return imcValue;
}

const status = {
  underWeight: 'Sous le poids',
  normal: 'Poids normal',
  overweight: 'En surpoids',
  obesity1: 'Obésité de grade 1',
  obesity2: 'Obésité de grade 2',
  obesity3: 'Obésité de grade 3',
  invalidWeight: 'Poids invalide',
  invalidHeight: 'Taille invalide'
}

function setResults(imc) {
  var cardScore = card.querySelector('span.score');
  var cardStatus = card.querySelector('span.status');

  cardScore.innerText = imc;

  var [statusText, color] = getStatus(imc);
  cardStatus.innerText = statusText;
  setCardColor(color);
  document.activeElement && document.activeElement.blur();
  setTimeout(() => {
    if (window.innerWidth <= 930) {
      location.href="#results";
    }
  }, 300) 
}

function getStatus(imc) {
  if (imc == -1) {
    return [status.invalidWeight, '']
  }
  if (imc == -2)  {
    return [status.invalidHeight, '']
  }
  if(imc < 18.5) {
    return [status.underWeight, 'yellow'];
  }
  if (imc >= 18.5 && imc <= 24.9) {
    return [status.normal, 'green'];
  }
  if (imc >= 25 && imc <= 29.9) {
    return [status.overweight, 'yellow'];
  }
  if (imc >= 30 && imc <= 34.9) {
    return [status.obesity1, 'red'];
  }
  if (imc >= 35 && imc <= 39.9) {
    return [status.obesity2, 'red'];
  }
  if (imc >= 40) {
    return [status.obesity3, 'red'];
  }
}

function setCardColor(color) {
  if (color) {
    card.className = `card ${color}`;
  }
  else {
    card.className = 'card default'
  }
}