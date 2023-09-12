let loginAdmin = document.querySelector('.loginAdmin');
let loginUser = document.querySelector('.loginUser');

let container = document.querySelector('.container');

if (!(loginAdmin === null)) {
    loginAdmin.addEventListener('click', () => {
        
        // selecting the form 
        let formAdmin = document.querySelector('.admin-form')
        formAdmin.onsubmit = (e) => {
            e.preventDefault();
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'loginAdminConfig.php', true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == 'success') {
                        location.href = 'adminAdd.php';
                    }else {
                        showWarn(data);
                    }
                }
            }
        }
        let formData = new FormData(formAdmin);
        xhr.send(formData);
    })
}

if (!(loginUser === null)) {
    loginUser.addEventListener('click', () => {
        // selecting the form 
        let formUsers = document.querySelector('.users-form')
        formUsers.onsubmit = (e) => {
            e.preventDefault();
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/loginUsersConfig.php', true)
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (data == 'success') {
                        location.href = 'php/userPanel.php';
                    }else {
                        showWarn(data);
                    }
                }
            }
        }
        let formData = new FormData(formUsers);
        xhr.send(formData);
    })
}

function showWarn(text) {
    let warn = document.createElement('div');
    warn.className = 'queryResult failed';
    warn.textContent = text;
    warn.style.width = '100%';
    warn.style.textAlign = 'center';
    container.appendChild(warn);

    setTimeout(() => {
        warn.remove();
    },1200)
}