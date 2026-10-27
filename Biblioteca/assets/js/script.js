const viem = document.querySelector(".aba");
const conteudo = document.querySelector(".conteudo");
const text = document.querySelectorAll(".text");

viem.addEventListener("mouseover", e => {

    viem.style.width = "17%";
    conteudo.style.width = "83%";
    text.forEach(t => t.style.width = "150px");
    text.forEach(t => t.style.marginLeft = "15px");

});

viem.addEventListener("mouseout", e => {

    viem.style.width = "8%";
    conteudo.style.width = "92%";

});