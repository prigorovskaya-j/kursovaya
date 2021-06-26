// проверка поля на пустоту
let checkInput = inputValue => { return inputValue.trim() === "" ? true : false}

let errors = {};

let showInputError = (input, errorMessage) => {
  if( checkInput(input.val()) ){
    showError(input, errorMessage);
    errors.input = true;
  } else{
    hideError(input);
    delete errors.input;
  }
}

$("input, select, textarea").on("change", function () {
  // showInputError($(this), $(this).attr("data-error-text"));
})

$("#fio").on("change", function () {
  // checkFio( $(this) );
})

$("#phone").on("change", function () {
  checkPhone( $(this) );
})

// =======проверка ФИО=======
function checkFio(fio) {
  if( checkInput(fio.val()) || fio.val().trim().split(' ').length != 3 ){
    showError(fio, "ФИО неверно");
    errors.fio = true;
  } else {
    hideError(fio);
    delete errors.fio;
  }
}

// =======показываем ошибку=======
function showError(field, errorMessage) {
  let errorText = field.next();

  errorText.css("display", "block");
  field.css("borderColor", "#D32F2F");
  errorText.html(errorMessage);
  field.focus();
}

// =======скрываем ошибку=======
function hideError(field) {
  let errorText = field.next();

  field.css("borderColor", "green");
  errorText.css("display", "none");
}

// =======скрываем все ошибки=======
function hideAllError() {
  $(".contact-form input, .contact-form select, .contact-form textarea").each(function () {
    hideError($(this));
    $(this).css("borderColor", "black");
  })
}

// =======проверяем первый вопрос из теста=======
function check_q_1(q_1){
  let q_value = q_1.val();

  hideError(q_1);
  if( checkInput(q_value) ){
    showError(q_1, "Заполните поле");
    errors.q_1 = true;
  } else if( q_value.split(' ').filter(item => item != "").length < 30 ){
    showError(q_1, "Нужно минимум 30 слов");
    delete errors.q_1;
  }
}

$("#q_1").on("change", function () {
  check_q_1($(this));
})

// =======проверяем форму теста =======
function checkTestForm(){
  let q_1 = $("#q_1");
  let fio = $("#fio");

  check_q_1(q_1);
  checkFio(fio);

  if( Object.keys(errors).length === 0 ){
    $(".contact-form")[0].submit();
  }
}

// =======МОДАЛЬНОЕ ОКНО=======
function showModal(modalText, btnCallback){
  $(".modal-wrapper").addClass("active");
  $(".modal-wrapper p").text(modalText);
  $("#yes_modal").on("click", btnCallback);
}

function hideModal(){
  $(".modal-wrapper").removeClass("active");
  $("#yes_modal").off("click");
}

function resetForm() {
  $(".contact-form")[0].reset();
  hideAllError();
}

// =======проверяем форму целиком=======

$(".btn-show-modal").on("click", function(){
  let modalText = $(this).attr("data-modal-text");
  let callback = $(this).attr("data-btn-callback");

  showModal(modalText, eval(callback));
});

$(".modal-btns button, .overlay").on("click", function() {
  console.log("ok");
  hideModal();
})

$(".tooltip").on("mouseenter", function() {
  $(this).find(".tooltip-block").text( $(this).attr("data-tooltip-text") );
  $(this).find(".tooltip-block").addClass("active");
})

$(".tooltip").on("mouseleave", function() {
  setTimeout(() => {
    $(this).find(".tooltip-block").removeClass("active");
  }, 1000);
})