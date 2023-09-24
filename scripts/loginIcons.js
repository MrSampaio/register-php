let inputs = document.querySelectorAll('.input');

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
let eyes = document.getElementById('eye-icon');

eyes.addEventListener('click', ()=>{ // ouvinte de eventos para clique no ícone relacionado

    let pswd = eyes.previousElementSibling; // retorna o input relacionado a cada olho

    if(eyes.textContent === 'visibility_off'){ // testa qual o ícone pelo texto que contem a tag
        pswd.type = 'text'; // modifica o tipo de input
        eyes.textContent = 'visibility'; // remove a visibilidade
    } else{
        pswd.type = 'password';
        eyes.textContent = 'visibility_off';
    }
})