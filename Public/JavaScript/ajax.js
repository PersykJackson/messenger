//Ajax document
function logout()
{
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: 'logout'}),
        dataType: 'html'
    });
    window.location.href = "/account/login"
}
function get(action)
{
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: action}),
        dataType: 'html',
        success: function (data) {
            $(".body").html(data);
        }
    })
}
function addFriend() {
    let login = $(".friendLogin").val();
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: 'addFriend', Val: login}),
        dataType: 'html',
        success: function (data) {
            $('.message').html(data);
        }
    })
}
function getTalk(id) {
    let user = id.value;
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: 'getTalk', Val: user}),
        dataType: 'html',
        success: function (data) {
            $(".body").html(data);
        }
    })
}
function send(id) {
    let user = id.value;
    let message = $('.field').val();
    let data = [user, message];
    let reload = function() {
        getTalk(id)
    };
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: 'send', Val: data}),
        dataType: 'html',
        success: function (info) {
            if (info) {
                reload()
            }
        }
    });

}
function reload(action, value) {
    let arr = [action, value];
    $.ajax({
        url: '/ajax/index',
        type: 'POST',
        data: ({Action: 'reload', Val: arr}),
        dataType: 'html',
        success: function (data) {
            $(".body").html(data);
        }
    })
}