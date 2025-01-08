// Модалка заявки
const questionnaireModal = document.getElementById('modal-questionnaire')
const questionnaireOpenButton = document.getElementById('questionnaire')
const questionnaireCloseButton = document.getElementById('close-questionnaire')

// Модалка авторизации

const authModal = document.getElementById('auth-modal')
const closeAuthModal = document.getElementById('close-auth')
const openAuthModal = document.getElementById('auth')

const bodyToggleOverflow = () => {
    if (document.getElementById('modal-shadows')) {
        document.getElementById('modal-shadows').remove()
        return
    }

    const modalShadows = document.createElement('div')
    modalShadows.id = 'modal-shadows'

    modalShadows.style.width = '100vw'
    modalShadows.style.height = '100%'
    modalShadows.style.opacity = '0.7'
    modalShadows.style.background = 'black'
    modalShadows.style.zIndex = "90"
    modalShadows.style.position = 'absolute'
    modalShadows.style.top = '0'
    modalShadows.style.left = '0'

    modalShadows.addEventListener('click', () => {
        questionnaireModal.classList.add('close-right-modal')
        authModal.classList.add('close-center-modal')
        authModal.style.transform = 'translateY(-40px)'
        bodyToggleOverflow()
    })

    document.body.append(modalShadows)
}

questionnaireOpenButton.addEventListener('click', () => {
    questionnaireModal.classList.remove('close-right-modal')
    questionnaireModal.style.zIndex = '999';
    bodyToggleOverflow()
})

questionnaireCloseButton.addEventListener('click', () => {
    questionnaireModal.classList.add('close-right-modal')
    questionnaireModal.style.zIndex = '0';
    bodyToggleOverflow()
})

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        questionnaireModal.classList.add('close-right-modal')
        authModal.classList.add('close-center-modal')
        authModal.style.transform = 'translateY(-40px)'
        bodyToggleOverflow()
    }
})

openAuthModal.addEventListener('click', () => {
    authModal.classList.remove('close-center-modal')
    authModal.style.zIndex = '999';

    setTimeout(() => {
        authModal.style.transform = 'translateY(0px)'
    }, 2)

    bodyToggleOverflow()
})

closeAuthModal.addEventListener('click', () => {
    authModal.classList.add('close-center-modal')
    authModal.style.transform = 'translateY(-40px)'
    authModal.style.zIndex = '0';
    bodyToggleOverflow()
})