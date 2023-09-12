let adminPage = document.querySelector('.admin-panel');

// for getting admin id for loging out !! 
getAdminId();
function getAdminId() {
    let logout = document.querySelector('.logout');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'sessionConfig.php', true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                logout.querySelector('a').href = `logoutAdmin.php?logout_id=${data}`;
            }
        }
    }
    xhr.send();
}
////

let add_user = document.querySelector('.add-user');

if (!(add_user === null)) {
    add_user.addEventListener('click', addMainUser);
}
function addMainUser() {
    let formUsers = document.querySelector('.form-users');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'addMainUser.php', true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                let warn = document.createElement('div');
                if (data === 'success') {
                    warn.className = 'queryResult success';
                    warn.textContent = "تم إضافة المستخدم بنجاح";
                    formUsers.appendChild(warn);
                    emptyFields(formUsers);
                } else if (data === 'userFound') {
                    warn.className = 'queryResult failed';
                    warn.textContent = 'اسم المستخدم موجود بالفعل';
                    formUsers.appendChild(warn);
                } else if (data === 'failed') {
                    warn.className = 'queryResult failed';
                    warn.textContent = 'أدخل الحقول المطلوبة';
                    formUsers.appendChild(warn);
                }
                setTimeout(() => {
                    warn.remove();
                }, 1500);
            }
        }
    }
    let fomrdata = new FormData(formUsers);
    xhr.send(fomrdata);
}

// making fields empty !! 
function emptyFields(form) {
    let inputs = form.querySelectorAll('input');
    inputs.forEach((input) => {
        input.value = '';
    })
}

// Deleting main users from all database !
let deleUser = document.querySelectorAll('.deleBtn');
if (!(deleUser === null)) {
    deleUser.forEach((btn) => {
        btn.addEventListener('click', () => {

            
            let row = btn.parentElement.parentElement;
            let userId = row.querySelector('.userId').value;
            createConfirmDialog('تنبيه', 'هل تريد حذف المستخدم ؟', 'deleteUser', userId)

        })
    })
}


// creating dialog for agree or not for any operation !!! 
function createConfirmDialog(title_name, description, queryType, id) {

    let con_page = createPage('div', 'confirm page', '', adminPage);

    createPage('div', 'title', title_name, con_page);

    let para = document.createElement('p');
    para.textContent = description;
    con_page.appendChild(para);

    // operations button agree , back , etc 
    let op = createPage('div', 'op', '', con_page)

    let agree = createPage('div', 'db_query btn', 'موافق', op)

    // back => cancel the dialog!
    let back = createPage('div', 'back btn', 'لا', op)

    agree.addEventListener('click', () => {
       if (queryType === 'deleteUser') {
            deleteConfirm(id);
        }
    });

    getBack(back, con_page);
}

function deleteConfirm(userId) {
    // put result page after it ! 
    let tabs = document.querySelector('.tabs');
    // remove this after successfully deletion ! 
    let confirm = document.querySelector('.confirm');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `deleteMainUser.php?userId=${userId}`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                let warn = document.createElement('div');
                warn.className = 'queryResult';
                warn.style.marginTop = '15px';
                tabs.after(warn);
                if (data === 'success') {
                    warn.textContent = 'تم حذف المستخدم بنجاح';
                    warn.classList.add('success');
                    confirm.remove();
                    location.reload();
                } else {
                    warn.textContent = 'حدث خطأ ما';
                    warn.classList.add('failed');
                }
                setTimeout(() => {
                    warn.remove();
                }, 1200)
            }
        }
    }
    xhr.send();
}

// create any element and add it to a parent !  
function createPage(type, className, text, parent) {
    let page = document.createElement(type);
    page.className = className;
    page.textContent = text;
    parent.appendChild(page);

    return page;
}


// remove the current popup page 
function getBack(back, page) {
    back.addEventListener('click', () => {

        let con = document.querySelector('.confirm');
        con.remove();
        page.remove();

    });
}