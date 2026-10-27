const pai = document.querySelector(".tableL");
const modalLivro = document.querySelector(".modalLivro");

pai.addEventListener("click", e => {
    const linha = e.target.closest(".livros");

    if(linha){
        const td = linha.querySelectorAll(".td");

        const nome = td[0].textContent;
        
    }

    modalLivro.showModal();
});

function sucessoLivro(){
    window.alert("Sucesso ao atualizar livro!");
};

document.getElementById("voltar").addEventListener("click", e => {
    modalLivro.close();
});