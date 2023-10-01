// login Window
const $loginWindow = $('.login-window');
const $loginBtn = $('#loginBtn');

$loginBtn.on('click', function(e) {
    e.preventDefault();
    $loginWindow.slideToggle(200);
});

// account window
const $accountWindow = $('.account-window');
const $accountBtn = $('#accountBtn');

$accountBtn.on('click', function(e) {
    e.preventDefault();
    $accountWindow.slideToggle(200);
});

// notification window
const $notificationBtn = $('#notification-btn');
const $notificationWindow = $('.notification-window');

$notificationBtn.on('click', function() {
    $.ajax({
        dataType: 'json',
        url: 'scripts/get_notification.php',
        success: function(data) {
            $('#noti-window').empty();
            if (data.titles != undefined) {
                $.each(data.titles, function(index, title) {
                    var titleLI = "<li>You should return " + title.title + " today.</li>";
                    $(titleLI).appendTo('#noti-window');
                });
            } else {
                $('<li>No Notifications</li>').appendTo('#noti-window');
            }
        }
    });
    $notificationWindow.slideToggle(200);
});

// back to top btn function
const $backToTopButton = $('.back-to-top');
const $categoriesContainer = $('.categories-container');

$(window).scroll(function() {
    const scroll = $(window).scrollTop();
    if (scroll >= 500) {
        $backToTopButton.addClass('active');
    } else {
        $backToTopButton.removeClass('active');
    }
});

$backToTopButton.on('click', function() {
    $('html, body').animate({
        scrollTop: 0
    }, 300);
});


// change password input validatin
const $changePasswordBtn = $('.passwordBtn');
const $passwordField = $('.change_password #password');
const $errorMsg = $('<span class="error-msg">Password length must be between 8 and 20.</span>');

$passwordField.keyup(function() {
    let value = $(this).val();
    if (value.length < 8 || value.length > 20) {
        $passwordField.css({
            'border': '2px solid darkred'
        });
        $('.password h2').after($errorMsg);
        $errorMsg.css({
            'display': 'block'
        });
        $changePasswordBtn.prop('disabled', true);
        $changePasswordBtn.removeClass('allow');
    } else {
        $passwordField.css({
            'border': '1px solid green'
        });
        $errorMsg.remove();
        $changePasswordBtn.prop('disabled', false);
        $changePasswordBtn.addClass('allow');
    }
});

// prevent reserving a book if the book is not available
// the function will prevent the anchor element to open the reserve modal window
$(function() {
    $('.no-reserve').on('click', function(e) {
        e.preventDefault();
    });
});

/*
  reserve modal window
*/

const $modalWindow = $('.modal-window');
// const $modalWindowContainer = $('.modal-window-container');
const $reserveBtn = $('.can-reserve');

// opening the modal window
$reserveBtn.on('click', function(e) {
    e.preventDefault();
    $modalWindow.addClass('is-visible');
});

const $close = $('.close');

$close.click(function() {
    $modalWindow.removeClass('is-visible');
});

$modalWindow.on('click', function(e) {
    if ($(e.target).is($modalWindow))
        $modalWindow.removeClass('is-visible');
});

$(document).keyup(function(e) {
    if (e.keyCode == 27 && $modalWindow.hasClass('is-visible'))
        $modalWindow.removeClass('is-visible');
});

// setting the min date for reserving a book-title
const $pickup = $('.pickup input[type="date"]');

let date = new Date();

let year = date.getFullYear();
let month = date.getMonth() + 1;
let day = date.getDate();

$(function() {
    if (day < 10)
        day = '0' + day.toString();
    else
        day = day.toString();

    if (month < 10)
        month = '0' + month.toString();
    else
        month = month.toString();

    year = year.toString();

    let minimum = year + '-' + month + '-' + day;

    $pickup.prop('min', minimum);
});

// open books sub-list
const $books = $('#books');
const $booksBtn = $('#books-btn');

$booksBtn.on('click', function(e) {
    e.preventDefault();
    var opened = false;

    if ($books.hasClass('open') == true) {
        opened = true;
    }

    if (opened) {
        $books.removeClass('open');
        $booksBtn.removeClass('opened');
    } else {
        $books.addClass('open');
        $booksBtn.addClass('opened');
    }

});

// open users sub-list
const $users = $('#users');
const $userBtn = $('#users-btn');

$userBtn.on('click', function(e) {
    e.preventDefault();
    var opened = false;

    if ($users.hasClass('open') == true) {
        opened = true;
    }

    if (opened) {
        $users.removeClass('open');
        $userBtn.removeClass('opened');
    } else {
        $users.addClass('open');
        $userBtn.addClass('opened');
    }

});

// display edit and delete btn in the view books page
$('.table tbody tr').hover(
    function() {
        $(this).children('td.actions-panel').css('display', 'block');
    },
    function() {
        $(this).children('td.actions-panel').css('display', 'none');
    }
);

// filter search for specific book
const $tableRow = $('.table tbody tr');

$('#book-search-input').keyup(function() {
    let searchValue = $(this).val().toUpperCase();

    $tableRow.each(function(key, value) {
        let tableData = $(value).children('td:nth-child(2)');
        if (tableData) {
            if (tableData.html().toUpperCase().indexOf(searchValue) > -1) {
                $(value).css('display', '');
            } else {
                $(value).css('display', 'none');
            }
        }
    });
});

// filter author in add book
const $auRow = $('.author_content .row');

$('input[name="filterAu"]').keyup(function() {
    let searchValue = $(this).val().toUpperCase();

    $auRow.each(function(key, value) {
        let data = $(value).children('div:last-child');
        if (data) {
            if (data.html().toUpperCase().indexOf(searchValue) > -1) {
                $(value).css('display', '');
            } else {
                $(value).css('display', 'none');
            }
        }
    });
});

// add book page form
const $inputFormGroup = $('.form-group > input');
const $textarea = $('.form-group > textarea');

$inputFormGroup.focus(function() {
    $(this).prev('label').addClass('active');
}).focusout(function() {
    if ($(this).val() == '') {
        $(this).prev('label').removeClass('active');
    }
});

$textarea.focus(function() {
    $(this).prev('label').addClass('active');
}).focusout(function() {
    if ($(this).val() == '') {
        $(this).prev('label').removeClass('active');
    }
});


// Login function
$('#submit_login').click(function(e) {
    e.preventDefault();
    let email = $('#email').val();
    let password = $('#password').val();

    $.ajax({
        type: 'post',
        url: 'scripts/login.php',
        data: {
            email: email,
            password: password
        },
        success: function(response) {
            if (response === 'Login 0') {
                window.location.href = 'http://localhost/TheMovieStore/admin';
            } else if (response === 'Login 1') {
                window.location.reload();
            } else {
                $('.login-form > .error-msg').css('display', 'block');
                $('#email').focus();
                $('#email').select();
                $('#password').val('');
            }
        }
    });
    return false;
});

// Logout
$('#logout').click(function(e) {
    e.preventDefault();

    $.ajax({
        type: 'post',
        url: 'scripts/logout.php',
        success: function() {
            window.location.href = 'http://localhost/TheMovieStore/';
        }
    })
});

// append authors input
const $nbAuthor = $('select[name="nbAuthor"]');
const $authorFields = $('#author_fields');

$nbAuthor.change(function() {
    let val = $(this).val();
    if (val != 'select') {
        val = parseInt(val);
        $authorFields.empty();

        for (var i = 1; i <= val; i++) {
            $("<div class=\"form-group\">" +
                "<label class=\"control-label ac\">Author " + i + " *</label>" +
                "<input type=\"text\" name=\"author-" + i + "\" class=\"form-control\" required>" +
                "</div>").appendTo($authorFields);
        }
    } else {
        $authorFields.empty();
    }
});

// insert book to database
$('#add_book').click(function(e) {
    e.preventDefault();
    let name = $('input[name="name"]').val();
    let slug = $('input[name="slug"]').val();
    let year = $('input[name="year"]').val();
    let genre = $('select[name="genre"]').val();
    let price = $('input[name="price"]').val();
    let description = $('textarea[name="description"]').val();
    let storyLine = $('select[name="story_line"]').val();

    if (name != '' && slug != '' && year != '' && genre != '' && price != '' && description != '' && storyLine != '') {
        $('#errorAdd').css('display', 'none');

        let data = $('#add_book_form').serialize();

        $.ajax({
            type: 'post',
            url: 'scripts/addmovie.php',
            data: data,
            success: function(response) {
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
                if (response === "Inserted Successfully") {
                    $('#insertSuccessful').css('display', 'block');
                    $('#add_book_form')[0].reset();
                    $authorFields.empty();
                    setTimeout(function() {
                        $('#insertSuccessful').fadeOut();
                    }, 3000);
                } else {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 3000);
                    $('#insertfail').css('display', 'block');
                    setTimeout(function() {
                        $('#insertfail').fadeOut();
                    }, 3000);
                }
            }
        });

    } else {
        $('#errorAdd').css('display', 'block');
        $('html, body').animate({
            scrollTop: 0
        }, 300);
    }

});

// delete book modal window
const $deleteBookBtn = $('.delete-btn');
const $deleteModal = $('.delete-modal');
const $yesBtn = $('.action-btn button[name="yes"]');
const $bookTitle = $('.red-banner span');

var deleteBook = function(isbn) {

    if (isbn != null) {
        $.ajax({
            type: 'post',
            url: 'scripts/delete_book.php',
            data: {
                isbn: isbn
            },
            success: function(response) {
                if (response == "Deleted") {
                    window.location.reload();
                } else {
                    $deleteModal.removeClass('is-visible');
                }
            },
            beforeSend: function() {
                $('.red-banner p').html('Deleting...');
            }
        });
    }
}

$deleteBookBtn.click('click', function() {
    let bookName = $(this).parent().parent().parent().children('td:nth-child(2)').text();
    $bookTitle.html(bookName);
    let isbn = $(this).parent().parent().parent().children('td:nth-child(1)').text();
    $deleteModal.addClass('is-visible');

    $yesBtn.on('click', function() {
        $yesBtn.bind('click', deleteBook(isbn));
    });

});

$('.action-btn button[name="no"]').click(function() {
    $deleteModal.removeClass('is-visible');
    $yesBtn.unbind('click', deleteBook(null));
});


// update btn click
const $editBookBtn = $('.edit-btn');

$editBookBtn.on('click', function() {
    let isbn = $(this).data('isbn');
    window.location.href = 'http://localhost/TheMovieStore/admin/update-book.php?isbn=' + isbn;
});

// update page
const $selectType = $('select[name="update"]');
const $inputType = $('.update-card .form-group > input');
const $textArea = $('.update-card .form-group > textarea');
const $updateBtn = $('#update_book');

$selectType.change(function() {
    let val = $('select[name="update"]').val();
    if (val == 'select') {
        $inputType.css('display', 'none');
        $textArea.css('display', 'none');
        $updateBtn.css('display', 'none');
    } else if (val == 'description') {
        $inputType.css('display', 'none');
        $textArea.css('display', 'block');
        $updateBtn.css('display', 'block');
    } else {
        $inputType.css('display', 'block');
        $textArea.css('display', 'none');
        $updateBtn.css('display', 'block');
    }
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$updateBtn.on('click', function(e) {
    e.preventDefault();

    let val = $('select[name="update"]').val();
    let value;
    if (val == 'description') {
        value = $('.update-card .form-group > textarea').val();
    } else {
        value = $('.update-card .form-group > input').val();
    }

    if (value == '') {
        $('#errorAdd').css('display', 'block');
    } else {
        $('#errorAdd').css('display', 'none');

        let isbn = getUrlParameter('isbn');

        const $parentUpdate = $updateBtn.parent();

        $.ajax({
            type: 'post',
            url: 'scripts/updatebook.php',
            data: {
                selectType: val,
                selectValue: value,
                isbn: isbn
            },
            success: function(response) {
                if (response == 'updated') {
                    $parentUpdate.remove();
                    $('#insertSuccessful').css('display', 'block');
                    $('#insertfail').css('display', 'none');
                    setTimeout(function() {
                        window.location.href = 'http://localhost/TheMovieStore/admin/view-books.php';
                    }, 2000);
                } else {
                    $('#insertSuccessful').css('display', 'none');
                    $('#insertfail').css('display', 'block');
                }
            },
            beforeSend: function() {
                $updateBtn.remove();
                $parentUpdate.html('Updating...');
            }
        });
    }
});

// update user password
const $updatePassBtn = $('#change_password');

$updatePassBtn.on('click', function(e) {
    e.preventDefault();

    let passValue = $('#password').val();

    $.ajax({
        type: 'post',
        url: 'scripts/updatepass.php',
        data: {
            password: passValue
        },
        success: function(response) {
            if (response == 'passupdated') {
                window.location.href = 'http://localhost/TheMovieStore/profile.php';
            } else {
                alert('Can\'t update password!');
            }
        }
    });

});

// Add a new user to database
$('#add_user').click(function(e) {
    e.preventDefault();
    let fname = $('input[name="fname"]').val();
    let lname = $('input[name="lname"]').val();
    let email = $('input[name="user_email"]').val();
    let gender = $('select[name="gender"]').val();
    let birthDate = $('select[name="dob"]').val();
    let type = $('select[name="type"]').val();

    let data = $('#add_user_form').serialize();

    if (fname != '' && lname != '' && email != '' && gender != '' && type != '') {
        $('#errorAdd').css('display', 'none');

        console.log(data);

        $.ajax({
            type: 'post',
            url: 'scripts/adduser.php',
            data: data,
            success: function(response) {
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
                if (response === "Inserted Successfully") {

                    $('#newID').load('scripts/new_id.php');

                    $('#insertSuccessful').css('display', 'block');
                    $('#add_user_form')[0].reset();
                    setTimeout(function() {
                        $('#insertSuccessful').fadeOut();
                    }, 3000);
                } else {
                    $('#insertfail').css('display', 'block');
                    setTimeout(function() {
                        $('#insertfail').fadeOut();
                    }, 3000);
                }
            }
        });

    } else {
        $('#errorAdd').css('display', 'block');
    }

});

// Add a new movie to database
$('#add_movie').click(function(e) {
    e.preventDefault();
    let movie_name = $('input[name="movie_name"]').val();
    let slug = $('input[name="slug"]').val();
    let description = $('input[name="description"]').val();
    let story_line = $('select[name="story_line"]').val();
    let release_year = $('select[name="release_year"]').val();
    let price = $('select[name="price"]').val();

    let data = $('#add_movie_form').serialize();

    if (movie_name != '' && slug != '' && description != '' && story_line != '' && release_year != '' && price != '') {
        $('#errorAdd').css('display', 'none');

        console.log(data);

        $.ajax({
            type: 'post',
            url: 'scripts/addmovie.php',
            data: data,
            success: function(response) {
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
                if (response === "Inserted Successfully") {

                    $('#newID').load('scripts/new_id.php');

                    $('#insertSuccessful').css('display', 'block');
                    $('#add_movie_form')[0].reset();
                    setTimeout(function() {
                        $('#insertSuccessful').fadeOut();
                    }, 3000);
                } else {
                    $('#insertfail').css('display', 'block');
                    setTimeout(function() {
                        $('#insertfail').fadeOut();
                    }, 3000);
                }
            }
        });

    } else {
        $('#errorAdd').css('display', 'block');
    }

});

// Add a new genre to database
$('#add_genre').click(function(e) {
    e.preventDefault();
    let genre = $('input[name="genre"]').val();

    let data = $('#add_genre_form').serialize();

    if (genre != '' ) {
        $('#errorAdd').css('display', 'none');

        console.log(data);

        $.ajax({
            type: 'post',
            url: 'scripts/addgenre.php',
            data: data,
            success: function(response) {
                $('html, body').animate({
                    scrollTop: 0
                }, 300);
                if (response === "Inserted Successfully") {

                    $('#newID').load('scripts/new_id.php');

                    $('#insertSuccessful').css('display', 'block');
                    $('#add_genre_form')[0].reset();
                    setTimeout(function() {
                        $('#insertSuccessful').fadeOut();
                    }, 3000);
                } else {
                    $('#insertfail').css('display', 'block');
                    setTimeout(function() {
                        $('#insertfail').fadeOut();
                    }, 3000);
                }
            }
        });

    } else {
        $('#errorAdd').css('display', 'block');
    }

});

// display the new id
$(function() {
    $('#newID').load('scripts/new_id.php');
});

// display notofication
$(function() {
    $.ajax({
        dataType: 'json',
        url: 'scripts/get_notification.php',
        success: function(data) {
            $('#noti-windows').empty();
            if (data.titles != undefined) {
                $.each(data.titles, function(index, title) {
                    var titleLI = "<li>You should return " + title.title + " today.</li>";
                    $(titleLI).appendTo('#noti-window');
                });
            } else {
                $('<li>No Notifications</li>').appendTo('#noti-window');
            }
        }
    });
});

// display number of books to be returned in Notification
$('#notification-count').load('scripts/count_notification.php');

setInterval(function() {
    $('#notification-count').load('scripts/count_notification.php');
}, 5000);

// edit admin profile
const $adminProfileCard = $('#admin_profile_card');
const $editAdminCard = $('#edit_admin_card');
const $editAdminProfileBtn = $('#admin_profile_card .update-profile-btn');

$editAdminProfileBtn.click(function(e) {
    e.preventDefault();
    $adminProfileCard.css('display', 'none');
    $editAdminCard.addClass('visible');
});

// update admin profile in database using ajax
const $updateAdminBtn = $('#update_admin_btn');
const $adminEditForm = $('#edit_admin_profile');

$updateAdminBtn.click(function(e) {
    e.preventDefault();

    if ($('#edit_admin_profile input[name="password"]').val() != '') {

        $('#errorAdd').css('display', 'none');

        let data = $adminEditForm.serialize();
        console.log(data);

        $.ajax({
            type: 'post',
            url: 'scripts/update_pass.php',
            data: data,
            success: function(response) {
                if (response == 'updated') {
                    $('#insertSuccessful').css('display', 'block');
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                } else {
                    $('#insertfail').css('display', 'block');
                }
            }
        });

    } else {
        $('#errorAdd').css('display', 'block');
        setTimeout(function() {
            $('#errorAdd').fadeOut();
        }, 3000);
    }
});

// update user profile
const $selectWhatToUpdate = $('#selectupdateuser');
const $userType = $('select[name="usertype"]');
const $passUpdateField = $('#userupdatepass');
const $updateUserBtn = $('#edit_profile');

$selectWhatToUpdate.change(function() {

    let val = $(this).val();

    if (val == 'select') {
        $updateUserBtn.css('display', 'none');
        $userType.css('display', 'none');
        $passUpdateField.css('display', 'none');
    } else {
        if (val == 'permission') {
            $updateUserBtn.css('display', 'block');
            $userType.css('display', 'block');
            $passUpdateField.css('display', 'none');
        } else if (val == 'password') {
            $updateUserBtn.css('display', 'block');
            $userType.css('display', 'none');
            $passUpdateField.css('display', 'block');
        }
    }

});

$updateUserBtn.on('click', function(e) {
    e.preventDefault();

    let val = $selectWhatToUpdate.val();
    let value;

    if (val == 'permission') {
        value = $userType.val();
    } else {
        value = $passUpdateField.val();
    }

    if (val == 'permission' && value == 'select') {
        $('#errorAdd').css('display', 'block');
    } else if (val == 'password' && value == '') {
        $('#errorAdd').css('display', 'block');
    } else {
        $('#errorAdd').css('display', 'none');

        const $parentUpdate = $(this).parent();
        let user_id = getUrlParameter('userid');

        $.ajax({
            type: 'post',
            url: 'scripts/updateuser.php',
            data: {
                userid: user_id,
                selectType: val,
                value: value
            },
            success: function(response) {
                if (response == 'updated') {
                    $parentUpdate.remove();
                    $('#insertSuccessful').css('display', 'block');
                    $('#insertfail').css('display', 'none');
                    setTimeout(function() {
                        window.location.href = 'http://localhost/TheMovieStore/admin/view-users.php';
                    }, 2000);
                } else {
                    $('#insertSuccessful').css('display', 'none');
                    $('#insertfail').css('display', 'block');
                }
            },
            beforeSend: function() {
                $updateUserBtn.remove();
                $parentUpdate.html('Updating...');
            }
        });
    }

});

// register a user with a book
const $registerBtn = $('button[name="register"]');

$registerBtn.on('click', function() {

    let reqid = $(this).data('reqid');
    let parentCont = $(this).parent().parent();

    $.ajax({
        type: 'post',
        url: 'scripts/register.php',
        data: {
            requestid: reqid
        },
        success: function(response) {
            if (response == 'inserted') {
                parentCont.css('background', '#2de22d');
                parentCont.hide('slow', function() {
                    $(this).remove();
                });
            } else {
                parentCont.css('background', '#fd5a35');
                setTimeout(function() {
                    parentCont.css('background', '#fff');
                }, 3000);
            }
        }
    });
});

// return a book from users
const $returnBtn = $('button[name="return"]');

$returnBtn.on('click', function() {
    let requestid = $(this).data('reqid');
    let isbn = $(this).data('isbn');
    let parentCont = $(this).parent().parent();

    $.ajax({
        type: 'post',
        url: 'scripts/return.php',
        data: {
            requestid: requestid,
            isbn: isbn
        },
        success: function(response) {
            if (response == 'returned') {
                parentCont.css('background', '#2de22d');
                parentCont.hide('slow', function() {
                    $(this).remove();
                });
            } else {
                parentCont.css('background', '#fd5a35');
                setTimeout(function() {
                    parentCont.css('background', '#fff');
                }, 3000);
            }
        }
    });
});

// reserve a book
const $submitReserve = $('#sbmtReserve');

$submitReserve.on('click', function() {
    let address = $('input[name="address"]').val();
    let id = $(this).data('id');
    let price = $(this).data('price');

    if (date != '') {
        $.ajax({
            type: 'post',
            url: 'scripts/reserve.php',
            data: {
                id: id,
                address: address,
                price: price
            },
            success: function(response) {
                if (response == 'inserted') {
                    window.location.reload();
                }
            }
        });
    } else {
        $('#errorAdd').show();
    }
});

// catalog search
const $searchCatalogForm = $('#search-catalog');

$searchCatalogForm.submit(function(e) {

    let q = $('input[name="search"]').val();
    let searchBy = $('select[name="select_option"]').val();
    let sort = $('select[name="sort_option"]').val();
    let order = $('select[name="order"]').val();

    getMovies(q, searchBy, sort, order);
    e.preventDefault();

});

// retrieve the books as a json objects
// and display them
function getMovies(search, searchBy, sort, order) {

    $('.loader').css('display', 'block');
    $noResult = "<div class=\"no-result\">No results</div>";

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'scripts/get-movies.php',
        data: {
            search: search,
            searchBy: searchBy,
            sortBy: sort,
            order: order
        },
        success: function(data) {
            $('#article-wrapper').empty();
            if (data.movies != undefined) {

                $.each(data.movies, function(index, movie) {
                    console.log('hi');
                    var article =
                        "<article class=\"col-2 clearfix\">" +
                        "<div class=\"article-padding\">" +
                        "<div>" +
                        "<figure class=\"thumb\">" +
                        "<a href='movie.php?id=" + movie.id + "'>" +
                        "<img src='img/movies/" + movie.slug + ".jpg' alt='" + movie.name + "'>" +
                        "</a>" +
                        "</figure>" +
                        "</div>" +
                        "<div class=\"breif-description caption\">" +
                        "<a href='movie.php?id=" + movie.id + "'>" + movie.name + "</a>" +
                        "<p class=\"title\"><strong>Release Year:</strong> " + movie.release_year + "</p>" +
                        "<p class=\"title\"><strong>Genre: </strong>" + movie.genres + "</p>" +
                        "<p class=\"title\"><strong>Price: </strong>$" + movie.price + "</p>" +
                        "<p class=\"title\"><strong>Rating: </strong>" + movie.rating + "</p>" +
                        "<a href='movie.php?id=" + movie.id + "' class=\"reserve-btn\">View more" +
                        "</a></div></div></article>";

                    $(article).appendTo('#article-wrapper');
                });
            } else {
                $('<div class="no-result">No Results</div>').appendTo('#article-wrapper');
            }
        },
        complete: function() {
            $('.loader').css('display', 'none');
        }
    });
}

// add bottom padding to the catalog container based on
// article wrapper content
setInterval(function() {
    if ($('#article-wrapper article').length == 0) {
        $('.catalog-articles-container').css('padding-bottom', '550px');
    } else if ($('#article-wrapper article').length <= 2) {
        $('.catalog-articles-container').css('padding-bottom', '350px');
    } else {
        $('.catalog-articles-container').css('padding-bottom', '0');
    }
}, 1000);

// set active for genre list
$(function() {
    const $genreList = $('.categories-list li');
    let catalogURL = getUrlParameter('category');

    $genreList.each(function(index, element) {
        let anchor = $(element).children('a').attr('href');
        let split_href = anchor.split('=');
        let category = split_href[1];

        if (catalogURL == category)
            $(element).addClass('active');
    });
});

// add author to the database
$('#add_author').click(function(e) {
    e.preventDefault();
    let name = $('input[name="name"]').val();
    let data = $('#add_author_form').serialize();

    if (name != '') {
        $('#errorAdd').css('display', 'none');

        $.ajax({
            type: 'post',
            url: 'scripts/addgenre.php',
            data: data,
            success: function(response) {
                if (response === "inserted") {
                    $('#insertSuccessful').css('display', 'block');
                    $('#add_author_form')[0].reset();
                    setTimeout(function() {
                        $('#insertSuccessful').fadeOut();
                    }, 3000);
                } else {
                    $('#insertfail').css('display', 'block');
                    setTimeout(function() {
                        $('#insertfail').fadeOut();
                    }, 3000);
                }
            }
        });
    } else {
        $('#errorAdd').css('display', 'block');
    }
});

// $(':radio').change(function() {
//     console.log('New star rating: ' + this.value);
// });

// Rating function
$("input[name='stars']").change(function(e) {

    let rating = $(this).val();
    let movie_id = $(this).attr('data-movie');

    $.ajax({
        type: 'post',
        url: 'scripts/rating.php',
        data: {
            rating: rating,
            movie_id: movie_id
        },
        success: function(response) {
            if (response === 'success') {
                $('#ratingstars').css('display', 'none');
                $('#rating_value').html('Thanks for Rating<br>Your Rating:' + rating);
            } else {
                $('#rating_value').html('Error. Please try again.');
            }
        }
    });
    return false;
});