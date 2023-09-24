
let inputs = document.querySelectorAll(".input");

inputs.forEach(input =>{ // para cada elemento encontrado, terá o nome de "input"
    let inputIcon = input.parentElement.querySelector("#icon"); // retorna o ícone relacionado a cada input

    input.addEventListener('focus', ()=>{ // ouvinte de evento para quando o input está em foco
        inputIcon.style.color = 'rgb(255, 132, 153)'; // muda a cor do ícone quando o input
    })

    input.addEventListener('blur', ()=>{
        inputIcon.style.color = ''; // remove a cor do input ao sair de foco
    })    
})

// *******************************************************************************************

let eyes = document.querySelectorAll('#eye-icon');

eyes.forEach(eye =>{ // para cada elemento encontrado, definirá o nome como "eye"
    eye.addEventListener("click", ()=>{ // ouvinte de eventos para clique no ícone relacionado

        let pswdInput = eye.previousElementSibling; // retorna o input relacionado a cada olho

        if(eye.textContent === "visibility"){ // testa qual o ícone pelo texto que contem a tag
            eye.textContent = "visibility_off"; // remove a visibilidade
            pswdInput.type = "password" // modifica o tipo de input

        } else{
            eye.textContent = "visibility";
            pswdInput.type = "text";

        }
    })
})







