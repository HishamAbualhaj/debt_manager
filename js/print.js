function getReport() {
    let report_view = document.querySelector('.report-view');
    // control panel 
    let parent = document.querySelector('.control-panel');
    // user id for getting his report 
    let id = parent.querySelector('.user_id');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `report-print.php?id=${id.value}`, true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                //removing white space from string 
                if (data.replace(/\s/g, "") === 'empty') {
                    report_view.innerHTML = "";
                    let noReport = document.querySelector('.noReport');
                    if (noReport === null) {
                        let warn = document.createElement('div');
                        warn.textContent = 'لا يوجد معاملات لهذا المستخدم';
                        warn.className = 'noReport';
                        document.querySelector('.title').after(warn);
                        setTimeout(() => {
                            warn.remove();
                        }, 1500);
                    } else {
                        setTimeout(() => {
                            noReport.remove();
                        }, 1500);
                    }
                } else {
                    report_view.innerHTML = data;

                    deleteTransc();
                }
                // adding print button
                let print = document.querySelector('.print-rep');
                if (print !== null) {
                    print.addEventListener('click', () => {
                        arrangeTable();
                        window.print();
                    });
                }
                // adding exist button 
                let xForReport = document.querySelector('.report-exist');
                if (xForReport !== null) {
                    getBack(xForReport, report_view);
                }
            }
        }
    }
    xhr.send();
}

function arrangeTable() {

    let rows = document.querySelector('.report-table').querySelectorAll('.deleTransc');
    let rowlength = document.querySelector('.report-table').querySelectorAll('tr').length;
    let len = 0;

    // if row numbers exceed 19 then split pages
    if (rowlength >= 19) {
        // lines of rows that can be formatted in a single page ..
        // start after 19 row 
        rowlength = rowlength - 19;
        // every page contains 24 rows but first page contains 19 rows
        len = rowlength / 24;
        let counter = 19;

        for (let i = 0; i < Math.ceil(len); i++) {
            let table = createNewTable();
            // splitting rows 
            rows.forEach((row) => {
                // making sure that number of row between 19 and next iteration 
                if (row.getAttribute('data-number') > counter && row.getAttribute('data-number') <= (counter + 24)) {
                    let selectedRow = row.parentElement.cloneNode(true);
                    table.appendChild(selectedRow);
                    row.parentElement.remove();
                }
            });
            // go for next table !
            counter = counter + 24;
            // selecting last element and adding table after it ! 
            let reportView = document.querySelector('.report-view');
            let lastEle = reportView.children[reportView.children.length - 2];
            if(table.children.length > 1) {
                lastEle.after(table);
            }
            
        }

    }

    // getting new table formate 
    function createNewTable() {
        // cloning table from current one 
        let table = document.querySelector('.report-table').cloneNode(false);
        table.classList.add('newTable');
        table.classList.remove('report-table');
        let tableHeader = document.querySelector('.table_header').cloneNode(true);
        table.appendChild(tableHeader);

        return table;
    }
}
