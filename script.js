const pButton = document.getElementById('parent-btn')
const formElements = document.getElementById('login-form')
const bButton = document.getElementById('back')
 
pButton.addEventListener('click', startLogin)
tButton.addEventListener('click', startLogin)
bButton.addEventListener('click', backSelect)
register.addEventListener('click', registerForm)

function startLogin(){
    pButton.classList.add('hide')
    formElements.classList.remove('hide')
}

function backSelect(){
    pButton.classList.remove('hide')
    formElements.classList.add('hide')

}

