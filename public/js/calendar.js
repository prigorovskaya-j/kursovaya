$("#birthday").on("click", () => {
  $("#calendar").toggleClass("active");
});

daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
allMonth = ["January", "February", "March", "April", "May", "June", "Jule", "August", "September", "October", "November", "December"]

let date = new Date();

function DrawCalendar(year, month) {
  let dayInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

  let lastDayOfWeek = 1;
  thisDayInMonth = month;

  let startDay = new Date(year, month, 1).getDay(); // день с которого начинается месяц
  let spacesDay = startDay - 1 === -1 ? 6 : startDay - 1;

  let dayInSelectedMonth;

  if( thisDayInMonth === 1 && year % 4 === 0 ){
    dayInSelectedMonth = dayInMonth[thisDayInMonth] + spacesDay + 2;
  } else {
    dayInSelectedMonth = dayInMonth[thisDayInMonth] + spacesDay + 1;
  }

  // Очищаем календарь
  $("#days").children().remove();
  // Формируем календарь
  $("#days").append(`
  <table>
  <tr class="not-hover">
    <td>Mon</td>
    <td>Tue</td>
    <td>Wed</td>
    <td>Thu</td>
    <td>Fri</td>
    <td>Sat</td>
    <td>Sun</td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  </table>
  `)

  for (let i = 0; i < 6; i++) {
    for (let j = lastDayOfWeek; j < dayInSelectedMonth; j++) {
      lastDayOfWeek = j + 1;
      day = j - spacesDay;
      let createdTD =  $( `<td>${(spacesDay + 1 > j ? "" : day)}</td>` );

      if( day === date.getDate() && month === date.getMonth() && year === date.getFullYear() ){
        createdTD.addClass("active");
      }

      if( spacesDay + 1 > j ){
        createdTD.addClass("not-hover");
      } else {
        createdTD.addClass("clicked");
      }

      $("#days tr").eq(i + 1).append(createdTD);

      if( j % 7 === 0 && j !== 0 ) break;
    }
  }

  $(".clicked").on("click", function(){  
    let day = $(this).text();
    let month = $("#selectMonth")[0].selectedIndex + 1;
    let year = $("#selectYear").val();

    day < 10 ? day = "0" + day : day;
    month < 10 ? month = "0" + month : month;
    year < 10 ? year = "0" + year : year;

    $("#birthday").val( day + "."  + month + "." + year );
    $("#calendar").removeClass("active");
  })
}

$(document).ready(function () {
  $("#selectYear, #selectMonth").on("change", () => {
    DrawCalendar( $("#selectYear").val(), $("#selectMonth")[0].selectedIndex );
  })

  $("#today_day_of_week").on("click", () => {
    DrawCalendar(date.getFullYear(), date.getMonth());
    $("#selectMonth")[0].selectedIndex = date.getMonth();
    $("#selectYear").val( date.getFullYear() );
  })

  DrawCalendar(date.getFullYear(), date.getMonth());
  $("#selectMonth")[0].selectedIndex = date.getMonth();
  $("#selectYear").val( date.getFullYear() );
  $("#today_day_of_week").html(daysOfWeek[date.getDay() - 1] + " " + date.getDate());
})