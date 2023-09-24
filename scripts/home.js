let disableButton = document.getElementById('submit-button')
let saveButton = document.getElementById('save-button')
let reloadButton = document.getElementById('reload-button')

let inputs = document.querySelectorAll(".input")

disableButton.addEventListener('click', ()=>{

    inputs.forEach(input =>{
        input.disabled = false;
        disableButton.hidden = true;
        saveButton.hidden = false;
        reloadButton.hidden = false;
    })
    
})

reloadButton.addEventListener('click', ()=>{
    inputs.forEach(input =>{
        input.disabled = true;
        saveButton.hidden = true;
        disableButton.hidden = false;
        reloadButton.hidden = true;
    })
})


inputs.forEach(input =>{ // para cada elemento encontrado, terá o nome de "input"
    let icon = input.parentElement.querySelector('#icon'); // retorna o ícone relacionado a cada input

    input.addEventListener('focus', ()=>{ //ouvinte de evento para quando o input está em foco
        icon.style.color = 'rgb(255, 132, 153)';  // muda a cor do ícone quando o input
    })

    input.addEventListener('blur', ()=>{
        icon.style.color = '';
    })
})

// *******************************************
let eyes = document.querySelectorAll('.eye');

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

