window.addEventListener('load', ()=>{
    const loadScreen = document.createElement('div');
    loadScreen.classList.add('LoadScreen');
    loadScreen.classList.add('fx-fullCenter');
    loadScreen.classList.add('fx-column');
    loadScreen.innerHTML = `
        <div class="fx-fullCenter">
            <h1>
                <span>MYB</span>
                <div></div>
                <small>Cargando...</small>
            </h1>
        </div>
    `;
    document.querySelector('#body').insertBefore(loadScreen, document.querySelector('#main'));
    setTimeout(() => {
        loadScreen.classList.add('remove');
        setTimeout(()=> {
            body.removeChild(loadScreen);
        }, 1000)
    }, 1500);
})