today = new Date();
currentMonth = today.getMonth();
currentYear = today.getFullYear();
selectYear = document.getElementById("year");
selectMonth = document.getElementById("month");

months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
    $("td").click(function () {

        $('.schedule').css('display', 'block');
        $('.schedule_edit').css('display', 'none');

        for(var i=0; i<=31; i++){
            $('input.checked_day[value=' + i + ']').prop('checked', false);
        }

        var value = $(this).text();
        $('input.checked_day[value=' + value + ']').prop('checked', true);

        getYear();
        getMonth();

        var year = $(".year").attr('value');
        var month = $(".month").attr('value');
        var day = $(this).text();

        $(".from_db").each(function() {
            var name1 = $(this).attr('name');
            var date_db = $(this).find('.date_db').attr('value');
            var split_year = date_db.split("-")[0];
            var split_month = date_db.split("-")[1];
            var split_day = date_db.split("-")[2];
            var name = $(this).find('.name_db').attr('value');
            if(split_year == year && split_month == month && split_day == day){

                $(".name_db").each(function() {
                    if($(this).attr('value') == name){
                        $('#event_edit').attr('value', name);
                    }
                }); 
    
                $('#date_edit').attr('value', year + "-" + month + "-" + day);
                $('.event').text(name1);
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'block');
                $('.delete').attr('action', '/delete-schedule/' + date_db)
            }   

        });

        $('#date').attr('value', year + "-" + month + "-" + day);

    });
    checkBusy();
    clicableTd();
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
    $("td").click(function () {

        $('.schedule').css('display', 'block');
        $('.schedule_edit').css('display', 'none');

        for(var i=0; i<=31; i++){
            $('input.checked_day[value=' + i + ']').prop('checked', false);
        }

        var value = $(this).text();
        $('input.checked_day[value=' + value + ']').prop('checked', true);

        getYear();
        getMonth();

        var year = $(".year").attr('value');
        var month = $(".month").attr('value');
        var day = $(this).text();

        $(".from_db").each(function() {
            var name1 = $(this).attr('name');
            var date_db = $(this).find('.date_db').attr('value');
            var split_year = date_db.split("-")[0];
            var split_month = date_db.split("-")[1];
            var split_day = date_db.split("-")[2];
            var name = $(this).find('.name_db').attr('value');
            if(split_year == year && split_month == month && split_day == day){

                $(".name_db").each(function() {
                    if($(this).attr('value') == name){
                        $('#event_edit').attr('value', name);
                    }
                }); 
    
                $('#date_edit').attr('value', year + "-" + month + "-" + day);
                $('.event').text(name1);
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'block');
                $('.delete').attr('action', '/delete-schedule/' + date_db)
            }   

        });

        $('#date').attr('value', year + "-" + month + "-" + day);

    });
    checkBusy();
    clicableTd();
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
    $("td").click(function () {

        $('.schedule').css('display', 'block');
        $('.schedule_edit').css('display', 'none');

        for(var i=0; i<=31; i++){
            $('input.checked_day[value=' + i + ']').prop('checked', false);
        }

        var value = $(this).text();
        $('input.checked_day[value=' + value + ']').prop('checked', true);

        getYear();
        getMonth();

        var year = $(".year").attr('value');
        var month = $(".month").attr('value');
        var day = $(this).text();

        $(".from_db").each(function() {
            var name1 = $(this).attr('name');
            var date_db = $(this).find('.date_db').attr('value');
            var split_year = date_db.split("-")[0];
            var split_month = date_db.split("-")[1];
            var split_day = date_db.split("-")[2];
            var name = $(this).find('.name_db').attr('value');
            if(split_year == year && split_month == month && split_day == day){

                $(".name_db").each(function() {
                    if($(this).attr('value') == name){
                        $('#event_edit').attr('value', name);
                    }
                }); 
    
                $('#date_edit').attr('value', year + "-" + month + "-" + day);
                $('.event').text(name1);
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'block');
                $('.delete').attr('action', '/delete-schedule/' + date_db)
            }   

        });

        $('#date').attr('value', year + "-" + month + "-" + day);

    });
    checkBusy();
    clicableTd();
}

function showCalendar(month, year) {

    $('.year').attr('value', year);
    $('.month').attr('value', month+1);

    let firstDay = (new Date(year, month)).getDay();

    tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                cell = document.createElement("td");
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            else if (date > daysInMonth(month, year)) {
                break;
            }

            else {
                cell = document.createElement("td");
                cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-info");
                } // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

}


// check how many days in a month code from https://dzone.com/articles/determining-number-days-month
function daysInMonth(iMonth, iYear) {
    return 32 - new Date(iYear, iMonth, 32).getDate();
}




function getYear(){
    var year = $(".year").attr('value');
}

function getMonth(){
    var month = $(".month").attr('value');
}

    $("td").click(function () {

        $('.schedule').css('display', 'block');
        $('.schedule_edit').css('display', 'none');

        for(var i=0; i<=31; i++){
            $('input.checked_day[value=' + i + ']').prop('checked', false);
        }

        var value = $(this).text();
        $('input.checked_day[value=' + value + ']').prop('checked', true);

        getYear();
        getMonth();

        var year = $(".year").attr('value');
        var month = $(".month").attr('value');
        var day = $(this).text();

        $(".from_db").each(function() {
            var name1 = $(this).attr('name');
            var date_db = $(this).find('.date_db').attr('value');
            var split_year = date_db.split("-")[0];
            var split_month = date_db.split("-")[1];
            var split_day = date_db.split("-")[2];
            var name = $(this).find('.name_db').attr('value');
            if(split_year == year && split_month == month && split_day == day){

                $(".name_db").each(function() {
                    if($(this).attr('value') == name){
                        $('#event_edit').attr('value', name);
                    }
                }); 
    
                $('#date_edit').attr('value', year + "-" + month + "-" + day);
                $('.event').text(name1);
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'block');
                $('.delete').attr('action', '/delete-schedule/' + date_db)
            }   

        });

        $('#date').attr('value', year + "-" + month + "-" + day);

    });




    function checkBusy(){
    $(".from_db").each(function() {
        var date_db = $(this).find('.date_db').attr('value');
        var split_year = date_db.split("-")[0];
        var split_month = date_db.split("-")[1];
        var split_day = date_db.split("-")[2];

        var now_year = $('.year').attr('value');
        var now_month = $('.month').attr('value');

        if(now_month == split_month && now_year == split_year){
        $('td').each(function() {
            var text = $(this).text();
            if(text == split_day){
                $(this).css("background-color", "red");
            }
        });
        }

    });
    }

    checkBusy();



    function clicableTd(){
        var d = new Date();
        day = d.getDate();
        m = d.getMonth()+1;
        y = d.getFullYear();

        var now_month = $('.month').attr('value');
        var now_year = $('.year').attr('value'); 

        $('td').click(function() {
            var td_day = $(this).text();
            if(td_day < day && m == now_month && y == now_year){
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'none');
            }
           else if(td_day <= 31 && m > now_month && y >= now_year){
                $('.schedule').css('display', 'none');
                $('.schedule_edit').css('display', 'none');
            }
        });
    }   

    clicableTd();