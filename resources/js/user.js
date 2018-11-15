$('#images').on('change', function () {
    var total_file = document.getElementById('images').files.length;
    for (var i = 0; i < total_file; i++) {
        $('#image_preview').append("<div class='col-md-3'><img width='100%' class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
    }
});

$('#title').on('keyup', function () {
    var title, slug;

    //Lấy text từ thẻ input title
    title = document.getElementById("title").value;

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');

    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');

    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");

    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');

    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

    //In slug ra textbox có id “slug”
    document.getElementById('slug').value = slug;
});

/* pusher comment*/
$(document).ready(function () {
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('ul.dropdown-lg');
    var auth = $('#auth_id').val();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('78e50552842a83edf0c5', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('CommentEvent');

    // Bind a function to a Event (the full Laravel class)

    channel.bind('send-comment', function (data) {
        var postUser = data.users;

        if (auth == postUser) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `<li class="list-item border bottom">
                                                    <a href="" class="media-hover p-15">
                                                        <div class="info">
                                                            <span class="title">` + data.user_id + `</span>
                                                            commented in
                                                            <span class="title">` + data.post_id + `</span>
                                                        </div>
                                                    </a>
                                                </li>`;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.counter').text(notificationsCount);
            notificationsWrapper.show();
        }
    });
});

function postComment(post_id) {
    var form = $('#comment_form_' + post_id);
    var formdata = form.serialize();
    var config = $('#config').val();

    $.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
    });

    $.ajax({
        type: 'POST',
        url: route('comments.store'),
        data: formdata,
        success: function (res) {
            if (res.info.images == null) {
                $avatar = config;
            } else {
                $avatar = res.info.images;
            }

            $('#load_comment_' + res.post_id).append(`<div class="social-comment" id="comment` + res.comment_id + `">
                                                                    <a href="" class="pull-left">
                                                                        <img alt="` + res.info.name + `" src="` + $avatar + `">
                                                                    </a>
                                                                    <div class="media-body">
                                                                    <a href=""> ` + res.info.name + ` </a> - <small class="text-muted">` + res.created_at + `</small> - <a data-id="` + res.comment_id + `" data-postid="` + post_id + `" class="btnDelete text-danger" title="Delete" onclick="deleteComment(` + res.comment_id + ` , `+ res.post_id +`)"><i class="fa fa-trash"></i></a>
                                                                    <br>
                                                                    ` + res.data.body + `
                                                                    <br>
                                                                    </div>
                                                                </div>`);
            var count = $('#countComment_' + res.post_id).html();
            $('#countComment_' + res.post_id).html(parseFloat(count) + 1);

            $('.body').val('');
        }
    });
}

function deleteComment(comment_id, post_id) {
    var delete_comment = $('#message_delete_comment').val();
    var yes = $('#message_yes').val();
    var no = $('#message_no').val();
    // var post_id = $(this).data('postid');

    swal({
            title: delete_comment,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            cancelButtonText: no,
            confirmButtonText: yes,
        },
        function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'DELETE',
                url: route('comments.destroy', comment_id),
                success: function (res) {
                    $('#comment' + comment_id).remove();
                    var count = $('#countComment_' + post_id).html();
                    $('#countComment_' + post_id).html(parseFloat(count) - 1);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //
                }
            });
        });
}

/* pusher like*/
$(document).ready(function () {
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('ul.dropdown-lg');
    var auth = $('#auth_id').val();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('78e50552842a83edf0c5', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('LikeEvent');

    // Bind a function to a Event (the full Laravel class)

    channel.bind('like-post', function (data) {
        var postUser = data.users;

        if (auth == postUser) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `<li class="list-item border bottom">
                                                    <a href="" class="media-hover p-15">
                                                        <div class="info">
                                                            <span class="title">` + data.user_id + `</span>
                                                            liked in
                                                            <span class="title">` + data.post_id + `</span>
                                                        </div>
                                                    </a>
                                                </li>`;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.counter').text(notificationsCount);
            notificationsWrapper.show();
        }
    });
});

/* Like */
$(document).on('click', '.like', function () {
    var post_id = $(this).data('postid');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: route('likes.store'),
        data: {
            user_id: user_id,
            post_id: post_id
        },
        success: function (res) {
            if (!res.error) {
                $('#like_' + post_id).replaceWith(`<i id="unlike_` + post_id + `" class="text-gray font-size-16 dislike" title="" data-typeid="1" data-postid="` + post_id + `" data-userid="` + user_id + `">
                                                                        <i class="fa fa-thumbs-up text-info p-r-5"></i>
                                                                    </i>`);
                var count = $('#countLike_' + post_id).html();
                $('#countLike_' + post_id).html(parseFloat(count) + 1);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

$(document).on('click', '.dislike', function () {
    var type_id = $(this).data('typeid');
    var post_id = $(this).data('postid');
    var user_id = $(this).data('userid');
    var like_id = $(this).data('likeid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'DELETE',
        url: route('likes.destroy', post_id),
        data: {
            post_id: post_id,
            user_id: user_id,
            like_id: like_id,
            type_id: type_id
        },
        success: function (res) {
            console.log(res);
            if (!res.error) {
                $('#unlike_' + post_id).replaceWith(`<a id="like_` + post_id + `" class="text-gray font-size-16 like" title="" data-typeid="0" data-postid="` + post_id + `" data-userid="` + user_id + `" data-likeid="` + like_id + `">
                                                                        <i class="fa fa-thumbs-o-up text-info p-r-5"></i>
                                                                    </a>`);
                var count = $('#countLike_' + post_id).html();
                $('#countLike_' + post_id).html(parseFloat(count) - 1);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

/* pusher report*/
$(document).ready(function () {
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('i[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('ul.dropdown-lg');
    var auth = $('#auth_id').val();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('78e50552842a83edf0c5', {
        cluster: 'ap1',
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('ReportEvent');

    // Bind a function to a Event (the full Laravel class)

    channel.bind('report-post', function (data) {
        var postUser = data.users;

        if (auth == postUser) {
            var existingNotifications = notifications.html();
            var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
            var newNotificationHtml = `<li class="list-item border bottom">
                                                    <a href="' + route('posts.show') + '" class="media-hover p-15">
                                                        <div class="info">
                                                            <span class="title">` + data.user_id + `</span>
                                                            reported in
                                                            <span class="title">` + data.post_id + `</span>
                                                        </div>
                                                    </a>
                                                </li>`;
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.counter').text(notificationsCount);
            notificationsWrapper.show();
        }
    });
});

/* Report */
$(document).on('click', '.report', function () {
    var post_id = $(this).data('postid');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: route('reports.store'),
        data: {
            post_id: post_id,
            user_id: user_id
        },
        success: function (res) {
            if (!res.error) {
                $('#report_' + post_id).replaceWith(`<a id="reported_` + post_id + `" class="text-gray font-size-16 reported" title="" data-typeid="1" data-postid="` + post_id + `" data-userid="` + user_id + `">
                                                                        <i class="fa fa-flag text-primary p-r-5"></i>
                                                                    </a>`);
                var count = $('#countReport_' + post_id).html();
                $('#countReport_' + post_id).html(parseFloat(count) + 1);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

$(document).on('click', '.reported', function () {
    var post_id = $(this).data('postid');
    var user_id = $(this).data('userid');
    var report_id = $(this).data('reportid');
    var type_id = $(this).data('typeid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'DELETE',
        url: route('reports.destroy', post_id),
        data: {
            post_id: post_id,
            user_id: user_id,
            type_id: type_id,
            report_id: report_id
        },
        success: function (res) {
            if (!res.error) {
                $('#reported_' + post_id).replaceWith(`<a id="report_` + post_id + `" class="text-gray font-size-16 report" title="" data-typeid="0" data-postid="` + post_id + `" data-userid="` + user_id + `" data-reportid="` + report_id + `">
                                                                        <i class="fa fa-flag-o text-primary p-r-5"></i>
                                                                    </a>`);
                var count = $('#countReport_' + post_id).html();
                $('#countReport_' + post_id).html(parseFloat(count) - 1);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

/* Following Topic */
$(document).on('click', '.follow', function () {
    var id = $(this).data('id');
    var type = $(this).data('type');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: route('follows.store'),
        data: {
            id: id,
            type: type,
            user_id: user_id,
        },
        success: function (res) {
            if (!res.error) {
                $('#follow_' + id).replaceWith(`<i id="following_` + id + `" class="btn btn-info btn-rounded btn-xs following" data-id="` + id + `" data-userid="` + user_id + `" data-type="App\\Models\\Topic">Following</i>`);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

$(document).on('click', '.following', function () {
    var id = $(this).data('id');
    var type = $(this).data('type');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'DELETE',
        url: route('follows.destroy', id),
        data: {
            id: id,
            type: type,
            user_id: user_id,
        },
        success: function (res) {
            if (!res.error) {
                $('#following_' + id).replaceWith(`<i id="follow_` + id + `" class="btn btn-info btn-rounded btn-xs follow" data-id="` + id + `" data-userid="` + user_id + `" data-type="App\\Models\\Topic">Follow</i>`);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

/* Following User */
$(document).on('click', '.followUser', function () {
    var id = $(this).data('id');
    var type = $(this).data('type');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: route('follows.store'),
        data: {
            id: id,
            type: type,
            user_id: user_id,
        },
        success: function (res) {
            if (!res.error) {
                $('#followUser_' + id).replaceWith(`<i id="followingUser_` + id + `" class="btn btn-info btn-rounded btn-outline btn-xs followingUser" data-id="` + id + `" data-userid="` + user_id + `" data-type="App\\Models\\User">Following</i>`);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

$(document).on('click', '.followingUser', function () {
    var id = $(this).data('id');
    var type = $(this).data('type');
    var user_id = $(this).data('userid');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'DELETE',
        url: route('destroyUser', id),
        data: {
            id: id,
            type: type,
            user_id: user_id,
        },
        success: function (res) {
            if (!res.error) {
                $('#followingUser_' + id).replaceWith(`<i id="followUser_` + id + `" class="btn btn-info btn-rounded btn-xs followUser" data-id="` + id + `" data-userid="` + user_id + `" data-type="App\\Models\\User">Follow</i>`);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //
        }
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(` + e.target.result + `)');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$('#imageUpload').change(function () {
    readURL(this);
});
