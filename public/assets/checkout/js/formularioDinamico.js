const numeroDeCartao = document.querySelector(".cartao-numero");
const mesDoCartao = document.querySelector(".cartao-mes");
const anoDoCartao = document.querySelector(".cartao-ano");
const cvvDoCartao = document.querySelector(".cartao-cvv");
const nomeDoCartao = document.querySelector(".cartao-nome");

const inputNumeroCartao = document.querySelector("#numero-cartao");
const inputAnoCartao = document.querySelector("#ano");
const inputMesCartao = document.querySelector("#mes");
const inputCVVCartao = document.querySelector("#cvv");
const inputNomeCartao = document.querySelector("#titular");

inputNumeroCartao.addEventListener("input", (event) => {
  let inputNumero = event.target.value;

  inputNumeroCartao.value = inputNumero
    .replace(/\s/g, "")
    .replace(/(\d{4})/g, "$1 ")
    .trim();

  numeroDeCartao.innerText = inputNumeroCartao.value;

  if (numeroDeCartao.innerText == "") {
    return (numeroDeCartao.innerText = "**** **** **** ****");
  }
});

// Inserindo no Cartão o nome
inputNomeCartao.addEventListener("input", (event) => {
  nomeDoCartao.innerText = inputNomeCartao.value;
  if (nomeDoCartao.innerText == "") {
    return (nomeDoCartao.innerText = "**** * * *****");
  }
});

inputAnoCartao.addEventListener("input", (event) => {
  anoDoCartao.innerText = inputAnoCartao.value;
  if (anoDoCartao.innerText == "") {
    return (anoDoCartao.innerText = "00");
  }
});

inputMesCartao.addEventListener("input", (event) => {
  mesDoCartao.innerText = inputMesCartao.value;
  if (mesDoCartao.innerText == "") {
    return (mesDoCartao.innerText = "00");
  }
});

inputCVVCartao.addEventListener("input", (event) => {
  cvvDoCartao.innerText = inputCVVCartao.value;
  if (cvvDoCartao.innerText == "") {
    return (vccDoCartao.innerText = "000");
  }
});
