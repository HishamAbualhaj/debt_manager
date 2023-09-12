// for adding users 
let add = document.querySelector('.add');
// main table page
let main_page = document.querySelector('.data-table');
// details page that contains edit , delete , and report page
let details = document.querySelectorAll('.details');
// just for making one request at a time 
let isClicked = true;
// only one popup page in the website 
let popup_page = false;
// only one dialog box in the website!
let isDialog = false;


function updateAmount() {
    // just requesting the current amount ! 
    let control = document.querySelector('.control-panel');
    let id = control.querySelector('.user_id').value;
    let user_amount = control.querySelector('.user_amount');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `getUserAmount.php?user_id=${id}`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                user_amount.textContent = data;
            }
        }
    }
    xhr.send();
}
details.forEach((td) => {
    td.addEventListener('click', () => {
        if (!popup_page) {

            let page = createPage('div', 'page control-panel', '', main_page);

            createPage('div', 'title', "لوحة التحكم", page);
            let table = createPage('table', 'tablePreview', '', page);
            // getting header 
            let tableHeader = document.querySelector('tbody').firstElementChild;
            let headerCloned = tableHeader.cloneNode(true);
            // table row 
            let tableRow = td.parentElement.cloneNode(true);

            table.appendChild(headerCloned);
            table.appendChild(tableRow);

            // just removing exsiting class and adding new one 
            tableRow.querySelector('.details').classList.add('user_name');
            tableRow.querySelector('.user_name').classList.remove('details');

            // operations delete edit print 
            let operations = createPage('div', 'operations', '', page);

            // create the edit button and select it ! 
            createPage('div', 'edit btn', 'تعديل', operations);
            let edit = document.querySelector('.edit');
            editButtonClick(edit);

            // create the delete button and select it ! 
            createPage('div', 'delete btn', 'حذف', operations);
            let dele = document.querySelector('.delete');
            deleteButtonClick(dele);

            // create the print buttons and select it ! 
            createPage('div', 'show-rep btn', 'التقرير', operations);
            let show = document.querySelector('.show-rep');

            updateAmount();

            show.addEventListener('click', () => {
                let isReport = document.querySelector('.report-view');
                if (isReport === null) {
                    // creating container for report view 
                    report_view = createPage('div', 'report-view', '', page);
                }
                getReport();
                addEventListener("afterprint", () => {
                    getReport();
                });

            });
            // create exsit button for control panel 
            let xForControlPanel = createPage('div', 'exist', 'X', page);
            getBack(xForControlPanel, page);

            animateOpacity(page);

            popup_page = true;
        }
    });
});

// adding data page 
add.addEventListener('click', () => {
    if (!popup_page) {

        // creating the card and adding elements inside of it
        let page = createPage('div', 'page add_page', '', main_page)

        // create title 
        createPage('div', 'title', "إضافة مستخدم", page);

        // create form 
        let form = createPage('form', 'form', '', page, '', '', '')
        // creating rows for the form 
        for (let i = 0; i < 4; i++) {

            let row = createPage('div', 'row', '', form);

            let div = createPage('div', '', '', row);

            if (i == 0) {
                div.textContent = "الإسم";
                createPage('input', 'name', '', row, 'text', 'الإسم', 'name');
            } else if (i == 1) {
                div.textContent = "التاريخ";
                createPage('input', 'date', '', row, 'date', 'التاريخ', 'date');

            } else if (i == 2) {
                div.textContent = "النوع";
                let input = createPage('input', 'type', '', row, 'text', 'النوع', 'type');
                input.value = "دائن";
            } else if (i == 3) {
                div.textContent = "المبلغ";
                let input = createPage('input', 'amount', '', row, 'number', 'المبلغ', 'amount');
                input.value = "00";
            }
        }
        // operations button agree , back , etc 
        let op = createPage('div', 'op', '', form)

        let add_user = createPage('div', 'add-user add-op btn', 'موافق', op, '', '', '')
        let back = createPage('div', 'back btn', 'إغلاق', op)

        // AJAX request for adding user
        add_user.addEventListener('click', add_user_db);

        getBack(back, page);

        // opacity animation on click 
        animateOpacity(page);

        popup_page = true;
    }

});

// adding user to database using ajax !
function add_user_db() {
    let formAdd = document.querySelector('.form');
    formAdd.onsubmit = (e) => {
        e.preventDefault();
    }
    let inputs = document.querySelectorAll('input');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "add_user.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data.replace(/\s/g, "") === "success") {
                    // making inputs empty after insertion 
                    inputs.forEach((input) => {
                        input.value = '';
                    })
                    let warn = createPage('div', 'query-result success', 'تم إضافة المستخدم بنجاح !', formAdd, '', '', '');
                    warn.style.display = 'block';
                    setTimeout(() => {
                        warn.remove();
                    }, 2000)

                } else if (data.replace(/\s/g, "") == "deletedUser") {
                    location.href = '../index.php';
                } else {
                    let warn = createPage('div', 'query-result failed', 'يرجى التأكد من إدخال جميع الحقول ! ', formAdd, '', '', '');
                    warn.style.display = 'block';
                    setTimeout(() => {
                        warn.remove();
                    }, 2000)
                }
            }
        }
    }
    let formData = new FormData(formAdd);
    xhr.send(formData);
}

// edit button event trigger 
function editButtonClick(edit) {

    edit.addEventListener('click', () => {

        //getting user id for editing it !!! 
        let control = document.querySelector('.control-panel');

        let idEdit = control.querySelector('.user_id').value;

        // creating the card and adding elements inside of it
        let page = createPage('div', 'page edit edit-page', '', main_page);

        // create exsit buttom
        let x = createPage('div', 'exist', 'X', page);

        // create title 
        createPage('div', 'title', "تعديل بيانات", page);

        //create the form
        let form = createPage('div', 'form', '', page);

        // selecting the name and the amount for the current row ! 

        let user_name = control.querySelector('.user_name');

        // just requesting the current amount ! 
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `getUserAmount.php?user_id=${idEdit}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    let user_amount = data;

                    // creating the for, rows 
                    for (let i = 0; i < 5; i++) {
                        let row = createPage('div', 'row', '', form);
                        let div = createPage('div', '', '', row)

                        if (i == 0) {
                            div.textContent = 'الإسم';
                            createPage('div', 'name', user_name.textContent, row);

                        } else if (i == 1) {
                            div.textContent = 'المبلغ الحالي';
                            createPage('div', 'amount', user_amount, row);

                        } else if (i == 2) {
                            div.textContent = 'المبلغ الجديد';
                            createPage('input', 'amount_edit', '', row, 'number', 'المبلغ المراد خصمه أو إضافته', 'amount');
                        } else if (i == 3) {
                            div.textContent = 'تاريخ المعاملة';
                            createPage('input', 'transc_date', '', row, 'date', 'تاريخ  المعاملة', 'transc_date');
                        }
                        else if (i == 4) {
                            div.textContent = 'وصف الحالة';
                            createPage('input', 'decription_edit', '', row, 'text', 'وصف حالة المعاملة', 'description');
                        }
                    }

                    // operations button agree , back , etc 
                    let op = createPage('div', 'op', '', form)

                    let add_amount = createPage('div', 'add-amount add-op btn', 'إضافة', op)
                    let off = createPage('div', 'off btn', 'خصم', op)

                    getBack(x, page);

                    // opacity animation on click 
                    animateOpacity(page);

                    // adding the amount for the current one! data base query 
                    add_amount.addEventListener('click', () => {
                        if (!isDialog) {
                            createConfirmDialog('تنبيه', 'هل تريد إضافة الملبغ؟', 'addAmount', idEdit, add_amount);
                            isDialog = true;
                        }
                    }, idEdit);
                    // get the amount off the current one! data base query
                    off.addEventListener('click', () => {
                        if (!isDialog) {
                            createConfirmDialog('تنبيه', 'هل تريد خصم المبلغ؟', 'offAmount', idEdit, add_amount);
                            isDialog = true;
                        }
                    }, idEdit);

                    // preventing add user panel from appearing 
                    popup_page = true;
                }
            }
        }
        xhr.send();
    })
}

// delete page confirm ! 
function deleteButtonClick(del) {
    del.addEventListener('click', () => {
        if (!isDialog) {
            let btnParent = document.querySelector('.control-panel');
            let idDelete = btnParent.querySelector('.user_id').value;
            createConfirmDialog('تنبيه', 'هل تريد حذف مستخدم؟', 'deleteUser', idDelete, del);
            isDialog = true;
        }
    });
}

// deleting a user from the database 
function delete_user_db(id) {
    let userId = id;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `delete_user.php?id=${userId}`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // for somehow the server returns data with double space within it --- data.replace(/\s/g, "") ---
                let data = xhr.response;
                // server response then u can request more 
                isClicked = true;
                if (data.replace(/\s/g, "") === "success") {
                    let control = document.querySelector('.control-panel');
                    control.remove();
                    popup_page = false;
                    location.reload();
                } else if (data.replace(/\s/g, "") == 'deletedUser') {
                    location.href = '../index.php';
                } else {
                    showResultMessage('فشلت العملية !', 'failed');
                }
            }
        }
    }
    xhr.send();
}

// add or remove the amount for the current one ! 
function update_amount_db(update_type, id) {
    let page = document.querySelector('.edit-page');
    let amount = document.querySelector('.amount_edit');
    let transc_date = document.querySelector('.transc_date');
    let description = document.querySelector('.decription_edit');
    let userId = id;
    let xhr = new XMLHttpRequest();
    if (update_type == 'add') {
        xhr.open("POST", `update.php?amount=${amount.value}&id=${userId}&type=${update_type}&transc_date=${transc_date.value}&description=${description.value}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    // server response then u can request more 
                    isClicked = true;
                    if (data.replace(/\s/g, "") === "success") {
                        amount.value = '';
                        description.value = '';
                        showResultMessage('تمت العملية بنجاح', 'success');
                        page.remove();
                        updateAmount();
                    } else if (data.replace(/\s/g, "") == 'deletedUser') {
                        location.href = '../index.php';
                    }
                    else {
                        showResultMessage('فشلت العملية !', 'failed');
                    }
                }
            }
        }
        xhr.send();
    } else if (update_type == 'off') {
        xhr.open("POST", `update.php?amount=${amount.value}&id=${userId}&type=${update_type}&transc_date=${transc_date.value}&description=${description.value}`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    // server response then u can request more 
                    isClicked = true;
                    if (data.replace(/\s/g, "") === "success") {
                        amount.value = '';
                        description.value = '';
                        showResultMessage('تمت العملية بنجاح', 'success');
                        page.remove();
                        updateAmount();
                    } else if (data.replace(/\s/g, "") == 'deletedUser') {
                        location.href = '../index.php';
                    }
                    else {
                        showResultMessage('فشلت العملية !', 'failed');
                    }
                }
            }
        }
        xhr.send();
    }
}
// showing dialog for deleting a transaction 
function deleteTransc() {
    let deleTransc = document.querySelectorAll('.deleTransc');
    if (deleTransc !== null) {
        deleTransc.forEach((btn) => {
            btn.addEventListener('click', () => {
                if (!isDialog) {
                    let id = btn.getAttribute('data-id');
                    createConfirmDialog('تنبيه', 'هل تريد حذف المعاملة ؟', 'deleteTransc', id, btn);
                    isDialog = true;
                }
            })
        });
    }

}
// delete transaction from database
function deleteTransc_db(id) {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `deleteTransaction.php?idTransc=${id}`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // server response then u can request more 
                isClicked = true;
                if (data.replace(/\s/g, "") === 'success') {
                    updateAmount();
                    getReport();
                    showResultMessage('تمت العملية بنجاح', 'success');
                } else {
                    showResultMessage('فشلت العملية !', 'failed');
                }
            }
        }
    }
    xhr.send();
}

// for logout !! 
getUserId();
function getUserId() {
    let logout = document.querySelector('.logout');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'sessionConfig.php', true)
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                logout.querySelector('a').href = `logoutUsers.php?logout_id=${data}`;
            }
        }
    }
    xhr.send();
}


// creating dialog for agree or not for any operation !!! 
function createConfirmDialog(title_name, description, queryType, id, element) {

    let parent = element.parentElement.parentElement;
    let con_page = createPage('div', 'confirm page', '', parent);

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
        if (isClicked) {
            isClicked = false;
            if (queryType === 'addAmount') {
                update_amount_db('add', id);
            } else if (queryType === 'offAmount') {
                update_amount_db('off', id);
            } else if (queryType === 'deleteUser') {
                delete_user_db(id);
            } else if (queryType === 'deleteTransc') {
                deleteTransc_db(id);
            }
        }
    });

    // opacity animation on click 
    animateOpacity(con_page);

    getBack(back, con_page);
}

// opacity animation on click 
function animateOpacity(page) {
    let opacity = 0;
    let timer = setInterval(() => {
        if (opacity > 1) {
            clearInterval(timer);
        } else {
            page.style.opacity = opacity;
            opacity += 0.2;
        }
    }, 5);
}

// showing a message for completing a task
function showResultMessage(title, type) {
    let warn = document.querySelector('.confirm');
    warn.remove();
    // just make sure there is no popup page after confirm !
    isDialog = false;
    let result = document.querySelector('.query-result');
    result.textContent = title;

    if (type == 'success') {
        result.classList.remove('failed');
        result.classList.add(type);
    } else {
        result.classList.add('success');
        result.classList.add(type);
    }
    result.style.display = 'block';
    setTimeout(() => {
        result.textContent = '';
        result.style.display = 'none';
    }, 1500);
}

// create any element and add it to a parent !  
function createPage(type, className, text, parent, type_input, placeholder, name) {
    let page = document.createElement(type);
    page.className = className;
    page.textContent = text;
    page.type = type_input;
    page.placeholder = placeholder;
    parent.appendChild(page);

    // for submitting form !! 
    page.name = name;
    //
    return page;
}

// remove the current popup page 
function getBack(back, page) {
    back.addEventListener('click', () => {
        if (isDialog) {
            let con = document.querySelector('.confirm');
            con.remove();
        }
        // control panel contains every popup page (edit,delete) when cancelling it then popup = false => there is no popup !
        if (page.classList.contains('control-panel') || page.classList.contains('add_page')) {
            popup_page = false;
            isDialog = false;
            location.reload();
        } else {
            popup_page = true;
            isDialog = false;
        }
        page.remove();
    });
};

