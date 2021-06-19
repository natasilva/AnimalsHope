/* Data automática - Copyright */
const anoAtual = document.querySelector('span#ano-atual')
const data = new Date()
const ano = data.getFullYear()

anoAtual.innerHTML = ano