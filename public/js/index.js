// ============Подменю===========
function showSubMenu(e) {
    console.log("Ok")
    if ($(this).children().length > 1) {
        $(this).find(".sub-menu").css("display", "grid");
    } else {
        return false;
    }
}

function hideSubMenu(e) {
    if ($(this).children().length > 1) {
        $(this).find(".sub-menu").css("display", "none");
    } else {
        return false;
    }
}


// ============Время============
let month = "";

let russianMonthName = ["январь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сентябрь", "октябрь", "ноябрь", "декабрь"]

function drawTime() {
    let date = new Date();

    let h = date.getHours();
    let m = date.getMinutes();
    let s = date.getSeconds();

    s < 10 ? s = "0" + s : s;
    m < 10 ? m = "0" + m : m;
    h < 10 ? h = "0" + h : h;

    time.innerHTML = `${h}:${m}:${s} ${date.getDate()} ${russianMonthName[date.getMonth()]} ${date.getFullYear()}`;
}

let timerId = setInterval(() => {
    drawTime();
}, 1000);

$(document).ready(function () {
    let thisHistory, globalHistory;

    let pathname = document.location.pathname; // адрес текущей страницы
    pathname = pathname.slice(pathname.lastIndexOf("/"), pathname.length);

    drawTime();
    saveThisHistory(pathname);
    saveGlobalHistory(pathname);
    if (pathname === "/history") drawHistoryTable();

    $("#menu li").each(function () {
        let thisURL = $(this).children().first();

        if (thisURL.attr("href") === pathname) {
            thisURL.addClass("active");
        }
    })
})

// =================История просмотра================
function saveThisHistory(pathname) {
    if (sessionStorage.getItem('thisHistory') === null) {
        thisHistory = {};
        sessionStorage.setItem('thisHistory', JSON.stringify(thisHistory));
    }

    thisHistory = JSON.parse(sessionStorage.getItem('thisHistory'));
    thisHistory[pathname] === undefined ? thisHistory[pathname] = 1 : thisHistory[pathname]++;
    sessionStorage.setItem('thisHistory', JSON.stringify(thisHistory));
}

function saveGlobalHistory(pathname) {
    if (localStorage.getItem('globalHistory') === null) {
        globalHistory = {};
        localStorage.setItem('globalHistory', JSON.stringify(globalHistory));
    }

    globalHistory = JSON.parse(localStorage.getItem('globalHistory'));
    globalHistory[pathname] === undefined ? globalHistory[pathname] = 1 : globalHistory[pathname]++;
    localStorage.setItem('globalHistory', JSON.stringify(globalHistory));
}

// Рисуем таблицу для истории
function drawHistoryTable() {
    $("#menu>li").each(function () {
        let link = $(this).children().first();
        let linkSrc = link.attr("href");

        $("#history_table").children()[0].insertAdjacentHTML("afterend",
            `<tr>
      <td>${link.text()}</td>
      <td>${thisHistory[linkSrc] || "0"}</td>
      <td>${globalHistory[linkSrc] || "0"}</td>
    </tr>
    `);
    });
}

function drawActiveImg(idActiveImg, firstOpen) {
    if (idActiveImg <= 0) {
        $(".prev-img").addClass("disabled");
    } else $(".prev-img").removeClass("disabled");

    if (idActiveImg >= 14) {
        $(".next-img").addClass("disabled");
    } else $(".next-img").removeClass("disabled");

    let srcClickedImg = $(`.foto_img[data-img-id=${idActiveImg}]`).attr("src");
    let textClickedImg = $(`.foto_img[data-img-id=${idActiveImg}]`).attr("title");

    $(".num-this-img").text(idActiveImg + 1);

    if (firstOpen) {
        $("#album_img img").prop("src", srcClickedImg);
        $("#album_img>span").text(textClickedImg);
    } else {
        $("#album_img>span").fadeOut();
        $("#album_img img").fadeOut(400, "swing", function () {
            $("#album_img img").prop("src", srcClickedImg).fadeIn();
            $("#album_img>span").text(textClickedImg).fadeIn();
        }, false);
    }

}

function attachScript(id, src) {
    let element = document.createElement("script")
    element.src = src
    element.id = id
    document.getElementsByTagName("head")[0].appendChild(element)
}

function sendXHRRequset(method, url, body = null) {
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest()

        xhr.open(method, url)
        xhr.responseType = "text"

        xhr.onload = () => {
            if (xhr.status >= 400) {
                reject(xhr.response)
            } else resolve(xhr.response)
        }

        xhr.onerror = () => {
            reject(xhr.response)
        }

        xhr.send(body)
    })
}

function sendFetchRequest(method, url, body = null) {
    const headers = {}

    return fetch(url, {
        method: method,
        body: body,
        headers: headers
    }).then((response) => {
        if (response.ok) {
            return response.json()
        }

        return response.json().catch((error) => {
            const e = new Error("Что-то пошло не так")
            e.data = error
            throw e
        })
    })
}

function formattingFormData(_this) {
    let formData = new FormData(_this[0]);
    let error = [];
    let supportedFormatsImg = ["image/png", "image/jpg", "image/jpeg"];

    formData.forEach((item, i) => {
        if (typeof item === "object") {
            if (supportedFormatsImg.includes(item.type)) {
                formData.set(i.toString(), item.name);
            } else {
                error.push("Неверный формат файла");
            }
        }
    })

    if (error.length > 0) {
        swal({
            title: "Ошибка",
            text: error[0],
            icon: "error",
        });
        return false;
    } else return formData;
}

function showModal(modal = $(".modal")) {
    modal.addClass("active")
    $(".black-bg").addClass("active")
}

function hideModal() {
    $(".modal").removeClass("active")
    $(".black-bg").removeClass("active")
}

function checkLogin(loginIsBusy){
    if( loginIsBusy )
        $(".notification__item.login-busy").css("display", "block")

    setTimeout(() => {
        $(".notification__item.login-busy").css("display", "none")
    }, 7000)
}

$(document).ready(function () {
    $(".menu-item").on("mouseenter", showSubMenu);
    $(".menu-item").on("mouseleave", hideSubMenu);

    $(".next-img").on("click", function (e) {
        let activeImg = $("#album_img").data("active-img");
        $("#album_img").data("active-img", activeImg + 1);
        drawActiveImg(activeImg + 1, false);
    })

    $(".prev-img").on("click", function (e) {
        let activeImg = $("#album_img").data("active-img");
        drawActiveImg(activeImg - 1, false);
        $("#album_img").data("active-img", activeImg - 1);
    })


    $(document).on("click", ".foto_img", function (e) {
        let activeImg = $(this).data("img-id");
        $("#album_img").data("active-img", activeImg);

        drawActiveImg(activeImg, true);
        $(".wrapper_album_img").toggleClass("active");
    });

    $("#black_bg, .close").on("click", function () {
        $(".wrapper_album_img").toggleClass("active");
    });

    $(".admin-controller__btn").on("click", function () {
        $(".admin-controller__panel").toggleClass("active");
    })

    $(".edit-blog").on("click", function () {
        let blogID = $(this).parents("tr").data("id")

        showModal()
        $(".blog-id").val(blogID)
    })

    $(".blog-comment").on("click", function () {
        showModal()
    })

    $(".edit-blog-modal form").on("submit", function (e) {
        e.preventDefault()
        let blogID = $(this).find(".blog-id").val()
        let url = $(this).attr("action")
        let method = $(this).attr("method")
        let body = formattingFormData($(this))

        sendFetchRequest(method, url, body)
            .then((data) => {
                swal({
                    title: data.title,
                    icon: data.icon,
                })
                let editedBlog = $(".blog-edit-table").find(`tr[data-id='${blogID}']`)
                editedBlog.find(".blog-title").text(data.blogTitle)
                editedBlog.find(".blog-text").text(data.blogText)
                hideModal()
            })
            .catch((err) => {
                swal({
                    title: err.title,
                    icon: err.icon,
                })
            })
    })

    $("input[name='last_comment_num']").val($(".comments__num span").eq(-1).text())

    $(".blog-comment-modal form").on("submit", function (e) {
        e.preventDefault()
        let url = $(this).attr("action")
        let method = $(this).attr("method")
        let body = formattingFormData($(this))

        sendXHRRequset(method, url, body)
            .then((data) => {
                hideModal()
                $(".comments").append(data)
            })
            .catch((err) => {
                swal({
                    title: err.title,
                    icon: err.icon,
                })
            })
    })

    function attachScript(id, src){
        var element = document.createElement("script")
        element.src = src
        element.id = id
        document.getElementsByTagName("head")[0].appendChild(element)
    }

    $(".register-form input[name='login']").on("blur", function (e) {
        attachScript("search-login", "/user/checkLogin?login=" + $(this).val() )
    });

    $(".black-bg").on("click", hideModal)
})